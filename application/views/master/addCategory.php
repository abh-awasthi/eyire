<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Add Category</h2>

                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>                                
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="alert alert-success removeDisplay">
                New Category Added <strong>Successfully!</strong>
            </div>
            <div class="alert alert-danger removeDisplay">

            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Add New</strong> Category</h2>
                        </div>
                        <div class="body">
                            <form id="addCategoryForm" action="javascript:void(0)" method="POST" novalidate="novalidate">
                                <div class="row clearfix">
                                    
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3 ">
                                            <label>Category *</label>

                                            <input type="text" class="form-control" value="" name="category" placeholder="Enter Category" id="category" required aria-required="true">
                                        </div>
                                        <label id="error-category" class="removeDisplay" for="Category Name">This field is required.</label>
                                    </div>
                                    
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3">
                                            <label>Item Name *</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" value="" name="item_name" placeholder="Enter Item Name" id="item_name" required aria-required="true">
                                            </div>
                                        </div>
                                        <label id="error-item_name" class="removeDisplay" for="Item Name">This field is required.</label>
                                    </div>
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3">
                                            <select class="form-control show-tick ms search-select" name="account_id"  id="account_id" required aria-required="true">
                                                <option value=""  selected="">Select Account</option>
                                                <?php foreach ($account as $key => $value) { ?>
                                                    <option value="<?php echo $value['id']; ?>" data-key='<?php echo $key; ?>' ><?php echo ucwords($value['account_name']); ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <label id="error-account_id" class="removeDisplay" for="conatct no">This field is required.</label>
                                    </div>

                                    <div class="col-md-12">
                                        <center>
                                            <input type="submit" class="btn btn-raised btn-primary waves-effect" onclick="addCategory()" value="Submit">
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
</script>

<script>
    
    function addCategory(){
        var category = $("#category").val();
        var item_name = $("#item_name").val();
        var account_id = $("#account_id").val();
       
        
        if(category == ""){
            $('#error-category').removeClass('removeDisplay');
            $('#error-category').addClass('error');
            
            return false;
        }
        $('#error-category').addClass('removeDisplay');
        
        if(item_name == ""){
            $('#error-item_name').removeClass('removeDisplay');
            $('#error-item_name').addClass('error');
            
            return false;
        }
        
        $('#error-item_name').addClass('removeDisplay');
        
        if(account_id == ""){
            $('#error-account_id').removeClass('removeDisplay');
            $('#error-account_id').addClass('error');
            
            return false;
        }
        
        $('#error-account_id').addClass('removeDisplay');

        var formData = new FormData(document.getElementById("addCategoryForm"));
        formData.append("label", "WEBUPLOAD");

        var url = base_url+'master/processAddCategory';
        
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
                    document.getElementById("addCategoryForm").reset();
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