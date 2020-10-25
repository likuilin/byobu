<?php

/*
 * This file is part of fof/byobu.
 *
 * Copyright (c) 2019 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\Byobu\Database;

use Flarum\Discussion\Discussion;
use Flarum\Extension\ExtensionManager;
use Flarum\User\User;
use Illuminate\Database\Query\Builder as Query;
use Illuminate\Database\Eloquent\Builder as Eloquent;

trait RecipientsConstraint
{
    /**
     * @param Query|Eloquent $query
     * @param User $user
     * @param bool $unify
     */
    public function constraint($query, User $user, bool $unify = false)
    {
        $method = $unify ? 'orWhere' : 'where';

        $query
            // Do a subquery where for filtering.
            ->{$method}(function ($query) use ($user) {
                // Open access for is_private discussions when the user is
                // part of the recipients either directly or through a group.
                if ($user->isGuest() === false) {
                    $this->forRecipient($query, $user->groups->pluck('id')->all(), $user->id);
                }

                // Open access for is_private discussions when the user handles
                // flags and any of the posts inside the discussion is flagged.
                if ($user->isGuest() === false
                    && $this->flagsInstalled()
                    && $user->hasPermission('user.viewPrivateDiscussionsWhenFlagged')
                    && $user->hasPermission('discussion.viewFlags')
                ) {
                    $this->whenFlagged($query);
                }
            });
    }

    protected function forRecipient($query, array $groupIds, int $userId)
    {
        $query->orWhereIn('discussions.id', function ($query) use ($groupIds, $userId) {
            $query->select('recipients.discussion_id')
                ->from('recipients')
                ->where(function ($query) use ($groupIds, $userId) {
                    $query
                        ->whereNull('recipients.removed_at')
                        ->where(function ($query) use ($groupIds, $userId) {
                            $query
                                ->whereIn('recipients.user_id', [$userId])
                                ->when(count($groupIds) > 0, function ($query) use ($groupIds) {
                                    $query->orWhereIn('recipients.group_id', $groupIds);
                                });
                        });
                });
        });
    }

    protected function whenFlagged($query)
    {
        $query->orWhereIn('discussions.id', function ($query) {
            Discussion::query()
                ->select('discussions.id')
                ->whereHas('posts.flags');
        });
    }

    protected function flagsInstalled(): bool
    {
        /** @var ExtensionManager $manager */
        $manager = app(ExtensionManager::class);

        return $manager->isEnabled('flarum-flags');
    }
}
