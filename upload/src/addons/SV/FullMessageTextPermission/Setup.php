<?php

/*
 * This file is part of a XenForo add-on.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SV\FullMessageTextPermission;

use XF\AddOn\AbstractSetup;
use XF\Db\Schema\Alter;

class Setup extends AbstractSetup
{
    public function install(array $stepParams = [])
    {
        $this->schemaManager()->alterTable('xf_user_option', function (Alter $table) {
            $table->addColumn('fmp_always_email_notify', 'tinyint', 3)->setDefault(0);
        });
    }

    public function upgrade(array $stepParams = [])
    {
    }

    public function uninstall(array $stepParams = [])
    {
        $this->schemaManager()->alterTable('xf_user_option', function (Alter $table) {
            $table->dropColumns('fmp_always_email_notify');
        });
    }
}