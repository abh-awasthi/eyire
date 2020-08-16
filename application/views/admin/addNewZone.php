<div class="main-section" id="add-floor"> 
    <div class="container">
<form action="<?php echo base_url(); ?>zone/processAddZone/<?php echo $zone[0]->id; ?>" method="POST" id="addZone">
        <div class="top-header">
            <div class="row">
                <div class="col-md-9">
                    <h2>ZONES (<?php echo $action; ?>)</h2>
                </div>

                <div class="col-md-3">
                    <div class="top-close"><input type="button" value="CLOSE" class="close-btn" name="submit" id="close-btn"></div>
                </div>
            </div>   
        </div>	   

        <div class="middle-body register-form" >
            <div class="row">
                <div class="col-md-9">  <?php // print_r($zone); ?>
				<div class="row">
					<div class="select-box">
					</div>
					</div>
					<div class="row">
					<div class="header-title">
					                    <div class="leftbox-top" id="zones-add">
					<!-- <h5> ENTER ZONE DETAILS THAT ARE LISTED BELOW :</h5> -->
					</div> 
					</div>
					</div>	
 
                    <div class="zone-info">
                        <h3> ZONES INFO</h3>  				
                        
                            <div class="form-group row  mb-4">
                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">PROJECT NAME</label>
                                <div class="col-sm-5">
                                    <select name="project_name" id="project_name" class="project_name" required="" >
                                        <option value="">SELECT A PROJECT</option>
                                        <?php if (!empty($projects)) {
                                            foreach ($projects as $project) {
                                                ?>
                                                <option  <?php if($zone[0]->project_id==$project->id){echo 'selected';} ?>  value="<?php echo $project->id; ?>"><?php echo $project->project_name; ?></option>
                                            <?php }
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">FLOOR PLAN NAME</label>
                                <div class="col-sm-5">
                                    
                                    <?php if(!empty($zone[0]->flor_plan_id)){ ?>
                                        
                                      <select name="floor_plan" id="floor_plans" class="project_name" required="" >
									  
                                       <option <?php if($zone[0]->flor_plan_id){echo 'selected';} ?> value="<?php echo $zone[0]->flor_plan_id; ?>"><?php echo $zone[0]->floor_plan_name; ?></option>
																	
                                    </select>   
                                    <?php }else{ ?>
                                        
                                    <select name="floor_plan" id="floor_plans" class="project_name" required="" >
                                        
                                    </select>
                                    <?php } ?>
                                    

                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">ZONE TYPE</label>
                                <div class="col-sm-5">
                                    <select name="zone_type" id="zone_type" class="project_name">
                                        <option  value="">SELECT A ZONE TYPE</option>
                                        <option <?php if($zone[0]->zone_type=='UNUSED SPACE'){echo 'selected';} ?> value="UNUSED SPACE">UNUSED SPACE</option>
                                        <option <?php if($zone[0]->zone_type=='DISPLAY SPACE'){echo 'selected';} ?> value="DISPLAY SPACE">DISPLAY SPACE</option>
                                        <option <?php if($zone[0]->zone_type=='COMMON SPACE'){echo 'selected';} ?> value="COMMON SPACE">COMMON SPACE</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="colFormLabelLg" class="col-sm-4 col-form-label">ZONE NAME / ZONE DESCRIPTION</label>
                                <div class="col-sm-5">
                                    <input type="text" name="description" value="<?php echo $zone[0]->zone_name; ?>" class="form-control" id="zone_name" placeholder="ENTER A ZONE NAME / ZONE DESCRIPTION">
                                </div>
                            </div>

                       
                    </div>  
                </div>

                <div class="col-md-3 right-text">
                    <div class="tab right-tabs">

                        <div class="table-content add-zone-1">	  
                            <ul class="nav nav-tabs ">
                                <!--li><a data-toggle="tab" href="#home">CONFIG PAGE</a></li-->
                     <!--            <li class=""><a data-toggle="tab" href="#menu1">CONFIG PAGE</a></li>  -->
				                <li class="active"><a data-toggle="tab" href="#menu1">MAIN MENU</a></li>
				                <li class=""><a data-toggle="tab" href="#menu1">ASSIGN ZONES</a></li>
                            </ul>
                            <div class="table_info floor-step">
                                <h5>STEP 1 OF 1</h5>
                                <p style="color:#00b050!important;font-weight: bold!important;">CURRENTLY SELECTED : <span style="color:black;font-size: 14px;font-weight: bold;" >ZONES (<?php echo $action; ?>) </span></p>
                                 <p>FILL IN THE DETAILS ON THE LEFT TAB.</p>
                                <p>WHEN YOU ARE DONE, CLICK NEXT.</p>
                       
                                <h6 class="image_err_fileformat1" style="color:red!important;font-weight: 600;"></h6>
                                <p class="image_err_fileformat2" style="float:left!important;text-align:left!important;color:red!important;"></p>
                                <br>
                                <h6 class="image_err_filesize1" style="color:red!important;font-weight: 600;"></h6>
                                <p class="image_err_filesize2" style="float:left!important;text-align:left!important;color:red!important;"></p>
                                <div class="tab-content">
                                </div>
                            </div>
                            <div class="form-submit"> 
                                <input type="submit" value="Back" class="close-btn" name="back" id="btn5">
                                <input type="submit" value="Next"       class="action-btn" name="submit" id="submitbtn">
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>

        <div class="footer">2019 – <?php echo date('Y'); ?> .<b>XMANAGE</b>. </div>  

 </form>
    </div>

</div>


<script>

    $(document).ready(function () {
        $("#project_name").change(function () {

            let project = $(this).val();

            $.ajax({
                method: "POST",
                url: "<?php echo base_url(); ?>zone/getFloorPlanbyProject/" + project,
                // data: { name: "John", location: "Boston" },
                success: function (data) {
                    console.log(data);
                    $("#floor_plans").empty()
                    $("#floor_plans").append(data);
                    $("#floor_plans option").each(function () {
                        if ($(this).val() == "") {
                            $(this).remove();
                        }


                    });
                }
            })

        });
//
//        $("body").on('click', '#submitbtn', function () {
//            var form = $("#addZone");
//            var url = form.attr('action');
//            let project_id = $("#project_name").val();
//            let floor_plan = $("#floor_plans").val();
//            let zone_type = $("#zone_type").val();
//            let zone_name = $("#zone_name").val();
//            
//            if(project_id==""){
//                
//                alert("Plse Enter ");
//            }
//            
////            $.ajax({
////                type: "POST",
////                url: url,
////                data:   {project_id: project_id,floor_plan: floor_plan,zone_type:zone_type,zone_name:zone_name}, 
////                success: function (data)
////                {
////                    $.fancybox.getInstance('close');
////                    
////                    if (parseInt(data) >= 1) {
////                        $.fancybox.open({
////                            src: 'http://13.235.169.150/XFactor/zone/addNewZoneSuccess/'+data,
////                            type: 'ajax',
////                            ajax: { 
////                             settings: { data : 'ABC', type : 'POST' }
////                           },    
////                            opts: {
////                                afterShow: function (instance, current) {
////                                    console.info('done!');
////                                }
////                            }
////                        });
////
////                    } else {
////
////                        $.fancybox.open({
////                            src: 'http://13.235.169.150/XFactor/zone/addNewZoneFailed',
////                            type: 'ajax',
////                            opts: {
////                                afterShow: function (instance, current) {
////                                    console.info('done!');
////                                }
////                            }
////                        });
////                    }
////                }
////            });
//            
//            
//            
//            
//            
//
//        });


        $('body').on('click', '.close-btn', function () {
            $.fancybox.close();

        });
        
     $.validator.setDefaults({
	    submitHandler: function() {             
            var form = $("#addZone");
            var url = form.attr('action');
            let project_id = $("#project_name").val();
            let floor_plan = $("#floor_plans").val();
            let zone_type = $("#zone_type").val();
            let zone_name = $("#zone_name").val();
            $.ajax({
                type: "POST",
                url: url,
                data:   {project_id: project_id,floor_plan: floor_plan,zone_type:zone_type,zone_name:zone_name}, 
                success: function (data)
                {
                    
             //       alert(data);
                    $.fancybox.getInstance('close');
                    let url = 'http://13.235.169.150/XFactor/zone/addNewZoneSuccess/'+parseInt(data);
                 //   alert(url);
                    if (parseInt(data) >= 1) {
                        $.fancybox.open({
                            src: url ,
                            type: 'ajax',
                            ajax: { 
                             settings: { data : 'ABC', type : 'POST' }
                           },    
                            opts: {
                                afterShow: function (instance, current) {
                                    console.info('done!');
                                },
                                  touch: false,
                                  clickSlide: false,
                                  clickOutside: false
                                  
                            }
                        });

                    } else {

                        $.fancybox.open({
                            src: 'http://13.235.169.150/XFactor/zone/addNewZoneFailed',
                            type: 'ajax',
                            opts: {
                                afterShow: function (instance, current) {
                                    console.info('done!');
                                },
                                  touch: false
                            }
                        });
                    }
                }
            });
                   
		}
	});
        
        
        $("#addZone").validate({
			rules: {
				project_name: "required",
				floor_plan: "required",
                                zone_type:"required",
                                description:"required"
			},
			messages: {
				project_name: "ENSURE THAT A PROJECT IS SELECTED.",
				floor_plan: "ENSURE THAT A FLOOR PLAN IS FILLED IN.",
                                zone_type: "ENSURE THAT A FLOOR PLAN IS FILLED IN.",
                                description:"ENSURE THAT ZONE NAME / ZONE DESCRIPTION IS FILLED IN."
			}
		});
        

    });

</script>
<style>
    .fancybox-close-small{
        display:none;
    }
    .error{
        color:red !important;
    }

</style>