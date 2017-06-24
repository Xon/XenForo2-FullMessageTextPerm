<?php

namespace SV\FullMessageTextPermission\XF\Entity;

class User extends XFCP_User
{
	public function canReceiveFullEmailMessageContent($type, $nodeId = null, $warningConversation = false)
	{
		switch ($type)
		{
			case 'forum':
			case 'thread':
			case 'post':
				return $this->hasNodePermission($nodeId, 'emailIncludeMessage');
				break;
			case 'conversation_invite':
			case 'conversation_create':
			case 'conversation_reply':
				return $this->hasPermission('conversation', 'emailIncludeMessage');
				break;
		}

		throw new \InvalidArgumentException("Invalid type $type passed to canReceiveFullEmailMessageContent method.");
	}
}