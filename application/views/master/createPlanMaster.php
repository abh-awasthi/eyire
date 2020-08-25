<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Create Plan Master</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> Plan</a></li>
                    <li class="breadcrumb-item active">Create Plan Master</li>
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

                    <div id="infoMessage"><?php echo $message; ?></div>

                    <div class="header">		
                        <h2><strong>Create</strong>Plan Master</h2>
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

                        <form id="wizard_with_validation_plan_master" action="<?php echo base_url(); ?>member/processCreateMember" method="POST" class="wizard clearfix">
                            <h5>Form No</h5>
                          
                                <div class="row">
								<div class="col-md-4">
								    <div class="form-group form-float">
                                            <label>Plan Type : *</label>
                                            <select class="form-control  show-tick ms select2" id="plan_type" name="plan_type" required>
                                                <option value=''>Select Plan</option>
													<?php foreach($plan_types as $plan_type){ ?>				
														<option value='<?php  echo $plan_type['id']; ?>'><?php  echo $plan_type['plan_type']; ?></option>
													<?php }  ?>

                                            </select>          

                                    </div>
								</div>
								
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <label>Plan  No</label>
                                            <input type="text" class="form-control" placeholder="Plan  No" name="plan_no" id="plan_no"   required>                                
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <label>Plan Name</label>
                                            <input type="text" class="form-control  " placeholder="Plan Name" name="plan_name"  id="plan_name"  required>                                

                                        </div>
                                    </div>
                                </div>
								
								
								 <div class="row">
								<div class="col-md-4">
								    <div class="form-group form-float">
                                            <label>Deposit Term : *</label>
                                            <select class="form-control  show-tick ms select2" id="plan_year" name="plan_year" required>
                                                <option value=''>Select Term</option>				
                                                 <?php for($i=1;$i<16;$i++){ ?>
													 
													<option value='<?php echo $i; ?>'><?php echo $i; ?> Years</option> 
												 <?php } ?>
												
											
                                            </select>          

                                    </div>
								</div>
								
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <label>Months</label>
                                                <select class="form-control  show-tick ms select2" name="plan_months" required>
                                                <option value=''>Select Months</option>				
                                                <?php for($i=1;$i<13;$i++){ ?>
													 
													<option value='<?php echo $i; ?>'><?php echo $i; ?> Months</option> 
												 <?php } ?>
											
                                            </select>              
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <label>Days</label>
                                               <select class="form-control  show-tick ms select2" name="plan_days" required>
                                                <option value=''>Select Days</option>				
                                                 <?php for($i=1;$i<366;$i++){ ?>
													 
													<option value='<?php echo $i; ?>'><?php echo $i; ?> Days</option> 
												 <?php } ?>
											
                                            </select>          

                                        </div>
                                    </div>
                                </div>
								
								
							
								<div class="row">
								<div class="col-md-4">
								    <div class="form-group form-float">
                                            <label>Pre-Maturity Month : *</label>
                                          <input type="number" class="form-control  " placeholder="Pre-Maturity Month" name="plan_pre_maturity_month"  id="plan_pre_maturity_month"  required>                                
         
                                    </div>
								</div>
								
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <label>Pre Maturity(%): * </label>
                                             <input type="number" class="form-control  " placeholder="Pre Maturity(%)" name="plan_pre_maturity_plan"  id="plan_pre_maturity_plan"  required>                                
                      
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <label>Multiple:</label>
                                            <input type="text" class="form-control  " placeholder="Multiple" name="plan_multiple"  id="plan_multiple"  required>                                
                               

                                        </div>
                                    </div>
                                </div>
								
								
								
								<div class="row">
								<div class="col-md-4">
								    <div class="form-group form-float">
                                            <label>Minimum Amount: *</label>
                                           <input type="number" class="form-control  " placeholder="Minimum Amount" name="minimum_amount"  id="minimum_amount"  required>                                
                                        
                                    </div>
								</div>
						
                                </div>
								
<!--  FD OPTIONAL --->


								<div class="row">
								<div class="col-md-4">
								    <div class="form-group form-float">
                                            <label>Interest Rate General: *</label>
                                           <input type="number" class="form-control  " placeholder="Interest Rate General" name="integrest_rate_general"  id="integrest_rate_general"  required>                                
                                        
                                    </div>
								</div>
								
                                    <div class="col-md-4">
								    <div class="form-group form-float">
                                            <label>Interest Rate SLP: *</label>
                                           <input type="number" class="form-control  " placeholder="Interest Rate SLP" name="interest_rate_slp"  id="interest_rate_slp"  required>                                
                                        
                                    </div>
                                    </div>
									
								    <div class="col-md-4">
								    <div class="form-group form-float">
												 <label>Interest Type: *</label>
                                         		<select class="form-control  show-tick ms select2" id="interest_types" name="interest_types" required>
                                               				
                                            </select> 
                                    </div>
                                    </div>	
									
									


                                </div>

<!--FD OPTIONAL END -->





                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group form-float">
                                            <label>Plan Status : * </label>
                                                <select class="form-control" name="plan_status" required>
                                                 	
													<option value='1'>Active</option> 
													<option value='0'>InActive</option> 
                                            </select>              
                                        </div>
                                    </div>
                                </div>
								<br><br>
							<div class="row">
  
							<div class="col-md-4">
							<button class="btn btn-raised btn-success waves-effect" type="submit">SUBMIT</button>	
							</div>
 							
							</div>
  
                        </form>
                    </div>
                </div>
            </div>
        </div>




    </div>
</section>



<style>

    .wizard .content {
        min-height: 321px !important;   
    }

    .wizard .steps>ul>li {
        width: 15% !important;
        float: left;
    }

</style>
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-select/css/bootstrap-select.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/select2.css" />

<script>

    $(document).ready(function () {

$('.select2').select2();

$("#plan_year").change(function(){

let year = $(this).val();
let plan_type = $("#plan_type").val();
if(plan_type==''){
	
	alert("Please Select Plan Type First");
	
	
}else{
	
	

        $.ajax({
            method: 'POST',
            url: '<?php echo base_url(); ?>master/getInterestTypesvailable',
            data: {year:year,plan_type:plan_type},
            beforeSend: function () {     
                $(".page-loader-wrapper").fadeIn();
            },
            success: function (response) {
				$("#interest_types").append(response);
            },
            complete: function () {
                $(".page-loader-wrapper").fadeOut();
            }
        });
	
}
	
	
});



$("a[href='#finish']").click(function(){
	
	showConfirmMessage(); 
	
});




 

//    $('.datepicker').bootstrapMaterialDatePicker({
//        format: 'DD-MM-YYYY',
//        clearButton: true,
//        weekStart: 1,
//        time: false
//    });

    /*    $('#form_advanced_validationmember').validate({
            rules: {
                'first_name': {
                    required: true
                },
                'last_name': {
                    required: true
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
            },
            submitHandler: function (form) {
                // do other things for a valid form
                showConfirmMessage();
            }
        }); */





        function showConfirmMessage() {
            swal({
                title: "Create Member",
                text: "By Clicking ok the member will be created .",
                icon: "info",
                buttons: true,

            })
                    .then((willDelete) => {
                        if (willDelete) {


                            var form = $('#wizard_with_validation');
                            var url = form.attr('action');

                            $.ajax({
                                type: "POST",
                                url: url,
                                data: form.serialize(), // serializes the form's elements.
								beforeSend: function () {
                                 $(".page-loader-wrapper").fadeIn();
                                },
                                success: function (data)
                                {
									console.log(data);
                                    // show response from the php script.
                                    var result = JSON.parse(data);
                                   
                                    if (result.status) {
										$('#wizard_with_validation').trigger("reset");
                                        swal(result.message, {
                                            icon: "success",
                                            text: "Member ID :" + result.data.member_id,
                                        });
                                    } else {
                                        swal(result.message, {
                                            icon: "error",
                                        });
                                    }
                                },
								complete: function () {
                                 $(".page-loader-wrapper").fadeOut();
                                }
                            });


                        } else {
                            swal("You cancelled the member creation process!");
                        }
                    });
        }




 

//    function showAJAXrequests() {
//    swal({
//        text: 'Are you sure want to create member ?',
//        button: {
//        text: "Search!",
//        closeModal: false,
//        },
//    })
//    .then(name => {
//        if (!name) throw null;
//    
//      //  return fetch(`https://itunes.apple.com/search?term=${name}&entity=movie`);
//      
//      
//      
//          e.preventDefault(); // avoid to execute the actual submit of the form.
//
//    var form = $(this);
//    var url = form.attr('action');
//    
//    $.ajax({
//           type: "POST",
//           url: url,
//           data: form.serialize(), // serializes the form's elements.
//           success: function(data)
//           {
//               alert(data); // show response from the php script.
//           }
//         });
//      
//      
//      
//      
//    })
//    .then(results => {
//        return results.json();
//    })
//    .then(json => {
//        const movie = json.results[0];
//    
//        if (!movie) {
//        return swal("No movie was found!");
//        }
//    
//        const name = movie.trackName;
//        const imageURL = movie.artworkUrl100;
//    
//        swal({
//        title: "Top result:",
//        text: name,
//        icon: imageURL,
//        });
//    })
//    .catch(err => {
//        if (err) {
//        swal("Oh noes!", "The AJAX request failed!", "error");
//        } else {
//        swal.stopLoading();
//        swal.close();
//        }
//    });
//}
    });

</script>




