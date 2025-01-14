<?php

/*
 * This file is part of fof/byobu.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\Byobu\Access;

use Flarum\Discussion\Discussion;
use Flarum\User\Access\AbstractPolicy;
use Flarum\User\User;
use FoF\Byobu\Database\RecipientsConstraint;
use FoF\Byobu\Discussion\Screener;

class DiscussionPolicy extends AbstractPolicy
{
    use RecipientsConstraint;

    /**
     * @param User       $actor
     * @param Discussion $discussion
     *
     * @return bool|void
     */
    public function startWithoutApproval(User $actor, Discussion $discussion)
    {
        return $this->approveIfPrivate($discussion);
    }

    /**
     * @param User       $actor
     * @param Discussion $discussion
     *
     * @return bool|void
     */
    public function replyWithoutApproval(User $actor, Discussion $discussion)
    {
        return $this->approveIfPrivate($discussion);
    }

    /**
     * @param Discussion $discussion
     *
     * @return bool|void
     */
    private function approveIfPrivate(Discussion $discussion)
    {
        /** @var Screener $screener */
        $screener = resolve('byobu.screener');
        $screener = $screener->fromDiscussion($discussion);

        return $screener->isPrivate() ? $this->allow() : null;
    }

    public function bypassTagCounts(User $actor, Discussion $discussion)
    {
        $isByobu = $discussion->isByobu;

        $discussion->offsetUnset('isByobu');

        return $isByobu ? $this->allow() : null;
    }
}
