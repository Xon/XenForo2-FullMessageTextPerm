<?php

namespace SV\FullMessageTextPermission\XF\Entity;

use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Structure;

/**
 * Extends \XF\Entity\UserOption
 *
 * @property bool fmp_always_email_notify
 */
class UserOption extends XFCP_UserOption
{
    /**
     * @param Structure $structure
     * @return Structure
     */
    public static function getStructure(Structure $structure)
    {
        $structure = parent::getStructure($structure);

        $structure->columns['fmp_always_email_notify'] = ['type' => Entity::BOOL, 'default' => 0];

        return $structure;
    }
}