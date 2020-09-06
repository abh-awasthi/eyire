<!-- Main Content -->
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Create Member</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="zmdi zmdi-home"></i> Member</a></li>
                    <li class="breadcrumb-item active">Create Member</li>
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
                        <h2><strong>Create</strong>Member</h2>
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

                        <form id="wizard_with_validation" action="<?php echo base_url(); ?>member/processCreateMember" method="POST" class="wizard clearfix">
                            <h5>Form No</h5>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <label>Form No</label>
                                            <input type="text" class="form-control" placeholder="Form No" name="form_no" id="form_number"   required>                                
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <label>Date</label>
                                            <input type="text" class="form-control datepicker" placeholder="Date" name="reg_date"  id="date"  required>                                

                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <h5>Personal Info</h5>
                            <fieldset>


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <label>First Name : *</label>
                                            <input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name"   required>                                

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <label>Last Name : *</label>
                                            <input type="text" class="form-control" placeholder="Last Name" name="last_name"  id="last_name"  required>                                

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <label>Phone : *</label>
                                            <input type="number" maxlength="10" class="form-control" placeholder="Phone" name="phone"  id="phone"  required>                                

                                        </div>
                                    </div>

                                </div>	



                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <label>Email : *</label>
                                            <input type="email"   class="form-control" placeholder="Email" name="identity"  id="email"  required>                                

                                        </div>
                                    </div>								

                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <label>Gender : *</label>
                                            <select class="form-control  show-tick ms select2" name="gender" required>
                                                <option value=''>Select Role</option>				
                                                <option value='Male'>Male</option>
                                                <option value='Female'>Female</option>

                                            </select>          

                                        </div>
                                    </div>
                                </div> 


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <label>C/O :  *</label>
                                            <select class="form-control show-tick ms select2" name="gurdian_type" required>
                                                <option value=''>Select</option>				
                                                <option value='S/O'>S/O</option>
                                                <option value='D/O'>D/O</option>
                                                <option value='W/O'>W/O</option>
                                            </select> 
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="form-group form-float">
                                            <label>Father/ Huband's Name : *</label>
                                            <input type="text" class="form-control" placeholder="Father/ Huband's Name " name="gurdian"  id="gurdian"  required>                                

                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <label>Address : *</label>
                                            <input type="text" class="form-control" placeholder="Enter Address" name="address"  id="address"  required>                                         
                                        </div>
                                    </div>

                                </div>   

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <label>State : *</label>

                                            <select class="form-control show-tick ms select2" id="states" name="state" required>
                                                <option value=''>Select</option>

                                                <?php foreach ($states as $state) { ?>	
                                                    <option value='<?php echo $state['id']; ?>'><?php echo $state['name']; ?></option>
                                                <?php } ?>
                                            </select>


                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <label>District : *</label>

                                            <select class="form-control show-tick ms select2" id="district" name="district" required>
                                                <option value=''>Select</option>				

                                            </select>
                                        </div>
                                    </div>

                                </div>   


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <label>City : *</label>

                                            <input type="text" class="form-control" placeholder="Enter City" name="city"  id="city"  required>                                     

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <label>Village : *</label>
                                            <input type="text" class="form-control" placeholder="Enter Village" name="village"  id="village"  required>                                     
                                        </div>
                                    </div>

                                </div>  



                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <label>Pincode : *</label>

                                            <input type="number"  maxlength="6"   class="form-control" placeholder="Enter Pincode" name="pincode"  id="pincode"  required>                                     

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <label>Alternate Phone : *</label>
                                            <input type="text" maxlength="10" class="form-control" placeholder="Enter Alt Number" name="alt_number"  id="alt_number"  required>                                     
                                        </div>
                                    </div>

                                </div>    


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <label>ID Proof : *</label>

                                            <select class="form-control show-tick ms select2"  name="idproof" required>
                                                <option value=''>Select ID</option>				
                                                <option value="Pan Card">Pan Card</option>
                                                <option value="Passport">Passport</option>
                                                <option value="Driving Licence">Driving Licence</option>
                                                <option value="Ration Card">Ration Card</option>
                                                <option value="Voter Id">Voter Id</option>
                                                <option value="Domicile Certificate">Domicile Certificate</option>
                                                <option value="Aadhar Card">Aadhar Card</option>
                                                <option value="Others">Others</option>
                                            </select>       
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <label>ID Number : *</label>
                                            <input type="text" class="form-control" placeholder="ID Number" name="id_number"  id="id_number"  required>                                     
                                        </div>
                                    </div>

                                </div>  


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <label>Address Proof : *</label>

                                            <select class="form-control show-tick ms select2" name="address_proof" required>
                                                <option value=''>Select ID</option>	
                                                <option value="Pan Card">Pan Card</option>
                                                <option value="Passport">Passport</option>
                                                <option value="Driving Licence">Driving Licence</option>
                                                <option value="Ration Card">Ration Card</option>
                                                <option value="Voter Id">Voter Id</option>
                                                <option value="Domicile Certificate">Domicile Certificate</option>
                                                <option value="Aadhar Card">Aadhar Card</option>
                                                <option value="Others">Others</option>
                                            </select>       
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <label>ID Number : *</label>
                                            <input type="text" class="form-control" placeholder="ID Number" name="add_id_number"  id="add_id_number"  required>                                     
                                        </div>
                                    </div>

                                </div>                                        

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <label>Date Of Birth : *</label>

                                            <input type="text" class="form-control datepickerdob" placeholder="Enter DOB" name="dob"  id="dob"  required>                                     

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <label>Age : *</label>
                                            <input type="number" min ="18" max="99" class="form-control" placeholder="Enter Age" name="age"  id="age"  required>                                     
                                        </div>
                                    </div>

                                </div>                                    

                            </fieldset>

                            <h5>Nominee Info</h5>
                            <fieldset>

                                <div class="row">
                                    <div class="col-md-">
                                        <div class="form-group form-float">
                                            <label>Nominee Name  : *</label>
                                            <input type="text" class="form-control" placeholder="Enter Nominee" name="n_name"  id="n_name"  required>                                     

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <label>Relationship  : *</label>
                                            <select class="form-control show-tick ms select2" name="n_relation" required>
                                                <option value=''>Select ID</option>				
                                                <option value="FATHER">FATHER</option>
                                                <option value="MOTHER">MOTHER</option>
                                                <option value="SON">SON</option>
                                                <option value="DAUGHTER">DAUGHTER</option>
                                                <option value="BROTHER">BROTHER</option>
                                                <option value="SISTER">SISTER</option>
                                                <option value="NEPHEW">NEPHEW</option>
                                                <option value="NIECE">NIECE</option>
                                                <option value="UNCLE">UNCLE</option>
                                                <option value="ANUTHY">AUNTY</option>
                                                <option value="MOTHER IN LAW">MOTHER IN LAW</option>
                                                <option value="FATHER IN LAW">FATHER IN LAW</option>
                                                <option value="SISTER IN LAW">SISTER IN LAW</option>
                                                <option value="BROTHER IN LAW">BROTHER IN LAW</option>
                                                <option value="HUSBAND">HUSBAND</option>
                                                <option value="WIFE">WIFE</option>
                                                <option value="GRAND SON">GRAND SON</option>
                                                <option value="GRAND DAUGHTER">GRAND DAUGHTER</option>
                                                <option value="DAUGHTER IN LAW">DAUGHTER IN LAW</option>
                                                <option value="FRIEND">FRIEND</option>
                                            </select>                                      
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <label>Gender : *</label>
                                            <select class="form-control show-tick ms select2" name="n_gender" required>
                                                <option value=''>Select Role</option>				
                                                <option value='Male'>Male</option>
                                                <option value='Female'>Female</option>

                                            </select>                                      
                                        </div>
                                    </div>

                                </div> 


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <label>Nominee (D.O.B.) : *</label>

                                            <input type="text" class="form-control datepickerdob" placeholder="Enter DOB" name="ndob"  id="ndob"  required>                                     

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <label>Age  : *</label>
                                            <input type="number" min="18" max="99" class="form-control" placeholder="Enter Nominee Age" name="n_age"  id="n_age"  required>                                     
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <label>Nominee Address : *</label>
                                            <input type="text" class="form-control" placeholder="Enter Nominee Address" name="n_address"  id="n_address"  required>                                     
                                        </div>
                                    </div>

                                </div>                                     



                            </fieldset>


                            <h5>Bank Details</h5>
                            <fieldset>





                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <label>Bank Name  : *</label>
                                            <select class="form-control show-tick ms select2" name="bank_name" required>
                                                <?php foreach ($banks as $bank) { ?>

                                                    <option value="<?php echo $bank['BANK']; ?>"><?php echo $bank['BANK']; ?></option>  
                                                <?php } ?>
                                            </select>                                      
                                        </div>
                                    </div>



                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <label>Branch Name  : *</label>
                                            <input type="text" class="form-control" placeholder="Enter Branch Name" name="n_name"  id="branch_name" >                                     

                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <label>Bank IFSC : *</label>
                                            <input type="text" class="form-control" placeholder="Bank IFSC" name="ifsc"  id="ifsc" >                                                                          
                                        </div>
                                    </div>

                                </div> 

                                <div class="row">    
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <label>Account No  : *</label>
                                            <input type="number" class="form-control" placeholder="Enter Account No" name="account_no"  id="account_no" >                                     

                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <label>PAN No : *</label>
                                            <input type="text" class="form-control" placeholder="Enter PAN" name="pan_no"  id="pan_no"   >                                                                         
                                        </div>
                                    </div>

                                </div>                                    

                            </fieldset>


                            <h5>Branch Details</h5>
                            <fieldset>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <label>Branch Name  : *</label>
                                            <select class="form-control show-tick ms select2" name="branch" required>
                                                <option value=''>Select Branch</option>				

                                            </select>                                      
                                        </div>
                                    </div>



                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <label>Branch Address  : *</label>
                                            <input type="text" class="form-control" placeholder="Enter Branch Address" name="branch_address"  id="branch_address" >                                     

                                        </div>
                                    </div>



                                </div> 
                            </fieldset>


                            <h5>Payment Info</h5>
                            <fieldset>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group form-float ">
                                            <label>Member Type  : *</label>
                                            <select class="form-control show-tick ms select2" name="member_type"  >
                                                <option value='ORDINARY'>ORDINARY</option> 
                                            </select>                                      
                                        </div>
                                    </div>



                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <label>No of Share  : *</label>
                                            <input type="number" class="form-control" placeholder="Enter No of shares" name="num_share"  id="num_share" >                                     

                                        </div>
                                    </div>



                                </div> 



                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <label>Applicant Charge  : *</label>
                                            <input type="number" class="form-control" placeholder="Applicant Charge" name="applicant_charge"  id="applicant_charge" >                                     

                                        </div>
                                    </div>



                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <label>Total Payble   : *</label>
                                            <input type="number" class="form-control" placeholder="Total Payble" name="total_payable"  id="branch_address" >                                     

                                        </div>
                                    </div>



                                </div> 



                            </fieldset>
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


        $('.datepicker').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD',
            clearButton: true,
            weekStart: 1,
            time: false
        });

        $('.datepickerdob').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD',
            clearButton: true,
            weekStart: 1,
            year: true,
            time: false
        });





        $('.select2').select2();

        $("#states").change(function () {

            let state = $(this).val();

            $.ajax({
                method: 'POST',
                url: '<?php echo base_url(); ?>member/getStateDistrict/' + state,
                data: {},
                beforeSend: function () {

                    $(".page-loader-wrapper").fadeIn();

                },
                success: function (response) {

                    $("#district").append(response);

                },
                complete: function () {
                    $(".page-loader-wrapper").fadeOut();
                }
            });



        });



        $("a[href='#finish']").click(function () {

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




