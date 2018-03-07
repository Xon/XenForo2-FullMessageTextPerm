<?php

/*
 * This file is part of a XenForo add-on.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SV\FullMessageTextPermission\XF\Service\Conversation;

use SV\ContentRatings\Globals;
use XF\Entity\User;

class Notifier extends XFCP_Notifier
{
    protected function _canUserReceiveNotification(User $user, User $sender = null)
    {
        if (Globals::$forceNotify)
        {
            return true;
        }

        return parent::_canUserReceiveNotification($user, $sender);
    }
}