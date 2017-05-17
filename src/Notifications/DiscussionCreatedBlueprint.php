<?php

namespace Flagrow\Byobu\Notifications;

use Flarum\Core\Discussion;
use Flarum\Core\Notification\BlueprintInterface;
use Flarum\Core\Notification\MailableInterface;
use Flarum\Locale\Translator;

class DiscussionCreatedBlueprint implements MailableInterface, BlueprintInterface
{
    /**
     * @var Discussion
     */
    protected $discussion;
    /**
     * @var Translator
     */
    protected $trans;

    public function __construct(Discussion $discussion, Translator $trans)
    {
        $this->discussion = $discussion;
        $this->trans = $trans;
    }

    /**
     * Get the user that sent the notification.
     *
     * @return \Flarum\Core\User|null
     */
    public function getSender()
    {
        return $this->discussion->startUser;
    }

    /**
     * Get the model that is the subject of this activity.
     *
     * @return \Flarum\Database\AbstractModel|null
     */
    public function getSubject()
    {
        return $this->discussion->title;
    }

    /**
     * Get the data to be stored in the notification.
     *
     * @return array|null
     */
    public function getData()
    {
        // TODO: Implement getData() method.
    }

    /**
     * Get the serialized type of this activity.
     *
     * @return string
     */
    public static function getType()
    {
        return 'byobuPrivateDiscussionCreated';
    }

    /**
     * Get the name of the model class for the subject of this activity.
     *
     * @return string
     */
    public static function getSubjectModel()
    {
        return Discussion::class;
    }

    /**
     * Get the name of the view to construct a notification email with.
     *
     * @return string
     */
    public function getEmailView()
    {
        return ['text' => 'byobu::emails.privateDiscussionCreated'];
    }

    /**
     * Get the subject line for a notification email.
     *
     * @return string
     */
    public function getEmailSubject()
    {
        return $this->trans->trans('flagrow-byobu.notifications.private_discussion_created.title', [
            'user' => $this->discussion->startUser->username,
            'title' => $this->discussion->title
        ]);
    }
}
