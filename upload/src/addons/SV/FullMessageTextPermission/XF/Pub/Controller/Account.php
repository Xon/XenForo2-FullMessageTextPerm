<?php

namespace SV\FullMessageTextPermission\XF\Pub\Controller;

use XF\Entity\User;

class Account extends XFCP_Account
{
    protected function preferencesSaveProcess(User $visitor)
    {
        $form = parent::preferencesSaveProcess($visitor);

        if (\XF::options()->fmp_allowAlwaysEmailWatched)
        {
            $input = $this->filter(
                [
                    'option' => [
                        'fmp_always_email_notify' => 'bool',
                    ],
                ]);

            $userOptions = $visitor->getRelationOrDefault('Option');
            $form->setupEntityInput($userOptions, $input['option']);
        }

        return $form;
    }
}