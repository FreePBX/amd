<?php
extract($data_value);
?>
<div class="container-fluid">
	<h1><?php echo _('AMD Settings')?></h1>
	<div class = "display full-border">
		<div class="row">
			<div class="col-md-12">
				<div class="fpbx-container">
					<div class="display full-border">
						<form class="fpbx-submit" action="" method="post" id="amd-settings" autocomplete="off" name="amd-settings">
								<div id="amd_general" class="tab-pane active">
									<input type="hidden" name="action" value="save">
									<!--Initial Silence Format-->
									<div class="element-container">
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="form-group">
														<div class="col-md-3">
															<label class="control-label" for="initial_silence"><?php echo _("Initial Silence") ?></label>
															<i class="fa fa-question-circle fpbx-help-icon" data-for="initial_silence"></i>
														</div>
														<div class="col-md-9">
															<input type="number" class="form-control" id="initial_silence" name="initial_silence" value="<?php echo $initial_silence ?? ''?>">
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<span id="initial_silence-help" class="help-block fpbx-help-block"> <?php echo _("Maximum silence duration before the greeting. Default is 2500.")?></span>
											</div>
										</div>
									</div>
									<!--END Initial Silence-->
									<!--Greeting-->
									<div class="element-container">
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="form-group">
														<div class="col-md-3">
															<label class="control-label" for="greeting"><?php echo _("Greeting") ?></label>
															<i class="fa fa-question-circle fpbx-help-icon" data-for="greeting"></i>
														</div>
														<div class="col-md-9">
															<input type="number" class="form-control" id="greeting" name="greeting" value="<?php echo $greeting ?? ''?>">
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
											<span id="greeting-help" class="help-block fpbx-help-block"><?php echo _("Maximum length of a greeting. If exceeded then MACHINE. Default is 1500.")?></span>
											</div>
										</div>
									</div>
									<!--END Greeting-->
									<!--After Greeting Silence-->
									<div class="element-container">
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="form-group">
														<div class="col-md-3">
															<label class="control-label" for="after_greeting_silence"><?php echo _("After Greeting Silence") ?></label>
															<i class="fa fa-question-circle fpbx-help-icon" data-for="after_greeting_silence"></i>
														</div>
														<div class="col-md-9">
															<input type="number" class="form-control" id="after_greeting_silence" name="after_greeting_silence" value="<?php echo $after_greeting_silence ?? ''?>">
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<span id="after_greeting_silence-help" class="help-block fpbx-help-block"><?php echo _("Silence after detecting a greeting. Default is 800.")?></span>
											</div>
										</div>
									</div>
									<!--END After Greeting Silence-->
									<!--Total Analysis Time-->
									<div class="element-container">
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="form-group">
														<div class="col-md-3">
															<label class="control-label" for="total_analysis_time"><?php echo _("Total Analysis Time") ?></label>
															<i class="fa fa-question-circle fpbx-help-icon" data-for="total_analysis_time"></i>
														</div>
														<div class="col-md-9">
															<input type="number" class="form-control" id="total_analysis_time" name="total_analysis_time" value="<?php echo $total_analysis_time ?? ''?>">
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<span id="total_analysis_time-help" class="help-block fpbx-help-block"><?php echo _("Maximum time allowed for the algorithm to decide. Default is 5000.")?></span>
											</div>
										</div>
									</div>
									<!--END Total Analysis Time-->
									<!--Min Word Length-->
									<div class="element-container">
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="form-group">
														<div class="col-md-3">
															<label class="control-label" for="min_word_length"><?php echo _("Minimum Word Length") ?></label>
															<i class="fa fa-question-circle fpbx-help-icon" data-for="min_word_length"></i>
														</div>
														<div class="col-md-9">
															<input type="number" class="form-control" id="min_word_length" name="min_word_length" value="<?php echo $min_word_length ?? ''?>">
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<span id="min_word_length-help" class="help-block fpbx-help-block"><?php echo _("Minimum duration of Voice to considered as a word. Default is 100.")?></span>
											</div>
										</div>
									</div>
									<!--END Min Word Length-->
									<!--Max Word Length-->
									<div class="element-container">
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="form-group">
														<div class="col-md-3">
															<label class="control-label" for="maximum_word_length"><?php echo _("Maximum Word Length") ?></label>
															<i class="fa fa-question-circle fpbx-help-icon" data-for="maximum_word_length"></i>
														</div>
														<div class="col-md-9">
															<input type="number" class="form-control" id="maximum_word_length" name="maximum_word_length" value="<?php echo $maximum_word_length ?? ''?>">
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<span id="maximum_word_length-help" class="help-block fpbx-help-block"><?php echo _("Maximum duration of a single Voice utterance allowed. Default is 5000.")?></span>
											</div>
										</div>
									</div>
									<!--END Max Word Length-->
									<!--Between Words Silence-->
									<div class="element-container">
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="form-group">
														<div class="col-md-3">
															<label class="control-label" for="between_words_silence"><?php echo _("Between Words Silence") ?></label>
															<i class="fa fa-question-circle fpbx-help-icon" data-for="between_words_silence"></i>
														</div>
														<div class="col-md-9">
															<input type="number" class="form-control" id="between_words_silence" name="between_words_silence" value="<?php echo $between_words_silence ?? ''?>">
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<span id="between_words_silence-help" class="help-block fpbx-help-block"><?php echo _("Minimum duration of silence after a word to consider. Default is 50.")?></span>
											</div>
										</div>
									</div>
									<!-- End Between Words Silence-->
									<!--Maximum Number Of Words-->
									<div class="element-container">
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="form-group">
														<div class="col-md-3">
															<label class="control-label" for="maximum_number_of_words"><?php echo _("Maximum Number Of Words") ?></label>
															<i class="fa fa-question-circle fpbx-help-icon" data-for="maximum_number_of_words"></i>
														</div>
														<div class="col-md-9">
															<input type="number" class="form-control" id="maximum_number_of_words" name="maximum_number_of_words" value="<?php echo $maximum_number_of_words ?? ''?>">
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<span id="maximum_number_of_words-help" class="help-block fpbx-help-block"><?php echo _("Maximum number of words in the greeting. Default is 3.")?></span>
											</div>
										</div>
									</div>
									<!-- End Maximum Number Of Words -->
									<!-- Silence Threshold -->
									<div class="element-container">
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="form-group">
														<div class="col-md-3">
															<label class="control-label" for="silence_threshold"><?php echo _("Silence Threshold") ?></label>
															<i class="fa fa-question-circle fpbx-help-icon" data-for="silence_threshold"></i>
														</div>
														<div class="col-md-9">
															<input type="number" class="form-control" id="silence_threshold" name="silence_threshold" value="<?php echo $silence_threshold ?? ''?>">
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<span id="silence_threshold-help" class="help-block fpbx-help-block"><?php echo _("Silence Threshold. Default is 256.")?></span>
											</div>
										</div>
									</div>
									<!-- End Silence Threshold -->
								</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
