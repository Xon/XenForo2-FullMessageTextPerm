<?php
/**
 * @noinspection PhpMissingReturnTypeInspection
 */

namespace SV\FullMessageTextPermission\SV\ThreadStarterAlerts\Notifier;

use XF\Entity\User;

/**
 * Extends \SV\ThreadStarterAlerts\Notifier\ThreadStarterWatch
 */
class ThreadStarterWatch extends XFCP_ThreadStarterWatch
{
    public function sendEmail(User $user)
    {
        $type = ($this->actionType === 'thread' ? 'forum_thread' : 'thread_reply');
        /** @var \SV\FullMessageTextPermission\XF\Entity\User $user */
        $user->configureFullEmailMessageContent($type, $this->post->Thread->node_id);

        return parent::sendEmail($user);
    }
}