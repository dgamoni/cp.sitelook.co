

jQuery(document).ready(function($){


   

    $(document).on('click', '.appointment_fee_save', function(e) {

         e.preventDefault();

        // Data for AJAX
        var data_patientid = jQuery(this).attr('data-patientid');
        var sitelook_appointment_fee = jQuery('.sitelook_appointment_fee').val();

        $.ajax({
                type    : "POST",
                url     : MyAjax.ajaxurl,
                dataType: "json",
                data    : "action=appointment_fee_save&data_patientid=" + data_patientid+"&sitelook_appointment_fee="+sitelook_appointment_fee,
                success : function (a) {
                    console.log(a);
                    //jQuery('.sitelook_appointment_fee').val( sitelook_appointment_fee);

                }
            }); //end ajax  

    });


$('#input_5_7').SumoSelect({ okCancelInMulti: true, selectAll: true });


    // $('#input_5_7').searchableOptionList({
    //     scrollTarget: $('#my-content-area'),    // change the scrollTarget if neccessary
    //     events: {
           
    //         // override the default onScroll positioning event if neccessary
    //         onScroll: function () {
    //             // gets called when the contents of the
    //             // my-content-area container are scrolled
                
    //             // now you need to position sol popup
    //             // below is the default implementation to
    //             // give you a hint how to position the popup
    //             // adapt it to your needs
    //             //
    //             // you have access to all internal SOL attributes via "this."
                
    //             var posY = this.$input.offset().top - this.config.scrollTarget.scrollTop() + this.$input.outerHeight(),
    //                 selectionContainerWidth = this.$innerContainer.outerWidth(false) - parseInt(this.$selectionContainer.css('border-left-width'), 10) - parseInt(this.$selectionContainer.css('border-right-width'), 10);

    //             if (this.$innerContainer.css('display') !== 'block') {
    //                 // container has a certain width
    //                 // make selection container a bit wider
    //                 selectionContainerWidth = Math.ceil(selectionContainerWidth * 1.2);
    //             } else {
    //                 // no border radius on top
    //                 this.$selectionContainer
    //                     .css('border-top-right-radius', 'initial');

    //                 if (this.$actionButtons) {
    //                     this.$actionButtons
    //                         .css('border-top-right-radius', 'initial');
    //                 }
    //             }

    //             this.$selectionContainer
    //                 .css('top', Math.floor(posY))
    //                 .css('left', Math.floor(this.$container.offset().left))
    //                 .css('width', selectionContainerWidth);
    //         }
    //     }
    // });

    //$('#users-select').searchableOptionList({
    // $('#input_5_7').searchableOptionList({
    //     // other options here
        
    //     // register events
    //     events: {            
    //         onRendered: function() {
    //         },
            
    //         // more events as you need
    //     }
    // });

    /* Send message */
    jQuery(document.body).on('click', '#gform_submit_button_5',function(e){
        e.preventDefault();
        jQuery('.um-message-send:visible').addClass('disabled');
        var to = jQuery('#input_5_7').val();
        console.log(to);
        var message_to = 42;
        var content = jQuery('#input_5_6').val();

        jQuery(to).each(function(index, todo) {
            console.log(todo);
            jQuery.ajax({
                url: wp.ajax.settings.url,
                type: 'post',
                dataType: 'json',
                data: {
                    action:'um_messaging_send',
                    message_to: todo,
                    content: content
                },
                success: function(data){
                        console.log( data);
                        jQuery('#input_5_6').val('');
                        jQuery('.message_sent').show();


                            $.ajax({
                                type    : "POST",
                                url     : MyAjax.ajaxurl,
                                dataType: "json",
                                data    : "action=update_message",
                                success : function (a) {
                                    jQuery('#notifications_block .textwidget').html(a);
                                }
                            }); //end ajax 

                },
                error: function(e){
                    console.log(e);
                }
            });
        });

        
        return false;
    });

$('.read_message').click(function(event) {
	//event.preventDefault();
	var userid = $(this).data('id');
	var conversation_id = $(this).data('conversation_id');
	//$('#unread_message').find(".um-message-conv-item[data-conversation_id='" + conversation_id +"']").trigger('click');
});

jQuery(document).bind('gform_post_render', function(event, formId, currentPage){
    if(formId ==1 ) {
       console.log('render');
        $('#gform_1 #gappointments_calendar').addClass('custom_calendar');
        $('#gform_1 #ga_appointments_calendar').hide();
        $('#gform_1 #ga_appointments_calendar').parent().parent().prepend('<input name="date_pre" id="date_pre" style="display:none;" value="" class="datepicker medium mdy datepicker_no_icon hasDatepicker" readonly type="text">');
        $('#gform_1 #date_pre').show();
    }
});

   
    $('#gform_1 #gappointments_calendar').addClass('custom_calendar');
    $('#gform_1 #ga_appointments_calendar').hide();
    $('#gform_1 #ga_appointments_calendar').parent().parent().prepend('<input name="date_pre" id="date_pre" style="display:none;" value="" class="datepicker medium mdy datepicker_no_icon hasDatepicker" readonly type="text">');
    $('#gform_1 #date_pre').show();

    $(document).on('click', '#date_pre', function(e){
        //console.log('click');
        $('#gform_1 #ga_appointments_calendar').show();

    });

    $(document).on('click', '.day_available', function(event) {
         console.log('click');
         console.log( $(this).attr('date-go'));
         $('#date_pre').val(  $(this).attr('date-go') );
         $('#gform_1 #ga_appointments_calendar').hide();


        // Data for AJAX
        var current_month = jQuery(this).attr('date-go');
        var service_id    = jQuery(this).attr('service_id');
        var provider_id   = jQuery(this).attr('provider_id');
        var form_id       = jQuery('#ga_appointments_calendar').attr('form_id');

        $.ajax({
                type    : "POST",
                url     : MyAjax.ajaxurl,
                dataType: "json",
                data    : "action=ga_calendar_time_slots_custom&current_month=" + current_month+'&service_id='+service_id+'&provider_id='+provider_id+'&form_id='+form_id,
                success : function (a) {
                    console.log(a);
                    $('#input_1_8').empty();
                    $('#input_1_8').append('<option value=0>Select time</option>');
                    $.each(a.data.time_array,function(key, value) {
                        $('#input_1_8').append('<option value=' + value + '>' + value + '</option>');
                    });


                }
            }); //end ajax  

    });

    $(document).on('change', '#input_1_8', function(event) {
        console.log($(this).val());
        $('.appointment_booking_time').val($(this).val());
        //$('.ginput_appointment_cost_input').val('888');
    });




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