<?php

/*
 * This file is part of a XenForo add-on.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SV\FullMessageTextPermission\XF\Service\User;

use SV\FullMessageTextPermission\Globals;

class Welcome extends XFCP_Welcome
{
    public function sendMessage()
    {
        Globals::$forceConversationNotification = \XF::options()->FMP_AlwaysSendWelcome;
        try
        {
            parent::sendMessage();
        }
        finally
        {
            Globals::$forceConversationNotification = null;
        }
    }
}