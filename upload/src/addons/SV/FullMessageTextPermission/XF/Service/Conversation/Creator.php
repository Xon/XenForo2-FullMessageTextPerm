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
    protected $forceWarningNotification = null;

    public function forceWarningNotification($forceWarningNotification = null)
    {
        if ($forceWarningNotification === null)
        {
            return $this->forceWarningNotification;
        }

        $this->forceWarningNotification = $forceWarningNotification;

        return $this;
    }

    public function sendNotifications()
    {
        Globals::$forceWarningNotification = $this->forceWarningNotification;
        try
        {
            parent::sendNotifications();
        }
        finally
        {
            Globals::$forceWarningNotification = null;
        }
    }
}