<?php

namespace SV\FullMessageTextPermission;

use XF\AddOn\AbstractSetup;
use XF\Db\Schema\Alter;

class Setup extends AbstractSetup
{
	public function install(array $stepParams = [])
	{
		$this->schemaManager()->alterTable('xf_user_option', function (Alter $table)
		{
			$table->addColumn('fmp_always_email_notify', 'boolean')->setDefault(0);
		});
	}

	public function upgrade(array $stepParams = [])
	{
	}

	public function uninstall(array $stepParams = [])
	{
		$this->schemaManager()->alterTable('xf_user_option', function (Alter $table)
		{
			$table->dropColumns('fmp_always_email_notify');
		});
	}
}