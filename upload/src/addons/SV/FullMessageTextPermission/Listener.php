<?php

/*
 * This file is part of a XenForo add-on.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SV\FullMessageTextPermission;

use XF\Mvc\Entity\Entity;

class Listener
{
    public static function userOptionEntityStructure(\XF\Mvc\Entity\Manager $em, \XF\Mvc\Entity\Structure &$structure)
    {
        $structure->columns['fmp_always_email_notify'] = [
            'type'    => Entity::BOOL,
            'default' => 0
        ];
    }
}