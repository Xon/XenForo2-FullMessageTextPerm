<?php
/**
 * @noinspection PhpMissingReturnTypeInspection
 */

namespace SV\FullMessageTextPermission\XF\Admin\Controller;

use XF\Entity\User as UserEntity;
use XF\Mvc\FormAction;
use XF\Mvc\Reply\Exception as ReplyException;

/**
 * Class User
 *
 * @package SV\FullMessageTextPermission
 */
class User extends XFCP_User
{
    /**
     * @param UserEntity $user
     * @return FormAction
     * @throws ReplyException
     */
    protected function userSaveProcess(UserEntity $user)
    {
        $formAction = parent::userSaveProcess($user);

        if (\XF::options()->sv_fmp_allow_always_email_watched ?? false)
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