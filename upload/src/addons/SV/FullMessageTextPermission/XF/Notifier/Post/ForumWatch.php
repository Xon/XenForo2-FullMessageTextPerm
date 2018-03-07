<?php

/*
 * This file is part of a XenForo add-on.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SV\FullMessageTextPermission\XF\Notifier\Post;

use SV\FullMessageTextPermission\XF\Entity\UserOption;
use XF\App;
use XF\Entity\Post;
use XF\Entity\User;

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
        // \XF::$time is anchored to the start of the request, but post date is based off the wall clock
        $this->now = intval(microtime(true));
        $this->allowAlwaysSent = \XF::options()->fmp_allowAlwaysEmailWatched;
        parent::__construct($app, $post, $actionType);
    }

    public function canNotify(User $user)
    {
        if ($this->allowAlwaysSent)
        {
            /** @var UserOption $option */
            $option = $user->Option;
            if ($option->fmp_always_email_notify)
            {
                $this->userReadDates[$user->user_id] = $this->now;
            }
        }
        return parent::canNotify($user);
    }

    public function sendEmail(User $user)
    {
        /** @var \SV\FullMessageTextPermission\XF\Entity\User $user */
        $user->configureFullEmailMessageContent('forum_'.$this->actionType, $this->post->Thread->node_id, true);

        return parent::sendEmail($user);
    }
}