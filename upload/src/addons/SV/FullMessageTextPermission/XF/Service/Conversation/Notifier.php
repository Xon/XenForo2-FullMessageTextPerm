<?php

/*
 * This file is part of a XenForo add-on.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SV\FullMessageTextPermission\XF\Service\Conversation;

use SV\ContentRatings\Globals;
use XF\App;
use XF\Entity\ConversationMaster;
use XF\Entity\ConversationMessage;
use XF\Entity\User;

class Notifier extends XFCP_Notifier
{
    /** @var bool */
    protected $forceWarningNotification = false;
    /** @var bool */
    protected $actionTypeForWarning = null;

    public function __construct(App $app, ConversationMaster $conversation)
    {
        if (Globals::$forceWarningNotification !== null)
        {
            $this->forceWarningNotification = Globals::$forceWarningNotification;
        }
        parent::__construct($app, $conversation);
    }

    protected function _sendNotifications($actionType, array $notifyUsers, ConversationMessage $message = null, User $sender = null)
    {
        if ($this->forceWarningNotification)
        {
            $this->actionTypeForWarning = 'conversation_' . $actionType;
        }

        return parent::_sendNotifications($actionType, $notifyUsers, $message, $sender);
    }


    protected function _canUserReceiveNotification(User $user, User $sender = null)
    {
        if ($this->forceWarningNotification && $this->actionTypeForWarning)
        {
            /** @var \SV\FullMessageTextPermission\XF\Entity\User $user */
            $user->configureFullEmailMessageContent($this->actionTypeForWarning, null, true);
        }

        return parent::_canUserReceiveNotification($user, $sender);
    }
}