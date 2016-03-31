<?php

add_action('admin_init', 'wp_plogg_sleep_apnea_form_register_settings');
function wp_plogg_sleep_apnea_form_register_settings() {
	register_setting('wp_plogg_sleep_apnea_form_settings_group', 'wp_plogg_sleep_apnea_form_settings');
}

add_action('admin_menu', 'wp_plogg_sleep_apnea_form_ajouter_lien_options');
function wp_plogg_sleep_apnea_form_ajouter_lien_options() {
	add_options_page('Réglages', __('Formulaire apnée du sommeil','wp_plogg_sleep_apnea_form'), 'manage_options', 'wp_plogg_sleep_apnea_form_options', 'wp_plogg_sleep_apnea_form_options_page');
}

function wp_plogg_sleep_apnea_form_options_page() 
{
 
	global $wp_plogg_sleep_apnea_form_settings;
	
	ob_start(); ?>
	<div class="wrap">
		<style>
			#wpfooter{position: relative;}
		</style>
	
		<h1><?php _e('sleap','wp_plogg_sleep_apnea_form') ?></h1>
 
		<form method="post" action="options.php">
 
			<?php settings_fields('wp_plogg_sleep_apnea_form_settings_group'); ?>
			
			<h3><?php _e('Shortcode to use','wp_plogg_sleep_apnea_form'); ?></h3>
			<p><?php _e('To use this plugin the shortcode is','wp_plogg_sleep_apnea_form'); ?> : [afficher-sleap-apnea-form]</p>
			
			<hr/>
						
			<h2><?php _e('Email information','wp_plogg_sleep_apnea_form')?></h2>
			<p>
				
				<label style="display:block; font-weight:bold;" for="wp_plogg_sleep_apnea_form_settings[email_doc]"><?php _e( "Administrator's email",'wp_plogg_sleep_apnea_form' ); ?></label>
				<input style="width:100%; max-width:800px;" type="text" id="wp_plogg_sleep_apnea_form_settings[email_doc]" name="wp_plogg_sleep_apnea_form_settings[email_doc]" value="<?= $wp_plogg_sleep_apnea_form_settings['email_doc']?>"/>
				<br/>
				<br/>
				<label style="display:block; font-weight:bold;" or="wp_plogg_sleep_apnea_form_settings[email_subject]"><?php _e( 'Email\'s subject','wp_plogg_sleep_apnea_form' ); ?></label>
				<input style="width:100%; max-width:800px;" type="text" id="wp_plogg_sleep_apnea_form_settings[email_subject]" name="wp_plogg_sleep_apnea_form_settings[email_subject]" value="<?= ($wp_plogg_sleep_apnea_form_settings['email_subject'] != "")?$wp_plogg_sleep_apnea_form_settings['email_subject']:__("Someone wants to contact you",'wp_plogg_sleep_apnea_form') ?>"/>
				<br/>
				<br/>
				<label style="display:block; font-weight:bold;" for="wp_plogg_sleep_apnea_form_settings[name_header_from]"><?php _e( "Transmitter's name",'wp_plogg_sleep_apnea_form' ); ?></label>
				<input style="width:100%; max-width:800px;" type="text" id="wp_plogg_sleep_apnea_form_settings[name_header_from]" name="wp_plogg_sleep_apnea_form_settings[name_header_from]" value="<?= $wp_plogg_sleep_apnea_form_settings['name_header_from']?>"/>
				<br/>
				<br/>
				<label style="display:block; font-weight:bold;" for="wp_plogg_sleep_apnea_form_settings[email_header_from]"><?php _e( "Transmitter's email",'wp_plogg_sleep_apnea_form' ); ?></label>
				<?php
				$find = array( 'http://', 'https://','http://www.', 'https://www.' );
				$replace = '';
				$output = str_replace( $find, $replace, $permalink );
				?>
				<input style="width:100%; max-width:800px;" type="text" id="wp_plogg_sleep_apnea_form_settings[email_header_from]" name="wp_plogg_sleep_apnea_form_settings[email_header_from]" value="<?= ($wp_plogg_sleep_apnea_form_settings['email_header_from'] != "")?$wp_plogg_sleep_apnea_form_settings['email_header_from']:get_bloginfo('name')." <noreply@". str_replace( $find, $replace, get_site_url() ).">" ?>"/>
				
			</p>
			
			<label style="display:block; font-weight:bold;"><?php _e('Texte du courriel')?></label>
			<p>NB : Veuillez utiliser la variable suivante :<br/>
			<b>%reponses%</b> : qui va être remplacée par les réponses du patient</p>
			
				<?php
				$args = array(
					
					'textarea_name' => 'wp_plogg_sleep_apnea_form_settings[email_text]',
					'media_buttons' => true,
					'tinymce' => true
					
					
				);
				 
				wp_editor( $wp_plogg_sleep_apnea_form_settings['email_text'], 'editor', $args );
				
								?>
			</div>
			<?php
			if ( function_exists('icl_object_id') ) {
			?>
			<br/><br/>
			<label style="display:block; font-weight:bold;"><?php _e('Texte du courriel (Anglais)')?></label>
			<br/>
				<?php
				$args = array(
					
					'textarea_name' => 'wp_plogg_sleep_apnea_form_settings[email_text_en]',
					'media_buttons' => true,
					'tinymce' => true
					
					
				);
				 
				wp_editor( $wp_plogg_sleep_apnea_form_settings['email_text_en'], 'editor2', $args );
				?>
			</div>
			
			<?php
			}
				
			?>
			<br/><br/>
				
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save settings','wp_plogg_sleep_apnea_form'); ?>" />
			</p>
 
		</form>
	</div>
	<?php
	echo ob_get_clean();
}


if (!function_exists('wp_plogg_sleep_apnea_form_stripAccents')) { 
	//==========================================================================
	// Suppression des accents d'une chaine de caractères
	//==========================================================================
	function wp_plogg_sleep_apnea_form_stripAccents($string){
	    return strtr($string, array('à'=>'a','á'=>'a','â'=>'a','ã'=>'a','ä'=>'a','ç'=>'c','è'=>'e','é'=>'e','ê'=>'e','ë'=>'e','ì'=>'i','í'=>'i','î'=>'i','ï'=>'i','ñ'=>'n','ò'=>'o','ó'=>'o','ô'=>'o','õ'=>'o','ö'=>'o','ù'=>'u','ú'=>'u','û'=>'u','ü'=>'u','ý'=>'y','ÿ'=>'y','À'=>'A','Á'=>'A','Â'=>'A','Ã'=>'A','Ä'=>'A','Ç'=>'C','È'=>'E','É'=>'E','Ê'=>'E','Ë'=>'E','Ì'=>'I','Í'=>'I','Î'=>'I','Ï'=>'I','Ñ'=>'N','Ò'=>'O','Ó'=>'O','Ô'=>'O','Õ'=>'O','Ö'=>'O','Ù'=>'U','Ú'=>'U','Û'=>'U','Ü'=>'U','Ý'=>'Y'));
	}
}


if (!function_exists('wp_plogg_sleep_apnea_form_add_custom_post_type')) { 
	//==========================================================================
	// Methode générale pour la création d'un type d'article
	//==========================================================================
	function wp_plogg_sleep_apnea_form_add_custom_post_type($name, $args = array()) {
	    add_action('init', function() use ($name, $args){
	        $post_type_name = strtolower(str_replace(' ','_',wp_plogg_sleep_apnea_form_stripAccents($name)));
	        $args = array_merge(array('public' => true,
	                      'query_var' => true,
	                      'label' => ucwords($name),
	                      'labels' => array(
	                          'add_new_item' => 'Ajouter un '. ucwords($name), 
	                          'edit_item' => 'Modifier un '. ucwords($name), 
	                          'view_item' => 'Afficher '.ucwords($name),
	                          'rewrite' => false,
	                          '_builtin' =>  false),
	                      'supports' => array('title', 'editor', 'thumbnail')),
	                      $args);
	        
	        register_post_type($post_type_name, $args);
	    });
	}
}



//==========================================================================
// Création du type d'article pour sauvegarder les données
//==========================================================================
wp_plogg_sleep_apnea_form_add_custom_post_type(
	'wp_plogg_saf',
	array(
		'labels' => array(
		'name' => __('Apnée du sommeil','wp_plogg_sleep_apnea_form'),
		'singular_name' => __('Apnée du sommeil','wp_plogg_sleep_apnea_form'),
		'add_new_item' => __('Add an answer','wp_plogg_sleep_apnea_form'),
		'edit_item' => __('Edit the answer','wp_plogg_sleep_apnea_form'),
		'view_item' => __('View the answer','wp_plogg_sleep_apnea_form')),
	'supports'=> array(
		'title'),
		
	'show_in_menu'=>'formulaires'
	)
);
add_action('add_meta_boxes',function(){
   add_meta_box('info', 'Informations', 'add_info_wp_plogg_saf', 'wp_plogg_saf', 'normal', 'high', 'high'); 
});
function add_info_wp_plogg_saf() {
    global $post;
    wp_nonce_field(__FILE__, 'nonce_wp_plogg_saf'); 
	
   	$wp_plogg_saf_nom = get_post_meta($post->ID, 'wp_plogg_saf_nom', true);
   	$wp_plogg_saf_courriel = get_post_meta($post->ID, 'wp_plogg_saf_courriel', true);
   	$wp_plogg_saf_url_provenance = get_post_meta($post->ID, 'wp_plogg_saf_url_provenance', true);
   	
   	$wp_plogg_saf_neck_circumference = get_post_meta($post->ID, 'wp_plogg_saf_neck_circumference', true);
   	$wp_plogg_saf_hypertension_calc = get_post_meta($post->ID, 'wp_plogg_saf_hypertension_calc', true);
   	$wp_plogg_saf_pause_calc = get_post_meta($post->ID, 'wp_plogg_saf_pause_calc', true);
   	$wp_plogg_saf_ronfle_calc = get_post_meta($post->ID, 'wp_plogg_saf_ronfle_calc', true);
   	$wp_plogg_saf_circ_total = get_post_meta($post->ID, 'wp_plogg_saf_circ_total', true);
   	
   	$wp_plogg_saf_heure_couche = get_post_meta($post->ID, 'wp_plogg_saf_heure_couche', true);
   	$wp_plogg_saf_heure_couche_minutes = get_post_meta($post->ID, 'wp_plogg_saf_heure_couche_minutes', true);
   	$wp_plogg_saf_heure_leve = get_post_meta($post->ID, 'wp_plogg_saf_heure_leve', true);
   	$wp_plogg_saf_heure_leve_minutes = get_post_meta($post->ID, 'wp_plogg_saf_heure_leve_minutes', true);
   	$wp_plogg_saf_endormi_vite = get_post_meta($post->ID, 'wp_plogg_saf_endormi_vite', true);
   	$wp_plogg_saf_reveille_facile = get_post_meta($post->ID, 'wp_plogg_saf_reveille_facile', true);
   	$wp_plogg_saf_reveil_frequent = get_post_meta($post->ID, 'wp_plogg_saf_reveil_frequent', true);
   	$wp_plogg_saf_matin_fatigue = get_post_meta($post->ID, 'wp_plogg_saf_matin_fatigue', true);
   	$wp_plogg_saf_matin_fatigue_depuis = get_post_meta($post->ID, 'wp_plogg_saf_matin_fatigue_depuis', true);
   	$wp_plogg_saf_qualite_sommeil = get_post_meta($post->ID, 'wp_plogg_saf_qualite_sommeil', true);
   	$wp_plogg_saf_ronfle = get_post_meta($post->ID, 'wp_plogg_saf_ronfle', true);
   	$wp_plogg_saf_ronfle_depuis = get_post_meta($post->ID, 'wp_plogg_saf_ronfle_depuis', true);
   	$wp_plogg_saf_socialement_derangeant = get_post_meta($post->ID, 'wp_plogg_saf_socialement_derangeant', true);
   	$wp_plogg_saf_ronfle_dos = get_post_meta($post->ID, 'wp_plogg_saf_ronfle_dos', true);
   	$wp_plogg_saf_socialement_comment = get_post_meta($post->ID, 'wp_plogg_saf_socialement_comment', true);
   	$wp_plogg_saf_ronfle_regulier = get_post_meta($post->ID, 'wp_plogg_saf_ronfle_regulier', true);
   	$wp_plogg_saf_ronfle_explosif = get_post_meta($post->ID, 'wp_plogg_saf_ronfle_explosif', true);
   	$wp_plogg_saf_ronfle_agrave_par_alcool = get_post_meta($post->ID, 'wp_plogg_saf_ronfle_agrave_par_alcool', true);
   	$wp_plogg_saf_ronfle_agrave_par_fatigue = get_post_meta($post->ID, 'wp_plogg_saf_ronfle_agrave_par_fatigue', true);
   	$wp_plogg_saf_pause = get_post_meta($post->ID, 'wp_plogg_saf_pause', true);
   	$wp_plogg_saf_pause_frequence = get_post_meta($post->ID, 'wp_plogg_saf_pause_frequence', true);
   	$wp_plogg_saf_reveil_etouffe = get_post_meta($post->ID, 'wp_plogg_saf_reveil_etouffe', true);
   	
   	$wp_plogg_saf_somnolent = get_post_meta($post->ID, 'wp_plogg_saf_somnolent', true);
   	$wp_plogg_saf_situation_lire = get_post_meta($post->ID, 'wp_plogg_saf_situation_lire', true);
   	$wp_plogg_saf_situation_tele = get_post_meta($post->ID, 'wp_plogg_saf_situation_tele', true);
   	$wp_plogg_saf_situation_inactif = get_post_meta($post->ID, 'wp_plogg_saf_situation_inactif', true);
   	$wp_plogg_saf_situation_passager = get_post_meta($post->ID, 'wp_plogg_saf_situation_passager', true);
   	$wp_plogg_saf_situation_sieste = get_post_meta($post->ID, 'wp_plogg_saf_situation_sieste', true);
   	$wp_plogg_saf_situation_discute_assis = get_post_meta($post->ID, 'wp_plogg_saf_situation_discute_assis', true);
   	$wp_plogg_saf_situation_apres_manger = get_post_meta($post->ID, 'wp_plogg_saf_situation_apres_manger', true);
   	$wp_plogg_saf_situation_congestion = get_post_meta($post->ID, 'wp_plogg_saf_situation_congestion', true);
   	$wp_plogg_saf_total_situations = get_post_meta($post->ID, 'wp_plogg_saf_total_situations', true);
   	$wp_plogg_saf_besoin_bouger = get_post_meta($post->ID, 'wp_plogg_saf_besoin_bouger', true);
   	$wp_plogg_saf_mal_tete_reveil = get_post_meta($post->ID, 'wp_plogg_saf_mal_tete_reveil', true);
   	$wp_plogg_saf_perte_memoire = get_post_meta($post->ID, 'wp_plogg_saf_perte_memoire', true);
   	$wp_plogg_saf_mauvaise_concentration = get_post_meta($post->ID, 'wp_plogg_saf_mauvaise_concentration', true);
   	$wp_plogg_saf_deja_traite = get_post_meta($post->ID, 'wp_plogg_saf_deja_traite', true);
   	$wp_plogg_saf_deja_traite_quand = get_post_meta($post->ID, 'wp_plogg_saf_deja_traite_quand', true);
   	
   	$wp_plogg_saf_day_symptoms = get_post_meta($post->ID, 'wp_plogg_saf_day_symptoms', true);
   	$wp_plogg_saf_night_symptoms = get_post_meta($post->ID, 'wp_plogg_saf_night_symptoms', true);
   	
   	$wp_plogg_saf_circonference = get_post_meta($post->ID, 'wp_plogg_saf_circonference', true);
   	$wp_plogg_saf_pause_rapporte = get_post_meta($post->ID, 'wp_plogg_saf_pause_rapporte', true);
   	$wp_plogg_saf_etouffe = get_post_meta($post->ID, 'wp_plogg_saf_etouffe', true);
   	$wp_plogg_saf_somnole = get_post_meta($post->ID, 'wp_plogg_saf_somnole', true);
   	$wp_plogg_saf_retrognathie = get_post_meta($post->ID, 'wp_plogg_saf_retrognathie', true);
   	$wp_plogg_saf_hypertension = get_post_meta($post->ID, 'wp_plogg_saf_hypertension', true);
   	
   	
   	
    ?>
    
    <style>
    	.mytable{
	        width: 100%;
		    border-collapse: collapse;
		    max-width: 800px;
    	}
    	.mytable th,
    	.mytable td{
    		border: 1px solid #ddd;
    		padding: 10px;
    	}
    	.mytable th{
		    font-weight: bold;
	    	background: #eee;
    	}
    	.mytable2{
	        width: 100%;
		    border-collapse: collapse;
		    max-width: 800px;
		    text-align: left;
    	}
    	.mytable2 th,
    	.mytable2 td{
    		border: 1px solid #ddd;
    		padding: 10px;
    	}
    	.mytable2 th{
		    font-weight: bold;
			width: 300px;
	    	background: #eee;
    	}
    	.mytable2 td{
    		min-width: 0;
    		width: auto;
    	}
    </style>
    <div>
  		<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_nom">Nom</label>
	    <input style="width:100%; display:block" type="text" name="wp_plogg_saf_nom" id="wp_plogg_saf_nom" value="<?php echo $wp_plogg_saf_nom; ?>">
	    <br/>
  		<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_courriel">Courriel</label>
	    <input style="width:100%; display:block" type="text" name="wp_plogg_saf_courriel" id="wp_plogg_saf_courriel" value="<?php echo $wp_plogg_saf_courriel; ?>">
	    <br/>
  		<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_url_provenance">Page où a été remplie le formulaire</label>
	    <?php echo $wp_plogg_saf_url_provenance; ?>
		<br/><br/>
	    
	    <hr/>
	    <br/>
  		
	    <h3>Étape 1</h3>
	    
	    <table class="mytable">
		    <tr>
			    <th>
		  			<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_neck_circumference">Circonférence du coup</label>
			    </th>
			    <th>
			    	<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_hypertension_calc">Hypertension</label>
			    </th>
			    <th>
				    <label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_pause_calc">Ronfleur</label>
			    </th>
			    <th>
			    	<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_ronfle_calc">Pauses respiratoires</label>
			    </th>
			    <th>
			   		<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_circ_total">Total</label>
			    </th>
		    </tr>
		    <tr>
			    <td>
			    	<input style="width:50px; display:block; margin:0 auto;" type="text" name="wp_plogg_saf_neck_circumference" id="wp_plogg_saf_neck_circumference" value="<?php echo $wp_plogg_saf_neck_circumference; ?>">
			    </td>
			    <td>
			    	<input style="width:50px; display:block margin:0 auto;" type="text" name="wp_plogg_saf_hypertension_calc" id="wp_plogg_saf_hypertension_calc" value="<?php echo $wp_plogg_saf_hypertension_calc; ?>">
			    </td>
			    <td>
			    	<input style="width:50px; display:block margin:0 auto;" type="text" name="wp_plogg_saf_pause_calc" id="wp_plogg_saf_pause_calc" value="<?php echo $wp_plogg_saf_pause_calc; ?>">
			    </td>
			    <td>
			    	<input style="width:50px; display:block margin:0 auto;" type="text" name="wp_plogg_saf_ronfle_calc" id="wp_plogg_saf_ronfle_calc" value="<?php echo $wp_plogg_saf_ronfle_calc; ?>">
			    </td>
			    <td>
			    	<input style="width:50px; display:block margin:0 auto;" type="text" name="wp_plogg_saf_circ_total" id="wp_plogg_saf_circ_total" value="<?php echo $wp_plogg_saf_circ_total; ?>">
			    </td>
		    </tr>
	    </table>
	    
	    <hr/>
	    <br/>
	    
	    <h3>Étape 2</h3>
	    
	    <table class="mytable2">
		    <tr>
			    <th>
		  			<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_heure_couche">Je me couche à</label>
			    </th>
			    <td>
			    	<input style="width:50px; display:inline-block" type="text" name="wp_plogg_saf_heure_couche" id="wp_plogg_saf_heure_couche" value="<?php echo $wp_plogg_saf_heure_couche; ?>"> h
					<input style="width:50px; display:inline-block" type="text" name="wp_plogg_saf_heure_couche_minutes" id="wp_plogg_saf_heure_couche_minutes" value="<?php echo $wp_plogg_saf_heure_couche_minutes; ?>">
			    </td>
		    </tr>
		    <tr>
		    	<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_heure_leve">Je me lève à</label>
		    	</th>
		    	<td>
		    		<input style="width:50px; display:inline-block" type="text" name="wp_plogg_saf_heure_leve" id="wp_plogg_saf_heure_leve" value="<?php echo $wp_plogg_saf_heure_leve; ?>"> h
					<input style="width:50px; display:inline-block" type="text" name="wp_plogg_saf_heure_levee_minutes" id="wp_plogg_saf_heure_levee_minutes" value="<?php echo $wp_plogg_saf_heure_leve_minutes; ?>"><br/>
		    	</td>
		    </tr>
		    <tr>
		    	<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_endormi_vite">Je m’endors rapidement</label>
		    	</th>
		    	<td>
				    <input style="width:50px; display:block" type="text" name="wp_plogg_saf_endormi_vite" id="wp_plogg_saf_endormi_vite" value="<?php echo $wp_plogg_saf_endormi_vite; ?>">
		    	</td>
		    </tr>
			<tr>
				<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_reveille_facile">Je me réveille facilement</label>
				</th>
				<td>
					<input style="width:50px; display:block" type="text" name="wp_plogg_saf_reveille_facile" id="wp_plogg_saf_reveille_facile" value="<?php echo $wp_plogg_saf_reveille_facile; ?>">
				</td>
			</tr>
			<tr>
				<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_reveil_frequent">Je me réveille fréquemment la nuit</label>
				</th>
				<td>
					<input style="width:50px; display:block" type="text" name="wp_plogg_saf_reveil_frequent" id="wp_plogg_saf_reveil_frequent" value="<?php echo $wp_plogg_saf_reveil_frequent; ?>">
				</td>
			</tr>
			<tr>
				<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_matin_fatigue">Je me réveille fatigué le matin</label>
				</th>
				<td>
					<input style="width:50px; display:block" type="text" name="wp_plogg_saf_matin_fatigue" id="wp_plogg_saf_matin_fatigue" value="<?php echo $wp_plogg_saf_matin_fatigue; ?>">
				</td>
			</tr>
			<tr>
				<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_matin_fatigue_depuis">Depuis combien de temps?</label>
				</th>
				<td>
					<input style="width:100%; display:block" type="text" name="wp_plogg_saf_matin_fatigue_depuis" id="wp_plogg_saf_matin_fatigue_depuis" value="<?php echo $wp_plogg_saf_matin_fatigue_depuis; ?>">
				</td>
			</tr>
			<tr>
				<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_qualite_sommeil">Jugez-vous que votre sommeil est globalement</label>
				</th>
				<td>
					<input style="width:100%; display:block" type="text" name="wp_plogg_saf_qualite_sommeil" id="wp_plogg_saf_qualite_sommeil" value="<?php echo $wp_plogg_saf_qualite_sommeil; ?>">
				</td>
			</tr>
			<tr>
				<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_ronfle">Ronflez-vous?</label>
				</th>
				<td>
					<input style="width:50px; display:block" type="text" name="wp_plogg_saf_ronfle" id="wp_plogg_saf_ronfle" value="<?php echo $wp_plogg_saf_ronfle; ?>">
				</td>
			</tr>
			<tr>
				<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_ronfle_depuis">Depuis combien de temps?</label>
				</th>
				<td>
					<input style="width:100%; display:block" type="text" name="wp_plogg_saf_ronfle_depuis" id="wp_plogg_saf_ronfle_depuis" value="<?php echo $wp_plogg_saf_ronfle_depuis; ?>">
				</td>
			</tr>
			<tr>
				<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_socialement_derangeant">Socialement dérangeant</label>
				</th>
				<td>
					<input style="width:50px; display:block" type="text" name="wp_plogg_saf_socialement_derangeant" id="wp_plogg_saf_socialement_derangeant" value="<?php echo $wp_plogg_saf_socialement_derangeant; ?>">
					<input style="width:100%; display:block" type="text" name="wp_plogg_saf_socialement_comment" id="wp_plogg_saf_socialement_comment" value="<?php echo $wp_plogg_saf_socialement_comment; ?>">
				</td>
			</tr>
			<tr>
				<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_ronfle_dos">Plus important lorsque vous dormez sur le dos?</label>
				</th>
				<td>
					<input style="width:50px; display:block" type="text" name="wp_plogg_saf_ronfle_dos" id="wp_plogg_saf_ronfle_dos" value="<?php echo $wp_plogg_saf_ronfle_dos; ?>">
				</td>
			</tr>
			<tr>
				<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_ronfle_regulier">Régulièrement?</label>
				</th>
				<td>
					<input style="width:50px; display:block" type="text" name="wp_plogg_saf_ronfle_regulier" id="wp_plogg_saf_ronfle_regulier" value="<?php echo $wp_plogg_saf_ronfle_regulier; ?>">
				</td>
			</tr>
			<tr>
				<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_ronfle_explosif">Explosif?</label>
				</th>
				<td>
					<input style="width:50px; display:block" type="text" name="wp_plogg_saf_ronfle_explosif" id="wp_plogg_saf_ronfle_explosif" value="<?php echo $wp_plogg_saf_ronfle_explosif; ?>">
				</td>
			</tr>
			<tr>
				<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_ronfle_agrave_par_alcool">Votre ronflement est-il aggravé par l'alcool?</label>
				</th>
				<td>
					<input style="width:100%; display:block" type="text" name="wp_plogg_saf_ronfle_agrave_par_alcool" id="wp_plogg_saf_ronfle_agrave_par_alcool" value="<?php echo $wp_plogg_saf_ronfle_agrave_par_alcool; ?>">
				</td>
			</tr>
			<tr>
				<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_ronfle_agrave_par_fatigue">Votre ronflement est-il aggravé par la fatigue?</label>
				</th>
				<td>
					<input style="width:100%; display:block" type="text" name="wp_plogg_saf_ronfle_agrave_par_fatigue" id="wp_plogg_saf_ronfle_agrave_par_fatigue" value="<?php echo $wp_plogg_saf_ronfle_agrave_par_fatigue; ?>">
				</td>
			</tr>
			<tr>
				<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_pause">Avez-vous des pauses respiratoires durant votre sommeil notées par une personne extérieure?</label>
				</th>
				<td>
					<input style="width:50px; display:block" type="text" name="wp_plogg_saf_pause" id="wp_plogg_saf_pause" value="<?php echo $wp_plogg_saf_pause; ?>">
				</td>
			</tr>
			<tr>
				<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_pause_frequence">Si oui, cela arrive-t-il</label>
				</th>
				<td>
					<input style="width:100%; display:block" type="text" name="wp_plogg_saf_pause_frequence" id="wp_plogg_saf_pause_frequence" value="<?php echo $wp_plogg_saf_pause_frequence; ?>">
				</td>
			</tr>
			<tr>
				<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_reveil_etouffe">Vous êtes-vous déjà réveillé avec la sensation d’étouffer?</label>
				</th>
				<td>
					<input style="width:50px; display:block" type="text" name="wp_plogg_saf_reveil_etouffe" id="wp_plogg_saf_reveil_etouffe" value="<?php echo $wp_plogg_saf_reveil_etouffe; ?>">
				</td>
			</tr>
	    </table>
	    
	    <hr/>
	    <br/>
	    
	    <h3>Étape 3</h3>
	    <table class="mytable2">
		    <tr>
			    <th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_somnolent">Êtes-vous somnolent durant le jour?</label>
			    </th>
			    <td>
			    	<input style="width:50px; display:block" type="text" name="wp_plogg_saf_somnolent" id="wp_plogg_saf_somnolent" value="<?php echo $wp_plogg_saf_somnolent; ?>">
			    </td>
		    </tr>
		    <tr>
			    <th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_situation_lire">Assis(e) à lire</label>
			    </th>
			    <td>
			    	<input style="width:50px; display:block" type="text" name="wp_plogg_saf_situation_lire" id="wp_plogg_saf_situation_lire" value="<?php echo $wp_plogg_saf_situation_lire; ?>">
			    </td>
		    </tr>
		    <tr>
		    	<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_situation_tele">Assis(e) en regardant la télévision</label>
		    	</th>
		    	<td>
		    		<input style="width:50px; display:block" type="text" name="wp_plogg_saf_situation_tele" id="wp_plogg_saf_situation_tele" value="<?php echo $wp_plogg_saf_situation_tele; ?>">
		    	</td>
		    </tr>
		    <tr>
		    	<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_situation_inactif">Assis(e) inactif(ve) dans un lieu public (cinéma, théâtre, réunion)</label>
		    	</th>
		    	<td>
		    		<input style="width:50px; display:block" type="text" name="wp_plogg_saf_situation_inactif" id="wp_plogg_saf_situation_inactif" value="<?php echo $wp_plogg_saf_situation_inactif; ?>">
		    	</td>
		    </tr>
		    <tr>
		    	<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_situation_passager">Assis(e) comme passager dans une voiture (ou dans un transport en commun) depuis plus d’une heure sans interruption</label>
		    	</th>
		    	<td>
		    		<input style="width:50px; display:block" type="text" name="wp_plogg_saf_situation_passager" id="wp_plogg_saf_situation_passager" value="<?php echo $wp_plogg_saf_situation_passager; ?>">
		    	</td>
		    </tr>
		    <tr>
		    	<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_situation_sieste">Me reposant allongé(e) dans l’après-midi lorsque les circonstances le permettent</label>
		    	</th>
		    	<td>
		    		<input style="width:50px; display:block" type="text" name="wp_plogg_saf_situation_sieste" id="wp_plogg_saf_situation_sieste" value="<?php echo $wp_plogg_saf_situation_sieste; ?>">
		    	</td>
		    </tr>
		    <tr>
		    	<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_situation_discute_assis">Assis(e) en parlant avec quelqu’un</label>
		    	</th>
		    	<td>
		    		<input style="width:50px; display:block" type="text" name="wp_plogg_saf_situation_discute_assis" id="wp_plogg_saf_situation_discute_assis" value="<?php echo $wp_plogg_saf_situation_discute_assis; ?>">
		    	</td>
		    </tr>
		    <tr>
		    	<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_situation_apres_manger">Assis(e) calmement après un déjeuner (lunch) sans alcool</label>
		    	</th>
		    	<td>
		    		<input style="width:50px; display:block" type="text" name="wp_plogg_saf_situation_apres_manger" id="wp_plogg_saf_situation_apres_manger" value="<?php echo $wp_plogg_saf_situation_apres_manger; ?>">
		    	</td>
		    </tr>
		    <tr>
		    	<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_situation_congestion">Assis(e) dans une voiture qui est arrêtée depuis quelques minutes dans le trafic</label>
		    	</th>
		    	<td>
		    		<input style="width:50px; display:block" type="text" name="wp_plogg_saf_situation_congestion" id="wp_plogg_saf_situation_congestion" value="<?php echo $wp_plogg_saf_situation_congestion; ?>">
		    	</td>
		    </tr>
		    <tr>
		    	<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_total_situations">Total</label>
		    	</th>
		    	<td>
		    		<input style="width:50px; display:block" type="text" name="wp_plogg_saf_total_situations" id="wp_plogg_saf_total_situations" value="<?php echo $wp_plogg_saf_total_situations; ?>">
		    	</td>
		    </tr>
		    <tr>
		    	<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_besoin_bouger">Ressentez-vous l’envie de bouger les jambes de façon irrésistible?</label>
		    	</th>
		    	<td>
		    		<input style="width:50px; display:block" type="text" name="wp_plogg_saf_besoin_bouger" id="wp_plogg_saf_besoin_bouger" value="<?php echo $wp_plogg_saf_besoin_bouger; ?>">
		    	</td>
		    </tr>
		    <tr>
		    	<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_mal_tete_reveil">Avez-vous mal à la tête le matin en vous levant?</label>
		    	</th>
		    	<td>
		    		<input style="width:50px; display:block" type="text" name="wp_plogg_saf_mal_tete_reveil" id="wp_plogg_saf_mal_tete_reveil" value="<?php echo $wp_plogg_saf_mal_tete_reveil; ?>">
		    	</td>
		    </tr>
		    <tr>
		    	<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_perte_memoire">Présentez-vous des troubles de la mémoire?</label>
		    	</th>
		    	<td>
		    		<input style="width:50px; display:block" type="text" name="wp_plogg_saf_perte_memoire" id="wp_plogg_saf_perte_memoire" value="<?php echo $wp_plogg_saf_perte_memoire; ?>">
		    	</td>
		    </tr>
		    <tr>
		    	<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_mauvaise_concentration">Avez-vous de la difficulté de concentration ou des difficultés pour fixer votre attention?</label>
		    	</th>
		    	<td>
		    		<input style="width:50px; display:block" type="text" name="wp_plogg_saf_mauvaise_concentration" id="wp_plogg_saf_mauvaise_concentration" value="<?php echo $wp_plogg_saf_mauvaise_concentration; ?>">
		    	</td>
		    </tr>
		    <tr>
		    	<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_deja_traite">Suivez-vous ou avez-vous déjà suivi un traitement pour la condition qui vous amène en consultation aujourd’hui?</label>
		    	</th>
		    	<td>
		    		<input style="width:50px; display:block" type="text" name="wp_plogg_saf_deja_traite" id="wp_plogg_saf_deja_traite" value="<?php echo $wp_plogg_saf_deja_traite; ?>">
		    	</td>
		    </tr>
		    <tr>
		    	<th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_deja_traite_quand">Depuis combien de temps?</label>
		    	</th>
		    	<td>
		    		<input style="width:100%; display:block" type="text" name="wp_plogg_saf_deja_traite_quand" id="wp_plogg_saf_deja_traite_quand" value="<?php echo $wp_plogg_saf_deja_traite_quand; ?>">
		    	</td>
		    </tr>
	    </table>
	    <hr/>
	    <br/>
	     
	    <h3>Étape 4</h3>
	    
	    <label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_day_symptoms">Signes de jour</label>
	    <input style="width:100%; display:block" type="text" name="wp_plogg_saf_day_symptoms" id="wp_plogg_saf_day_symptoms" value="<?php echo $wp_plogg_saf_day_symptoms; ?>">
	    <br/>
	    
	    <label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_night_symptoms">Signes de nuit</label>
	    <input style="width:100%; display:block" type="text" name="wp_plogg_saf_night_symptoms" id="wp_plogg_saf_night_symptoms" value="<?php echo $wp_plogg_saf_night_symptoms; ?>">
	    <br/>
	    
	    <hr/>
	    <br/>
	     
	    <h3>Étape 5</h3>
	    
	    <table class="mytable2">
		    <tr>
			    <th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_circonference">Tour de cou</label>
			    </th>
			    <td>
			    	<input style="width:50px; display:block" type="text" name="wp_plogg_saf_circonference" id="wp_plogg_saf_circonference" value="<?php echo $wp_plogg_saf_circonference; ?>">
			    </td>
		    </tr>
		    <tr>
			    <th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_pause_rapporte">Pauses respiratoires rapportées par le conjoint</label>
			    </th>
			    <td>
			    	<input style="width:50px; display:block" type="text" name="wp_plogg_saf_pause_rapporte" id="wp_plogg_saf_pause_rapporte" value="<?php echo $wp_plogg_saf_pause_rapporte; ?>">
			    </td>
		    </tr>
		    <tr>
			    <th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_etouffe">Sensation d’étouffement</label>
			    </th>
			    <td>
			    	<input style="width:50px; display:block" type="text" name="wp_plogg_saf_etouffe" id="wp_plogg_saf_etouffe" value="<?php echo $wp_plogg_saf_etouffe; ?>">
			    </td>
		    </tr>
		    <tr>
			    <th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_somnole">Somnolence</label>
			    </th>
			    <td>
			    	<input style="width:50px; display:block" type="text" name="wp_plogg_saf_somnole" id="wp_plogg_saf_somnole" value="<?php echo $wp_plogg_saf_somnole; ?>">
			    </td>
		    </tr>
		    <tr>
			    <th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_retrognathie">Rétrognathie mandibulaire et/ou maxillaire</label>
			    </th>
			    <td>
			    	<input style="width:50px; display:block" type="text" name="wp_plogg_saf_retrognathie" id="wp_plogg_saf_retrognathie" value="<?php echo $wp_plogg_saf_retrognathie; ?>">
			    </td>
		    </tr>
		    <tr>
			    <th>
					<label style="width:100%; display:block; font-weight:bold;" for="wp_plogg_saf_hypertension">Rétrognathie mandibulaire et/ou maxillaire</label>
			    </th>
			    <td>
			    	<input style="width:50px; display:block" type="text" name="wp_plogg_saf_hypertension" id="wp_plogg_saf_hypertension" value="<?php echo $wp_plogg_saf_hypertension; ?>">
			    </td>
		    </tr>
	    </table>
	    
	</div>
<?php
}
add_action('save_post', function() {
    global $post;
    
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    
    if($_POST && wp_verify_nonce($_POST['nonce_wp_plogg_saf'],__FILE__)) {
    	if(isset($_POST['gallery'])){
	    	update_post_meta($post->ID, 'gallery', $_POST['gallery']); 
    	}
    	if(isset($_POST['ordre'])){
	    	update_post_meta($post->ID, 'ordre', $_POST['ordre']); 
    	}
   	}
});




//==========================================================================
// Onglet des formulaires
//==========================================================================
if(!function_exists("admin_formulaires_menu")){
	function admin_formulaires_menu()  {
		global $themename, $shortname, $options;
	
		add_menu_page( 'Formulaires', 'Formulaires', 'administrator', 'formulaires', 'my_forms_menu_page', 'dashicons-clipboard' ); 
		// L'ajout des Custom Post au menu enlève le lien du menu vers la page du menu, il faut donc créer un sous menu poyr y accèder
		//add_submenu_page( 'formulaires', 'Statistiques', 'Statistiques', 'administrator', 'formulaires_options', 'my_forms_menu_page',0);
	
	}
	add_action('admin_menu', 'admin_formulaires_menu');
	
	function my_forms_menu_page(){
	?>
		<h1>Statistiques des formulaires</h1>
	<?php
	}
}



?>