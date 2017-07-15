<?php

namespace SV\FullMessageTextPermission;

use XF\Mvc\Entity\Entity;

class Listener
{
	public static function userOptionEntityStructure(\XF\Mvc\Entity\Manager $em, \XF\Mvc\Entity\Structure &$structure)
	{
		$structure->columns['fmp_always_email_notify'] = [
			'type' => Entity::BOOL,
			'default' => 0
		];
	}
}