<?php

/*
 * This file is part of a XenForo add-on.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SV\FullMessageTextPermission\XF\Service\Conversation;

use SV\ContentRatings\Globals;

class Creator extends XFCP_Creator
{
    protected $forceNotification = false;

    public function forceNotification($forceNotification = null)
    {
        if ($forceNotification === null)
        {
            $forceNotification = true;
        }

        $this->forceNotification = $forceNotification;

        return $this;
    }

    public function getForceNotification()
    {
        return $this->forceNotification;
    }

    public function sendNotifications()
    {
        Globals::$forceNotify = $this->forceNotification;

        parent::sendNotifications();
    }
}