<?php

namespace SV\FullMessageTextPermission\XF\Service\User;

use SV\FullMessageTextPermission\Globals;

class Welcome extends XFCP_Welcome
{
    public function sendMessage()
    {
        Globals::$forceConversationNotification = \XF::options()->sv_fmp_always_send_welcome ?? true;
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