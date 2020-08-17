<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>District Master</h2>
                    
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>                                
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="alert alert-success removeDisplay">
               New District Added <strong>Successfully!</strong>
            </div>
            <div class="alert alert-danger removeDisplay">
                
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Add</strong> District</h2>
                        </div>
                        <div class="body">
                           <form id="form_validation" method="POST" novalidate="novalidate">
                            <div class="row clearfix">
                                <div class="col-md-6 form-group form-float">
                                    <div class="mb-3">
                                        <label>State *</label>
                                        <div class="input-group">
                                            <select class="form-control show-tick ms search-select" name="state" data-placeholder="Select" id="state">
                                                <option value=""  selected="">Select State</option>
                                            <?php foreach ($states as $key => $value) { ?>
                                                <option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
                                            <?php }?>
                                    </select>
                                            
                                        </div>
                                    </div>
                                    <label id="name-state" class="removeDisplay" for="State">This field is required.</label>
                                </div>
                                <div class="col-md-6 form-group form-float">
                                    <div class="mb-3 ">
                                        <label>District  *</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="" placeholder="Enter District" id="district">
                                            
                                            <div class="input-group-append">
                                                <span class="input-group-text"><span class="input-group-addon"> <i class="zmdi zmdi-hc-fw"></i> </span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <label id="name-district" class="removeDisplay" for="District">This field is required.</label>
                                </div>
                                <div class="col-md-12">
                                    <center>
                                        <button type="button" class="btn btn-raised btn-primary waves-effect" onclick="addDistrict()">Submit</button>
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