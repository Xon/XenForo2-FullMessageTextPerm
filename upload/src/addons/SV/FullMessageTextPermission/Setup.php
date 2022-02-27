<?php

namespace SV\FullMessageTextPermission;

use SV\StandardLib\InstallerHelper;
use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;
use XF\Db\Schema\Alter;

class Setup extends AbstractSetup
{
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

    public function upgrade2030000Step1()
    {
        $this->renameOption('FMP_AlwaysSendWarning', 'sv_fmp_always_send_warning');
        $this->renameOption('FMP_AlwaysSendWelcome', 'sv_fmp_always_send_welcome');
        $this->renameOption('fmp_allowAlwaysEmailWatched', 'sv_fmp_allow_always_email_watched');
        $this->renameOption('FMP_TextTrimLength', 'sv_fmp_text_trim_length');
        $this->renameOption('FMP_TextTrimLengthFull', 'sv_fmp_full_text_trim_length');
    }

    public function uninstallStep1()
    {
        $this->schemaManager()->alterTable('xf_user_option', function (Alter $table) {
            $table->dropColumns('fmp_always_email_notify');
        });
    }
}