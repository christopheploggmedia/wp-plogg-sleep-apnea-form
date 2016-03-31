<?php

function wp_plogg_sleep_apnea_form_register_shortcodes(){
	add_shortcode("afficher-sleap-apnea-form", "wp_plogg_sleep_apnea_form_afficher_handler");
}

function wp_plogg_sleep_apnea_form_afficher_handler($atts){
	global $wp_plogg_sleep_apnea_form_settings;
		
	wp_enqueue_style('wp-plogg-sleep-apnea-form-style', plugin_dir_url( __FILE__ ) . 'assets/css/wp_plogg_sleep_apnea_form_style.css');
	wp_enqueue_script('wp-plogg-sleep-apnea-form-script', plugin_dir_url( __FILE__ ) . 'assets/js/wp_plogg_sleep_apnea_form_main.js'); ?>
	
	<div id="wp-plogg-saf-div">

		<?php if(isset($_GET['wp_plogg_sleep_apnea_form_status']) && $_GET['wp_plogg_sleep_apnea_form_status']==1){ ?>
			<div class="notification ok" >
				<div class="wrapper">
					
					<div class="alert-box success"><p class="wp-plogg-saf-important"><?php _e('Important'); ?></p><?php _e('A confirmation email was sent.<br/>Make sure that you have received this message (it is possible that the message arrives in your spam), it confirms that we have the right email.','wp_plogg_sleep_apnea_form');?></div>
					<br/>
				</div>
			</div>
		<?php
		} else if(isset($_GET['wp_plogg_sleep_apnea_form_status']) && $_GET['wp_plogg_sleep_apnea_form_status']==0){?>
			<div class="notification" >
				<div class="wrapper">
					<div class="alert-box error"><?php _e("An error has occurred and your message has not been sent. Please try again in a few moments.",'wp_plogg_sleep_apnea_form');?></div>
					<br/>
				</div>
			</div>
		<?php
		}
		?>
		
		<form action="<?php echo plugin_dir_url(__FILE__); ?>form-manager.php" onsubmit="return wp_plogg_sleep_apnea_form_validation()" method="post" id="contact-form">
			<input type="hidden" name="wp_plogg_sleep_apnea_form_nomformulaire"  id="wp_plogg_sleep_apnea_form_nomformulaire" value="wp_plogg_sleep_apnea"/>
			<input type="hidden" name="wp_plogg_sleep_apnea_form_goto"  id="wp_plogg_sleep_apnea_form_goto" value="<?php echo get_permalink(); ?>"/>
			<input type="hidden" name="wp_plogg_sleep_apnea_form_lang"  id="wp_plogg_sleep_apnea_form_lang" value="<?php if(ICL_LANGUAGE_CODE && ICL_LANGUAGE_CODE!='ICL_LANGUAGE_CODE'){echo ICL_LANGUAGE_CODE;}else{echo 'fr';} ?>"/>
			<input type="text" name="wp_plogg_sleep_apnea_form_magicfield"  class="wp_plogg_sleep_apnea_form_magicfield" value="" autocomplete="off"/>
			
			<div class="wp-plogg-saf-step current" data-step="1">
				<div class="wp-plogg-saf-step-counter">
					<?php _e('Step','wp_plogg_sleep_apnea_form'); ?> 1<span>/5</span>
				</div>
				
				<div class="wp-plogg-saf-field-wrapper">
					<h2><?php _e('Enter your neck circumference in cm','wp_plogg_sleep_apnea_form'); ?></h2>
				
		            <ul>
		            	<li>
							<?php _e('If your neck is larger than 49 cm, enter 49 cm.','wp_plogg_sleep_apnea_form'); ?>
			            </li>
						<li>
							<?php _e('If you have high blood pressure, add 4 cm to the circumference of your neck.','wp_plogg_sleep_apnea_form'); ?>
			            </li>
						<li>
							<?php _e('If you snore, add another 3 cm to the the circumference of your neck.','wp_plogg_sleep_apnea_form'); ?>
			            </li>
			            <li>
							<?php _e('If anyone noticed that you stop breathing during your sleep, add 3 cm.','wp_plogg_sleep_apnea_form'); ?>
						</li>
					</ul>
					<table class="wp_plogg_saf_table_cca">
						<tr>
							<td><?php _e('Circumference','wp_plogg_sleep_apnea_form'); ?> cm</td>
							<td><?php _e('Hypertension + 4 cm','wp_plogg_sleep_apnea_form'); ?></td>
							<td><?php _e('Snorer + 3cm','wp_plogg_sleep_apnea_form'); ?></td>
							<td><?php _e('Respiratory pauses + 3 cm','wp_plogg_sleep_apnea_form'); ?></td>
							<td><b><?php _e('TOTAL','wp_plogg_sleep_apnea_form'); ?></b></td>
						</tr>
						<tr>
							<td>
								<input type="number" name="wp_plogg_saf_neck_circumference" id="wp_plogg_saf_neck_circumference" placeholder="" value="" size="2" tabindex="1" max="49" required/>
							</td>
							<td>
								<input type="checkbox" name="wp_plogg_saf_hypertension_calc" id="wp_plogg_saf_hypertension_calc" value="<?php _e('Yes','wp_plogg_sleep_apnea_form'); ?>" class="custom-checkbox" />
								<label for="wp_plogg_saf_hypertension_calc" class=""></label>
							</td>
							<td>
								<input type="checkbox" name="wp_plogg_saf_ronfle_calc" id="wp_plogg_saf_ronfle_calc" value="<?php _e('Yes','wp_plogg_sleep_apnea_form'); ?>" class="custom-checkbox" />
								<label for="wp_plogg_saf_ronfle_calc" class=""></label>
							</td>
							<td>
								<input type="checkbox" name="wp_plogg_saf_pause_calc" id="wp_plogg_saf_pause_calc" value="<?php _e('Yes','wp_plogg_sleep_apnea_form'); ?>" class="custom-checkbox" />
								<label for="wp_plogg_saf_pause_calc" class=""></label>
							</td>
							<td>
								<b><span class="wp-plogg-saf-circonference-calc"></span></b>
							</td>
						</tr>
					</table>
				</div>
				
				<div class="wp-plogg-saf-prev-next-buttons">
					<div class="next button"><?php _e('Next step','wp_plogg_sleep_apnea_form'); ?></div>
				</div>
			</div>
			
			<div class="wp-plogg-saf-step " data-step="2">
				<div class="wp-plogg-saf-step-counter">
					<?php _e('Step','wp_plogg_sleep_apnea_form'); ?> 2<span>/5</span>
				</div>
				
				<h2><?php _e('Sleep habits','wp_plogg_sleep_apnea_form'); ?></h2>
				
				<div class="wp-plogg-saf-field-wrapper">
					<div class="wp-plogg-saf-question-number">1</div>
					
					<div class="wp-plogg-saf-question-fields-wrapper">
						<div class="wp-plogg-saf-single-question-wrapper">
							<label for="wp_plogg_saf_heure_couche" class="wp-plogg-saf-label">
				                <span><?php _e('I got to bed at','wp_plogg_sleep_apnea_form'); ?></span>
				            </label>
							<?php /*
							<input type="number" name="wp_plogg_saf_heure_couche" id="wp_plogg_saf_heure_couche" placeholder="" value="" size="2" tabindex="2" required/>
							*/ ?>
							<label for="wp_plogg_saf_heure_couche" class="wp_plogg_saf_heure_label custom-combobox">
								<select name="wp_plogg_saf_heure_couche" id="wp_plogg_saf_heure_couche" >
									<?php
									for($i=0; $i<24; $i++){?>
										<option value="<?= $i ?>"><?= $i ?></option>
									<?php
									} ?>
								</select>
							</label>
							<?php _e('hour(s)','wp_plogg_sleep_apnea_form'); ?>
							
							<label for="wp_plogg_saf_heure_couche_minutes" class="wp_plogg_saf_heure_label custom-combobox">
								<select name="wp_plogg_saf_heure_couche_minutes" id="wp_plogg_saf_heure_couche_minutes" >
									<option value="0">00</option>
									<option value="15">15</option>
									<option value="30">30</option>
									<option value="45">45</option>
								</select>
							</label>
							<?php _e('minute(s)','wp_plogg_sleep_apnea_form'); ?>.
						</div>
						<div class="wp-plogg-saf-single-question-wrapper">
							<label for="wp_plogg_saf_heure_leve" class="wp-plogg-saf-label">
				                <span><?php _e('I wake up at','wp_plogg_sleep_apnea_form'); ?></span>
				            </label>
				            <?php /*
							<input type="number" name="wp_plogg_saf_heure_leve" id="wp_plogg_saf_heure_leve" placeholder="" value="" size="2" tabindex="3" min="0" max="23" step="1" required/>
							*/ ?>
							<label for="wp_plogg_saf_heure_leve" class="wp_plogg_saf_heure_label custom-combobox">
								<select name="wp_plogg_saf_heure_leve" id="wp_plogg_saf_heure_leve" >
									<?php
									for($i=0; $i<24; $i++){?>
										<option value="<?= $i ?>"><?= $i ?></option>
									<?php
									} ?>
								</select>
							</label>
							
							<?php _e('hour(s)','wp_plogg_sleep_apnea_form'); ?>
							
							<label for="wp_plogg_saf_heure_leve_minutes" class="wp_plogg_saf_heure_label custom-combobox">
								<select name="wp_plogg_saf_heure_leve_minutes" id="wp_plogg_saf_heure_leve_minutes" >
									<option value="0">00</option>
									<option value="15">15</option>
									<option value="30">30</option>
									<option value="45">45</option>
								</select>
							</label>
							<?php _e('minute(s)','wp_plogg_sleep_apnea_form'); ?>.
						</div>
					</div>
				</div>
				
				<div class="wp-plogg-saf-field-wrapper">
					<div class="wp-plogg-saf-question-number">2</div>
					
					<div class="wp-plogg-saf-question-fields-wrapper">
						<label for="wp_plogg_saf_endormi_vite_oui" class="wp-plogg-saf-label">
			                <span><?php _e('I fall asleep quickly','wp_plogg_sleep_apnea_form'); ?></span>
			            </label><br/>
						<input type="radio" name="wp_plogg_saf_endormi_vite" id="wp_plogg_saf_endormi_vite_oui" value="<?php _e('Yes','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_endormi_vite_oui" class=""><?php _e('Yes','wp_plogg_sleep_apnea_form'); ?></label>
						<input type="radio" name="wp_plogg_saf_endormi_vite" id="wp_plogg_saf_endormi_vite_non" value="<?php _e('No','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_endormi_vite_non" class=""><?php _e('No','wp_plogg_sleep_apnea_form'); ?></label>
					</div>
				</div>
				
				<div class="wp-plogg-saf-field-wrapper">
					<div class="wp-plogg-saf-question-number">3</div>
					
					<div class="wp-plogg-saf-question-fields-wrapper">
						<label for="wp_plogg_saf_reveille_facile_oui" class="wp-plogg-saf-label">
			                <span><?php _e('I wake up easily','wp_plogg_sleep_apnea_form'); ?></span>
			            </label><br/>
						<input type="radio" name="wp_plogg_saf_reveille_facile" id="wp_plogg_saf_reveille_facile_oui" value="<?php _e('Yes','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_reveille_facile_oui" class=""><?php _e('Yes','wp_plogg_sleep_apnea_form'); ?></label>
						<input type="radio" name="wp_plogg_saf_reveille_facile" id="wp_plogg_saf_reveille_facile_non" value="<?php _e('No','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_reveille_facile_non" class=""><?php _e('No','wp_plogg_sleep_apnea_form'); ?></label>
					</div>
				</div>
				
				<div class="wp-plogg-saf-field-wrapper">
					<div class="wp-plogg-saf-question-number">4</div>
					
					<div class="wp-plogg-saf-question-fields-wrapper">
						<label for="wp_plogg_saf_reveil_frequent_oui" class="wp-plogg-saf-label">
			                <span><?php _e('I frequently wake up at night','wp_plogg_sleep_apnea_form'); ?></span>
			            </label><br/>
						<input type="radio" name="wp_plogg_saf_reveil_frequent" id="wp_plogg_saf_reveil_frequent_oui" value="<?php _e('Yes','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_reveil_frequent_oui" class=""><?php _e('Yes','wp_plogg_sleep_apnea_form'); ?></label>
						<input type="radio" name="wp_plogg_saf_reveil_frequent" id="wp_plogg_saf_reveil_frequent_non" value="<?php _e('No','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_reveil_frequent_non" class=""><?php _e('No','wp_plogg_sleep_apnea_form'); ?></label>
					</div>
				</div>
				
				<div class="wp-plogg-saf-field-wrapper">
					<div class="wp-plogg-saf-question-number">5</div>
					
					<div class="wp-plogg-saf-question-fields-wrapper">
						<div class="wp-plogg-saf-single-question-wrapper">
							<label for="wp_plogg_saf_matin_fatigue_oui" class="wp-plogg-saf-label">
				                <span><?php _e('I wake up tired in the morning','wp_plogg_sleep_apnea_form'); ?></span>
				            </label><br/>
							<input type="radio" name="wp_plogg_saf_matin_fatigue" id="wp_plogg_saf_matin_fatigue_oui" value="<?php _e('Yes','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_matin_fatigue_oui" class=""><?php _e('Yes','wp_plogg_sleep_apnea_form'); ?></label>
							<input type="radio" name="wp_plogg_saf_matin_fatigue" id="wp_plogg_saf_matin_fatigue_non" value="<?php _e('No','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_matin_fatigue_non" class=""><?php _e('No','wp_plogg_sleep_apnea_form'); ?></label>
						</div>
						
						<div class="wp-plogg-saf-single-question-wrapper wp_plogg_saf_si_matin_fatigue_oui">
							<label for="wp_plogg_saf_matin_fatigue_depuis" class="wp-plogg-saf-label">
				                <span><?php _e('Since how long?','wp_plogg_sleep_apnea_form'); ?></span>
				            </label><br/>
							<input type="text" name="wp_plogg_saf_matin_fatigue_depuis" id="wp_plogg_saf_matin_fatigue_depuis" placeholder="" value="" size="22" tabindex="4" />
						</div>
					</div>
				</div>
				
				<div class="wp-plogg-saf-field-wrapper">
					<div class="wp-plogg-saf-question-number">6</div>
					
					<div class="wp-plogg-saf-question-fields-wrapper">
						<label for="wp_plogg_saf_matin_fatigue_tresbien" class="wp-plogg-saf-label">
			                <span><?php _e('Globally, do you consider that you sleep','wp_plogg_sleep_apnea_form'); ?></span>
			            </label><br/>
						<input type="radio" name="wp_plogg_saf_qualite_sommeil" id="wp_plogg_saf_matin_fatigue_tresbien" value="<?php _e('Very well','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_matin_fatigue_tresbien" class=""><?php _e('Very well','wp_plogg_sleep_apnea_form'); ?></label>
						<input type="radio" name="wp_plogg_saf_qualite_sommeil" id="wp_plogg_saf_matin_fatigue_bien" value="<?php _e('Well','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio"  /> <label for="wp_plogg_saf_matin_fatigue_bien" class=""><?php _e('Well','wp_plogg_sleep_apnea_form'); ?></label>
						<input type="radio" name="wp_plogg_saf_qualite_sommeil" id="wp_plogg_saf_matin_fatigue_mauvais" value="<?php _e('Bad','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_matin_fatigue_mauvais" class=""><?php _e('Bad','wp_plogg_sleep_apnea_form'); ?></label>
						<input type="radio" name="wp_plogg_saf_qualite_sommeil" id="wp_plogg_saf_matin_fatigue_tresmauvais" value="<?php _e('Very bad','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_matin_fatigue_tresmauvais" class=""><?php _e('Very bad','wp_plogg_sleep_apnea_form'); ?></label>
					</div>
				</div>
				
				<div class="wp-plogg-saf-field-wrapper">
					<div class="wp-plogg-saf-question-number">7</div>
					
					<div class="wp-plogg-saf-question-fields-wrapper">
						
						<div class="wp-plogg-saf-single-question-wrapper">
							<label for="wp_plogg_saf_ronfle_oui" class="wp-plogg-saf-label">
				                <span><?php _e('Do you snore?','wp_plogg_sleep_apnea_form'); ?></span>
				            </label><br/>
							<input type="radio" name="wp_plogg_saf_ronfle" data-related-val="1" id="wp_plogg_saf_ronfle_oui" value="<?php _e('Yes','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_ronfle_oui" class=""><?php _e('Yes','wp_plogg_sleep_apnea_form'); ?></label>
							<input type="radio" name="wp_plogg_saf_ronfle" data-related-val="0" id="wp_plogg_saf_ronfle_non" value="<?php _e('No','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_ronfle_non" class=""><?php _e('No','wp_plogg_sleep_apnea_form'); ?></label>
						</div>
						
						
						<div class="wp_plogg_saf_si_ronfle_oui">
							<div class="wp-plogg-saf-single-question-wrapper">
								<label for="wp_plogg_saf_ronfle_depuis" class="wp-plogg-saf-label" >
					                <span><?php _e('Since how long?','wp_plogg_sleep_apnea_form'); ?></span>
					            </label><br/>
								<input type="text" name="wp_plogg_saf_ronfle_depuis" id="wp_plogg_saf_ronfle_depuis" placeholder="" value="" size="22" tabindex="5" />
							</div>
							
							<div class="wp-plogg-saf-single-question-wrapper">
								<label for="wp_plogg_saf_socialement_derangeant_oui" class="wp-plogg-saf-label">
					                <span><?php _e('Socially disturbing','wp_plogg_sleep_apnea_form'); ?></span>
					            </label><br/>
								<input type="radio" name="wp_plogg_saf_socialement_derangeant" data-related="wp_plogg_saf_ronfle" id="wp_plogg_saf_socialement_derangeant_oui" value="<?php _e('Yes','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_socialement_derangeant_oui" class=""><?php _e('Yes','wp_plogg_sleep_apnea_form'); ?></label>
								<input type="radio" name="wp_plogg_saf_socialement_derangeant" data-related="wp_plogg_saf_ronfle" id="wp_plogg_saf_socialement_derangeant_non" value="<?php _e('No','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_socialement_derangeant_non" class=""><?php _e('No','wp_plogg_sleep_apnea_form'); ?></label>
								
								<br/>
	
								<input type="radio" name="wp_plogg_saf_socialement_comment" data-related="wp_plogg_saf_ronfle" id="wp_plogg_saf_socialement_comment_grave" value="<?php _e('Severe','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_socialement_comment_grave" class=""><?php _e('Severe','wp_plogg_sleep_apnea_form'); ?></label>
								<input type="radio" name="wp_plogg_saf_socialement_comment" data-related="wp_plogg_saf_ronfle" id="wp_plogg_saf_socialement_comment_modere" value="<?php _e('Moderate','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_socialement_comment_modere" class=""><?php _e('Moderate','wp_plogg_sleep_apnea_form'); ?></label>
								<input type="radio" name="wp_plogg_saf_socialement_comment" data-related="wp_plogg_saf_ronfle" id="wp_plogg_saf_socialement_comment_leger" value="<?php _e('Light','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_socialement_comment_leger" class=""><?php _e('Light','wp_plogg_sleep_apnea_form'); ?></label>
							</div>
							
							<div class="wp-plogg-saf-single-question-wrapper">
								<label for="wp_plogg_saf_ronfle_dos_oui" class="wp-plogg-saf-label">
					                <span><?php _e('More important when you sleep on your back?','wp_plogg_sleep_apnea_form'); ?></span>
					            </label><br/>
								<input type="radio" name="wp_plogg_saf_ronfle_dos" data-related="wp_plogg_saf_ronfle" id="wp_plogg_saf_ronfle_dos_oui" value="<?php _e('Yes','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_ronfle_dos_oui" class=""><?php _e('Yes','wp_plogg_sleep_apnea_form'); ?></label>
								<input type="radio" name="wp_plogg_saf_ronfle_dos" data-related="wp_plogg_saf_ronfle" id="wp_plogg_saf_ronfle_dos_non" value="<?php _e('No','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_ronfle_dos_non" class=""><?php _e('No','wp_plogg_sleep_apnea_form'); ?></label>
							</div>
							
							<div class="wp-plogg-saf-single-question-wrapper">
								<label for="wp_plogg_saf_ronfle_regulier_oui" class="wp-plogg-saf-label">
					                <span><?php _e('Regulary?','wp_plogg_sleep_apnea_form'); ?></span>
					            </label><br/>
								<input type="radio" name="wp_plogg_saf_ronfle_regulier" data-related="wp_plogg_saf_ronfle" id="wp_plogg_saf_ronfle_regulier_oui" value="<?php _e('Yes','wp_plogg_sleep_apnea_form'); ?>"class="custom-radio"  /> <label for="wp_plogg_saf_ronfle_regulier_oui" class=""><?php _e('Yes','wp_plogg_sleep_apnea_form'); ?></label>
								<input type="radio" name="wp_plogg_saf_ronfle_regulier" data-related="wp_plogg_saf_ronfle" id="wp_plogg_saf_ronfle_regulier_non" value="<?php _e('No','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_ronfle_regulier_non" class=""><?php _e('No','wp_plogg_sleep_apnea_form'); ?></label>
							</div>
						
							<div class="wp-plogg-saf-single-question-wrapper">
								<label for="wp_plogg_saf_ronfle_explosif_oui" class="wp-plogg-saf-label">
					                <span><?php _e('Explosive?','wp_plogg_sleep_apnea_form'); ?></span>
					            </label><br/>
								<input type="radio" name="wp_plogg_saf_ronfle_explosif" data-related="wp_plogg_saf_ronfle" id="wp_plogg_saf_ronfle_explosif_oui" value="<?php _e('Yes','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_ronfle_explosif_oui" class=""><?php _e('Yes','wp_plogg_sleep_apnea_form'); ?></label>
								<input type="radio" name="wp_plogg_saf_ronfle_explosif" data-related="wp_plogg_saf_ronfle" id="wp_plogg_saf_ronfle_explosif_non" value="<?php _e('No','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_ronfle_explosif_non" class=""><?php _e('No','wp_plogg_sleep_apnea_form'); ?></label>
							</div>
							
							<div class="wp-plogg-saf-single-question-wrapper">
								<label class="wp-plogg-saf-label">
					                <span><?php _e('Is your snoring worsened by','wp_plogg_sleep_apnea_form'); ?>:</span>
					            </label><br/>
					            
					            <br/>
					            
					            <label for="wp_plogg_saf_ronfle_agrave_par_alcool_oui" class="wp-plogg-saf-label">
					                <span><?php _e('Alcohol intake','wp_plogg_sleep_apnea_form'); ?></span>
					            </label><br/>
					           
								<input type="radio" name="wp_plogg_saf_ronfle_agrave_par_alcool" data-related="wp_plogg_saf_ronfle" id="wp_plogg_saf_ronfle_agrave_par_alcool_oui" value="<?php _e('Yes','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> 
								<label for="wp_plogg_saf_ronfle_agrave_par_alcool_oui" class=""><?php _e('Yes','wp_plogg_sleep_apnea_form'); ?></label>
								<input type="radio" name="wp_plogg_saf_ronfle_agrave_par_alcool" data-related="wp_plogg_saf_ronfle" id="wp_plogg_saf_ronfle_agrave_par_alcool_non" value="<?php _e('No','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> 
								<label for="wp_plogg_saf_ronfle_agrave_par_alcool_non" class=""><?php _e('No','wp_plogg_sleep_apnea_form'); ?></label>
								
								<br/>
								<br/>
								
					            <label for="wp_plogg_saf_ronfle_agrave_par_alcool_oui" class="wp-plogg-saf-label">
					                <span><?php _e('Tiredness','wp_plogg_sleep_apnea_form'); ?></span>
					            </label><br/>
								<input type="radio" name="wp_plogg_saf_ronfle_agrave_par_fatigue" data-related="wp_plogg_saf_ronfle" id="wp_plogg_saf_ronfle_agrave_par_fatigue_oui" value="<?php _e('Yes','wp_plogg_sleep_apnea_form'); ?>" class="custom-checkbox" /> 
								<label for="wp_plogg_saf_ronfle_agrave_par_fatigue_oui" class=""><?php _e('Yes','wp_plogg_sleep_apnea_form'); ?></label>
								<input type="radio" name="wp_plogg_saf_ronfle_agrave_par_fatigue" data-related="wp_plogg_saf_ronfle" id="wp_plogg_saf_ronfle_agrave_par_fatigue_non" value="<?php _e('No','wp_plogg_sleep_apnea_form'); ?>" class="custom-checkbox" /> 
								<label for="wp_plogg_saf_ronfle_agrave_par_fatigue_non" class=""><?php _e('No','wp_plogg_sleep_apnea_form'); ?></label>
							</div>
						</div>
						
					</div>
				</div>
				
				<div class="wp-plogg-saf-field-wrapper">
					<div class="wp-plogg-saf-question-number">8</div>
					
					<div class="wp-plogg-saf-question-fields-wrapper">
						
						<div class="wp-plogg-saf-single-question-wrapper">
							<label for="wp_plogg_saf_pause_oui" class="wp-plogg-saf-label">
				                <span><?php _e('Do you have respiratory pauses during your sleep which are noted by an external person?','wp_plogg_sleep_apnea_form'); ?></span>
				            </label><br/>
							<input type="radio" name="wp_plogg_saf_pause" data-related-val="1" id="wp_plogg_saf_pause_oui" value="<?php _e('Yes','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_pause_oui" class=""><?php _e('Yes','wp_plogg_sleep_apnea_form'); ?></label>
							<input type="radio" name="wp_plogg_saf_pause" data-related-val="0" id="wp_plogg_saf_pause_non" value="<?php _e('No','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_pause_non" class=""><?php _e('No','wp_plogg_sleep_apnea_form'); ?></label>
						</div>
						<div class="wp-plogg-saf-single-question-wrapper wp_plogg_saf_si_pause_oui">
							<label for="wp_plogg_saf_pause_frequence_rarement" class="wp-plogg-saf-label">
				                <span><?php _e('If yes, does it happen','wp_plogg_sleep_apnea_form'); ?></span>
				            </label><br/>
							<input type="radio" name="wp_plogg_saf_pause_frequence" data-related="wp_plogg_saf_pause" id="wp_plogg_saf_pause_frequence_rarement" value="<?php _e('Rarely','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_pause_frequence_rarement" class=""><?php _e('Rarely','wp_plogg_sleep_apnea_form'); ?></label>
							<input type="radio" name="wp_plogg_saf_pause_frequence" data-related="wp_plogg_saf_pause" id="wp_plogg_saf_pause_frequence_souvent" value="<?php _e('Often','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_pause_frequence_souvent" class=""><?php _e('Often','wp_plogg_sleep_apnea_form'); ?></label>
							<input type="radio" name="wp_plogg_saf_pause_frequence" data-related="wp_plogg_saf_pause" id="wp_plogg_saf_pause_frequence_everynight" value="<?php _e('Every night','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_pause_frequence_everynight" class=""><?php _e('Every night','wp_plogg_sleep_apnea_form'); ?></label>
						</div>
					</div>
				</div>
				
				<div class="wp-plogg-saf-field-wrapper">
					<div class="wp-plogg-saf-question-number">9</div>
					
					<div class="wp-plogg-saf-question-fields-wrapper">
						<label for="wp_plogg_saf_reveil_etouffe_oui" class="wp-plogg-saf-label">
			                <span><?php _e('Did you ever wake up with a choking sensation?','wp_plogg_sleep_apnea_form'); ?></span>
			            </label><br/>
						<input type="radio" name="wp_plogg_saf_reveil_etouffe" id="wp_plogg_saf_reveil_etouffe_oui" value="<?php _e('Yes','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_reveil_etouffe_oui" class=""><?php _e('Yes','wp_plogg_sleep_apnea_form'); ?></label>
						<input type="radio" name="wp_plogg_saf_reveil_etouffe" id="wp_plogg_saf_reveil_etouffe_non" value="<?php _e('No','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_reveil_etouffe_non" class=""><?php _e('No','wp_plogg_sleep_apnea_form'); ?></label>
					</div>
				</div>
				
				<div class="wp-plogg-saf-prev-next-buttons">
					<div class="prev button"><?php _e('Previous step','wp_plogg_sleep_apnea_form'); ?></div>
					<div class="next button"><?php _e('Next step','wp_plogg_sleep_apnea_form'); ?></div>
				</div>
			</div>
			
			
			<div class="wp-plogg-saf-step" data-step="3">
				<div class="wp-plogg-saf-step-counter">
					<?php _e('Step','wp_plogg_sleep_apnea_form'); ?> 3/<span>5</span>
				</div>
				
				<h2><?php _e('Epworth sleepiness scale','wp_plogg_sleep_apnea_form'); ?></h2>
			
				<div class="wp-plogg-saf-field-wrapper">
					<div class="wp-plogg-saf-question-number">10</div>
					
					<div class="wp-plogg-saf-question-fields-wrapper">
						<label for="wp_plogg_saf_somnolent_oui" class="wp-plogg-saf-label">
			                <span><?php _e('Are you sleepy during the day?','wp_plogg_sleep_apnea_form'); ?></span>
			            </label><br/>
						<input type="radio" name="wp_plogg_saf_somnolent" id="wp_plogg_saf_somnolent_oui" value="<?php _e('Yes','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_somnolent_oui" class=""><?php _e('Yes','wp_plogg_sleep_apnea_form'); ?></label>
						<input type="radio" name="wp_plogg_saf_somnolent" id="wp_plogg_saf_somnolent_non" value="<?php _e('No','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_somnolent_non" class=""><?php _e('No','wp_plogg_sleep_apnea_form'); ?></label>
					
					
						<p>
						<?php _e('Last week, what was your probability of drowsing (letting yourself fall asleep slowly; being half asleep) during the following situations? Even if you have not recently been in one of these situations, try to imagine how this situation could have affected you. To answer, use the following scale by choosing the appropriate number for each situation:','wp_plogg_sleep_apnea_form'); ?>
						</p>
						<p>
							<?php _e('No drowsiness','wp_plogg_sleep_apnea_form'); ?>:  0<br/>
							<?php _e('Small chance of drowsiness','wp_plogg_sleep_apnea_form'); ?>:  1<br/>
							<?php _e('Moderate chance of drowsiness','wp_plogg_sleep_apnea_form'); ?>:  2<br/>
							<?php _e('High chance of drowsiness','wp_plogg_sleep_apnea_form'); ?>:  3<br/>
						</p>
						
						<label class="wp-plogg-saf-label">
							<span><?php _e('Situations: Answer each of the statements below:','wp_plogg_sleep_apnea_form'); ?></span>
						</label>
						<br/>
						<br/>
						
						<div class="wp-plogg-saf-situations-wrapper">
							<label for="wp_plogg_saf_situation_lire"><?php _e('Sitting down reading','wp_plogg_sleep_apnea_form'); ?></label>
							<label class="custom-combobox wp_plogg_saf_situation_label">
								<select name="wp_plogg_saf_situation_lire" id="wp_plogg_saf_situation_lire">
									<option value=""><?php _e('Choose an answer','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="0">0 - <?php _e('No drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="1">1 - <?php _e('Small chance of drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="2">2 - <?php _e('Moderate chance of drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="3">3 - <?php _e('High chance of drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
								</select>
							</label>							
							<br/>
							<?php /*
							<input type="number" name="wp_plogg_saf_situation_lire" id="wp_plogg_saf_situation_lire"  size="1"  required/><br/>*/ ?>
							
							<label for="wp_plogg_saf_situation_tele"><?php _e('Sitting down watching television','wp_plogg_sleep_apnea_form'); ?></label>
							<label class="custom-combobox wp_plogg_saf_situation_label">
								<select name="wp_plogg_saf_situation_tele" id="wp_plogg_saf_situation_tele">
									<option value=""><?php _e('Choose an answer','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="0">0 - <?php _e('No drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="1">1 - <?php _e('Small chance of drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="2">2 - <?php _e('Moderate chance of drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="3">3 - <?php _e('High chance of drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
								</select>
							</label>							
							<br/>
							<?php /*
							<input type="number" name="wp_plogg_saf_situation_tele" id="wp_plogg_saf_situation_tele"  size="1" required/><br/>
							*/ ?>
							
							<label for="wp_plogg_saf_situation_inactif"><?php _e('Sitting down inactive in a public place (movies, theater (play), meeting)','wp_plogg_sleep_apnea_form'); ?></label>
							<label class="custom-combobox wp_plogg_saf_situation_label">
								<select name="wp_plogg_saf_situation_inactif" id="wp_plogg_saf_situation_inactif">
									<option value=""><?php _e('Choose an answer','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="0">0 - <?php _e('No drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="1">1 - <?php _e('Small chance of drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="2">2 - <?php _e('Moderate chance of drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="3">3 - <?php _e('High chance of drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
								</select>
							</label>							
							<br/>
							<?php /*
							<input type="number" name="wp_plogg_saf_situation_inactif" id="wp_plogg_saf_situation_inactif"  size="1" required/><br/>
							*/ ?>
							 
							<label for="wp_plogg_saf_situation_passager"><?php _e('Sitting down as a passenger in a car (or in a public transport) for more than one hour without interruption','wp_plogg_sleep_apnea_form'); ?></label>
							<label class="custom-combobox wp_plogg_saf_situation_label">
								<select name="wp_plogg_saf_situation_passager" id="wp_plogg_saf_situation_passager">
									<option value=""><?php _e('Choose an answer','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="0">0 - <?php _e('No drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="1">1 - <?php _e('Small chance of drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="2">2 - <?php _e('Moderate chance of drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="3">3 - <?php _e('High chance of drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
								</select>
							</label>							
							<br/>
							<?php /*
							<input type="number" name="wp_plogg_saf_situation_passager" id="wp_plogg_saf_situation_passager"  size="1"  required/><br/>
							*/ ?>
							
							<label for="wp_plogg_saf_situation_sieste"><?php _e('Resting laid down in the afternoon when circumstances allow it','wp_plogg_sleep_apnea_form'); ?></label>
							<label class="custom-combobox wp_plogg_saf_situation_label">
								<select name="wp_plogg_saf_situation_sieste" id="wp_plogg_saf_situation_sieste">
									<option value=""><?php _e('Choose an answer','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="0">0 - <?php _e('No drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="1">1 - <?php _e('Small chance of drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="2">2 - <?php _e('Moderate chance of drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="3">3 - <?php _e('High chance of drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
								</select>
							</label>							
							<br/>
							<?php /*
							<input type="number" name="wp_plogg_saf_situation_sieste" id="wp_plogg_saf_situation_sieste"  size="1"  required/><br/>
							*/ ?>
							
							<label for="wp_plogg_saf_situation_discute_assis"><?php _e('Sitting down talking to someone','wp_plogg_sleep_apnea_form'); ?></label>
							<label class="custom-combobox wp_plogg_saf_situation_label">
								<select name="wp_plogg_saf_situation_discute_assis" id="wp_plogg_saf_situation_discute_assis">
									<option value=""><?php _e('Choose an answer','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="0">0 - <?php _e('No drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="1">1 - <?php _e('Small chance of drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="2">2 - <?php _e('Moderate chance of drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="3">3 - <?php _e('High chance of drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
								</select>
							</label>							
							<br/>
							<?php /*
							<input type="number" name="wp_plogg_saf_situation_discute_assis" id="wp_plogg_saf_situation_discute_assis"  size="1" required/><br/>
							*/ ?>
							
							<label for="wp_plogg_saf_situation_apres_manger"><?php _e('Sitting down calmly after lunch without alcohol','wp_plogg_sleep_apnea_form'); ?></label>
							<label class="custom-combobox wp_plogg_saf_situation_label">
								<select name="wp_plogg_saf_situation_apres_manger" id="wp_plogg_saf_situation_apres_manger">
									<option value=""><?php _e('Choose an answer','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="0">0 - <?php _e('No drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="1">1 - <?php _e('Small chance of drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="2">2 - <?php _e('Moderate chance of drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="3">3 - <?php _e('High chance of drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
								</select>
							</label>							
							<br/>
							<?php /*
							<input type="number" name="wp_plogg_saf_situation_apres_manger" id="wp_plogg_saf_situation_apres_manger"  size="1"  required/><br/>
							*/ ?>
							
							<label for="wp_plogg_saf_situation_congestion"><?php _e('Sitting down in a car that is stuck in traffic for a few minutes','wp_plogg_sleep_apnea_form'); ?></label>
							<label class="custom-combobox wp_plogg_saf_situation_label">
								<select name="wp_plogg_saf_situation_congestion" id="wp_plogg_saf_situation_congestion">
									<option value=""><?php _e('Choose an answer','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="0">0 - <?php _e('No drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="1">1 - <?php _e('Small chance of drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="2">2 - <?php _e('Moderate chance of drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
									<option value="3">3 - <?php _e('High chance of drowsiness','wp_plogg_sleep_apnea_form'); ?></option>
								</select>
							</label>							
							<br/>
							<?php /*
							<input type="number" name="wp_plogg_saf_situation_congestion" id="wp_plogg_saf_situation_congestion"  size="1"  required/><br/>
							*/ ?>
						</div>
						
						<div class="wp-plogg-saf-situation-total-wrapper">
							<p>
								<b>Total = <span class="wp-plogg-saf-situation-total"></span></b>
							</p>
						</div>
					</div>
					
					
					<div class="wp-plogg-saf-field-wrapper">
						<div class="wp-plogg-saf-question-number">11</div>
						
						<div class="wp-plogg-saf-question-fields-wrapper">
							<label for="wp_plogg_saf_besoin_bouger_oui" class="wp-plogg-saf-label">
				                <span><?php _e('Do you feel the need to move your legs irresistibly?','wp_plogg_sleep_apnea_form'); ?></span>
				            </label><br/>
							<input type="radio" name="wp_plogg_saf_besoin_bouger" id="wp_plogg_saf_besoin_bouger_oui" value="<?php _e('Yes','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_besoin_bouger_oui" class=""><?php _e('Yes','wp_plogg_sleep_apnea_form'); ?></label>
							<input type="radio" name="wp_plogg_saf_besoin_bouger" id="wp_plogg_saf_besoin_bouger_non" value="<?php _e('No','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_besoin_bouger_non" class=""><?php _e('No','wp_plogg_sleep_apnea_form'); ?></label>
						</div>
					</div>
					
					<div class="wp-plogg-saf-field-wrapper">
						<div class="wp-plogg-saf-question-number">12</div>
						
						<div class="wp-plogg-saf-question-fields-wrapper">
							<label for="wp_plogg_saf_mal_tete_reveil_oui" class="wp-plogg-saf-label">
				                <span><?php _e('Do you suffer from headaches in the morning when you wake up?','wp_plogg_sleep_apnea_form'); ?></span>
				            </label><br/>
							<input type="radio" name="wp_plogg_saf_mal_tete_reveil" id="wp_plogg_saf_mal_tete_reveil_oui" value="<?php _e('Yes','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_mal_tete_reveil_oui" class=""><?php _e('Yes','wp_plogg_sleep_apnea_form'); ?></label>
							<input type="radio" name="wp_plogg_saf_mal_tete_reveil" id="wp_plogg_saf_mal_tete_reveil_non" value="<?php _e('No','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_mal_tete_reveil_non" class=""><?php _e('No','wp_plogg_sleep_apnea_form'); ?></label>
						</div>
					</div>
					
					<div class="wp-plogg-saf-field-wrapper">
						<div class="wp-plogg-saf-question-number">13</div>
						
						<div class="wp-plogg-saf-question-fields-wrapper">
							<label for="wp_plogg_saf_perte_memoire_oui" class="wp-plogg-saf-label">
				                <span><?php _e('Do you suffer from memory loss?','wp_plogg_sleep_apnea_form'); ?></span>
				            </label><br/>
							<input type="radio" name="wp_plogg_saf_perte_memoire" id="wp_plogg_saf_perte_memoire_oui" value="<?php _e('Yes','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_perte_memoire_oui" class=""><?php _e('Yes','wp_plogg_sleep_apnea_form'); ?></label>
							<input type="radio" name="wp_plogg_saf_perte_memoire" id="wp_plogg_saf_perte_memoire_non" value="<?php _e('No','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_perte_memoire_non" class=""><?php _e('No','wp_plogg_sleep_apnea_form'); ?></label>
						</div>
					</div>
					
					<div class="wp-plogg-saf-field-wrapper">
						<div class="wp-plogg-saf-question-number">14</div>
						
						<div class="wp-plogg-saf-question-fields-wrapper">
							<label for="wp_plogg_saf_mauvaise_concentration_oui" class="wp-plogg-saf-label">
				                <span><?php _e('Do you have poor concentration or difficulties focusing your attention?','wp_plogg_sleep_apnea_form'); ?></span>
				            </label><br/>
							<input type="radio" name="wp_plogg_saf_mauvaise_concentration" id="wp_plogg_saf_mauvaise_concentration_oui" value="<?php _e('Yes','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_mauvaise_concentration_oui" class=""><?php _e('Yes','wp_plogg_sleep_apnea_form'); ?></label>
							<input type="radio" name="wp_plogg_saf_mauvaise_concentration" id="wp_plogg_saf_mauvaise_concentration_non" value="<?php _e('No','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_mauvaise_concentration_non" class=""><?php _e('No','wp_plogg_sleep_apnea_form'); ?></label>
						</div>
					</div>
										
					<div class="wp-plogg-saf-field-wrapper">
						<div class="wp-plogg-saf-question-number">15</div>
						
						<div class="wp-plogg-saf-question-fields-wrapper">
							
							<div class="wp-plogg-saf-single-question-wrapper">
								<label for="wp_plogg_saf_deja_traite_oui" class="wp-plogg-saf-label">
					                <span><?php _e('Do you get or have you ever gotten a treatment for the condition that brings you to consult today?','wp_plogg_sleep_apnea_form'); ?></span>
					            </label><br/>
								<input type="radio" name="wp_plogg_saf_deja_traite" id="wp_plogg_saf_deja_traite_oui" value="<?php _e('Yes','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_deja_traite_oui" class=""><?php _e('Yes','wp_plogg_sleep_apnea_form'); ?></label>
								<input type="radio" name="wp_plogg_saf_deja_traite" id="wp_plogg_saf_deja_traite_non" value="<?php _e('No','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_deja_traite_non" class=""><?php _e('No','wp_plogg_sleep_apnea_form'); ?></label>
							</div>
							
							<div class="wp-plogg-saf-single-question-wrapper">
								<label for="wp_plogg_saf_deja_traite_quand" class="wp-plogg-saf-label" style="display:none">
					                <span><?php _e('If yes, since how long?','wp_plogg_sleep_apnea_form'); ?></span>
					            </label><br/>
								<input type="text" name="wp_plogg_saf_deja_traite_quand" id="wp_plogg_saf_deja_traite_quand" placeholder="" value="" size="22" tabindex="5" style="display:none"/>
							</div>
						</div>
					</div>
					
					
				</div>
				
				
				<div class="wp-plogg-saf-prev-next-buttons">
					<div class="prev button"><?php _e('Previous step','wp_plogg_sleep_apnea_form'); ?></div>
					<div class="next button"><?php _e('Next step','wp_plogg_sleep_apnea_form'); ?></div>
				</div>
			</div>
			
			
			<div class="wp-plogg-saf-step" data-step="4">
				<div class="wp-plogg-saf-step-counter">
					<?php _e('Step','wp_plogg_sleep_apnea_form'); ?> 4<span>/5</span>
				</div>
				
				<h2><?php _e('Symptoms that can be associated with sleep apnea','wp_plogg_sleep_apnea_form'); ?></h2>
				
				<div class="wp-plogg-saf-symptoms-cols-wrapper">
					<div class="wp-plogg-saf-symptoms-col">
						<b><?php _e('Daytime signs','wp_plogg_sleep_apnea_form'); ?></b><br/>
						
						<input type="checkbox" name="wp_plogg_saf_day_symptoms[]" id="wp_plogg_saf_symptoms_maux_tete" value="<?php _e('Headaches','wp_plogg_sleep_apnea_form'); ?>" class="custom-checkbox" /> <label for="wp_plogg_saf_symptoms_maux_tete" class=""><?php _e('Headaches','wp_plogg_sleep_apnea_form'); ?></label><br/>
						<input type="checkbox" name="wp_plogg_saf_day_symptoms[]" id="wp_plogg_saf_symptoms_hypersomnolence" value="<?php _e('Hypersomnia','wp_plogg_sleep_apnea_form'); ?>" class="custom-checkbox" /> <label for="wp_plogg_saf_symptoms_hypersomnolence" class=""><?php _e('Hypersomnia','wp_plogg_sleep_apnea_form'); ?></label><br/>
						<input type="checkbox" name="wp_plogg_saf_day_symptoms[]" id="wp_plogg_saf_symptoms_manque_sommeil" value="<?php _e('Lack of restorative sleep','wp_plogg_sleep_apnea_form'); ?>" class="custom-checkbox" /> <label for="wp_plogg_saf_symptoms_manque_sommeil" class=""><?php _e('Lack of restorative sleep','wp_plogg_sleep_apnea_form'); ?></label><br/>
						<input type="checkbox" name="wp_plogg_saf_day_symptoms[]" id="wp_plogg_saf_symptoms_perte_memoire" value="<?php _e('Memory loss','wp_plogg_sleep_apnea_form'); ?>" class="custom-checkbox" /> <label for="wp_plogg_saf_symptoms_perte_memoire" class=""><?php _e('Memory loss','wp_plogg_sleep_apnea_form'); ?></label><br/>
						<input type="checkbox" name="wp_plogg_saf_day_symptoms[]" id="wp_plogg_saf_symptoms_irritable" value="<?php _e('Irritability','wp_plogg_sleep_apnea_form'); ?>" class="custom-checkbox" /> <label for="wp_plogg_saf_symptoms_irritable" class=""><?php _e('Irritability','wp_plogg_sleep_apnea_form'); ?></label><br/>
						<input type="checkbox" name="wp_plogg_saf_day_symptoms[]" id="wp_plogg_saf_symptoms_epuisement" value="<?php _e('Exhaustion','wp_plogg_sleep_apnea_form'); ?>" class="custom-checkbox" /> <label for="wp_plogg_saf_symptoms_epuisement" class=""><?php _e('Exhaustion','wp_plogg_sleep_apnea_form'); ?></label><br/>
						<input type="checkbox" name="wp_plogg_saf_day_symptoms[]" id="wp_plogg_saf_symptoms_libido" value="<?php _e('Loss of libido','wp_plogg_sleep_apnea_form'); ?>" class="custom-checkbox" /> <label for="wp_plogg_saf_symptoms_libido" class=""><?php _e('Loss of libido','wp_plogg_sleep_apnea_form'); ?></label><br/>
					</div>
					<div class="wp-plogg-saf-symptoms-col">
						<b><?php _e('Night-time signs','wp_plogg_sleep_apnea_form'); ?></b><br/>
						
						<input type="checkbox" name="wp_plogg_saf_night_symptoms[]" id="wp_plogg_saf_symptoms_ronfle" value="<?php _e('Snoring','wp_plogg_sleep_apnea_form'); ?>" class="custom-checkbox" /> <label for="wp_plogg_saf_symptoms_ronfle" class=""><?php _e('Snoring','wp_plogg_sleep_apnea_form'); ?></label><br/>
						<input type="checkbox" name="wp_plogg_saf_night_symptoms[]" id="wp_plogg_saf_symptoms_agite" value="<?php _e('Agitated sleep','wp_plogg_sleep_apnea_form'); ?>" class="custom-checkbox" /> <label for="wp_plogg_saf_symptoms_agite" class=""><?php _e('Agitated sleep','wp_plogg_sleep_apnea_form'); ?></label><br/>
						<input type="checkbox" name="wp_plogg_saf_night_symptoms[]" id="wp_plogg_saf_symptoms_transpire" value="<?php _e('Night-time sweating','wp_plogg_sleep_apnea_form'); ?>" class="custom-checkbox" /> <label for="wp_plogg_saf_symptoms_transpire" class=""><?php _e('Night-time sweating','wp_plogg_sleep_apnea_form'); ?></label><br/>
						<input type="checkbox" name="wp_plogg_saf_night_symptoms[]" id="wp_plogg_saf_symptoms_etouffe" value="<?php _e('Arousals with choking sensation','wp_plogg_sleep_apnea_form'); ?>" class="custom-checkbox" /> <label for="wp_plogg_saf_symptoms_etouffe" class=""><?php _e('Arousals with choking sensation','wp_plogg_sleep_apnea_form'); ?></label><br/>
						<input type="checkbox" name="wp_plogg_saf_night_symptoms[]" id="wp_plogg_saf_symptoms_tiers" value="<?php _e('Apnea observed by relatives','wp_plogg_sleep_apnea_form'); ?>" class="custom-checkbox" /> <label for="wp_plogg_saf_symptoms_tiers" class=""><?php _e('Apnea observed by relatives','wp_plogg_sleep_apnea_form'); ?></label><br/>
						<input type="checkbox" name="wp_plogg_saf_night_symptoms[]" id="wp_plogg_saf_symptoms_leve_souvent" value="<?php _e('Getting out of bed regularly to urinate at night','wp_plogg_sleep_apnea_form'); ?>" class="custom-checkbox" /> <label for="wp_plogg_saf_symptoms_leve_souvent" class=""><?php _e('Getting out of bed regularly to urinate at night','wp_plogg_sleep_apnea_form'); ?></label><br/>
					</div>
				</div>
				
				<p>
					<?php _e('The presence of these symptoms indicates the possibility of suffering from sleep apnea or another sleep disorder.','wp_plogg_sleep_apnea_form'); ?>
				</p>
				
				<div class="wp-plogg-saf-prev-next-buttons">
					<div class="prev button"><?php _e('Previous step','wp_plogg_sleep_apnea_form'); ?></div>
					<div class="next button"><?php _e('Next step','wp_plogg_sleep_apnea_form'); ?></div>
				</div>
			</div>
			
			<div class="wp-plogg-saf-step" data-step="5">
				<div class="wp-plogg-saf-step-counter">
					<?php _e('Step','wp_plogg_sleep_apnea_form'); ?> 5<span>/5</span>
				</div>
				
				<h2><?php _e('Diagnosis','wp_plogg_sleep_apnea_form'); ?></h2>
				
				<h3><?php _e('Predictive values',"wp_plogg_sleep_apnea_form"); ?></h3>
				
				<div class="wp-plogg-saf-field-wrapper">
					
					<div class="wp-plogg-saf-question-fields-wrapper">
						
						<div class="wp-plogg-saf-single-question-wrapper">
							<label for="wp_plogg_saf_circonference_oui" class="wp-plogg-saf-label">
				                <span><?php _e('Neck circumference','wp_plogg_sleep_apnea_form'); ?></span>
				            </label><br/>
							<input type="radio" name="wp_plogg_saf_circonference" id="wp_plogg_saf_circonference_oui" value="<?php _e('Yes','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_circonference_oui" class=""><?php _e('Yes','wp_plogg_sleep_apnea_form'); ?></label>
							<input type="radio" name="wp_plogg_saf_circonference" id="wp_plogg_saf_circonference_non" value="<?php _e('No','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_circonference_non" class=""><?php _e('No','wp_plogg_sleep_apnea_form'); ?></label>
						</div>
						
						<div class="wp-plogg-saf-single-question-wrapper">
							<label for="wp_plogg_saf_pause_rapporte_oui" class="wp-plogg-saf-label">
				                <span><?php _e('Respiratory pauses reported by the spouse','wp_plogg_sleep_apnea_form'); ?></span>
				            </label><br/>
							<input type="radio" name="wp_plogg_saf_pause_rapporte" id="wp_plogg_saf_pause_rapporte_oui" value="<?php _e('Yes','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_pause_rapporte_oui" class=""><?php _e('Yes','wp_plogg_sleep_apnea_form'); ?></label>
							<input type="radio" name="wp_plogg_saf_pause_rapporte" id="wp_plogg_saf_pause_rapporte_non" value="<?php _e('No','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_pause_rapporte_non" class=""><?php _e('No','wp_plogg_sleep_apnea_form'); ?></label>
						</div>
						
						<div class="wp-plogg-saf-single-question-wrapper">
							<label for="wp_plogg_saf_etouffe_oui" class="wp-plogg-saf-label">
				                <span><?php _e('Choking sensation','wp_plogg_sleep_apnea_form'); ?></span>
				            </label><br/>
							<input type="radio" name="wp_plogg_saf_etouffe" id="wp_plogg_saf_etouffe_oui" value="<?php _e('Yes','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_etouffe_oui" class=""><?php _e('Yes','wp_plogg_sleep_apnea_form'); ?></label>
							<input type="radio" name="wp_plogg_saf_etouffe" id="wp_plogg_saf_etouffe_non" value="<?php _e('No','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_etouffe_non" class=""><?php _e('No','wp_plogg_sleep_apnea_form'); ?></label>
						</div>
						
						<div class="wp-plogg-saf-single-question-wrapper">
							<label for="wp_plogg_saf_somnole_oui" class="wp-plogg-saf-label">
				                <span><?php _e('Drowsiness','wp_plogg_sleep_apnea_form'); ?></span>
				            </label><br/>
							<input type="radio" name="wp_plogg_saf_somnole" id="wp_plogg_saf_somnole_oui" value="<?php _e('Yes','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_somnole_oui" class=""><?php _e('Yes','wp_plogg_sleep_apnea_form'); ?></label>
							<input type="radio" name="wp_plogg_saf_somnole" id="wp_plogg_saf_somnole_non" value="<?php _e('No','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_somnole_non" class=""><?php _e('No','wp_plogg_sleep_apnea_form'); ?></label>
						</div>
						
						<div class="wp-plogg-saf-single-question-wrapper">
							<label for="wp_plogg_saf_retrognathie_oui" class="wp-plogg-saf-label">
				                <span><?php _e('Mandibular and/or maxillary retrognathia','wp_plogg_sleep_apnea_form'); ?></span>
				            </label><br/>
							<input type="radio" name="wp_plogg_saf_retrognathie" id="wp_plogg_saf_retrognathie_oui" value="<?php _e('Yes','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_retrognathie_oui" class=""><?php _e('Yes','wp_plogg_sleep_apnea_form'); ?></label>
							<input type="radio" name="wp_plogg_saf_retrognathie" id="wp_plogg_saf_retrognathie_non" value="<?php _e('No','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_retrognathie_non" class=""><?php _e('No','wp_plogg_sleep_apnea_form'); ?></label>
						</div>
						
						<div class="wp-plogg-saf-single-question-wrapper">
							<label for="wp_plogg_saf_hypertension_oui" class="wp-plogg-saf-label">
				                <span><?php _e('Arterial hypertension','wp_plogg_sleep_apnea_form'); ?></span>
				            </label><br/>
							<input type="radio" name="wp_plogg_saf_hypertension" id="wp_plogg_saf_hypertension_oui" value="<?php _e('Yes','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_hypertension_oui" class=""><?php _e('Yes','wp_plogg_sleep_apnea_form'); ?></label>
							<input type="radio" name="wp_plogg_saf_hypertension" id="wp_plogg_saf_hypertension_non" value="<?php _e('No','wp_plogg_sleep_apnea_form'); ?>" class="custom-radio" /> <label for="wp_plogg_saf_hypertension_non" class=""><?php _e('No','wp_plogg_sleep_apnea_form'); ?></label>
						</div>
					</div>
				</div>

				
				<div class="wp-plogg-saf-prev-next-buttons">
					<div class="prev button"><?php _e('Previous step','wp_plogg_sleep_apnea_form'); ?></div>
					<div class="next button"><?php _e('Next step','wp_plogg_sleep_apnea_form'); ?></div>
				</div>
			</div>
			
			
			<div class="wp-plogg-saf-step" data-step="6">
			
				<h2><?php _e('Contact details for sending the results of the sleep apnea test','wp_plogg_sleep_apnea_form'); ?></h2>
				
				<p><?php _e('Please allow a delay of 2 to 5 days','wp_plogg_sleep_apnea_form'); ?></p>
				
				<div class="cols-wrapper">
					<div class="col-left">
						<input type="text" name="wp_plogg_sleep_apnea_form_nom" placeholder="<?php _e('Name','wp_plogg_sleep_apnea_form'); ?> *" required/>
					</div>
					<div class="col-right">
						<input type="email" name="wp_plogg_sleep_apnea_form_courriel" id="wp_plogg_sleep_apnea_form_courriel" placeholder="<?php _e('Email','wp_plogg_sleep_apnea_form'); ?> *" required/>
					</div>
				</div>
				
				<div class="wp-plogg-saf-prev-next-buttons">
					<div class="prev button"><?php _e('Previous step','wp_plogg_sleep_apnea_form'); ?></div>
					<button type="submit" class="button " name="submit"><?php _e('Send my answers','wp_plogg_sleep_apnea_form'); ?></button>
				</div>
				
			</div>
			
			<p class="error-sentence">
				<?php _e('Please answer correctly all the questions indicated in red.','wp_plogg_sleep_apnea_form'); ?>
			</p>
		</form>
		
	</div>
<?php	
}


function wp_plogg_sleep_apnea_form_load_textdomain() {
	// si wpml est installé on va chargé la bonne traduction
	if ( function_exists('icl_object_id') ) {
		load_plugin_textdomain( 'wp_plogg_sleep_apnea_form', false, dirname( plugin_basename( __FILE__ ) ) . '/l10n/' ); 
	}
	else {
		global $wp_plogg_sleep_apnea_form_settings;
		$wp_plogg_sleep_apnea_form_lang = $wp_plogg_sleep_apnea_form_settings['wp_plogg_sleep_apnea_form_language'];
		switch($wp_plogg_sleep_apnea_form_lang)
		{
			case "fr":
				$wp_plogg_sleep_apnea_form_lang_mo = "fr_FR";
			break;
			case "en":
				$wp_plogg_sleep_apnea_form_lang_mo = "en_EN";
			break;
			default:
				$wp_plogg_sleep_apnea_form_lang_mo = "fr_FR";
			break;
		}
		load_textdomain( 'wp_plogg_sleep_apnea_form', plugin_dir_path( __FILE__ ) . 'l10n/wp_plogg_sleep_apnea_form-'.$wp_plogg_sleep_apnea_form_lang_mo.'.mo' );
		
	}
  
}
add_action('init', 'wp_plogg_sleep_apnea_form_load_textdomain');
?>