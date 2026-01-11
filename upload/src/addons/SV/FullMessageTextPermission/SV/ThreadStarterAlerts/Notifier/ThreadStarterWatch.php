<?php
/**
 * @noinspection PhpMissingReturnTypeInspection
 */

namespace SV\FullMessageTextPermission\SV\ThreadStarterAlerts\Notifier;

use SV\FullMessageTextPermission\XF\Entity\User as ExtendedUserEntity;
use XF\Entity\User as UserEntity;

/**
 * @extends \SV\ThreadStarterAlerts\Notifier\ThreadStarterWatch
 */
class ThreadStarterWatch extends XFCP_ThreadStarterWatch
{
    public function sendEmail(UserEntity $user)
    {
        $type = ($this->actionType === 'thread' ? 'forum_thread' : 'thread_reply');
        /** @var ExtendedUserEntity $user */
        $user->configureFullEmailMessageContent($type, $this->post->Thread->node_id);
        try
        {
            return parent::sendEmail($user);
        }
        finally
        {
            $user->resetCanReceiveFullEmailMessageContent();
        }
    }
}