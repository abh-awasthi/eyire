<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Stock Received</h2>

                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>                                
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="alert alert-success removeDisplay">
                New Stock Updated <strong>Successfully!</strong>
            </div>
            <div class="alert alert-danger removeDisplay">

            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Update Stock</strong> Received</h2>
                        </div>
                        <div class="body">
                            <form id="addJournalVoucher" action="javascript:void(0)" method="POST" novalidate="novalidate">
                                <div class="row clearfix">
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3 ">
                                            <label>Category *</label>

                                            <select class="form-control show-tick ms search-select" name="category" onchange="getCategoryItem()" data-placeholder="Select" id="category" required aria-required="true">
                                                <option value=""  selected="">Select Category</option>
                                                <?php foreach ($category as $value) { ?>
                                                    <option value="<?php echo $value['category_name'];?>"  ><?php echo $value['category_name'];?></option>
                                              <?php  }?>
 
                                            </select>
                                        </div>
                                        <label id="error-category" class="removeDisplay" for="Branch Name">This field is required.</label>
                                    </div>
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3 ">
                                            <label>Item Name *</label>

                                            <select class="form-control show-tick ms search-select" name="item_name" data-placeholder="Select" id="item_name" required aria-required="true">
                                                
                                            </select>
                                        </div>
                                        <label id="error-item_name" class="removeDisplay" for="Narration">This field is required.</label>
                                    </div>
                                    
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3">
                                            <label>Stock Location *</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" value="" name="stock_location" placeholder="Enter Date" id="stock_location" required aria-required="true">
                                            </div>
                                        </div>
                                        <label id="error-stock_location" class="removeDisplay" for="voucher date">This field is required.</label>
                                    </div>
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3">
                                            <label>Rate * </label>

                                            <input type="number" step="1" class="form-control" value="" name="rate" placeholder="Enter Cheque Number" id="rate" >

                                        </div>
                                        <label id="error-rate" class="removeDisplay" for="cheque_number">This field is required.</label>
                                    </div>
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3">
                                            <label>Quantity *</label>

                                            <input type="number" class="form-control" value="" name="quantity" placeholder="Enter Quantity" id="quantity" >

                                        </div>
                                        <label id="error-quantity" class="removeDisplay" for="cheque_number">This field is required.</label>
                                    </div>
                                    
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3">
                                            <label>Amount *</label>

                                            <input type="number" step="1" class="form-control" value="" name="amount" placeholder="Enter Amount" id="amount" >

                                        </div>
                                        <label id="error-amount" class="removeDisplay" for="cheque_number">This field is required.</label>
                                    </div>
                                    <div class="col-md-12 form-group form-float">
                                        <div class="mb-3">
                                            <label>Description *</label>

                                            <textarea rows="3" class="form-control no-resize" name="description" placeholder="Enter Description" required aria-required="true"></textarea>


                                        </div>
                                        <label id="name-branch-address" class="removeDisplay" for="District">This field is required.</label>
                                    </div>

                                    <div class="col-md-12">
                                        <center>
                                            <input type="submit" class="btn btn-raised btn-primary waves-effect" onclick="addJournalVoucher()" value="Submit">
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
$(function () {
    $(".search-select").select2({
        allowClear: true
    });
    
});

    function getCategoryItem(){
        var category = $('#category').val();
        var url = base_url+'master/getCategoryItem';
        $.ajax({
            method: 'POST',
            url: url,
            data:{category: category},
            contentType: false,
            processData: false,
            beforeSend: function () {
                
                $(".page-loader-wrapper").fadeIn();

            },
            success: function (response) {
                console.log(response);
                $("#item_name").html(response).change();
               // var data = jQuery.parseJSON(response);
//                if (data.status) {
//                    $('.alert-success').removeClass('removeDisplay');
//                    $(".alert-danger").addClass("removeDisplay");
//                    document.getElementById("addJournalVoucher").reset();
//                    //location.reload();
//                } else {
//                    $('.alert-success').addClass('removeDisplay');
//                    $(".alert-danger").html(data.message);
//                    $(".alert-danger").removeClass("removeDisplay");
//                }
                
            },
            complete: function () {
                $(".page-loader-wrapper").fadeOut();
            }
        });  
    }

    
    function addJournalVoucher(){
        var voucher_type_id = $("#voucher_type_id").val();
        var voucher_date = $("#voucher_date").val();
        var branch_id = $("#branch_id").val();
        var debit_account_id = $("#debit_account_id").val();
        var credit_account_id = $("#credit_account_id").val();
        var narration = $("#narration").val();
        var cheque_number = $("#cheque_number").val();
        var transaction_id =$("#transaction_id").val();
        var amount =$("#amount").val();
        var limit = $('#branch_id').find(':selected').attr('data-limit');
        
        //alert(voucher_date);
        const date1 = new Date(voucher_date);
        const date2 = new Date();
        const diffTime = date2 - date1;
        const diffDays = (diffTime / (1000 * 60 * 60 * 24)); 
        
        if(voucher_type_id == ""){
            $('#error-voucher_type_id').removeClass('removeDisplay');
            $('#error-voucher_type_id').addClass('error');
            
            return false;
        }
        $('#error-voucher_type_id').addClass('removeDisplay');
        if(diffDays > 31){
            $('#error-voucher-date').removeClass('removeDisplay');
            $('#error-voucher-date').addClass('error');
            $('#error-voucher-date').html('Voucher Date should not be 31 days back');
            return false;
            
        } else if(diffDays < 0){
            $('#error-voucher-date').removeClass('removeDisplay');
            $('#error-voucher-date').addClass('error');
            $('#error-voucher-date').html('Voucher Date should not be future');
            return false;
        }
        $('#error-voucher-date').addClass('removeDisplay');
        
        if(branch_id == ""){
            $('#error-branch').removeClass('removeDisplay');
            $('#error-branch').addClass('error');
            
            return false;
        }
        
        $('#error-branch').addClass('removeDisplay');
        
        if(debit_account_id == ""){
            $('#error-debit_account_id').removeClass('removeDisplay');
            $('#error-debit_account_id').addClass('error');
            
            return false;
        }
        
        $('#error-debit_account_id').addClass('removeDisplay');
        
        if(credit_account_id == ""){
            $('#error-credit_account_id').removeClass('removeDisplay');
            $('#error-credit_account_id').addClass('error');
            
            return false;
        }
        
        $('#error-credit_account_id').addClass('removeDisplay');
        
        if(narration == ""){
            $('#error-narration').removeClass('removeDisplay');
            $('#error-narration').addClass('error');
            
            return false;
        }
        
        $('#error-narration').addClass('removeDisplay');
        
        if(cheque_number === "" && transaction_id === ""){
            $('#error-cheque_number').removeClass('removeDisplay');
            $('#error-cheque_number').addClass('error');
            
            $('#error-transaction_id').removeClass('removeDisplay');
            $('#error-transaction_id').addClass('error');
            
            $('#error-cheque_number').html("Plesse add either Cheque no or Transaction ID");
            $('#error-transaction_id').html("Plesse add either Cheque no or Transaction ID");
            
            return false;
        }
        
        $('#error-cheque_number').addClass('removeDisplay');
        
        if(Number(amount) > Number(limit)){
            $('#error-amount').html("Amount should be less than Branch limit (" +limit + ") ");
            return false;
        }
        $('#error-amount').addClass('removeDisplay');
        
        var formData = new FormData(document.getElementById("addJournalVoucher"));
        formData.append("label", "WEBUPLOAD");

        var url = base_url+'account/processAddJournalVoucher';
        
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
                    document.getElementById("addJournalVoucher").reset();
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