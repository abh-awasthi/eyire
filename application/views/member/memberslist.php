
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
 
<table class="table table-bordered table-striped table-hover dataTable js-exportableusersmembers">
                                    <thead>
                                         <tr>
										    <th>Member ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Reg Date</th>
                                            <th>Gurdian Name</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
											 <th>Member ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Reg Date</th>
                                            <th>Gurdian Name</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
 
                                    </tbody>
                                </table>


     
 
 
    </div>
	</div>
</section>



 


 
<script>

 $(function () {
    
    //Exportable table
    $('.js-exportableusersmembers').DataTable({
        dom: 'Bfrtip',
		"ajax": '<?php echo base_url(); ?>member/get_member_list',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
	
	
	
	
	
	
	

});

</script>


