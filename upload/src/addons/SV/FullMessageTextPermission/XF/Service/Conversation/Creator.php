<?php

namespace SV\FullMessageTextPermission\XF\Service\Conversation;

class Creator extends XFCP_Creator
{
	protected $forceNotification = false;

	public function forceNotification($forceNotification = null)
	{
		if ($forceNotification === null)
		{
			$forceNotification = true;
		}

		$this->forceNotification = $forceNotification;

		return $this;
	}

	public function getForceNotification()
	{
		return $this->forceNotification;
	}

	public function sendNotifications()
	{
		$this->app->sv_fmtp_force_notif = $this->forceNotification;

		parent::sendNotifications();
	}
}