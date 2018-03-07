<?php

/*
 * This file is part of a XenForo add-on.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SV\FullMessageTextPermission\XF\Entity;

class User extends XFCP_User
{
    /**
     * @param string $type
     * @param int    $nodeId
     * @param bool   $warningConversation
     * @return bool
     */
    public function canReceiveFullEmailMessageContent(/** @noinspection PhpUnusedParameterInspection */
        $type, $nodeId = null, $warningConversation = false)
    {
        switch ($type)
        {
            case 'forum':
            case 'thread':
            case 'post':
                return $this->hasNodePermission($nodeId, 'emailIncludeMessage');
                break;
            case 'conversation_invite':
            case 'conversation_create':
            case 'conversation_reply':
                if ($warningConversation)
                {
                    return true;
                }

                return $this->hasPermission('conversation', 'emailIncludeMessage');
                break;
            default:
                throw new \LogicException("Invalid type {$type} passed to canReceiveFullEmailMessageContent method.");
        }
    }
}