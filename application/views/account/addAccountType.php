<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Chart Of Account</h2>
                    
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>                                
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="alert alert-success removeDisplay">
               New Ledger Account added <strong>Successfully!</strong>
            </div>
            <div class="alert alert-danger removeDisplay">
                
            </div>
            <div class="row clearfix">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="card">
                        <div class="body">
                            <div id="treeview1" >
                                
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <div class="card">
<!--                        <div class="header">
                            <h2><strong>Add </strong> Account Type</h2>
                        </div>-->
                        <div class="body">
                           <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Add Ledger</strong> Account</h2>
                            <ul class="header-dropdown">
                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="javascript:void(0);">Edit</a></li>
                                        <li><a href="javascript:void(0);">Activate</a></li>
                                        <li><a href="javascript:void(0);">Deactivate</a></li>
                                    </ul>
                                </li>
                                <li class="remove">
                                    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <form class="form-horizontal" action="javascript:void()" id="treeview_account">
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-4 form-control-label">
                                        <label for="ledger Account">General Ledger A/C No.</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                        <div class="form-group">
                                            <select name ="parent_id" class="form-control show-tick ms search-select" data-placeholder="Select Parent Account" id="parent_id">
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-4 form-control-label">
                                        <label for="Sub Ledger">Sub Ledger A/C No</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                        <div class="form-group">
                                            <input type="text" name="account_no"  id="account_no"class="form-control" placeholder="Sub Ledger A/C No">
                                        </div>
                                        <label id="name-account-no" class="removeDisplay" for="Account">This field is required.</label>
                                    </div>
                                    
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-4 form-control-label">
                                        <label for="Sub ledger A/c">Sub Ledger A/C Name</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                        <div class="form-group">
                                            <input type="text" name="account_name" id="account_name" class="form-control" placeholder="Sub Ledger A/C Name">
                                        </div>
                                        <label id="name-account-name" class="removeDisplay" for="Account">This field is required.</label>
                                    </div>
                                </div>

                                  <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-4 form-control-label">
                                        <input type="submit" value="Submit" class="btn btn-primary btn-lg">
                                    </div>
                                    
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
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
<style>/* Remove default bullets */
ul, #myUL {
  list-style-type: none;
}

/* Remove margins and padding from the parent ul */
#myUL {
  margin: 0;
  padding: 0;
}

#myUL li{
    margin-bottom: 11px;
}

#myUL li ul{
    margin-top: 11px;
}

/* Style the caret/arrow */
.caret {
  cursor: pointer;
  user-select: none; /* Prevent text selection */
}

/* Create the caret/arrow with a unicode, and style it */
.caret::before {
  content: "\25B6";
  color: black;
  display: inline-block;
  margin-right: 6px;
}

/* Rotate the caret/arrow icon when clicked on (using JavaScript) */
.caret-down::before {
  transform: rotate(90deg);
}

/* Hide the nested list */
.nested {
  display: none;
}

/* Show the nested list when the user clicks on the caret/arrow (with JavaScript) */
.active {
  display: block;
}</style>
<script>
 


$(document).ready(function (){
    fill_parent_category();
    fill_treeview();
    
    function treeViewJS(){
        var toggler = document.getElementsByClassName("caret");
        var i;

        for (i = 0; i < toggler.length; i++) {
          toggler[i].addEventListener("click", function() {
            this.parentElement.querySelector(".nested").classList.toggle("active");
            this.classList.toggle("caret-down");
          });
        }
    }
    function fill_treeview(){
       
        $.ajax({
           url:'<?php echo base_url();?>account/getTreeviewAccount',
           success:function(data){
               $("#treeview1").html(data);
               treeViewJS();
              
           }
        });
    }
    function fill_parent_category(){
        $.ajax({
           url:'<?php echo base_url();?>account/getAccountOption',
           success:function(data){
               $('#parent_id').html(data).change();
           }
        });
    }
    
    $("#treeview_account").on('submit', function(event){
          event.preventDefault();
          var sub_account_no = $("#account_no").val();
          var sub_account_name = $("#account_name").val();
          if(sub_account_no === ""){
              $("#name-account-no").addClass("error");
              $("#name-account-no").removeClass('removeDisplay');

              return false;
          } else if(sub_account_name ==""){
              $("#name-account-name").addClass("error");
              $("#name-account-name").removeClass('removeDisplay');
              return false

          }
          $.ajax({
              url:'<?php echo base_url();?>account/processAddAccount',
              method:"POST",
              beforeSend: function () {
                
                $(".page-loader-wrapper").fadeIn();

            },
              data:$(this).serialize(),
              success:function(response){
                   console.log(response);
                var data = jQuery.parseJSON(response);
                if (data.status) {
                    fill_parent_category();
                    fill_treeview();
                    $( '#treeview_form' ).each(function(){
                      this.reset();
                    });
                    $('.alert-success').removeClass('removeDisplay');
                    $(".alert-danger").addClass("removeDisplay");
                    //location.reload();
                } else {
                    $('.alert-success').addClass('removeDisplay');
                    $(".alert-danger").html(data.message);
                    $(".alert-danger").removeClass("removeDisplay");
                }
                  
//                  $('#treeview_form')[0].reset();
              },
              complete: function () {
                $(".page-loader-wrapper").fadeOut();
              }
          });
    });
    
});
</script>