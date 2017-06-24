<?php

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