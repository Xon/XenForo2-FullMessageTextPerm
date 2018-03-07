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
    protected $canReceiveFullEmailMessageContent = true;

    /**
     * @param string   $type
     * @param int|null $nodeId
     * @param bool     $warningConversation
     */
    public function configureFullEmailMessageContent($type, $nodeId = null, $warningConversation = false)
    {
        switch ($type)
        {
            case 'forum':
            case 'thread':
            case 'post':
                $this->canReceiveFullEmailMessageContent = $this->hasNodePermission($nodeId, 'emailIncludeMessage');
                break;
            case 'conversation_invite':
            case 'conversation_create':
            case 'conversation_reply':
                if ($warningConversation)
                {
                    $this->canReceiveFullEmailMessageContent = true;
                }
                else
                {
                    $this->canReceiveFullEmailMessageContent = $this->hasPermission('conversation', 'emailIncludeMessage');
                }
                break;
            default:
                throw new \LogicException("Invalid type {$type} passed to canReceiveFullEmailMessageContent method.");
        }
    }

    /**
     * This function relies on user state to be setup before hand
     *
     * @return bool
     */
    public function canReceiveFullEmailMessageContent()
    {
        return $this->canReceiveFullEmailMessageContent;
    }
}