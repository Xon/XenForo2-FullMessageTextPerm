<?php

namespace SV\FullMessageTextPermission\XF\Entity;

class User extends XFCP_User
{
    protected $canReceiveFullEmailMessageContent = true;

    /**
     * @param string   $type
     * @param int|null $nodeId
     * @param bool     $forceConversationNotification
     */
    public function configureFullEmailMessageContent($type, $nodeId = null, $forceConversationNotification = false)
    {
        switch ($type)
        {
            case 'forum_reply':
            case 'forum_thread':
            case 'thread_reply':
                $this->canReceiveFullEmailMessageContent = $this->hasNodePermission($nodeId, 'emailIncludeMessage');
                break;
            case 'conversation_invite':
            case 'conversation_create':
            case 'conversation_reply':
                if ($forceConversationNotification)
                {
                    $this->canReceiveFullEmailMessageContent = true;
                }
                else
                {
                    $this->canReceiveFullEmailMessageContent = $this->hasPermission('conversation', 'emailIncludeMessage');
                }
                break;
            default:
                if (\XF::$developmentMode)
                {
                    throw new \LogicException("Invalid type {$type} passed to configureFullEmailMessageContent method.");
                }
                $this->canReceiveFullEmailMessageContent = true;
                break;
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