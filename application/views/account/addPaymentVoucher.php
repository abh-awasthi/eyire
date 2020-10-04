<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Payment Voucher</h2>
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
            <form id="addJournalVoucher" action="javascript:void(0)" method="POST" novalidate="novalidate">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Voucher</strong> Details</h2>
                            </div>
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-md-6 form-group form-float" style="display:none;">
                                        <div class="mb-3 ">
                                            <label>Voucher Type *</label>
                                            <select class="form-control show-tick ms search-select" name="voucher_type_id" data-placeholder="Select" id="voucher_type_id" required aria-required="true">
                                                <option value=""  selected="">Select Voucher</option>
                                                <option value="2" selected="selected">Payment Voucher</option>
                                            </select>
                                        </div>
                                        <label id="error-voucher_type_id" class="removeDisplay" for="Branch Name">This field is required.</label>
                                    </div>
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3">
                                            <label>Voucher Date *</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker" value="" name="voucher_date" min="<?php echo date('d-m-Y', strtotime('-31 days'))?>" max="<?php echo date('d-m-Y');?>" placeholder="Enter Date" id="voucher_date" required aria-required="true">
                                            </div>
                                        </div>
                                        <label id="error-voucher-date" class="removeDisplay" for="voucher date">This field is required.</label>
                                    </div>
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3 ">
                                            <label>Branch *</label>
                                            <select class="form-control show-tick ms search-select" name="branch_id" data-placeholder="Select" id="branch_id" onchange="credit_entry()" required aria-required="true">
                                                <option value=""  selected="">Select Branch</option>
                                                <?php foreach ($branchDeatils as $key => $value) { ?>
                                                <option value="<?php echo $value['branch_id']; ?>" data-limit ='<?php echo $value['credit_limit_amount'] ?>'><?php echo $value['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <label id="error-branch" class="removeDisplay" for="Branch Name">This field is required.</label>
                                    </div>
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3 ">
                                            <label>Debit Entry *</label>
                                            <select class="form-control show-tick ms search-select"  name="debit_account_id"  id="debit_account_id" required aria-required="true">
                                                <option value=""  selected="">Select Debit</option>
                                                <?php foreach ($account as $key => $value) { if(empty($value['account_type'])){ ?>
                                                <option value="<?php echo $value['id']; ?>" data-key='<?php echo $key; ?>' ><?php echo ucwords($value['account_name']); ?></option>
                                                <?php } } ?>
                                            </select>
                                        </div>
                                        <label id="error-debit_account_id" class="removeDisplay" for="debit_account_id">This field is required.</label>
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
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3 ">
                                            <label>Narration *</label>
                                            <input type="text" class="form-control" value="" name="narration" placeholder="Enter Narration" id="narration" required aria-required="true">
                                        </div>
                                        <label id="error-narration" class="removeDisplay" for="Narration">This field is required.</label>
                                    </div>
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3 ">
                                            <label>Payment Mode *</label><br/>
                                            <label class="radio-inline">
                                            <input type="radio" name="paymentmode" value="1" checked onchange="displayTransaction()"> &nbsp;&nbsp;Cash&nbsp;
                                            </label>
                                            <label class="radio-inline">
                                            <input type="radio" name="paymentmode" value="2" onchange="displayTransaction()"> &nbsp;&nbsp;Cheque&nbsp;
                                            </label>
                                            <label class="radio-inline">
                                            <input type="radio" name="paymentmode" value="3" onchange="displayTransaction()"> &nbsp;&nbsp;NEFT/ RTGS/ IMPS&nbsp;&nbsp;
                                            </label>
                                            <label class="radio-inline">
                                            <input type="radio" name="paymentmode" value="4" onchange="displayTransaction()"> &nbsp;&nbsp;UPI&nbsp;&nbsp;
                                            </label>
                                            <label class="radio-inline">
                                            <input type="radio" name="paymentmode" value="5" onchange="displayTransaction()"> &nbsp;&nbsp;Others&nbsp;&nbsp;
                                            </label>
                                        </div>
                                        <label id="error-payment_mode" class="removeDisplay" for="Narration">This field is required.</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Transactional</strong> Details</h2>
                            </div>
                            <div class="body">
                                <div id="chequeDetails">
                                    <div class="row clearfix">
                                        <div class="col-md-6 form-group form-float">
                                            <div class="mb-3">
                                                <label>Cheque No. </label>
                                                <input type="number" class="form-control" value="" name="cheque_number" placeholder="Enter Cheque Number" id="cheque_number" >
                                            </div>
                                            <label id="error-cheque_number" class="removeDisplay" for="cheque_number">This field is required.</label>
                                        </div>
                                        <div class="col-md-6 form-group form-float">
                                            <div class="mb-3">
                                                <label>Cheque Date</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control datepicker" value="" name="cheque_date" placeholder="Enter Date" id="cheque_date" >
                                                </div>
                                            </div>
                                            <label id="error-cheque_date" class="removeDisplay" for="voucher date">This field is required.</label>
                                        </div>
                                        <div class="col-md-6 form-group form-float">
                                            <div class="mb-3">
                                                <label>Bank Name</label>
                                                <div class="input-group">
                                                   <select class="form-control show-tick ms search-select" name="bank_id" placeholder="Select Bank Name" id="bank_id" required aria-required="true">
                                                        <option value="0"  selected="">Select Bank Name</option>
                                                        <?php foreach ($bank_name as  $value) { ?>
                                                        <option value="<?php echo $value['id'];?>"><?php echo $value['bank_name'];?></option>
                                                        <?php } ?>
                                                  </select>
                                                    
                                                </div>
                                            </div>
                                            <label id="error-bank_name" class="removeDisplay" for="BankName">This field is required.</label>
                                        </div>
                                        
                                        <div class="col-md-6 form-group form-float">
                                            <div class="mb-3">
                                                <label>Received By</label>
                                                <div class="input-group">
                                                   <select class="form-control show-tick ms search-select" name="received_by" placeholder="Select Users Name" id="received_by" required aria-required="true">
                                                        <option value="0"  selected="">Select Received By</option>
                                                        <?php foreach ($users as  $value) { ?>
                                                        <option value="<?php echo $value['id'];?>"><?php echo $value['first_name']. " ".$value['last_name'];?></option>
                                                        <?php } ?>
                                                  </select>
                                                    
                                                </div>
                                            </div>
                                            <label id="error-received_by" class="removeDisplay" for="BankName">This field is required.</label>
                                        </div>
                                        <div class="col-md-12 form-group form-float">
                                            <div class="mb-3">
                                                <label>Amount In Words</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control display_in_words" value="" name="display_in_words" id="display_in_words" readonly="">
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                                <div id="online" class="removeDisplay">
                                    <div class="row clearfix">
                                        <div class="col-md-6 form-group form-float">
                                            <div class="mb-3">
                                                <label>Transaction ID</label>
                                                <input type="text" class="form-control" value="" name="transaction_id" placeholder="Enter Transaction ID " id="transaction_id" >
                                            </div>
                                            <label id="error-transaction_id" class="removeDisplay" for="transaction_id">This field is required.</label>
                                        </div>
                                        <div class="col-md-6 form-group form-float">
                                            <div class="mb-3">
                                                <label>Transaction Date</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control datepicker" value="" name="transaction_date" min="<?php echo date('d-m-Y', strtotime('-31 days'))?>" max="<?php echo date('d-m-Y');?>" placeholder="Enter Date" id="transaction_date" >
                                                </div>
                                            </div>
                                            <label id="error-transaction-date" class="removeDisplay" for="voucher date">This field is required.</label>
                                        </div>
                                        <div class="col-md-12 form-group form-float">
                                            <div class="mb-3">
                                                <label>Amount In Words</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control display_in_words" value="" name="display_in_words" id="display_in_words" readonly="">
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="cash" class="removeDisplay">
                                    <div class="row clearfix">
                                        <div class="col-md-6 form-group form-float">
                                            <div class="mb-3">
                                                <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Value</th>
                                            <th>No. of Note</th>
                                            <th></th>
                                            <th>Rupees</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">2000 * </th>
                                            <td><input type="number" class="form-control" onblur="ruppes_set(this.id, 2000)" style="width: 100px;" name="two_thousand" id="two_thousand"></td>
                                            <td>=</td>
                                            <td id="two_thousand_text"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">500 * </th>
                                            <td><input type="number" class="form-control" style="width: 100px;" onblur="ruppes_set(this.id, 500)" name="five_hundred" id="five_hundred"></td>
                                            <td>=</td>
                                            <td id="five_hundred_text"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">200 * </th>
                                            <td><input type="number" class="form-control" style="width: 100px;" onblur="ruppes_set(this.id, 200)" name="two_hundred" id="two_hundred"></td>
                                            <td>=</td>
                                            <td id="two_hundred_text"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">100 * </th>
                                            <td><input type="number" class="form-control" style="width: 100px;" onblur="ruppes_set(this.id, 100)" name="one_hundred" id="one_hundred"></td>
                                            <td>=</td>
                                            <td id="one_hundred_text"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">50 * </th>
                                            <td><input type="number" class="form-control" style="width: 100px;" onblur="ruppes_set(this.id, 30)" name="fifty" id="fifty"></td>
                                            <td>=</td>
                                            <td id="fifty_text"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">20 * </th>
                                            <td ><input type="number" class="form-control" style="width: 100px;" name="twenty" onblur="ruppes_set(this.id, 20)" id="twenty"></td>
                                            <td>=</td>
                                            <td id="twenty_text"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">10 * </th>
                                            <td><input type="number" class="form-control" style="width: 100px;" onblur="ruppes_set(this.id, 10)" name="ten" id="ten"></td>
                                            <td>=</td>
                                            <td id="ten_text"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">5 * </th>
                                            <td><input type="number" class="form-control" style="width: 100px;" name="five" onblur="ruppes_set(this.id, 5)" id="five"></td>
                                            <td>=</td>
                                            <td id="five_text"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2 * </th>
                                            <td><input type="number" class="form-control" style="width: 100px;" name="two" id="two" onblur="ruppes_set(this.id, 2)"></td>
                                            <td>=</td>
                                            <td  id="two_text"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">1 * </th>
                                            <td><input type="number" class="form-control" style="width: 100px;" name="one" id="one" onblur="ruppes_set(this.id, 1)"></td>
                                            <td>=</td>
                                            <td id="one_text"></td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td></td>
                                            <td></td>
                                            <td id="total_amount"></td>
                                            
                                        </tr>
                                        <tr>
                                            <th colspan="4" id="total_in_words"></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                                            </div>
                                            <label id="error-cash" class="removeDisplay" for="transaction_id">Amount Transfered is not with total match.</label>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="body">
                                <div class="col-md-12">
                                    <center>
                                        <input type="submit" class="btn btn-raised btn-primary waves-effect" onclick="addJournalVoucher()" value="Submit">
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
            
            //var key = $('#debit_account_id').find(':selected').attr('data-key');
            var branch_id = $("#branch_id").val();
            var array = JSON.parse('<?php echo json_encode($account, true); ?>');
            //delete array[key];
            var html = '<option value=""  selected="">Select Credit Entry</option>';
            array.forEach((item, index) => {
                
                if((item.branch_id == branch_id) && (Number(item.account_type) == 1 || Number(item.account_type) == 2)){
                    html += '<option value="' + item.id + '" >' + item.account_name + '</option>';
                }
                
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
            var cheque_date = $("#cheque_date").val();
            var transaction_id =$("#transaction_id").val();
            var amount =$("#amount").val();
            var limit = $('#branch_id').find(':selected').attr('data-limit');
            var paymentmode = $("[name='paymentmode']:checked").val();
            var transaction_date = $('#transaction_date').val();
            
            //alert(voucher_date);
            var dateMomentObject = moment(voucher_date, "DD/MM/YYYY"); // 1st argument - string, 2nd argument - format
            var dateObject = dateMomentObject.toDate(); // convert moment.js object to Date object



            const date1 = new Date(dateObject.toString());
            const date2 = new Date();
            
            //console.log(date2);
            const diffTime = date2 - date1;
            const diffDays = (diffTime / (1000 * 60 * 60 * 24)); 
            
            if(voucher_type_id == ""){
                $('#error-voucher_type_id').removeClass('removeDisplay');
                $('#error-voucher_type_id').addClass('error');
                
                return false;
            }
            $('#error-voucher_type_id').addClass('removeDisplay');
           // console.log(diffDays);
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
            
            if(paymentmode == 2){
                if(cheque_number === ""){
                    $('#error-cheque_number').removeClass('removeDisplay');
                    $('#error-cheque_number').addClass('error');
                    return false;
                   
                }
                if(cheque_date === ""){
                    $('#error-cheque_date').removeClass('removeDisplay');
                    $('#error-cheque_date').addClass('error');
                    return false;
                }
                
                var bank_name = $('#bank_id').val();
                var received_by = $("#received_by").val();
                if(bank_name ==""){
                    $('#error-bank_name').removeClass('removeDisplay');
                    $('#error-bank_name').addClass('error');
                    return false;
                }
                
                if(received_by ==""){
                    $('#error-received_by').removeClass('removeDisplay');
                    $('#error-received_by').addClass('error');
                    return false;
                }
                
                $('#transaction_date').val('');
                $('#transaction_id').val('');
                
            } if(paymentmode == 1){
                var total_amount = $('#total_amount').text();
                if(Number(amount) === Number(total_amount)){
                    
                } else {
                    $('#error-cash').removeClass('removeDisplay');
                    $('#error-cash').addClass('error');
                    return false;
                    
                }
                $('#transaction_date').val('');
                $('#transaction_id').val('');
                $('#cheque_number').val('');
                $('#cheque_date').val('');
            }else {
                $('#cheque_number').val('');
                $('#cheque_date').val('');
                if(transaction_id === ""){
                    $('#error-transaction_id').removeClass('removeDisplay');
                    $('#error-transaction_id').addClass('error');
                    return false;
                }
                
                if(transaction_date == ""){
                    $("#error-transaction-date").removeClass('removeDisplay');
                    $('#error-transaction-date').addClass('error');
                    return false;
                }
            }
            
            $('#error-cheque_number').addClass('removeDisplay');
            $('#error-transaction_id').addClass('removeDisplay');
            $('#error-transaction-date').addClass('removeDisplay');
            
            if(Number(amount) > Number(limit)){
                $('#error-amount').html("Amount should be less than Branch limit (" +limit + ") ");
                return false;
            }
            $('#error-amount').addClass('removeDisplay');
            
            var formData = new FormData(document.getElementById("addJournalVoucher"));
            formData.append("label", "WEBUPLOAD");
    
            var url = base_url+'account/processAddJournalVoucher';
            if (window.confirm("Are You Sure? ")) {
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
            
        }
        
        $('.datepicker').bootstrapMaterialDatePicker({
            format: 'DD-MM-YYYY',
            clearButton: true,
            weekStart: 1,
            time: false
        });
        $('#voucher_date').val('<?php echo date('d-m-Y'); ?>');
         displayTransaction();
         function displayTransaction(){
            var paymentmode = $("[name='paymentmode']:checked").val();
            if(paymentmode == 2){
                $("#online").addClass("removeDisplay");
                $("#cash").addClass("removeDisplay");
                $("#chequeDetails").removeClass("removeDisplay");
                
            } else if(paymentmode == 1){
                $("#online").addClass("removeDisplay");
                $("#cash").removeClass("removeDisplay");
                $("#chequeDetails").addClass("removeDisplay");
            }else {
                $("#chequeDetails").addClass("removeDisplay");
                $("#online").removeClass("removeDisplay");
                $("#cash").addClass("removeDisplay");
            }
         }
         
         
     function displayInWords(){
        var number = $('#amount').val();
        $.ajax({
           url:'<?php echo base_url();?>account/displaywords/'+number,
           success:function(response){
              $('.display_in_words').val(response);
                
           }
        });
        
    }
    
    function ruppes_set(id, note){
       var number = $("#"+id).val();
       var amount = Number(number) * Number(note);
       $("#"+id+"_text").text(amount);
       var total_amount = get_total_amount();
       $("#total_amount").text(total_amount);
       $.ajax({
           url:'<?php echo base_url();?>account/displaywords/'+total_amount,
           success:function(response){
              $('#total_in_words').text(response);
                
           }
        });
    }
    
    function get_total_amount(){
        return ((Number($("#two_thousand").val()) * 2000) + (Number($("#five_hundred").val()) * 500) +(Number($("#one_hundred").val()) * 100) + (Number($("#two_hundred").val()) * 200) 
                + (Number($("#fifty").val()) * 50) + (Number($("#twenty").val()) * 20) + (Number($("#ten").val()) * 10) + (Number($("#five").val()) * 5) + (Number($("#two").val()) * 2) 
                + (Number($("#one").val()) * 1));
        
    }
</script>