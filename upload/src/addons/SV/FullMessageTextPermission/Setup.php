<?php

/*
 * This file is part of a XenForo add-on.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SV\FullMessageTextPermission;

use SV\Utils\InstallerHelper;
use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;
use XF\Db\Schema\Alter;

class Setup extends AbstractSetup
{
    // from https://github.com/Xon/XenForo2-Utils cloned to src/addons/SV/Utils
    use InstallerHelper;
    use StepRunnerInstallTrait;
    use StepRunnerUpgradeTrait;
    use StepRunnerUninstallTrait;

    public function installStep1()
    {
        $this->schemaManager()->alterTable('xf_user_option', function (Alter $table) {
            $this->addOrChangeColumn($table, 'fmp_always_email_notify', 'tinyint', 3)->setDefault(0);
        });
    }

    public function installStep2()
    {
        $this->applyRegistrationDefaults([
            'fmp_always_email_notify' => 0,
        ]);
    }

    public function upgrade2000200Step1()
    {
        $this->installStep1();
    }

    public function upgrade2000200Step2()
    {
        $this->installStep2();
    }

    public function uninstallStep1()
    {
        $this->schemaManager()->alterTable('xf_user_option', function (Alter $table) {
            $table->dropColumns('fmp_always_email_notify');
        });
    }
}