<?php

function wp_plogg_sleep_apnea_form_load_ressources() {
	
	wp_enqueue_style('wp-plogg-sleep-apnea-form-style', plugin_dir_url( __FILE__ ) . 'assets/css/ahpr_style.css');
	wp_enqueue_script('wp-plogg-sleep-apnea-form-script', plugin_dir_url( __FILE__ ) . 'assets/js/ahpr_main.js');
	
}

?>