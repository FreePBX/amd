<?php
namespace FreePBX\modules\Amd;
use FreePBX\modules\Backup as Base;
class Restore Extends Base\RestoreBase{
	public function runRestore(){
		$configs = $this->getConfigs();
		if (array_key_exists('kvstore', $configs)) {
			$this->importKVStore($configs['kvstore']);
		}
	}

	public function processLegacy($pdo, $data, $tables, $unknownTables){
		$this->restoreLegacyKvstore($pdo);
	}
}
