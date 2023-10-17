<?php
/**
 * @noinspection PhpMissingReturnTypeInspection
 */

namespace SV\FullMessageTextPermission\XF\Notifier\Post;

use SV\FullMessageTextPermission\XF\Entity\UserOption;
use XF\App;
use XF\Entity\Post;
use XF\Entity\User;
use function min;

/**
 * Extends \XF\Notifier\Post\ForumWatch
 */
class ForumWatch extends XFCP_ForumWatch
{
    /** @var int */
    protected $now;
    /** @var bool */
    protected $allowAlwaysSent;

    public function __construct(App $app, Post $post, $actionType)
    {
        // canNotify clamps if the last read-date is after the last post, but we want to alert anyway
        $this->now = min($post->post_date, $post->Thread->last_post_date);
        $this->allowAlwaysSent = \XF::options()->sv_fmp_allow_always_email_watched ?? false;
        parent::__construct($app, $post, $actionType);
    }

    public function canNotify(User $user)
    {
        if ($this->allowAlwaysSent)
        {
            /** @var UserOption $option */
            $option = $user->Option;
            if ($option->fmp_always_email_notify ?? false)
            {
                $this->userReadDates[$user->user_id] = $this->now;
            }
        }

        return parent::canNotify($user);
    }

    public function sendEmail(User $user)
    {
        /** @var \SV\FullMessageTextPermission\XF\Entity\User $user */
        $user->configureFullEmailMessageContent('forum_' . $this->actionType, $this->post->Thread->node_id);
        try
        {
            return parent::sendEmail($user);
        }
        finally
        {
            $user->resetCanReceiveFullEmailMessageContent();
        }
    }
}