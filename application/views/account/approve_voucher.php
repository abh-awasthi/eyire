<link href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Un-Approved Voucher</h2>

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
                                            <th>Action</th>
                                            
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
   
//getVoucherDetails();
    //function getVoucherDetails(){
        //Exportable table
        //var voucherlist;
//        if ($.fn.DataTable.isDataTable('.js-exportable')) {
//             $('.js-exportable').dataTable().fnClearTable();
//              $('.js-exportable').dataTable().fnDestroy();
//        }
        var table = $('.js-exportable').DataTable({
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
   // }
   
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
