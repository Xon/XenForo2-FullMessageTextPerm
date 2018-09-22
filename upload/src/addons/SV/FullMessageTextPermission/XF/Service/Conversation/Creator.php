<?php

/*
 * This file is part of a XenForo add-on.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SV\FullMessageTextPermission\XF\Service\Conversation;

use SV\FullMessageTextPermission\Globals;

class Creator extends XFCP_Creator
{
    protected $forceConversationNotification = null;

    public function forceConversationNotification($forceConversationNotification = null)
    {
        if ($forceConversationNotification === null)
        {
            return $this->forceConversationNotification;
        }

        $this->forceConversationNotification = $forceConversationNotification;

        return $this;
    }

    public function sendNotifications()
    {
        Globals::$forceConversationNotification = $this->forceConversationNotification;
        try
        {
            parent::sendNotifications();
        }
        finally
        {
            Globals::$forceConversationNotification = null;
        }
    }
}