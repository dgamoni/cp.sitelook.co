

jQuery(document).ready(function($){
	$('[data-toggle="tooltip"]').tooltip();

	
	$(document).on('click', '.update_note', function(e){
		e.preventDefault();
		//console.log( $(this).data('note_to') );
            var note_id =  $(this).data('note_to');
            var update_note_text = $('.update_note_text_'+note_id).val();

            $.ajax({
                type    : "POST",
                url     : MyAjax.ajaxurl,
                dataType: "json",
                data    : "action=appointment_update_note&note_id=" + note_id+'&note_text='+update_note_text,
                success : function (a) {
                    console.log(a.note.length);
                    if( a.note.length >0 ) {
                    	$('.appointment_note_'+note_id).html('<i>*</i> '+ a.note).show();
                    } else {
                    	$('.appointment_note_'+note_id).html('<i>*</i> '+ a.note).hide();
                    }
                    
                    $('.collapse_note_'+note_id).trigger('click');
                }
            }); //end ajax		
	});


    $(document).on('click', '#save_user_data', function(e){
        e.preventDefault();

            var sitelook_user_address =  $('#update_user_data #sitelook_user_address').val();
            var sitelook_user_state =  $('#update_user_data #sitelook_user_state').val();
            var user_meta_phone =  $('#update_user_data #user_meta_phone').val();
            var user_id = $('#update_user_data #user_id').val();
            var intake_form = $('#update_user_data .applay_sitelook_intake_form_front').val();
            var consent_form = $('#update_user_data .applay_sitelook_informed_consent_form_front').val();

            $.ajax({
                type    : "POST",
                url     : MyAjax.ajaxurl,
                dataType: "json",
                data    : "action=save_patinet_data&address=" + sitelook_user_address+'&state='+sitelook_user_state+'&phone='+user_meta_phone+'&user_id='+user_id,
                success : function (a) {
                    //console.log(a);
                    //console.log(a.success);
                    if(a.success && intake_form == 'Completed' && consent_form == 'Completed'){
                        $('#update_user_data #message').html('Thanks! Setup complete').show();
                        window.location.replace('patient-home');
                    } else {
                        $('#update_user_data #message').addClass('error').html('Please complete setup!').show();
                    }

                }
            }); //end ajax      
    });


}); //end ready