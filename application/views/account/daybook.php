<!-- bootstrap-daterangepicker -->
        <link href="<?php echo base_url();?>assets/css/daterangepicker.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
<!-- bootstrap-daterangepicker -->
        <script src="<?php echo base_url();?>assets/js/moment.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/daterangepicker.js"></script>
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Day Book</h2>

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
                                            <label>Voucher Date</label>
                                            <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                                <i class="fa fa-calendar"></i>&nbsp;
                                                <span></span> <i class="fa fa-caret-down"></i>
                                            </div>
                                            <input type="hidden" class="form-control" value="<?php echo date('Y-m-d');?>" name="from_date" placeholder="Enter Date" id="from_date">
                                            <input type="hidden" class="form-control" value="<?php echo date('Y-m-d');?>" name="to_date" placeholder="Enter Date" id="to_date">
<!--                                            <div class="input-group">
                                                
                                            </div>-->
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
	
//    $('.datepicker').bootstrapMaterialDatePicker({
//        format: 'DD-MM-YYYY',
//        clearButton: true,
//        weekStart: 1,
//        time: false
//    });
   
   

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
                data: {'from_date': $("#from_date").val(),'to_date': $('#to_date').val(), 'branch_id': $("#branch_id").val(),type:2}
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
<script type="text/javascript">
$(function() {

    var start = moment().subtract(0, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        $('#from_date').val(start.format('MMMM D, YYYY'));
        $('#to_date').val(end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

});
</script>
