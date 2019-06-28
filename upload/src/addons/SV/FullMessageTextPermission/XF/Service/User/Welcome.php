<?php

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