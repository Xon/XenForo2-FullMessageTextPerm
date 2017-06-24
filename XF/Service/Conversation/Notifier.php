<?php

namespace SV\FullMessageTextPermission\XF\Service\Conversation;

class Notifier extends XFCP_Notifier
{
	protected function _canUserReceiveNotification(\XF\Entity\User $user, \XF\Entity\User $sender = null)
	{
		if ($this->app->offsetExists('sv_fmtp_force_notif') && $this->app->sv_fmtp_force_notif)
		{
			return true;
		}

		return parent::_canUserReceiveNotification($user, $sender);
	}
}