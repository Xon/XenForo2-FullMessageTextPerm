<?php

namespace SV\FullMessageTextPermission\XF\Service\User;

class Warn extends XFCP_Warn
{
	// TODO: When the typo is fixed, this needs updating.
	protected function setupConveration(\XF\Entity\Warning $warning)
	{
		/** @var \SV\FullMessageTextPermission\XF\Service\Conversation\Creator $creator */
		$creator = parent::setupConveration($warning);

		if (\XF::options()->FMP_AlwaysSendWarning)
		{
			$creator->forceNotification(true);
		}

		return $creator;
	}
}