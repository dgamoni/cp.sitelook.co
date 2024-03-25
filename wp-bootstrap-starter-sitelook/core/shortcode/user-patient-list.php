<?php

add_shortcode( 'user-patient-list', 'user_patient_list_func' );
function user_patient_list_func( $atts ){

	$atts = shortcode_atts( array(
		'therapist_id' => ''
	), $atts );

	$html = '';
	ob_start();	?>
	
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
						<h2>Patients <b>Management</b></h2>
					</div>
					<div class="col-sm-7">
						<a href="<?php echo home_url() .'/therapist-home/add-new-patient/'; ?>" class="btn btn-primary" ><i class="material-icons">&#xE147;</i> <span>Add New Pacient</span></a>
						<a href="#" class="btn btn-primary"><i class="material-icons">&#xE24D;</i> <span>Export to Excel</span></a>						
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>						
						<th>Date Created</th>
						<th>Role</th>
                        <th>Status</th>
						<th>Action</th>
                    </tr>
                </thead>
                <tbody>
                
                <?php 
                $args = array(
					'role'      => 'um_patient',
					'fields'	=> 'all_with_meta'
				);
					$users = get_users( $args );
					foreach( $users as $key=> $user ){ ?>
					<?php //var_dump( get_avatar_url( $user->ID )); ?>
                    <tr>
                        <td><?php echo $key; ?></td>
                       <!--  <td><a href="<?php echo home_url() .'/user/'. $user->user_nicename.'/?profiletab=main&um_action=edit'; ?>" target="_blank"><img src="<?php echo get_avatar_url( $user->ID ); ?>" class="avatar" alt=""><?php echo $user->display_name; ?></a></td> -->
                        
                        <td><a href="<?php echo home_url() .'/therapist-home/patient-details/?patient_id='. $user->ID.''; ?>" ><img src="<?php echo get_avatar_url( $user->ID ); ?>" class="avatar" alt=""><?php echo $user->display_name; ?></a></td> 

                        <td><?php echo $user->user_registered; ?></td>                        
                        <td>Patien</td>
						<td><span class="status text-success">&bull;</span> Active</td>
						<!-- <td><span class="status text-warning">&bull;</span> Inactive</td> -->
						<!-- <td><span class="status text-danger">&bull;</span> Suspended</td> -->   
						<td>
							<!-- <a href="<?php echo home_url() .'/user/'. $user->user_nicename.'/?profiletab=main&um_action=edit'; ?>" class="settings" title="Edit" data-toggle="tooltip" target="_blank"><i class="material-icons">&#xE8B8;</i></a> -->
							<a href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></a>
						</td>
                    </tr>
					
					<?php }
					//var_dump($users);
                ?>
                </tbody>
            </table>
			<div class="clearfix">
                <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                <ul class="pagination">
                    <li class="page-item disabled"><a href="#">Previous</a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item active"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                    <li class="page-item"><a href="#" class="page-link">Next</a></li>
                </ul>
            </div>
        </div>
    </div> 
	
	<?php
	$html .= ob_get_contents();
	ob_end_clean();

	return $html;
} 