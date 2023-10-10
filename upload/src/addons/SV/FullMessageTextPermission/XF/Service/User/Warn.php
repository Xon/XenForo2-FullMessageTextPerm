<?php
/**
 * @noinspection PhpMissingReturnTypeInspection
 */

namespace SV\FullMessageTextPermission\XF\Service\User;

use SV\FullMessageTextPermission\XF\Service\Conversation\Creator;
use XF\Entity\Warning;

class Warn extends XFCP_Warn
{
    protected function setupConversation(Warning $warning)
    {
        /** @var Creator $creator */
        $creator = parent::setupConversation($warning);

        if (\XF::options()->sv_fmp_always_send_warning ?? true)
        {
            $creator->forceConversationNotification(true);
        }

        return $creator;
    }
}