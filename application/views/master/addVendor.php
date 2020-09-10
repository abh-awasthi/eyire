<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Add Vendor</h2>

                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>                                
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="alert alert-success removeDisplay">
                New Vendor Added <strong>Successfully!</strong>
            </div>
            <div class="alert alert-danger removeDisplay">

            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Add New</strong> Vendor</h2>
                        </div>
                        <div class="body">
                            <form id="addVendorForm" action="javascript:void(0)" method="POST" novalidate="novalidate">
                                <div class="row clearfix">
                                    
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3 ">
                                            <label>Firm/Company Name *</label>

                                            <input type="text" class="form-control" value="" name="company_name" placeholder="Enter Firm/Company Name" id="company_name" required aria-required="true">
                                        </div>
                                        <label id="error-company-name" class="removeDisplay" for="Company Name">This field is required.</label>
                                    </div>
                                    
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3">
                                            <label>Owner/Director Name *</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" value="" name="owner_name" placeholder="Enter Owner/Director Name" id="owner_name" required aria-required="true">
                                            </div>
                                        </div>
                                        <label id="error-owner-name" class="removeDisplay" for="Owner Name">This field is required.</label>
                                    </div>
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3">
                                            <label>Contact No. </label>

                                            <input type="text" class="form-control" value="" name="contact_no" placeholder="Enter Contact Number" id="contact_no" >

                                        </div>
                                        <label id="error-contact-no" class="removeDisplay" for="conatct no">This field is required.</label>
                                    </div>
                                    
                                    
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3">
                                            <label>Address </label>
                                            <textarea class="form-control" name="address" placeholder="Enter Address " id="address"></textarea>
                                        </div>
                                        <label id="error-address" class="removeDisplay" for="address">This field is required.</label>
                                    </div>
                                    
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3">
                                            <label>Payee Name *</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" value="" name="payee_name" placeholder="Enter Payee Name" id="payeename" >
                                                (as on cheque)
                                            </div>
                                        </div>
                                        <label id="error-payeename" class="removeDisplay" for="payeename">This field is required.</label>
                                    </div>

                                    <div class="col-md-12">
                                        <center>
                                            <input type="submit" class="btn btn-raised btn-primary waves-effect" onclick="addVendor()" value="Submit">
                                        </center>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>
<style>
    .removeDisplay{
        display: none;
    }
</style>

<script>
    
    function addVendor(){
        var company_name = $("#company_name").val();
        var owner_name = $("#owner_name").val();
        var contact_no = $("#contact_no").val();
        var address = $("#address").val();
        var payeename = $("#payeename").val();
       
        
        if(company_name == ""){
            $('#error-company-name').removeClass('removeDisplay');
            $('#error-company-name').addClass('error');
            
            return false;
        }
        $('#error-company-name').addClass('removeDisplay');
        
        if(owner_name == ""){
            $('#error-owner-name').removeClass('removeDisplay');
            $('#error-owner-name').addClass('error');
            
            return false;
        }
        
        $('#error-owner-name').addClass('removeDisplay');
        
        if(contact_no == ""){
            $('#error-contact-no').removeClass('removeDisplay');
            $('#error-contact-no').addClass('error');
            
            return false;
        }
        
        $('#error-contact-no').addClass('removeDisplay');
        
        if(address == ""){
            $('#error-address').removeClass('removeDisplay');
            $('#error-address').addClass('error');
            
            return false;
        }
        
        $('#error-address').addClass('removeDisplay');
        
        if(payeename == ""){
            $('#error-payeename').removeClass('removeDisplay');
            $('#error-payeename').addClass('error');
            
            return false;
        }
        
        $('#error-payeename').addClass('removeDisplay');
        var formData = new FormData(document.getElementById("addVendorForm"));
        formData.append("label", "WEBUPLOAD");

        var url = base_url+'master/processAddVendor';
        
        $.ajax({
            method: 'POST',
            url: url,
            data:formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                
                $(".page-loader-wrapper").fadeIn();

            },
            success: function (response) {
                console.log(response);
                var data = jQuery.parseJSON(response);
                if (data.status) {
                    $('.alert-success').removeClass('removeDisplay');
                    $(".alert-danger").addClass("removeDisplay");
                    document.getElementById("addVendorForm").reset();
                    //location.reload();
                } else {
                    $('.alert-success').addClass('removeDisplay');
                    $(".alert-danger").html(data.message);
                    $(".alert-danger").removeClass("removeDisplay");
                }
                
            },
            complete: function () {
                $(".page-loader-wrapper").fadeOut();
            }
        });   
        
    }
</script>