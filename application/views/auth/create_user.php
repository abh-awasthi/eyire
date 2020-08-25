

<!-- Main Content -->

<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Create User</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> User</a></li>
                    <li class="breadcrumb-item active">Create User</li>
                </ul>
                <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">                
                <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
            </div>
        </div>
    </div>
    <div class="container-fluid">
 
		
		<!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
					
					<div id="infoMessage"><?php echo $message;?></div>
					
                        <div class="header">
						
						
                            <h2><strong>Create</strong> User</h2>
                            <ul class="header-dropdown">
                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                                <li class="remove">
                                    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" action="<?php echo base_url(); ?>auth/create_user" method="POST">
							
							<div class="row">
								<div class="col-md-6">
                                <div class="form-group form-float">
								<label>First Name</label>
                                    <input type="text" class="form-control" placeholder="Name" name="first_name"    required>                                
                                    
                                </div>
								</div>
								<div class="col-md-6">
								<div class="form-group form-float">
								<label>Last Name</label>
                                    <input type="text" class="form-control" placeholder="Name" name="last_name"    required>                                
                                     
                                </div>
								</div>
							</div>	
							
							
							<div class="row">
								<div class="col-md-6">							
								<div class="form-group form-float">
								<label>Email</label>
                                    <input type="text" class="form-control" placeholder="Email" name="email"  required>                                
                                </div>
								</div>
								
								<div class="col-md-6">	
								<div class="form-group form-float">
								<label>Phone</label>
                                    <input type="text" class="form-control" placeholder="Phone" name="phone"  required>                                
                                    
                                </div>
								</div>
								
							</div>	
							
							
						 <div class="row">
								<div class="col-md-6">							
								<div class="form-group form-float">
							 
                                    <select class="form-control show-tick" name="role">
									<option value=''>Select Role</option>
									<?php foreach($groups as $group){ ?>
									
										<option value='<?php echo $group['id'] ?>'><?php echo $group['description'] ?></option>
										
									<?php } ?>
									</select>                      
                                </div>
								</div>
							</div>	


							<div class="row">
								<div class="col-md-6">							
								<div class="form-group form-float">
								<label>User Name</label>
                                    <input type="text" class="form-control"  placeholder="User Name" name="username"  required>                                
                                </div>
								</div>
								<div class="col-md-6">	
								<div class="form-group form-float">
								<label>Address</label>
                                    <input type="text" class="form-control"  placeholder="Address" name="Address"  required>                                
                                </div>
								</div>
							</div>
							
							<div class="row">
							<div class="col-md-6">	
								<div class="form-group form-float">
								<label>Passowrd</label>
                                    <input type="text" class="form-control" placeholder="Password" name="password"  required>                                
                                </div>
								</div>
								
								<div class="col-md-6">
								<div class="form-group form-float">
								<label>Confirm Passowrd</label>
                                    <input type="text" class="form-control" placeholder="Confirm Password" name="password_confirm"  required>                                
                                </div>
								</div>
							</div>	
                                <button class="btn btn-raised btn-primary waves-effect" type="submit">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

     
 
 
    </div>
</section>
<script>


    //Advanced Form Validation
    $('#form_advanced_validation').validate({
        rules: {
            'date': {
                customdate: true
            },
            'creditcard': {
                creditcard: true
            }
        },
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        }
    });

</script>




 