<?php 

add_shortcode( 'notes', 'patient_notes_func' );
function patient_notes_func( $atts ){

	$html = '';
	ob_start();

	?>


	<div id="new_patient_block" class="notes_wrap vc_wp_text wpb_content_element notifications_style">
		<div class="widget widget_text">
			
			<div class="patient_info_header">
				<h2 class="widgettitle">Notes</h2>
				<div class="patient_button">
					<a href="<?php echo home_url('/therapist-home/new-note/'); ?>" class="btn btn-primary button_message" >New Note</a>
				</div>
			</div>	

			<div class="textwidget"> 

			<table class="table table-striped table-hover">
                <thead>
<!--                     <tr>
                        <th>date/th>
                        <th>time</th>						
						<th>name</th>
						<th>status</th>
                        <th>actions</th>
                    </tr> -->
                </thead>
                <tbody>

					<?php 
					$form = GFAPI::get_entries( 4, '');
					//var_dump($form);
					//echo "<pre>", var_dump($form), "</pre>";
					//var_dump(get_current_user_id());
					foreach ($form as $key => $value) {
						if( $value['created_by'] == get_current_user_id()){
							$user = get_user_by('id', $value[8]);
							if (!$value[2]) {
								$sign = '<a href="'.home_url().'/therapist-home/notes-edit/?entry='.$value['id'].'" class="signature_required">Signature Required</a>';
							} else {
								$sign = 'Signed';
							}


						 	?>

							<tr>
								<td><a href="<?php echo home_url() . '/pdf/5b9d21934ebad/'.$value['id'].'/'; ?>"><?php echo $value['date_created']; ?></a></td>
								<td><a href="<?php echo home_url() .'/therapist-home/patient-details/?patient_id='. $user->ID.''; ?>" ><?php echo $user->display_name; ?></a></td> 
								<td><?php echo $value[1]; ?></td>
								<td><?php echo $sign; ?></td>
								<td><a href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></a></td>
							</tr>
						<?php
						}
					}

					?>

				</tbody>
            </table>

			</div>
		</div>
	</div>

	<?php
	$html .= ob_get_contents();
	ob_end_clean();

	return $html;
}