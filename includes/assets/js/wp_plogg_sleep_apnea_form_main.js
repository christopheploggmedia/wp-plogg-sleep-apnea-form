
//======================================================================
// Validation de la cironférence du coup
//======================================================================
$('.wp_plogg_saf_table_cca #wp_plogg_saf_neck_circumference').change(function(){
	if($(this).val()<0){
		$(this).val(0);
	}
});


//======================================================================
// Calcul de la cironférence du coup
//======================================================================

var circTotal=-1;
$('.wp_plogg_saf_table_cca input').change(function(){
	
		
	circTotal=-1;
	if(""!=$('.wp_plogg_saf_table_cca #wp_plogg_saf_neck_circumference').val()){
		circTotal=0;
		circTotal+=parseInt($('.wp_plogg_saf_table_cca #wp_plogg_saf_neck_circumference').val());
		
		if(circTotal<=0){
			$('.wp_plogg_saf_table_cca .wp-plogg-saf-circonference-calc').html(circTotal);
		}
		
		if(circTotal>49){
			circTotal=49;
			$('.wp_plogg_saf_table_cca #wp_plogg_saf_neck_circumference').val(49)
		}
		
		if($('.wp_plogg_saf_table_cca #wp_plogg_saf_hypertension_calc:checked').length==1){
			circTotal+=4;
		}	
		if($('.wp_plogg_saf_table_cca #wp_plogg_saf_ronfle_calc:checked').length==1){
			circTotal+=3;
		}	
		if($('.wp_plogg_saf_table_cca #wp_plogg_saf_pause_calc:checked').length==1){
			circTotal+=3;
		}		
	}
	
	if(circTotal>=0){
		$('.wp_plogg_saf_table_cca .wp-plogg-saf-circonference-calc').html(circTotal);
	}
	
});




//======================================================================
// Validation de l'heure de levé et de couché
//======================================================================
/*$('#wp_plogg_saf_heure_couche, #wp_plogg_saf_heure_leve').change(function(){
	$(this).val( Math.floor($(this).val()) );
	if($(this).val()<0 || $(this).val()>24){
		$(this).val(0);
	}
});*/

//======================================================================
// Calcul score des situations
//======================================================================
/*$('#wp_plogg_saf_situation_lire, #wp_plogg_saf_situation_tele, #wp_plogg_saf_situation_inactif, #wp_plogg_saf_situation_passager, #wp_plogg_saf_situation_sieste, #wp_plogg_saf_situation_discute_assis, #wp_plogg_saf_situation_apres_manger, #wp_plogg_saf_situation_congestion').change(function(){
	if($(this).val()<0 || $(this).val()>3){
		$(this).val(0);
	}
});*/

$('.wp-plogg-saf-situations-wrapper select').change(function(){
	var situationsTotal=0;
	situationsTotal+=parseInt($('#wp_plogg_saf_situation_lire').val());
	situationsTotal+=parseInt($('#wp_plogg_saf_situation_tele').val());
	situationsTotal+=parseInt($('#wp_plogg_saf_situation_inactif').val());
	situationsTotal+=parseInt($('#wp_plogg_saf_situation_passager').val());
	situationsTotal+=parseInt($('#wp_plogg_saf_situation_sieste').val());
	situationsTotal+=parseInt($('#wp_plogg_saf_situation_discute_assis').val());
	situationsTotal+=parseInt($('#wp_plogg_saf_situation_apres_manger').val());
	situationsTotal+=parseInt($('#wp_plogg_saf_situation_congestion').val());
	
	if(situationsTotal>=0){
		$('.wp-plogg-saf-situation-total-wrapper').addClass('show');
		$('.wp-plogg-saf-situation-total-wrapper .wp-plogg-saf-situation-total').html(situationsTotal);
	}
});



//======================================================================
// Afficher les champs 'Si oui combien'
//======================================================================

$('input[name="wp_plogg_saf_matin_fatigue"]').change(function(){
	if($(this).val()=="Yes" || $(this).val()=="Oui"){
		$('.wp_plogg_saf_si_matin_fatigue_oui').show();
	}else{
		$('.wp_plogg_saf_si_matin_fatigue_oui').hide();
	}
});

$('input[name="wp_plogg_saf_ronfle"]').change(function(){
	if($(this).val()=="Yes" || $(this).val()=="Oui"){
		$('.wp_plogg_saf_si_ronfle_oui').show();
	}else{
		$('.wp_plogg_saf_si_ronfle_oui').hide();
	}
});

$('input[name="wp_plogg_saf_deja_traite"]').change(function(){
	if($(this).val()=="Yes" || $(this).val()=="Oui"){
		$('label[for="wp_plogg_saf_deja_traite_quand"], #wp_plogg_saf_deja_traite_quand').show();
	}else{
		$('label[for="wp_plogg_saf_deja_traite_quand"], #wp_plogg_saf_deja_traite_quand').hide();
	}
});

$('input[name="wp_plogg_saf_pause"]').change(function(){
	if($(this).val()=="Yes" || $(this).val()=="Oui"){
		$('.wp_plogg_saf_si_pause_oui').show();
	}else{
		$('.wp_plogg_saf_si_pause_oui').hide();
	}
});



//======================================================================
// Validation des champs
//======================================================================

/* On liste tous les champs par étape pour tester selon l'étape courante */

var fields = [[],[],[], [], [], []];

fields[2]['wp_plogg_saf_heure_couche']='number';
//fields[2]['wp_plogg_saf_heure_leve']='number';
fields[2]['wp_plogg_saf_endormi_vite']='radio';
fields[2]['wp_plogg_saf_reveille_facile']='radio';
fields[2]['wp_plogg_saf_reveil_frequent']='radio';
fields[2]['wp_plogg_saf_matin_fatigue']='radio';
fields[2]['wp_plogg_saf_qualite_sommeil']='radio';
fields[2]['wp_plogg_saf_ronfle']='radio';
fields[2]['wp_plogg_saf_socialement_derangeant']='radio';
fields[2]['wp_plogg_saf_socialement_comment']='radio';
fields[2]['wp_plogg_saf_ronfle_dos']='radio';
fields[2]['wp_plogg_saf_ronfle_regulier']='radio';
fields[2]['wp_plogg_saf_ronfle_explosif']='radio';
fields[2]['wp_plogg_saf_ronfle_agrave_par_alcool']='radio';
fields[2]['wp_plogg_saf_ronfle_agrave_par_fatigue']='radio';
//fields[2]['wp_plogg_saf_ronfle_agrave_par']='checkbox';
fields[2]['wp_plogg_saf_pause']='radio';
fields[2]['wp_plogg_saf_pause_frequence']='radio';
fields[2]['wp_plogg_saf_reveil_etouffe']='radio';

fields[3]['wp_plogg_saf_somnolent']='radio';
fields[3]['wp_plogg_saf_situation_lire']='select';
fields[3]['wp_plogg_saf_situation_tele']='select';
fields[3]['wp_plogg_saf_situation_inactif']='select';
fields[3]['wp_plogg_saf_situation_passager']='select';
fields[3]['wp_plogg_saf_situation_sieste']='select';
fields[3]['wp_plogg_saf_situation_discute_assis']='select';
fields[3]['wp_plogg_saf_situation_apres_manger']='select';
fields[3]['wp_plogg_saf_situation_congestion']='select';
fields[3]['wp_plogg_saf_besoin_bouger']='radio';
fields[3]['wp_plogg_saf_mal_tete_reveil']='radio';
fields[3]['wp_plogg_saf_perte_memoire']='radio';
fields[3]['wp_plogg_saf_mauvaise_concentration']='radio';
fields[3]['wp_plogg_saf_deja_traite']='radio';

//fields[4]['wp_plogg_saf_day_symptoms']='checkbox';
//fields[4]['wp_plogg_saf_night_symptoms']='checkbox';

fields[5]['wp_plogg_saf_circonference']='radio';
fields[5]['wp_plogg_saf_pause_rapporte']='radio';
fields[5]['wp_plogg_saf_etouffe']='radio';
fields[5]['wp_plogg_saf_somnole']='radio';
fields[5]['wp_plogg_saf_retrognathie']='radio';
fields[5]['wp_plogg_saf_hypertension']='radio';
			
	
//======================================================================
// Check des champs obligatoires
//======================================================================	
var currentStep=1;
var canGoNext = true;
function wp_plogg_sleep_apnea_form_validation(){
	canGoNext = true;
	$("*").removeClass('wp-plogg-saf-error');
	$(".error-sentence").removeClass('show');
	
	if(1==currentStep){	
		$(".wp_plogg_saf_table_cca").removeClass('wp-plogg-saf-error');	
		if(!circTotal || circTotal<=0 || parseInt($('.wp_plogg_saf_table_cca #wp_plogg_saf_neck_circumference').val())<=0){
			canGoNext = false;
			
			$(".wp_plogg_saf_table_cca").addClass('wp-plogg-saf-error');	
		}
	}
	
	if(2==currentStep){	
		wp_plogg_saf_heure_couche=$("#wp_plogg_saf_heure_couche").val();
		wp_plogg_saf_heure_leve = $("#wp_plogg_saf_heure_leve").val();
		
		if(wp_plogg_saf_heure_couche<0 || wp_plogg_saf_heure_couche>24 || wp_plogg_saf_heure_leve<0 || wp_plogg_saf_heure_leve>24){
			$("#wp_plogg_saf_heure_couche").closest(".wp-plogg-saf-question-fields-wrapper").addClass('wp-plogg-saf-error');
			canGoNext=false;
		}
	}
	
	if(3==currentStep){	
		wp_plogg_saf_situation_lire=$("#wp_plogg_saf_situation_lire, #wp_plogg_saf_situation_tele, #wp_plogg_saf_situation_inactif, #wp_plogg_saf_situation_passager, #wp_plogg_saf_situation_sieste, #wp_plogg_saf_situation_discute_assis, #wp_plogg_saf_situation_apres_manger, #wp_plogg_saf_situation_congestion").each(function(){
			if($(this).val()<0 ||$(this).val()>3){
				canGoNext=false;
				$(this).closest(".wp-plogg-saf-question-fields-wrapper").addClass('wp-plogg-saf-error');
			}
		});
	}
	
	// On teste les champs selon l'étape courante
	for (var arrayIndex in fields[currentStep]) {
		if("number"==fields[currentStep][arrayIndex] || "text"==fields[currentStep][arrayIndex]){
			if(''== $("input[name='"+arrayIndex+"']").val()){
				canGoNext=false;
				$("input[name='"+arrayIndex+"']").closest(".wp-plogg-saf-question-fields-wrapper").addClass('wp-plogg-saf-error');
			}
			 
		}
		if("radio"==fields[currentStep][arrayIndex] || "checkbox"==fields[currentStep][arrayIndex]){
			var data_related = $("input[name='"+arrayIndex+"']").attr("data-related");
			if(data_related==undefined || $("input[name='"+data_related+"']:checked").attr("data-related-val")==1 ){
				if(0== $("input[name='"+arrayIndex+"']:checked").length){
					canGoNext=false;
					$("input[name='"+arrayIndex+"']").closest(".wp-plogg-saf-question-fields-wrapper").addClass('wp-plogg-saf-error');
				}
			}
		}
		
		if('select'==fields[currentStep][arrayIndex] || "checkbox"==fields[currentStep][arrayIndex]){
			if(''== $("select[name='"+arrayIndex+"']").val()){
				canGoNext=false;
				$("select[name='"+arrayIndex+"']").closest(".wp-plogg-saf-question-fields-wrapper").addClass('wp-plogg-saf-error');
			}
		}
	}

	
	if(canGoNext){
		goNextStep();
		return true;
	}else{
		$(".error-sentence").addClass('show');
		return false;
	}
}

$('.wp-plogg-saf-step .next, #wp-plogg-saf-div submit').click(function(){
	wp_plogg_sleep_apnea_form_validation();
});

//======================================================================
// Changement d'étapes
//======================================================================

var currentStepSelector='.wp-plogg-saf-step[data-step='+currentStep+']';
function goNextStep(){
	if(currentStep<6){
		currentStep++;
	}
	$('.wp-plogg-saf-step').removeClass('current');
	currentStepSelector='.wp-plogg-saf-step[data-step='+currentStep+']';
	$(currentStepSelector).addClass('current');
}
function goPrevStep(){
	if(currentStep>1){
		currentStep--;
	}
	$('.wp-plogg-saf-step').removeClass('current');
	currentStepSelector='.wp-plogg-saf-step[data-step='+currentStep+']';
	$(currentStepSelector).addClass('current');
}

$('.wp-plogg-saf-step .prev').click(function(){
	goPrevStep();
});