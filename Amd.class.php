<?php
namespace FreePBX\modules;

class Amd extends \DB_Helper implements \BMO {
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
			$request = $_REQUEST;
			$action = isset($request['action'])?$request['action']:'';
			$initial_silence = !empty($request['initial_silence'])?$request['initial_silence']:'2500';
			$greeting = !empty($request['greeting'])?$request['greeting']:'1500';
			$after_greeting_silence = !empty($request['after_greeting_silence'])?$request['after_greeting_silence']:'800';
			$total_analysis_time = !empty($request['total_analysis_time'])?$request['total_analysis_time']:'5000';
			$min_word_length = !empty($request['min_word_length'])?$request['min_word_length']:'100';
			$maximum_word_length = !empty($request['maximum_word_length'])?$request['maximum_word_length']:'5000';
			$between_words_silence = !empty($request['between_words_silence'])?$request['between_words_silence']:'50';
			$maximum_number_of_words = !empty($request['maximum_number_of_words'])?$request['maximum_number_of_words']:'3';
			$silence_threshold = !empty($request['silence_threshold'])?$request['silence_threshold']:'256';
			$data = array(  "initial_silence" => $initial_silence,
					"greeting" => $greeting,
					"after_greeting_silence" => $after_greeting_silence,
					"total_analysis_time" => $total_analysis_time,
					"min_word_length" => $min_word_length,
					"maximum_word_length" => $maximum_word_length,
					"between_words_silence" => $between_words_silence,
					"maximum_number_of_words" => $maximum_number_of_words,
					"silence_threshold" => $silence_threshold
					);
			switch($action){
				case 'save':
					$this->addAmdSettings($data);
					needreload();
					return true;
					break;
				default:
					break;
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
		$amd = $this->getAll();
		$amd_values = $this->getConfig('amdsettings');
		return $amd_values;
	}
	public function delAmdSettings() {
		$this->delConfig('amdsettings');
	}
	public function genConfig() {
		global $version;
		if(version_compare($version, '12', 'ge')) {
			$data = $this->getAmdSettings();
			$amd_context = 'general';
			$conf['amd.conf'][$amd_context] = array(
				'initial_silence' => $data['initial_silence'],
				'greeting' => $data['greeting'],
				'after_greeting_silence' => $data['after_greeting_silence'],
				'total_analysis_time' => $data['total_analysis_time'],
				'min_word_length' => $data['min_word_length'],
				'maximum_word_length' => $data['maximum_word_length'],
				'between_words_silence' => $data['between_words_silence'],
				'maximum_number_of_words' => $data['maximum_number_of_words'],
				'silence_threshold' => $data['silence_threshold']
			);
			return $conf;
		}
	}
	public function writeConfig($conf){
		global $amp_conf;
		global $astman;
		if (is_object($astman)) {
			$param['Module'] = "app_amd.so";
			$param['LoadType'] = "load";
			$value = $astman->send_request("ModuleCheck", $param);
			if($value['Response'] == "Error"){
				$astman->send_request("ModuleLoad", $param);
			}
		}
		$this->FreePBX->WriteConfig($conf);
	}
}

