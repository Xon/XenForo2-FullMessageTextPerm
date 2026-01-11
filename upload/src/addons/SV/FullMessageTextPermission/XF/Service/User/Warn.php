<?php
/**
 * @noinspection PhpMissingReturnTypeInspection
 */

namespace SV\FullMessageTextPermission\XF\Service\User;

use SV\FullMessageTextPermission\XF\Service\Conversation\Creator as ExtendedConversationCreatorService;
use XF\Entity\Warning as WarningEntity;

/**
 * @extends \XF\Service\User\Warn
 */
class Warn extends XFCP_Warn
{
    protected function setupConversation(WarningEntity $warning)
    {
        /** @var ExtendedConversationCreatorService $creator */
        $creator = parent::setupConversation($warning);

        if (\XF::options()->sv_fmp_always_send_warning ?? true)
        {
            $creator->forceConversationNotification(true);
        }

        return $creator;
    }
}