<?php

/*
 * This file is part of a XenForo add-on.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SV\FullMessageTextPermission\XF\Service\User;

use XF\Entity\Warning;

class Warn extends XFCP_Warn
{
    protected function setupConversation(Warning $warning)
    {
        /** @var \SV\FullMessageTextPermission\XF\Service\Conversation\Creator $creator */
        $creator = parent::setupConversation($warning);

        if (\XF::options()->FMP_AlwaysSendWarning)
        {
            $creator->forceConversationNotification(true);
        }

        return $creator;
    }
}