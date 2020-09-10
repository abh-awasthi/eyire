<link href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Voucher Details</h2>

                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>                                
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <form id="addJournalVoucher" action="javascript:void(0)" method="POST" novalidate="novalidate">
                                <div class="row clearfix">
                                    
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3">
                                            <label>From Date</label>
                                            <div class="input-group">
                                                <input type="date" class="form-control datepicker" value="" name="from_date" placeholder="Enter Date" id="from_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3">
                                            <label>To Date</label>
                                            <div class="input-group">
                                                <input type="date" class="form-control datepicker " value="" name="to_date" placeholder="Enter Date" id="to_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3 ">
                                            <label>Branch *</label>

                                            <select class="form-control show-tick ms search-select" name="branch_id" data-placeholder="Select" id="branch_id" >
                                                <option value=""  selected="">Select Branch</option>
                                                <?php foreach ($branchDeatils as $key => $value) { ?>
                                                    <option value="<?php echo $value['branch_id']; ?>" data-limit ='<?php echo $value['credit_limit_amount'] ?>'><?php echo $value['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3">
                                            <label>Voucher ID</label>

                                            <input type="text" class="form-control" value="" name="voucher_id" placeholder="Enter Voucher ID " id="voucher_id" >
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3 ">
                                            <label>Received A/c</label>
                                            <select class="form-control show-tick ms search-select" name="credit_account_id"  id="received_account">
                                                <option value=""  selected="">Select Receiver Account</option>
                                                <?php foreach ($account as $key => $value) { ?>
                                                    <option value="<?php echo $value['id']; ?>" data-key='<?php echo $key; ?>' ><?php echo ucwords($value['account_name']); ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                       
                                    </div>
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3 ">
                                            <label>Payment A/c</label>
                                            <select class="form-control show-tick ms search-select" name="debit_account_id"  id="payment_account">
                                                <option value=""  selected="">Select Payment Account</option>
                                                <?php foreach ($account as $key => $value) { ?>
                                                    <option value="<?php echo $value['id']; ?>" data-key='<?php echo $key; ?>' ><?php echo ucwords($value['account_name']); ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                        
                                    </div>

                                    <div class="col-md-12">
                                        <center>
                                            <input type="submit" class="btn btn-raised btn-primary waves-effect" onclick="getVoucherDetails()" value="Submit">
                                        </center>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Voucher </strong> List </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Voucher ID</th>
                                            <th>Branch</th>
                                            <th>Debit Account</th>
                                            <th>Credit Account</th>
                                            <th>Payment Title</th>
                                            <th>Payment Amount</th>
                                            <th>Voucher Date</th>
                                            <th>Cheque Number</th>
                                            <th>Transaction ID</th>
                                            <th>Narration</th>
                                            <th>Created By</th>
                                            <th>Created Date</th>
                                            <th>Approved By</th>
                                            <th>Approved Date</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
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
	
		$('.datepicker').bootstrapMaterialDatePicker({
        format: 'DD-MM-YYYY',
        clearButton: true,
        weekStart: 1,
        time: false
    });
   

    function getVoucherDetails(){
        //Exportable table
        //var voucherlist;
        if ($.fn.DataTable.isDataTable('.js-exportable')) {
             $('.js-exportable').dataTable().fnClearTable();
              $('.js-exportable').dataTable().fnDestroy();
        }
        $('.js-exportable').DataTable({
            dom: 'lBfrtip',
            processing: true, //Feature control the processing indicator.
            serverSide: true,
            responsive:true,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            ajax: {
                url: base_url + "account/getVoucherDetails",
                type: "POST",
                data: {'from_date': $("#from_date").val(),'to_date': $('#to_date').val(), 'branch_id': $("#branch_id").val(), 'voucher_id': $('#voucher_id').val(), 
                    'credit_account_id': $('#credit_account_id').val(), 'debit_account_id': $('#debit_account_id').val(), type:2}
            },
            //Set column definition initialisation properties.
            columnDefs: [
                {
                    "targets": [0,1,2,3,4,5], //first column / numbering column
                    "orderable": false //set not orderable
                }
            ],
    //        "fnInitComplete": function (oSettings, response) {
    //
    ////            $(".dataTables_filter").addClass("pull-right");
    ////            $("#total_req_quote").html('(<i>'+response.recordsFiltered+'</i>)').css({"font-size": "14px;", "color": "red","background-color":"#fff"});
    //        }
        });
    }
    
    
</script>