

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



}); //end ready