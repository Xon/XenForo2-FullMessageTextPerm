<?php

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