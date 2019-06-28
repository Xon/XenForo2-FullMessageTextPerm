<?php

namespace SV\FullMessageTextPermission\XF\Service\Conversation;

use SV\FullMessageTextPermission\Globals;
use XF\App;
use XF\Entity\ConversationMaster;
use XF\Entity\ConversationMessage;
use XF\Entity\User;

class Notifier extends XFCP_Notifier
{
    /** @var bool */
    protected $forceConversationNotification = false;
    /** @var bool */
    protected $actionTypeForWarning = null;

    public function __construct(App $app, ConversationMaster $conversation)
    {
        if (Globals::$forceConversationNotification !== null)
        {
            $this->forceConversationNotification = Globals::$forceConversationNotification;
        }
        parent::__construct($app, $conversation);
    }

    protected function _sendNotifications($actionType, array $notifyUsers, ConversationMessage $message = null, User $sender = null)
    {
        $this->actionTypeForWarning = 'conversation_' . $actionType;

        return parent::_sendNotifications($actionType, $notifyUsers, $message, $sender);
    }


    protected function _canUserReceiveNotification(User $user, User $sender = null)
    {
        if ($this->actionTypeForWarning)
        {
            /** @var \SV\FullMessageTextPermission\XF\Entity\User $user */
            $user->configureFullEmailMessageContent($this->actionTypeForWarning, null, $this->forceConversationNotification);
        }

        return parent::_canUserReceiveNotification($user, $sender);
    }
}