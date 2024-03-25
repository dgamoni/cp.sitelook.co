<?php 

add_shortcode( 'notes_patient', 'notes_patient_func' );
function notes_patient_func( $atts ){

	$html = '';
	ob_start();
		

		if ( isset($_GET['patient_id']) )  {
			$id = $_GET['patient_id'];
			//$user = get_user_by('id', $id );
			//var_dump($id);
			?>
			<table class="table table-striped table-hover">
                <thead>
                </thead>
                <tbody>

					<?php		
					$form = GFAPI::get_entries( 4, '');
					//echo "<pre>", var_dump($form), "</pre>";
					foreach ($form as $key => $value) {
						if(  $value[8] == $id){
							$user = get_user_by('id', $value[8]);
							if (!$value[2]) {
								$sign = '<a href="'.home_url().'/therapist-home/notes-edit/?entry='.$value['id'].'" class="signature_required">Signature Required</a>';
							} else {
								$sign = 'Signed';
							}


						 	?>

							<tr>
								<td><a href="<?php echo home_url() . '/pdf/5b9d21934ebad/'.$value['id'].'/'; ?>"><?php echo $value['date_created']; ?></a></td>
								<!-- <td><a href="<?php echo home_url() .'/therapist-home/patient-details/?patient_id='. $user->ID.''; ?>" ><?php echo $user->display_name; ?></a></td>  -->
								<td><?php echo $value[1]; ?></td>
								<td><?php echo $sign; ?></td>
								<td><a href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></a></td>
							</tr>
						<?php
						}
					} ?>
				</tbody>
            </table>
        <?php 
		}
	?> 
	<?php
	$html .= ob_get_contents();
	ob_end_clean();

	return $html;
}	