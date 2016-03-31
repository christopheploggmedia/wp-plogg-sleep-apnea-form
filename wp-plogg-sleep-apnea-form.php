<?php
/*
Plugin Name: Formulaire de l'apnée du sommeil EpWorth
Plugin URI: http://www.ploggdentisterie.com/
Version: 1.1
Dernière modification : 31 mars 2016
Author: Plogg Solutions
Description: Ce pluggin est destiné à afficher un formulaire de l'apnée du sommeil EpWorth
Text Domain: wp_plogg_sleep_apnea_form
*/


/****************************
Variables globales
*****************************/
$wp_plogg_sleep_apnea_form_settings=get_option('wp_plogg_sleep_apnea_form_settings');


/****************************
Includes
*****************************/

include("includes/functions.php"); // les fonctions
//include("includes/assets.php"); // include des js et css
include("includes/wp_plogg_sleep_apnea_form_settings.php"); // page des réglages du plugin


/*******************************
INIT
*********************************/
add_action( 'init', 'wp_plogg_sleep_apnea_form_register_shortcodes');

?>