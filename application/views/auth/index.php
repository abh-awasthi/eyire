<link src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css"> 

<script src="<?php echo base_url(); ?>assets/bundles/datatablescripts.bundle.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/buttons/buttons.flash.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/buttons/buttons.print.min.js"></script>







<!-- Main Content -->

<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>User List</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> User</a></li>
                    <li class="breadcrumb-item active">User List</li>
                </ul>
                <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">                
                <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
            </div>
        </div>
    </div>
	<div class="body">
    <div class="table-responsive">
 
<table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Groups</th>
                                            <th>Activate/Deactivate</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Groups</th>
                                            <th>Activate/Deactivate</th>
                                            <th>Edit</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
		<?php foreach ($users as $user):?>
		<tr>
            <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
			<td>
				<?php foreach ($user->groups as $group):?>
					<?php echo anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
                <?php endforeach?>
			</td>
			<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></td>
			<td><?php echo anchor("auth/edit_user/".$user->id, 'Edit') ;?></td>
		</tr>
	<?php endforeach;?>
                                    </tbody>
                                </table>


     
 
 
    </div>
	</div>
</section>



 


 
<script>

 $(function () {
    
    //Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
		"ajax": '<?php echo base_url(); ?>auth/usersList',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
	
	
	
	
	
	
	

});

</script>


