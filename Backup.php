<?php
namespace FreePBX\modules\Amd;
use FreePBX\modules\Backup as Base;
class Backup Extends Base\BackupBase{
	public function runBackup($id,$transaction){
		$this->addConfigs([
			'kvstore' => $this->dumpKVStore()
		]);
	}
}