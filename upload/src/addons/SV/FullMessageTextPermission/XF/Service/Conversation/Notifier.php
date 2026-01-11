<?php
/**
 * @noinspection PhpMissingReturnTypeInspection
 */

namespace SV\FullMessageTextPermission\XF\Service\Conversation;

use SV\FullMessageTextPermission\Globals;
use XF\App;
use XF\Entity\ConversationMaster as ConversationMasterEntity;
use XF\Entity\ConversationMessage as ConversationMessageEntity;
use XF\Entity\User as UserEntity;

/**
 * @extends \XF\Service\Conversation\Notifier
 */
class Notifier extends XFCP_Notifier
{
    /** @var bool */
    protected $forceConversationNotification = false;
    /** @var string|null */
    protected $actionTypeForWarning = null;

    public function __construct(App $app, ConversationMasterEntity $conversation)
    {
        $this->forceConversationNotification = Globals::$forceConversationNotification ?? false;
        parent::__construct($app, $conversation);
    }

    protected function _sendNotifications($actionType, array $notifyUsers, ?ConversationMessageEntity $message = null, ?UserEntity $sender = null)
    {
        $this->actionTypeForWarning = 'conversation_' . $actionType;

        return parent::_sendNotifications($actionType, $notifyUsers, $message, $sender);
    }


    protected function _canUserReceiveNotification(UserEntity $user, ?UserEntity $sender = null)
    {
        if ($this->actionTypeForWarning)
        {
            /** @var \SV\FullMessageTextPermission\XF\Entity\User $user */
            $user->configureFullEmailMessageContent($this->actionTypeForWarning, null, $this->forceConversationNotification);
        }

        return parent::_canUserReceiveNotification($user, $sender);
    }
}