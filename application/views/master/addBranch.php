<script src="<?php echo base_url(); ?>assets/js/pages/forms/advanced-form-elements.js"></script> 
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Branch Master</h2>

                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>                                
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="alert alert-success removeDisplay">
                New Branch Added <strong>Successfully!</strong>
            </div>
            <div class="alert alert-danger removeDisplay">

            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Branch</strong> Entry</h2>
                        </div>
                        <div class="body">
                            <form id="addbranch" action="javascript:void(0)" method="POST" novalidate="novalidate">
                                <div class="row clearfix">
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3">
                                            <label>District *</label>
                                            <div class="input-group">
                                                <select class="form-control show-tick ms search-select" name="district" data-placeholder="Select" id="district" required aria-required="true">
                                                    <option value=""  selected="">Select District</option>
                                                    <?php foreach ($district as $key => $value) { ?>
                                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['district']; ?></option>
                                                    <?php } ?>
                                                </select>

                                            </div>
                                        </div>
                                        <label id="name-district" class="removeDisplay" for="District">This field is required.</label>
                                    </div>
                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3 ">
                                            <label>Branch Name *</label>

                                            <input type="text" class="form-control" value="" name="branch_name" placeholder="Enter Branch Name" id="branch_name" required aria-required="true">

                                        </div>
                                        <label id="name-branch-name" class="removeDisplay" for="Branch Name">This field is required.</label>
                                    </div>

                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3 ">
                                            <label>Contact Person *</label>
                                            <select class="form-control show-tick ms search-select" name="contact_person" placeholder="Enter Contact Person" id="contact_person" required aria-required="true">
                                                <option value=""  selected="">Select Contact Person</option>
                                                <?php foreach ($agent as $key => $value) { ?>
                                                    <option value="<?php echo $value['id']; ?>"><?php echo ucwords($value['first_name'] . " " . $value['last_name']); ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                        <label id="name-contact-person" class="removeDisplay" for="Contact Person">This field is required.</label>
                                    </div>

                                    <div class="col-md-6 form-group form-float">
                                        <div class="mb-3 ">
                                            <label>Credit Limit Amount  *</label>

                                            <input type="number" min="0" step="1" class="form-control" value="" name="credit_limit_amount" placeholder="Enter Credit Limit Amount" id="credit_limit_amount" required aria-required="true">
                                        </div>
                                        <label id="name-credit-limit-amount" class="removeDisplay" for="District">This field is required.</label>
                                    </div>

                                    <div class="col-md-12 form-group form-float">
                                        <div class="mb-3">
                                            <label>Branch Address *</label>

                                            <textarea rows="3" class="form-control no-resize" name="branch_address" placeholder="Enter Branch Address" required aria-required="true"></textarea>


                                        </div>
                                        <label id="name-branch-address" class="removeDisplay" for="District">This field is required.</label>
                                    </div>

                                    <div class="col-md-12">
                                        <center>
                                            <input type="submit" class="btn btn-raised btn-primary waves-effect" onclick="addBranchEntry()" value="Submit">
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
                            <h2><strong>Current Branch</strong> List </h2>
                            <ul class="header-dropdown">
                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                    <ul class="dropdown-menu dropdown-menu-right slideUp">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                                <li class="remove">
                                    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Branch Code</th>
                                            <th>Branch Name</th>
                                            <th>Branch Address</th>
                                            <th>Contact Person</th>
                                            <th>Mobile No.</th>
                                            <th>Email ID</th>
                                            <th>Credit Limit</th>
                                            <th></th>
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