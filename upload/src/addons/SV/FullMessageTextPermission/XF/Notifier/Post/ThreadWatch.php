<?php
/**
 * @noinspection PhpMissingReturnTypeInspection
 */

namespace SV\FullMessageTextPermission\XF\Notifier\Post;

use SV\FullMessageTextPermission\XF\Entity\User as ExtendedUserEntity;
use XF\App;
use XF\Entity\Post as PostEntity;
use XF\Entity\User as UserEntity;
use function min;

/**
 * @extends \XF\Notifier\Post\ThreadWatch
 */
class ThreadWatch extends XFCP_ThreadWatch
{
    /** @var int */
    protected $now;
    /** @var bool */
    protected $allowAlwaysSent;

    public function __construct(App $app, PostEntity $post, $actionType)
    {
        // canNotify clamps if the last read-date is after the last post, but we want to alert anyway
        $this->now = min($post->post_date, $post->Thread->last_post_date);
        $this->allowAlwaysSent = \XF::options()->sv_fmp_allow_always_email_watched ?? false;
        parent::__construct($app, $post, $actionType);
    }

    public function canNotify(UserEntity $user)
    {
        if ($this->allowAlwaysSent)
        {
            /** @var ExtendedUserEntity $user */
            if ($user->Option->fmp_always_email_notify ?? false)
            {
                $this->userReadDates[$user->user_id] = $this->now;
            }
        }

        return parent::canNotify($user);
    }

    public function sendEmail(UserEntity $user)
    {
        /** @var ExtendedUserEntity $user */
        $user->configureFullEmailMessageContent('thread_' . $this->actionType, $this->post->Thread->node_id);
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