<?php

namespace SV\FullMessageTextPermission\XF\Admin\Controller;

/**
 * Class User
 *
 * @package SV\FullMessageTextPermission
 */
class User extends XFCP_User
{
    /**
     * @param \XF\Entity\User $user
     * @return \XF\Mvc\FormAction
     * @throws \XF\Mvc\Reply\Exception
     */
    protected function userSaveProcess(\XF\Entity\User $user)
    {
        $formAction = parent::userSaveProcess($user);

        if (\XF::options()->fmp_allowAlwaysEmailWatched)
        {
            $input = $this->filter([
                'option' => [
                    'fmp_always_email_notify' => 'bool',
                ],
            ]);

            $userOptions = $user->getRelationOrDefault('Option');
            $formAction->setupEntityInput($userOptions, $input['option']);
        }

        return $formAction;
    }
}