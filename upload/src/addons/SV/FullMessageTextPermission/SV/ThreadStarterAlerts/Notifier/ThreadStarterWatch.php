<?php

namespace SV\FullMessageTextPermission\SV\ThreadStarterAlerts\Notifier;

use XF\Entity\User;

/**
 * Extends \SV\ThreadStarterAlerts\Notifier\ThreadStarterWatch
 */
class ThreadStarterWatch extends XFCP_ThreadStarterWatch
{
    public function sendEmail(User $user)
    {
        /** @var \SV\FullMessageTextPermission\XF\Entity\User $user */
        $user->configureFullEmailMessageContent('thread_' . $this->actionType, $this->post->Thread->node_id);

        return parent::sendEmail($user);
    }
}