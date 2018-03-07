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
use XF\Entity\User;

class Notifier extends XFCP_Notifier
{
    /** @var bool */
    protected $forceNotify = false;

    public function __construct(App $app, ConversationMaster $conversation)
    {
        if (Globals::$forceNotify !== null)
        {
            $this->forceNotify = Globals::$forceNotify;
        }
        parent::__construct($app, $conversation);
    }

    protected function _canUserReceiveNotification(User $user, User $sender = null)
    {
        if ($this->forceNotify)
        {
            return true;
        }

        return parent::_canUserReceiveNotification($user, $sender);
    }
}