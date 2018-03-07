<?php

/*
 * This file is part of a XenForo add-on.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SV\FullMessageTextPermission\XF\Service\Post;

class Notifier extends XFCP_Notifier
{
    protected function canUserReceiveWatchNotification(\XF\Entity\User $user, $userReadDate)
    {
        $canReceive = parent::canUserReceiveWatchNotification($user, $userReadDate);

        if (!$canReceive)
        {
            $post = $this->post;

            if ($user->user_id == $post->user_id || $user->isIgnoring($post->user_id))
            {
                return false;
            }

            $canReceive = $user->Option->fmp_always_email_notify;
        }

        return $canReceive;
    }
}