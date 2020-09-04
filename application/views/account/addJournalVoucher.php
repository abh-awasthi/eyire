<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Journal Voucher</h2>

                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>                                
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="alert alert-success removeDisplay">
                New Voucher Added <strong>Successfully!</strong>
            </div>
            <div class="alert alert-danger removeDisplay">

            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Add Journal</strong> Voucher</h2>
                        </div>
                        <div class="body">
                            <form id="addJournalVoucher" action="javascript:void(0)" method="POST" novalidate="novalidate">
                                <div class="row clearfix">
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3 ">
                                            <label>Voucher Type *</label>

                                            <select class="form-control show-tick ms search-select" name="voucher_type_id" data-placeholder="Select" id="voucher_type_id" required aria-required="true">
                                                <option value=""  selected="">Select Voucher</option>
                                                <?php if (!$this->ion_auth->is_admin()){ ?>
                                                   
                                                <option value="2" selected="selected">Payment Voucher</option>
                                                <?php } else { ?>
                                                    <option value="1"  >Journal Voucher</option>
                                                    <option value="2"  >Payment Voucher</option>
                                               <?php }?>
                                                
                                                
                                            </select>
                                        </div>
                                        <label id="error-voucher_type_id" class="removeDisplay" for="Branch Name">This field is required.</label>
                                    </div>
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3 ">
                                            <label>Narration *</label>

                                            <input type="text" class="form-control" value="" name="narration" placeholder="Enter Narration" id="narration" required aria-required="true">
                                        </div>
                                        <label id="error-narration" class="removeDisplay" for="Narration">This field is required.</label>
                                    </div>
                                    
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3">
                                            <label>Voucher Date *</label>
                                            <div class="input-group">
                                                <input type="date" class="form-control" value="" name="voucher_date" min="<?php echo date('d-m-Y', strtotime('-31 days'))?>" max="<?php echo date('d-m-Y');?>" placeholder="Enter Date" id="voucher_date" required aria-required="true">
                                            </div>
                                        </div>
                                        <label id="error-voucher-date" class="removeDisplay" for="voucher date">This field is required.</label>
                                    </div>
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3">
                                            <label>Cheque No. </label>

                                            <input type="text" class="form-control" value="" name="cheque_number" placeholder="Enter Cheque Number" id="cheque_number" >

                                        </div>
                                        <label id="error-cheque_number" class="removeDisplay" for="cheque_number">This field is required.</label>
                                    </div>
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3 ">
                                            <label>Branch *</label>

                                            <select class="form-control show-tick ms search-select" name="branch_id" data-placeholder="Select" id="branch_id" required aria-required="true">
                                                <option value=""  selected="">Select Branch</option>
                                                <?php foreach ($branchDeatils as $key => $value) { ?>
                                                    <option value="<?php echo $value['branch_id']; ?>" data-limit ='<?php echo $value['credit_limit_amount'] ?>'><?php echo $value['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <label id="error-branch" class="removeDisplay" for="Branch Name">This field is required.</label>
                                    </div>
                                    
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3">
                                            <label>Transaction ID</label>

                                            <input type="text" class="form-control" value="" name="transaction_id" placeholder="Enter Transaction ID " id="transaction_id" >


                                        </div>
                                        <label id="error-transaction_id" class="removeDisplay" for="transaction_id">This field is required.</label>
                                    </div>

                                    


                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3 ">
                                            <label>Debit Entry *</label>
                                            <select class="form-control show-tick ms search-select" onclick="credit_entry()" name="debit_account_id"  id="debit_account_id" required aria-required="true">
                                                <option value=""  selected="">Select Debit</option>
                                                <?php foreach ($account as $key => $value) { ?>
                                                    <option value="<?php echo $value['id']; ?>" data-key='<?php echo $key; ?>' ><?php echo ucwords($value['account_name']); ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                        <label id="error-debit_account_id" class="removeDisplay" for="debit_account_id">This field is required.</label>
                                    </div>
                                    
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3">
                                            <label>Transaction Date</label>
                                            <div class="input-group">
                                                <input type="date" class="form-control" value="" name="transaction_date" min="<?php echo date('d-m-Y', strtotime('-31 days'))?>" max="<?php echo date('d-m-Y');?>" placeholder="Enter Date" id="transaction_date" >
                                            </div>
                                        </div>
                                        <label id="error-transaction-date" class="removeDisplay" for="voucher date">This field is required.</label>
                                    </div>
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3 ">
                                            <label>Credit Entry *</label>
                                            <select class="form-control show-tick ms search-select" name="credit_account_id" placeholder="Enter Credit Account" id="credit_account_id" required aria-required="true">
                                                <option value=""  selected="">Select Credit Entry</option>
                                            </select>


                                        </div>
                                        <label id="name-credit-account_id" class="removeDisplay" for="District">This field is required.</label>
                                    </div>

                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3">
                                            <label>Amount Transfer *</label>

                                            <input type="number" min="0" step="1"  class="form-control" value="" name="amount" placeholder="Enter Balance Amount" id="amount" required aria-required="true">


                                        </div>
                                        <label id="error-amount" class="removeDisplay" for="District">This field is required.</label>
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

    function credit_entry() {
        var key = $('#debit_account_id').find(':selected').attr('data-key');
        var array = JSON.parse('<?php echo json_encode($account, true); ?>');
        delete array[key];
        var html = '<option value=""  selected="">Select Credit Entry</option>';
        array.forEach((item, index) => {
            html += '<option value="' + index + '" >' + item.account_name + '</option>';
        });

        $("#credit_account_id").html(html).change();


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