<?php include(APPPATH . "views/admin/inc/header.php"); ?>
<?php include(APPPATH . "views/admin/inc/sidebar.php"); ?>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="min-height: 1603px;">

        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="<?php echo site_url(); ?>">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">Edit</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption uppercase">
                            <i class="fa fa-gift"></i><?php echo $title; ?></div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php echo $this->session->flashdata('error'); ?>
                        <form name="add" id="add" method="post" enctype="multipart/form-data" action="<?php echo site_url('admin/restaurants/editSuccess'); ?>" class="form-horizontal">
                            <input type="hidden" name="restaurant_id" value="<?php echo $_GET['id'];?>"/>
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Restaurant Name</label>
                                    <div class="col-md-7">
                                        <input type="text" name="title" id="title" class="form-control input-circle" value="<?php echo $restaurants->title;?>" placeholder="Enter title">

                                    </div>
                                </div>
                               
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Restaurant Logo</label>
                                    <div class="col-md-8">
                                        <input type="file" name="logo" id="logo" class="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-8">
                                        <div><img src="<?php echo base_url();?>uploads/<?php echo $restaurants->image;?>" height="250" width="250"></div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Address</label>
                                    <div class="col-md-8">
                                        <input type="text" name="address" id="address" class="form-control input-circle" value="<?php echo $restaurants->address;?>" placeholder="Address">
                                    </div>
                                    
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Address 2</label>
                                    <div class="col-md-8">
                                        <input type="text" name="address2" id="address2" class="form-control input-circle" value="<?php echo $restaurants->address_2;?>">
                                    </div>
                                    
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">City</label>
                                    <div class="col-md-3">
                                         <input type="text" name="city" id="city" class="form-control input-circle" value="<?php echo $restaurants->city;?>" placeholder="City">
                                    </div>
                                    <label class="col-md-2 control-label">State</label>
                                    <div class="col-md-3">
                                        <select class="form-control input-circle" name="state" id="state">

                                         </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    
                                    <label class="col-md-3 control-label">Zip Code</label>
                                    <div class="col-md-3">
                                        <input type="text" name="zipcode" id="zipcode" value="<?php echo $restaurants->zipcode;?>" class="form-control input-circle" placeholder="">
                                    </div>
                                    <label class="col-md-2 control-label">Country</label>
                                    <div class="col-md-3">
                                        <select class="form-control input-circle" name="country" id="country" onchange="getCities()">
                                            <?php
                                            if (count($countries) > 0) {
                                                foreach ($countries->result() as $country) {
                                                    ?>
                                            <option value="<?php echo $country->id; ?>" <?php if($restaurants->country == $country->id){ echo 'selected="selected"';}?>><?php echo $country->name; ?></option>
                                                <?php }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Phone number(Land Line)</label>
                                    <div class="col-md-3">
                                        <input type="text" name="phone" id="phone" value="<?php echo $restaurants->phone;?>" class="form-control input-circle" placeholder="">
                                    </div>
                                    <label class="col-md-2 control-label">Mobile Phone number</label>
                                    <div class="col-md-3">
                                        <input type="text" name="mobile" id="mobile" class="form-control input-circle" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    
                                    <label class="col-md-3 control-label">Fax number</label>
                                     <div class="col-md-3">
                                        <input type="text" name="fax" id="fax" class="form-control input-circle" placeholder="">
                                    </div>
                                </div>
                                
                                

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Email Address</label>
                                    <div class="col-md-6">
                                        <input type="email" name="email" id="email" value="<?php echo $restaurants->email;?>" class="form-control input-circle" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <label class=" control-label margin-bottom-15">How would you like to be notified of new orders?</label>
                                        <div class="mt-radio-list">
                                            <label class="mt-radio mt-radio-outline">
                                                <input type="radio" onclick="checkNotifiy('email')" name="notified_via" id="optionsRadios22" value="email" <?php if($restaurants->notified_choice == 'email'){ echo 'checked="checked"'; }?> > Email
                                                <span></span>
                                            </label>
                                            <label class="mt-radio mt-radio-outline">
                                                <input type="radio" onclick="checkNotifiy('call')" name="notified_via" id="optionsRadios23" value="call" <?php if($restaurants->notified_choice == 'call'){ echo 'checked="checked"'; }?>> Call
                                                <span></span>
                                            </label>
                                            <label class="mt-radio mt-radio-outline">
                                                <input type="radio" onclick="checkNotifiy('sms')" name="notified_via" id="optionsRadios24" value="sms" <?php if($restaurants->notified_choice == 'sms'){ echo 'checked="checked"'; }?>> SMS
                                                <span></span>
                                            </label>
                                            <label class="mt-radio mt-radio-outline">
                                                <input type="radio" onclick="checkNotifiy('notification')" name="notified_via" id="optionsRadios25" value="push notification" <?php if($restaurants->notified_choice == 'push notification'){ echo 'checked="checked"'; }?>> Push Notification
                                                <span></span>
                                            </label>
                                            <label class="mt-radio mt-radio-outline">
                                                <input type="radio" onclick="checkNotifiy('fax')" name="notified_via" id="optionsRadios26" value="fax" <?php if($restaurants->notified_choice == 'fax'){ echo 'checked="checked"'; }?>> Fax
                                                <span></span>
                                            </label>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
										<div class="col-md-7 col-sm-offset-5">
										  <label for="about" class="control-label"><b>Hours of Operation</b></label>
										</div>
									  </div>
                               
                                <div id="add_hours">
                                     <?php $json =json_decode($restaurants->hours_of_operations, true); $counter = 0;?>
                                    <?php foreach($json as $hours){ ?>
                                    <div class="form-group" id="row<?php echo $counter ?>" style="padding-left:42px;">
                                    <input type="hidden" id="" name="counter[]" value="<?php echo $counter ?>" />
                                    <?php   $FromTime = substr($hours,-40,19); $ToTime = substr($hours,-8,12); $Day = substr($hours,0,3);  ?> 
                                    <div class="col-md-11 col-sm-offset-0">
                                        
                                        <div class="col-md-3">
                                            <select class="form-control  c-square c-theme" id="" name="day[<?php echo $counter ?>][]">
                                                <option <?php if($Day=='Mon'){echo 'selected="selected"';} ?> value="Mon" >Monday</option>
                                                <option <?php if($Day=='Tue'){echo 'selected="selected"';} ?> value="Tue">Tuesday</option>
                                                <option <?php if($Day=='Wed'){echo 'selected="selected"';} ?> value="Wed">Wednesday</option>
                                                <option <?php if($Day=='Thu'){echo 'selected="selected"';} ?> value="Thu">Thursday</option>
                                                <option <?php if($Day=='Fri'){echo 'selected="selected"';} ?> value="Fri">Friday</option>
                                                <option <?php if($Day=='Sat'){echo 'selected="selected"';} ?> value="Sat">Saturday</option>
                                                <option <?php if($Day=='Sun'){echo 'selected="selected"';} ?> value="Sun">Sunday</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                        <label for="from" class="control-label">from</label>
                                       </div>
                                        <div class="col-md-3">
                                           <input type="text" class="form-control  c-square c-theme timepicker_7" name="from[<?php echo $counter ?>][]" id="" value="<?php echo $FromTime; ?>" >
                                         </div>
                                        <div class="col-md-1">
                                        <label for="to" class="control-label">to</label>
                                        </div>
                                        <div class="col-md-3">
                                          <input type="text" class="form-control  c-square c-theme timepicker_7" name="to[<?php echo $counter ?>][]" id="" value="<?php echo $ToTime; ?>" >
                                        </div>
                                        <?php if($counter == 0) {?>
                                        <div class="col-md-1">
                                            <button type="button" class="btn c-theme-btn  c-btn-square c-btn-uppercase c-btn-bold" id="add-row" style="width: 97px;"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                        </div>
                                        <?php }else { ?>
                                        <div class="col-md-1"><button type="button" style="width:97px;" class="btn btn-danger btn_remove c-btn-square c-btn-uppercase" id="<?php echo $counter ?>"><i class="icon-trash"></i>Remove</button></div>
                                        <?php } ?>
                                    </div>
                                   
                                </div>
                                    <?php $counter++; ?>
                                     <?php }?>
                                    </div>
                                
                                <div class="form-group">
                                        <label for="multiple" class="col-md-3 control-label"> Restaurant Category</label>
                                        <div class="col-md-8">
                                            <select id="categories" name="categories[]" class="form-control select2-multiple  input-circle" multiple>
                                                  <?php 
                                            if (count($categories) > 0) {
                                                foreach ($categories->result() as $category) {
                                                    ?>
                                                <option value="<?php echo $category->name;?>" <?php if(strpos($restaurants->categories, $category->name)){ echo 'selected';}?>><?php echo $category->name;?></option>
                                                <?php }
                                            }
                                            ?>
                                            </select>
                                    </div>
                                         </div>
                                
                                
                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Status</label>
                                    <div class="col-md-2">
                                        <select class="form-control input-circle" name="status" id="status">
                                           
                                                    <option value="Active" <?php if($restaurants->status == 'Active'){ echo 'selected="selected"'; }?>>Active</option>
                                                    <option value="Not Active" <?php if($restaurants->status == 'Not Active'){ echo 'selected="selected"'; }?>>Inactive</option>
                                               
                                        </select>
                                    </div>
                                   
                                </div>
                                
                                

                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn btn-circle green">Update</button>
                                        <button type="button" class="btn btn-circle grey-salsa btn-outline">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
</div>

<?php include(APPPATH . "views/admin/inc/footer.php"); ?>

<script type="text/javascript">
    function getCities() {
        var country_id = $('#country').val();
        $.post("<?php echo site_url('admin/restaurants/getCities'); ?>", {country_id: country_id}).done(function (data) {
            $('#state').html(data);
        });
    }
    
    $( document ).ready(function() {
    var country_id = <?php echo $restaurants->country ?>;
        $.post("<?php echo site_url('admin/restaurants/getCities'); ?>", {country_id: country_id}).done(function (data) {
            $('#state').html(data);
        });
});
        $(document).ready(function() {
                $('.timepicker_7').timepicker({
                    showPeriod: true,
                    onHourShow: timepicker7OnHourShowCallback,
                    onMinuteShow: timepicker7OnMinuteShowCallback
                });
                
                
                
            });
            function timepicker7OnHourShowCallback(hour) {
                if ((hour > 20) || (hour < 6)) {
                    return false;
                }
                return true;
            }
            function timepicker7OnMinuteShowCallback(hour, minute) {
                if ((hour == 20) && (minute >= 30)) { return false; }
                if ((hour == 6) && (minute < 30)) { return false; }
                return true;
            }
			
			$(document).ready(function(){
	var i = <?php echo $counter+1 ?>;
	$('#add-row').click(function(){
		i++;
		$('#add_hours').append('<div class="form-group" id="row'+i+'" style="padding-left:42px;"><input type="hidden" id="" name="counter[]" value="'+i+'" /><div class="col-md-11 col-sm-offset-0"><div class="col-md-3"><select class="form-control  c-square c-theme" id="" name="day['+i+'][]"><option value="Mon" selected="selected">Monday</option><option value="Tue">Tuesday</option><option value="Wed">Wednesday</option><option value="Thu">Thursday</option><option value="Fri">Friday</option><option value="Sat">Saturday</option><option value="Sun">Sunday</option></select></div><div class="col-md-1"><label for="from" class="control-label">from</label></div><div class="col-md-3"><input type="text" class="form-control  c-square c-theme timepicker_7" name="from['+i+'][]" id="" value="01:30 PM" ></div><div class="col-md-1"><label for="to" class="control-label">to</label></div><div class="col-md-3"><input type="text" class="form-control  c-square c-theme timepicker_7" name="to['+i+'][]" id="" value="01:30 PM" ></div><div class="col-md-1"><button type="button" style="width:97px;" class="btn btn-danger btn_remove c-btn-square c-btn-uppercase" id="'+i+'"><i class="icon-trash"></i>Remove</button></div></div></div>');
	$('.timepicker_7').timepicker({
                    showPeriod: true,
                    onHourShow: timepicker7OnHourShowCallback,
                    onMinuteShow: timepicker7OnMinuteShowCallback
                });
                //$("#counter").val(i);
            });
            
	$(document).on('click','.btn_remove', function(){
		var button_id = $(this).attr("id");
		$("#row"+button_id+"").remove();
	});
	
});
    
</script>