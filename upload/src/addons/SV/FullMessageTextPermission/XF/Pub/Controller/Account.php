<?php

/*
 * This file is part of a XenForo add-on.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
                        'fmp_always_email_notify' => 'bool'
                    ]
                ]);

            $userOptions = $visitor->getRelationOrDefault('Option');
            $form->setupEntityInput($userOptions, $input['option']);
        }

        return $form;
    }
}