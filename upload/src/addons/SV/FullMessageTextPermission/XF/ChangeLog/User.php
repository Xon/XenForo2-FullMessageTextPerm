<?php

namespace SV\FullMessageTextPermission\XF\ChangeLog;

/**
 * Extends \XF\ChangeLog\User
 */
class User extends XFCP_User
{
    protected function getLabelMap()
    {
        $map = parent::getLabelMap();
        $map['fmp_always_email_notify'] = 'sv_fullmessagetextpermission_always_email_notify';

        return $map;
    }

    protected function getFormatterMap()
    {
        $map = parent::getFormatterMap();
        $map['fmp_always_email_notify'] = 'formatYesNo';

        return $map;
    }
}