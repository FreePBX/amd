<?php
if (!defined('FREEPBX_IS_AUTH')) { die('No direct script access allowed'); }
//take a copy of existing amd.conf
//lets read the existing configuration
if(file_exists('/etc/asterisk/amd.conf') && !file_exists('/etc/asterisk/amd.conf.backup')) {
	out(_("amd.conf Configuration file found"));
	$lines = file('/etc/asterisk/amd.conf',FILE_SKIP_EMPTY_LINES);
	$existingdata = array();
	foreach($lines as $line) {
		if(substr(trim($line),0,1) ==';' || strpos($line, 'general') !== false){
			continue;
		}
		$vars = explode("=",trim($line));
		$key = trim($vars[0]);
		$val = explode(";",trim($vars[1]));
		$value = trim($val[0]);
		if($key !='' && $value != '') {
			$existingdata["$key"] = $value;
		}
	}
	rename('/etc/asterisk/amd.conf','/etc/asterisk/amd.conf.backup');
}
if(count($existingdata) == 9) {
	FreePBX::AMD()->addAmdSettings($existingdata);
	out(_("Restoring the existing settings"));
} else {
	$data_value = FreePBX::AMD()->getAmdSettings();
	if(empty($data_value)){
		$data = array("initial_silence" => 2500,
	                "greeting" => 1500,
			"after_greeting_silence" => 800,
			"total_analysis_time" => 5000,
			"min_word_length" => 100,
			"maximum_word_length" => 5000,
			"between_words_silence" => 50,
			"maximum_number_of_words" => 3,
			"silence_threshold" => 256
		);

	FreePBX::AMD()->addAmdSettings($data);
	}
}
?>
