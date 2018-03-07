<?php

/*
 * This file is part of a XenForo add-on.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SV\FullMessageTextPermission\XF\Service\Post;

use SV\FullMessageTextPermission\XF\Entity\UserOption;

class Notifier extends XFCP_Notifier
{
    protected function canUserReceiveWatchNotification(\XF\Entity\User $user, $userReadDate)
    {
        $canReceive = parent::canUserReceiveWatchNotification($user, $userReadDate);

        if (!$canReceive && \XF::options()->fmp_allowAlwaysEmailWatched)
        {
            $post = $this->post;

            if ($user->user_id == $post->user_id || $user->isIgnoring($post->user_id))
            {
                return false;
            }

            /** @var UserOption $option */
            $option = $user->Option;
            $canReceive = $option->fmp_always_email_notify;
        }

        return $canReceive;
    }
}