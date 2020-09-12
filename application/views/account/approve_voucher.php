<link href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Approve Voucher</h2>

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
                                            <label>Voucher From Date</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker" value="" name="from_date" placeholder="Enter Date" id="from_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3">
                                            <label>Voucher To Date</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker " value="" name="to_date" placeholder="Enter Date" id="to_date">
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
                                            <th>Date</th>
                                            <th>Branch</th>
                                            <th>Voucher No</th>
                                            <th>Voucher Type</th>
                                            <th>Ledger (Dr)</th>
                                            <th>Ledger (Cr)</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                            <th>Narration</th>
                                            <th>Entry By</th>
                                            <th>Entry Time</th>
                                            <th>Approved By</th>
                                            <th>Approved Date</th>
                                            <th>Cheque No</th>
                                            <th>Transaction Date</th>
                                            <th>Transaction ID</th>
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
            pageLength: 50,
            lengthMenu: [[50, 100, 500, -1], [50, 100, 500, "All"]],
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            ajax: {
                url: base_url + "account/getVoucherDetails",
                type: "POST",
                data: {type:1}
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
    
    function approve_voucher(voucher_id){
        $.ajax({
           url:'<?php echo base_url();?>account/approvedVoucher/'+voucher_id,
           success:function(response){
              var data = jQuery.parseJSON(response);
                if (data.status) {
                    alert('Approved');
                    table.ajax.reload(null, false); 
                } else {
                    alert('Update failed');
                }
           }
        });
    }
    
    
</script>