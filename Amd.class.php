<?php
namespace FreePBX\modules;

class Amd extends \DB_Helper implements \BMO {
	private $defaults = array(
		"initial_silence" => 2500,
		"greeting" => 1500,
		"after_greeting_silence" => 800,
		"total_analysis_time" => 5000,
		"min_word_length" => 100,
		"maximum_word_length" => 5000,
		"between_words_silence" => 50,
		"maximum_number_of_words" => 3,
		"silence_threshold" => 256
	);

	public function __construct($freepbx = null) {
		if ($freepbx == null) {
			throw new Exception("Not given a FreePBX Object");
		}
		$this->FreePBX = $freepbx;
		$this->db = $freepbx->Database;
	}

	public function install() {}

	public function uninstall() {}

	public function backup() {}

	public function restore($backup) {}

	public function doConfigPageInit($page) {
		if ($page == "amd") {
			$request = freepbxGetSanitizedRequest();
			$data = array();
			foreach($this->defaults as $key => $default) {
				$data[$key] = isset($request[$key]) ? $request[$key] : $default;
			}
			$action = isset($request['action'])?$request['action']:'';
			if($action === 'save') {
				$this->addAmdSettings($data);
				needreload();
			}
			return true;
		}
	}
	public function getActionBar($request) {
		$buttons = array();
		switch($_GET['display']) {
			case 'amd':
				$buttons = array(
					'reset' => array(
						'name' => 'reset',
						'id' => 'reset',
						'value' => _('Reset')
					),
					'submit' => array(
						'name' => 'submit',
						'id' => 'submit',
						'value' => _('Submit')
					)
				);
			break;
		}
		return $buttons;
	}

	public function showPage(){
		$data_value = $this->getAmdSettings();
		return load_view(__DIR__.'/views/settings.php',array('data_value' => $data_value));
	}

	public function ajaxRequest($req, &$setting) {
		switch ($req) {
			case 'getJSON':
				return true;
			break;
			default:
				return false;
			break;
		}
	}

	public function ajaxHandler(){
		switch ($_REQUEST['command']) {
			case 'getJSON':
				switch ($_REQUEST['jdata']) {
					case 'grid':
						$ret = array();
						/*code here to generate array*/
						return $ret;
					break;

					default:
						return false;
					break;
				}
			break;

			default:
				return false;
			break;
		}
	}
	public function addAmdSettings($data) {
		$this->setConfig('amdsettings',$data);
	}

	public function getAmdSettings() {
		$amd_values = $this->getConfig('amdsettings');

		$data = array();
		foreach($this->defaults as $key => $default) {
			$data[$key] = is_array($amd_values) && isset($amd_values[$key]) ? $amd_values[$key] : $default;
		}

		return $data;
	}

	public function delAmdSettings() {
		$this->delConfig('amdsettings');
	}

	public function genConfig() {
		$version = $this->FreePBX->Config->get('ASTVERSION');
		if(version_compare($version, '12', 'ge')) {
			$data = $this->getAmdSettings();
			if(empty($data)) {
				return array();
			}
			return array(
				'amd.conf' => array(
					'general' => array(
						'initial_silence' => $data['initial_silence'],
						'greeting' => $data['greeting'],
						'after_greeting_silence' => $data['after_greeting_silence'],
						'total_analysis_time' => $data['total_analysis_time'],
						'min_word_length' => $data['min_word_length'],
						'maximum_word_length' => $data['maximum_word_length'],
						'between_words_silence' => $data['between_words_silence'],
						'maximum_number_of_words' => $data['maximum_number_of_words'],
						'silence_threshold' => $data['silence_threshold']
					)
				)
			);
		}
	}

	public function writeConfig($conf){
		if ($this->FreePBX->astman->connected() && !$this->FreePBX->astman->mod_loaded("app_amd.so")) {
			exec(fpbx_which('asterisk')." -rx 'module load app_amd.so'");
		}
		$this->FreePBX->WriteConfig($conf);
	}
}

