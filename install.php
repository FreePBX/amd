<?php
if (!defined('FREEPBX_IS_AUTH')) { die('No direct script access allowed'); }

$data_value = FreePBX::AMD()->getAmdSettings();
if(empty($data_value)){
	$data = array(  "initial_silence" => 2500,
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
?>
