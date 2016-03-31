<?php
	$bootstrap = 'wp-load.php';
	while( !is_file( $bootstrap ) ) {
		if( is_dir( '..' ) ) 
			chdir( '..' );
		else
			die( 'Impossible de trouver WordPress !' );
	}
	require_once( $bootstrap );
	
	
	
	if(isset($_POST['wp_plogg_sleep_apnea_form_nomformulaire']))
	{
		if(isset($_POST['wp_plogg_sleep_apnea_form_magicfield']) && $_POST['wp_plogg_sleep_apnea_form_magicfield']!='')
		{
			header('Location: ' . $_POST['wp_plogg_sleep_apnea_form_goto'] .'?wp_plogg_sleep_apnea_form_status=0');
		}
		else
		{
			$formulaire=$_POST['wp_plogg_sleep_apnea_form_nomformulaire'];
			$goto=$_POST['wp_plogg_sleep_apnea_form_goto'];
			
			global $wp_plogg_sleep_apnea_form_settings;
			
			switch($formulaire) {
				case 'wp_plogg_sleep_apnea':
					if(isset($_POST['wp_plogg_sleep_apnea_form_nom']) && isset($_POST['wp_plogg_sleep_apnea_form_courriel']) ){
						
						$subject =  __($wp_plogg_sleep_apnea_form_settings['email_subject']);
			
						$headers = 'From: '.$wp_plogg_sleep_apnea_form_settings['name_header_from'];
						if($wp_plogg_sleep_apnea_form_settings['email_header_from']){
							$headers .= ' <'.$wp_plogg_sleep_apnea_form_settings['email_header_from'].'>';
						}
		
						$email_destinataire = $wp_plogg_sleep_apnea_form_settings['email_doc'];
							
						$message_doc = __("Hello",'wp_plogg_sleep_apnea_form').',';
						$message_doc .= "<br/><br/>";
						
						$message_doc .= __("Someone filled the epWorth sleep apnea form",'wp_plogg_sleep_apnea_form')." ".$goto . ': <br/><br/>'; 
						
						$message_doc .= get_email_message();
						
						$message_doc .= __("Have a nice day",'wp_plogg_sleep_apnea_form').'<br/><br/>';
						
						
						add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
		
						if(wp_mail($email_destinataire, $subject, $message_doc, $headers, "")){
							unload_textdomain( "wp_plogg_sleep_apnea_form" );
							if( isset($_POST['wp_plogg_sleep_apnea_form_lang']) ){
								
								if($_POST['wp_plogg_sleep_apnea_form_lang'] == "en"){
									$wp_plogg_sleep_apnea_form_lang_mo="en_US";
								}else{
									$wp_plogg_sleep_apnea_form_lang_mo="fr_FR";
								}
								load_textdomain( 'wp_plogg_sleep_apnea_form', plugin_dir_path( __FILE__ ) . 'l10n/wp_plogg_sleep_apnea_form-'.$wp_plogg_sleep_apnea_form_lang_mo.'.mo' );
							}
							$message = get_email_message();
	
							//On envoie un mail à la personne qui a demandé le rendez-vous pour lui confirmer qu'on a recu son message
							if($_POST['wp_plogg_sleep_apnea_form_courriel']){
								
								if ( function_exists('icl_object_id') ) 
								{
									if( $_POST['wp_plogg_sleep_apnea_form_lang'] && $_POST['wp_plogg_sleep_apnea_form_lang'] == "en")
									{
										$email_text = $wp_plogg_sleep_apnea_form_settings['email_text_en'];
										$sujet = "Message receipt confirmation";
									}
									else
									{
										$email_text = $wp_plogg_sleep_apnea_form_settings['email_text'];
										$sujet = "Confirmation de réception de message";
									}
								}
								else
								{
									$email_text = $wp_plogg_sleep_apnea_form_settings['email_text'];
									$sujet = "Confirmation de réception de message";
								}
								$message_final = str_replace("%reponses%", $message, $email_text);
								
								$message_final = apply_filters('the_content', $message_final);
								
								
								wp_mail($_POST['wp_plogg_sleep_apnea_form_courriel'], $sujet, $message_final, $headers);
							}
							
								
							//Création d'un post pour sauvegarder les données
							$my_id = wp_insert_post(array(
						      'post_status'    => 'publish',
						      'post_content'  => '',
						      'post_author'   => 1, 
						      'post_title'    => 'Nouveau message de '.$_POST['wp_plogg_sleep_apnea_form_nom'],
						      'post_type'     => 'wp_plogg_saf',
						      ), true);
						   
							$wp_plogg_saf_neck_circumference = ($_POST['wp_plogg_saf_neck_circumference']?__($_POST['wp_plogg_saf_neck_circumference'],'wp_plogg_sleep_apnea_form'):__('No','wp_plogg_sleep_apnea_form'));
							$wp_plogg_saf_hypertension_calc = ($_POST['wp_plogg_saf_hypertension_calc']?__($_POST['wp_plogg_saf_hypertension_calc'],'wp_plogg_sleep_apnea_form'):__('No','wp_plogg_sleep_apnea_form'));
							$wp_plogg_saf_ronfle_calc = ($_POST['wp_plogg_saf_ronfle_calc']?__($_POST['wp_plogg_saf_ronfle_calc'],'wp_plogg_sleep_apnea_form'):__('No','wp_plogg_sleep_apnea_form'));
							$wp_plogg_saf_pause_calc = ($_POST['wp_plogg_saf_pause_calc']?__($_POST['wp_plogg_saf_pause_calc'],'wp_plogg_sleep_apnea_form'):__('No','wp_plogg_sleep_apnea_form'));
							$circ_total = 0;
							if($_POST['wp_plogg_saf_neck_circumference']){
								$circ_total+= $_POST['wp_plogg_saf_neck_circumference'];
							}
							if($_POST['wp_plogg_saf_hypertension_calc']){
								$circ_total+=4;
							}
							if($_POST['wp_plogg_saf_ronfle_calc']){
								$circ_total+=3;
							}
							if($_POST['wp_plogg_saf_pause_calc']){
								$circ_total+=3;
							}
						   
							$wp_plogg_saf_day_symptoms = $_POST['wp_plogg_saf_day_symptoms'];
							if(!isset($_POST['wp_plogg_saf_day_symptoms'])){
								$wp_plogg_saf_day_symptoms=__('None','wp_plogg_sleep_apnea_form');
							}else{
								$day_symptoms_traduit = array();
								foreach($_POST['wp_plogg_saf_day_symptoms'] as $day_symptoms){
									array_push($day_symptoms_traduit, __($day_symptoms,'wp_plogg_sleep_apnea_form'));
								}
								$wp_plogg_saf_day_symptoms = implode(', ', $day_symptoms_traduit);
							}
							
							$wp_plogg_saf_night_symptoms = $_POST['wp_plogg_saf_night_symptoms'];
							if(!isset($_POST['wp_plogg_saf_night_symptoms'])){
								$wp_plogg_saf_night_symptoms=__('None','wp_plogg_sleep_apnea_form');
							}else{
								$night_symptoms_traduit = array();
								foreach($_POST['wp_plogg_saf_night_symptoms'] as $night_symptom){
									array_push($night_symptoms_traduit, __($night_symptom,'wp_plogg_sleep_apnea_form'));
								}
								$wp_plogg_saf_night_symptoms = implode(', ', $night_symptoms_traduit);
							}
							
							$total_situations = $_POST['wp_plogg_saf_situation_lire'] + $_POST['wp_plogg_saf_situation_tele'] + $_POST['wp_plogg_saf_situation_inactif'] + $_POST['wp_plogg_saf_situation_passager'] + $_POST['wp_plogg_saf_situation_sieste'] + $_POST['wp_plogg_saf_situation_discute_assis'] + $_POST['wp_plogg_saf_situation_apres_manger'] + $_POST['wp_plogg_saf_situation_congestion'];

				            update_post_meta($my_id, 'wp_plogg_saf_nom', $_POST['wp_plogg_sleep_apnea_form_nom'] );
				            update_post_meta($my_id, 'wp_plogg_saf_courriel', $_POST['wp_plogg_sleep_apnea_form_courriel'] );
				            update_post_meta($my_id, 'wp_plogg_saf_url_provenance', $goto );
				            update_post_meta($my_id, 'wp_plogg_saf_neck_circumference', $wp_plogg_saf_neck_circumference );
				            update_post_meta($my_id, 'wp_plogg_saf_hypertension_calc', $wp_plogg_saf_hypertension_calc );
				            update_post_meta($my_id, 'wp_plogg_saf_ronfle_calc', $wp_plogg_saf_ronfle_calc );
				            update_post_meta($my_id, 'wp_plogg_saf_pause_calc', $wp_plogg_saf_pause_calc );
				            update_post_meta($my_id, 'wp_plogg_saf_circ_total', $circ_total );
				            update_post_meta($my_id, 'wp_plogg_saf_heure_couche', $_POST['wp_plogg_saf_heure_couche'] );
				            update_post_meta($my_id, 'wp_plogg_saf_heure_couche_minutes', $_POST['wp_plogg_saf_heure_couche_minutes'] );
				            update_post_meta($my_id, 'wp_plogg_saf_heure_leve', $_POST['wp_plogg_saf_heure_leve'] );
				            update_post_meta($my_id, 'wp_plogg_saf_heure_leve_minutes', $_POST['wp_plogg_saf_heure_leve_minutes'] );
				            update_post_meta($my_id, 'wp_plogg_saf_endormi_vite', $_POST['wp_plogg_saf_endormi_vite'] );
				            update_post_meta($my_id, 'wp_plogg_saf_reveille_facile', $_POST['wp_plogg_saf_reveille_facile'] );
				            update_post_meta($my_id, 'wp_plogg_saf_reveil_frequent', $_POST['wp_plogg_saf_reveil_frequent'] );
				            update_post_meta($my_id, 'wp_plogg_saf_matin_fatigue', $_POST['wp_plogg_saf_matin_fatigue'] );
				            update_post_meta($my_id, 'wp_plogg_saf_matin_fatigue_depuis', $_POST['wp_plogg_saf_matin_fatigue_depuis'] );
				            update_post_meta($my_id, 'wp_plogg_saf_qualite_sommeil', $_POST['wp_plogg_saf_qualite_sommeil'] );
				            update_post_meta($my_id, 'wp_plogg_saf_ronfle', $_POST['wp_plogg_saf_ronfle'] );
				            update_post_meta($my_id, 'wp_plogg_saf_ronfle_depuis', $_POST['wp_plogg_saf_ronfle_depuis'] );
				            update_post_meta($my_id, 'wp_plogg_saf_socialement_comment', $_POST['wp_plogg_saf_socialement_comment'] );
				            update_post_meta($my_id, 'wp_plogg_saf_socialement_derangeant', $_POST['wp_plogg_saf_socialement_derangeant'] );
				            update_post_meta($my_id, 'wp_plogg_saf_ronfle_dos', $_POST['wp_plogg_saf_ronfle_dos'] );
				            update_post_meta($my_id, 'wp_plogg_saf_socialement_comment', $_POST['wp_plogg_saf_socialement_comment'] );
				            update_post_meta($my_id, 'wp_plogg_saf_ronfle_regulier', $_POST['wp_plogg_saf_ronfle_regulier'] );
				            update_post_meta($my_id, 'wp_plogg_saf_ronfle_explosif', $_POST['wp_plogg_saf_ronfle_explosif'] );
				            update_post_meta($my_id, 'wp_plogg_saf_ronfle_agrave_par_alcool', $_POST['wp_plogg_saf_ronfle_agrave_par_alcool'] );
				            update_post_meta($my_id, 'wp_plogg_saf_ronfle_agrave_par_fatigue', $_POST['wp_plogg_saf_ronfle_agrave_par_fatigue'] );
				            update_post_meta($my_id, 'wp_plogg_saf_pause', $_POST['wp_plogg_saf_pause'] );
				            update_post_meta($my_id, 'wp_plogg_saf_ronfle_explosif', $_POST['wp_plogg_saf_ronfle_explosif'] );
				            update_post_meta($my_id, 'wp_plogg_saf_pause_frequence', $_POST['wp_plogg_saf_pause_frequence'] );
				            update_post_meta($my_id, 'wp_plogg_saf_reveil_etouffe', $_POST['wp_plogg_saf_reveil_etouffe'] );
				            update_post_meta($my_id, 'wp_plogg_saf_somnolent', $_POST['wp_plogg_saf_somnolent'] );
				            update_post_meta($my_id, 'wp_plogg_saf_situation_lire', $_POST['wp_plogg_saf_situation_lire'] );
				            update_post_meta($my_id, 'wp_plogg_saf_situation_tele', $_POST['wp_plogg_saf_situation_tele'] );
				            update_post_meta($my_id, 'wp_plogg_saf_situation_inactif', $_POST['wp_plogg_saf_situation_inactif'] );
				            update_post_meta($my_id, 'wp_plogg_saf_situation_passager', $_POST['wp_plogg_saf_situation_passager'] );
				            update_post_meta($my_id, 'wp_plogg_saf_situation_sieste', $_POST['wp_plogg_saf_situation_sieste'] );
				            update_post_meta($my_id, 'wp_plogg_saf_situation_discute_assis', $_POST['wp_plogg_saf_situation_discute_assis'] );
				            update_post_meta($my_id, 'wp_plogg_saf_situation_apres_manger', $_POST['wp_plogg_saf_situation_apres_manger'] );
				            update_post_meta($my_id, 'wp_plogg_saf_situation_congestion', $_POST['wp_plogg_saf_situation_congestion'] );
				            update_post_meta($my_id, 'wp_plogg_saf_total_situations', $total_situations );
				            update_post_meta($my_id, 'wp_plogg_saf_besoin_bouger', $_POST['wp_plogg_saf_besoin_bouger'] );
				            update_post_meta($my_id, 'wp_plogg_saf_mal_tete_reveil', $_POST['wp_plogg_saf_mal_tete_reveil'] );
				            update_post_meta($my_id, 'wp_plogg_saf_mal_tete_reveil', $_POST['wp_plogg_saf_mal_tete_reveil'] );
				            update_post_meta($my_id, 'wp_plogg_saf_perte_memoire', $_POST['wp_plogg_saf_perte_memoire'] );
				            update_post_meta($my_id, 'wp_plogg_saf_mauvaise_concentration', $_POST['wp_plogg_saf_mauvaise_concentration'] );
				            update_post_meta($my_id, 'wp_plogg_saf_deja_traite', $_POST['wp_plogg_saf_deja_traite'] );
				            update_post_meta($my_id, 'wp_plogg_saf_deja_traite_quand', $_POST['wp_plogg_saf_deja_traite_quand'] );
				            update_post_meta($my_id, 'wp_plogg_saf_day_symptoms', $wp_plogg_saf_day_symptoms );
				            update_post_meta($my_id, 'wp_plogg_saf_night_symptoms', $wp_plogg_saf_night_symptoms );
				            update_post_meta($my_id, 'wp_plogg_saf_circonference', $_POST['wp_plogg_saf_circonference'] );
				            update_post_meta($my_id, 'wp_plogg_saf_pause_rapporte', $_POST['wp_plogg_saf_pause_rapporte'] );
				            update_post_meta($my_id, 'wp_plogg_saf_etouffe', $_POST['wp_plogg_saf_etouffe'] );
				            update_post_meta($my_id, 'wp_plogg_saf_somnole', $_POST['wp_plogg_saf_somnole'] );
				            update_post_meta($my_id, 'wp_plogg_saf_retrognathie', $_POST['wp_plogg_saf_retrognathie'] );
				            update_post_meta($my_id, 'wp_plogg_saf_hypertension', $_POST['wp_plogg_saf_hypertension'] );
				            
				            
				            
						    header('Location: ' . $_POST['wp_plogg_sleep_apnea_form_goto'].'?wp_plogg_sleep_apnea_form_status=1');
						    break;
						}
						
					}else{
					    header('Location: ' . $_POST['wp_plogg_sleep_apnea_form_goto'].'?wp_plogg_sleep_apnea_form_status=0');
					    break;
					}   
				break;
			}//fin du switch
		}
	}
	
	
	function get_email_message(){
		$message = "<h2>".__('Contact information','wp_plogg_sleep_apnea_form')."</h2>";  
		$message .= '<b>'.__('Name','wp_plogg_sleep_apnea_form').' :</b> ' . $_POST['wp_plogg_sleep_apnea_form_nom'].'<br/>'; 
		$message .= '<b>'.__('Email','wp_plogg_sleep_apnea_form').' :</b> ' . $_POST['wp_plogg_sleep_apnea_form_courriel'].'<br/>'; 
		
		
		$message .= "<h2>".__('Step','wp_plogg_sleep_apnea_form')." 1</h2>";  
		
		$message .= "<h3>".__('Neck circumference in cm','wp_plogg_sleep_apnea_form')."</h3>"; 
		$wp_plogg_saf_neck_circumference = ($_POST['wp_plogg_saf_neck_circumference']?__($_POST['wp_plogg_saf_neck_circumference'],'wp_plogg_sleep_apnea_form'):__('No','wp_plogg_sleep_apnea_form'));
		$message .= '<b>'.__('Circumference','wp_plogg_sleep_apnea_form').' :</b> ' . $wp_plogg_saf_neck_circumference .'<br/>'; 
		$wp_plogg_saf_hypertension_calc = ($_POST['wp_plogg_saf_hypertension_calc']?__($_POST['wp_plogg_saf_hypertension_calc'],'wp_plogg_sleep_apnea_form'):__('No','wp_plogg_sleep_apnea_form'));
		$message .= '<b>'.__('Hypertension + 4 cm','wp_plogg_sleep_apnea_form').' :</b> ' .$wp_plogg_saf_hypertension_calc.'<br/>'; 
		$wp_plogg_saf_ronfle_calc = ($_POST['wp_plogg_saf_ronfle_calc']?__($_POST['wp_plogg_saf_ronfle_calc'],'wp_plogg_sleep_apnea_form'):__('No','wp_plogg_sleep_apnea_form'));
		$message .= '<b>'.__('Snorer + 3cm','wp_plogg_sleep_apnea_form').' :</b> ' .$wp_plogg_saf_ronfle_calc .'<br/>'; 
		$wp_plogg_saf_pause_calc = ($_POST['wp_plogg_saf_pause_calc']?__($_POST['wp_plogg_saf_pause_calc'],'wp_plogg_sleep_apnea_form'):__('No','wp_plogg_sleep_apnea_form'));
		$message .= '<b>'.__('Respiratory pauses + 3 cm','wp_plogg_sleep_apnea_form').' :</b> ' .$wp_plogg_saf_pause_calc.'<br/>'; 
		$circ_total = 0;
		if($_POST['wp_plogg_saf_neck_circumference']){
			$circ_total+= $_POST['wp_plogg_saf_neck_circumference'];
		}
		if($_POST['wp_plogg_saf_hypertension_calc']){
			$circ_total+=4;
		}
		if($_POST['wp_plogg_saf_ronfle_calc']){
			$circ_total+=3;
		}
		if($_POST['wp_plogg_saf_pause_calc']){
			$circ_total+=3;
		}
		$message .= '<b>'.__('Total','wp_plogg_sleep_apnea_form').' :</b> ' . $circ_total.'cm<br/>'; 
		
		
		$message .= "<h2>".__('Step','wp_plogg_sleep_apnea_form')." 2</h2>";  
		
		$message .= "<h3>".__('Sleep habits','wp_plogg_sleep_apnea_form')."</h3>";  
		
		$message .= '<b>1) '.__('I got to bed at','wp_plogg_sleep_apnea_form').' :</b> ' . $_POST['wp_plogg_saf_heure_couche'].'h'.$_POST['wp_plogg_saf_heure_couche_minutes'].'. <b>'.__('I wake up at','wp_plogg_sleep_apnea_form').' :</b> ' . $_POST['wp_plogg_saf_heure_leve'].'h'.$_POST['wp_plogg_saf_heure_leve_minutes'].'<br/>';
		$message .= '<b>2) '.__('I fall asleep quickly','wp_plogg_sleep_apnea_form').' :</b> ' . __($_POST['wp_plogg_saf_endormi_vite'],'wp_plogg_sleep_apnea_form').'<br/>';
		$message .= '<b>3) '.__('I wake up easily','wp_plogg_sleep_apnea_form').' :</b> ' . __($_POST['wp_plogg_saf_reveille_facile'],'wp_plogg_sleep_apnea_form').'<br/>';
		$message .= '<b>4) '.__('I frequently wake up at night','wp_plogg_sleep_apnea_form').' :</b> ' . __($_POST['wp_plogg_saf_reveil_frequent'],'wp_plogg_sleep_apnea_form').'<br/>';
		$message .= '<b>5) '.__('I wake up tired in the morning','wp_plogg_sleep_apnea_form').' :</b> ' . __($_POST['wp_plogg_saf_matin_fatigue'],'wp_plogg_sleep_apnea_form').' '. $_POST['wp_plogg_saf_matin_fatigue_depuis'].'<br/>';
		$message .= '<b>6) '.__('Globally, do you consider that you sleep','wp_plogg_sleep_apnea_form').' :</b> ' . __($_POST['wp_plogg_saf_qualite_sommeil'],'wp_plogg_sleep_apnea_form').'<br/>';
		$message .= '<b>7) '.__('Do you snore?','wp_plogg_sleep_apnea_form').' :</b> ' . __($_POST['wp_plogg_saf_ronfle'],'wp_plogg_sleep_apnea_form').' '. $_POST['wp_plogg_saf_ronfle_depuis'].'<br/>';
		if($_POST['wp_plogg_saf_ronfle']=='Yes' || $_POST['wp_plogg_saf_ronfle']=='Oui'){
			$message .= '<b>&nbsp;&nbsp;&nbsp;&nbsp;'.__('Socially disturbing','wp_plogg_sleep_apnea_form').' :</b> ' . __($_POST['wp_plogg_saf_socialement_derangeant'],'wp_plogg_sleep_apnea_form').' '. __($_POST['wp_plogg_saf_socialement_comment'],'wp_plogg_sleep_apnea_form').'<br/>';
			$message .= '<b>&nbsp;&nbsp;&nbsp;&nbsp;'.__('More important when you sleep on your back?','wp_plogg_sleep_apnea_form').' :</b> ' . __($_POST['wp_plogg_saf_ronfle_dos'],'wp_plogg_sleep_apnea_form').' '. __($_POST['wp_plogg_saf_socialement_comment'],'wp_plogg_sleep_apnea_form').'<br/>';
			$message .= '<b>&nbsp;&nbsp;&nbsp;&nbsp;'.__('Regulary?','wp_plogg_sleep_apnea_form').' :</b> ' . __($_POST['wp_plogg_saf_ronfle_regulier'],'wp_plogg_sleep_apnea_form').'<br/>';
			$message .= '<b>&nbsp;&nbsp;&nbsp;&nbsp;'.__('Explosive?','wp_plogg_sleep_apnea_form').' :</b> ' . __($_POST['wp_plogg_saf_ronfle_explosif'],'wp_plogg_sleep_apnea_form').'<br/>';
		
			$message .= '<b>&nbsp;&nbsp;&nbsp;&nbsp;'.__('Is your snoring worsened by','wp_plogg_sleep_apnea_form').':</b><br/>';
			$message .= '<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.__('Alcohol intake','wp_plogg_sleep_apnea_form').':</b> '.$_POST['wp_plogg_saf_ronfle_agrave_par_alcool'].'<br/>';
			$message .= '<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.__('Tiredness','wp_plogg_sleep_apnea_form').':</b> '.$_POST['wp_plogg_saf_ronfle_agrave_par_fatigue'].'<br/>';
			 
			/*
			$wp_plogg_saf_ronfle_agrave_par = $_POST['wp_plogg_saf_ronfle_agrave_par'];
			if(!isset($_POST['wp_plogg_saf_ronfle_agrave_par'])){
				$wp_plogg_saf_ronfle_agrave_par=__('No','wp_plogg_sleep_apnea_form');
			}else{
				$ronfle_agrave_par_traduit = array();
				foreach($_POST['wp_plogg_saf_ronfle_agrave_par'] as $ronfle_agrave_par){
					array_push($ronfle_agrave_par_traduit, __($ronfle_agrave_par,'wp_plogg_sleep_apnea_form'));
				}
				$wp_plogg_saf_ronfle_agrave_par = implode(', ', $ronfle_agrave_par_traduit);
			}
			
			$message .= '<b>&nbsp;&nbsp;&nbsp;&nbsp;'.__('Is your snoring worsened by alcohol or tiredness?','wp_plogg_sleep_apnea_form').' :</b> ' .$wp_plogg_saf_ronfle_agrave_par.'<br/>';
			*/
		}
		
		$message .= '<b>8) '.__('Do you have respiratory pauses during your sleep which are noted by an external person?','wp_plogg_sleep_apnea_form').' :</b> ' . $_POST['wp_plogg_saf_pause'].' '. __($_POST['wp_plogg_saf_pause_frequence'],'wp_plogg_sleep_apnea_form').'<br/>';
		$message .= '<b>9) '.__('Did you ever wake up with a choking sensation?','wp_plogg_sleep_apnea_form').' :</b> ' . __($_POST['wp_plogg_saf_reveil_etouffe'],'wp_plogg_sleep_apnea_form').'<br/>';
		
		$message .= "<h2>".__('Step','wp_plogg_sleep_apnea_form')." 3</h2>";  
		
		$message .= "<h3>".__('Epworth sleepiness scale','wp_plogg_sleep_apnea_form')."</h3>";  
		
		$message .= '<b>10) '.__('Are you sleepy during the day?','wp_plogg_sleep_apnea_form').' :</b> ' . __($_POST['wp_plogg_saf_somnolent'],'wp_plogg_sleep_apnea_form').'<br/>';
		$message .= '<b>&nbsp;&nbsp;&nbsp;&nbsp;'.__('Situations','wp_plogg_sleep_apnea_form').' :</b><br/>';
		$message .= '<b>&nbsp;&nbsp;&nbsp;&nbsp;'.__('Sitting down reading','wp_plogg_sleep_apnea_form').' :</b> ' .__($_POST['wp_plogg_saf_situation_lire'],'wp_plogg_sleep_apnea_form').'<br/>';
		$message .= '<b>&nbsp;&nbsp;&nbsp;&nbsp;'.__('Sitting down watching television','wp_plogg_sleep_apnea_form').' :</b> ' .__($_POST['wp_plogg_saf_situation_tele'],'wp_plogg_sleep_apnea_form').'<br/>';
		$message .= '<b>&nbsp;&nbsp;&nbsp;&nbsp;'.__('Sitting down inactive in a public place (movies, theater (play), meeting)','wp_plogg_sleep_apnea_form').' :</b> ' .__($_POST['wp_plogg_saf_situation_inactif'],'wp_plogg_sleep_apnea_form').'<br/>';
		$message .= '<b>&nbsp;&nbsp;&nbsp;&nbsp;'.__('Sitting down as a passenger in a car (or in a public transport) for more than one hour without interruption','wp_plogg_sleep_apnea_form').' :</b> ' .__($_POST['wp_plogg_saf_situation_passager'],'wp_plogg_sleep_apnea_form').'<br/>';
		$message .= '<b>&nbsp;&nbsp;&nbsp;&nbsp;'.__('Resting laid down in the afternoon when circumstances allow it','wp_plogg_sleep_apnea_form').' :</b> ' .__($_POST['wp_plogg_saf_situation_sieste'],'wp_plogg_sleep_apnea_form').'<br/>';
		$message .= '<b>&nbsp;&nbsp;&nbsp;&nbsp;'.__('Sitting down talking to someone','wp_plogg_sleep_apnea_form').' :</b> ' .__($_POST['wp_plogg_saf_situation_discute_assis'],'wp_plogg_sleep_apnea_form').'<br/>';
		$message .= '<b>&nbsp;&nbsp;&nbsp;&nbsp;'.__('Sitting down calmly after lunch without alcohol','wp_plogg_sleep_apnea_form').' :</b> ' .__($_POST['wp_plogg_saf_situation_apres_manger'],'wp_plogg_sleep_apnea_form').'<br/>';
		$message .= '<b>&nbsp;&nbsp;&nbsp;&nbsp;'.__('Sitting down in a car that is stuck in traffic for a few minutes','wp_plogg_sleep_apnea_form').' :</b> ' .__($_POST['wp_plogg_saf_situation_congestion'],'wp_plogg_sleep_apnea_form').'<br/>';
		
		$total_situations = $_POST['wp_plogg_saf_situation_lire'] + $_POST['wp_plogg_saf_situation_tele'] + $_POST['wp_plogg_saf_situation_inactif'] + $_POST['wp_plogg_saf_situation_passager'] + $_POST['wp_plogg_saf_situation_sieste'] + $_POST['wp_plogg_saf_situation_discute_assis'] + $_POST['wp_plogg_saf_situation_apres_manger'] + $_POST['wp_plogg_saf_situation_congestion'];
		
		$message .= '<b>&nbsp;&nbsp;&nbsp;&nbsp;'.__('Total','wp_plogg_sleep_apnea_form').' :</b> ' .$total_situations .'<br/>';
		
		$message .= '<b>11) '.__('Do you feel the need to move your legs irresistibly?','wp_plogg_sleep_apnea_form').' :</b> ' . __($_POST['wp_plogg_saf_besoin_bouger'],'wp_plogg_sleep_apnea_form').'<br/>';
		$message .= '<b>12) '.__('Do you suffer from headaches in the morning when you wake up?','wp_plogg_sleep_apnea_form').' :</b> ' . __($_POST['wp_plogg_saf_mal_tete_reveil'],'wp_plogg_sleep_apnea_form').'<br/>';
		$message .= '<b>13) '.__('Do you suffer from memory loss?','wp_plogg_sleep_apnea_form').' :</b> ' . __($_POST['wp_plogg_saf_perte_memoire'],'wp_plogg_sleep_apnea_form').'<br/>';
		$message .= '<b>14) '.__('Do you have poor concentration or difficulties focusing your attention?','wp_plogg_sleep_apnea_form').' :</b> ' . __($_POST['wp_plogg_saf_mauvaise_concentration'],'wp_plogg_sleep_apnea_form').'<br/>';
		$message .= '<b>15) '.__('Do you get or have you ever gotten a treatment for the condition that brings you to consult today?','wp_plogg_sleep_apnea_form').' :</b> ' . __($_POST['wp_plogg_saf_deja_traite'],'wp_plogg_sleep_apnea_form').' '. $_POST['wp_plogg_saf_deja_traite_quand'].'<br/>';
		
		$message .= "<h2>".__('Step','wp_plogg_sleep_apnea_form')." 4</h2>";  
		
		$message .= "<h3>".__('Symptoms that can be associated with sleep apnea','wp_plogg_sleep_apnea_form')."</h3>";  
		
		$wp_plogg_saf_day_symptoms = $_POST['wp_plogg_saf_day_symptoms'];
		if(!isset($_POST['wp_plogg_saf_day_symptoms'])){
			$wp_plogg_saf_day_symptoms=__('None','wp_plogg_sleep_apnea_form');
		}else{
			$day_symptoms_traduit = array();
			foreach($_POST['wp_plogg_saf_day_symptoms'] as $day_symptoms){
				array_push($day_symptoms_traduit, __($day_symptoms,'wp_plogg_sleep_apnea_form'));
			}
			$wp_plogg_saf_day_symptoms = implode(', ', $day_symptoms_traduit);
		}
		$message .= '<b>'.__('Daytime signs','wp_plogg_sleep_apnea_form').' :</b> ' . $wp_plogg_saf_day_symptoms .'<br/>'; 
		
		$wp_plogg_saf_night_symptoms = $_POST['wp_plogg_saf_night_symptoms'];
		if(!isset($_POST['wp_plogg_saf_night_symptoms'])){
			$wp_plogg_saf_night_symptoms=__('None','wp_plogg_sleep_apnea_form');
		}else{
			$night_symptoms_traduit = array();
			foreach($_POST['wp_plogg_saf_night_symptoms'] as $night_symptom){
				array_push($night_symptoms_traduit, __($night_symptom,'wp_plogg_sleep_apnea_form'));
			}
			$wp_plogg_saf_night_symptoms = implode(', ', $night_symptoms_traduit);
		}
		$message .= '<b>'.__('Night-time signs','wp_plogg_sleep_apnea_form').' :</b> ' . $wp_plogg_saf_night_symptoms .'<br/>'; 
		
		
		$message .= "<h2>".__('Step','wp_plogg_sleep_apnea_form')." 5</h2>";  
		
		$message .= "<h3>".__('Diagnosis','wp_plogg_sleep_apnea_form')."</h3>";  
		
		$message .= "<b>".__('Predictive values','wp_plogg_sleep_apnea_form')."</b><br/>";  
		$message .= '<b>'.__('Neck circumference','wp_plogg_sleep_apnea_form').' :</b> ' . __($_POST['wp_plogg_saf_circonference'],'wp_plogg_sleep_apnea_form').'<br/>';
		$message .= '<b>'.__('Respiratory pauses reported by the spouse','wp_plogg_sleep_apnea_form').' :</b> ' . __($_POST['wp_plogg_saf_pause_rapporte'],'wp_plogg_sleep_apnea_form').'<br/>';
		$message .= '<b>'.__('Choking sensation','wp_plogg_sleep_apnea_form').' :</b> ' . __($_POST['wp_plogg_saf_etouffe'],'wp_plogg_sleep_apnea_form').'<br/>';
		$message .= '<b>'.__('Drowsiness','wp_plogg_sleep_apnea_form').' :</b> ' . __($_POST['wp_plogg_saf_somnole'],'wp_plogg_sleep_apnea_form').'<br/>';
		$message .= '<b>'.__('Mandibular and/or maxillary retrognathia','wp_plogg_sleep_apnea_form').' :</b> ' . __($_POST['wp_plogg_saf_retrognathie'],'wp_plogg_sleep_apnea_form').'<br/>';
		$message .= '<b>'.__('Arterial hypertension','wp_plogg_sleep_apnea_form').' :</b> ' . __($_POST['wp_plogg_saf_hypertension'],'wp_plogg_sleep_apnea_form').'<br/><br/>';
		
		
		return $message;
	}
	
?>