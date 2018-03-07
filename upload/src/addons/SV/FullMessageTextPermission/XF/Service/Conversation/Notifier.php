<?php

/*
 * This file is part of a XenForo add-on.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SV\FullMessageTextPermission\XF\Service\Conversation;

use XF\Entity\User;

class Notifier extends XFCP_Notifier
{
    protected function _canUserReceiveNotification(User $user, User $sender = null)
    {
        if ($this->app->offsetExists('sv_fmtp_force_notif') && $this->app->sv_fmtp_force_notif)
        {
            return true;
        }

        return parent::_canUserReceiveNotification($user, $sender);
    }
}