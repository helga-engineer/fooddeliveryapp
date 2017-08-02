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
                                    <div class="col-md-7">
                                        <input type="file" name="logo" id="logo" class="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-7">
                                        <div><img src="<?php echo base_url();?>uploads/<?php echo $restaurants->image;?>" height="250" width="250"></div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Address</label>
                                    <div class="col-md-7">
                                        <input type="text" name="address" id="address" class="form-control input-circle" value="<?php echo $restaurants->address;?>" placeholder="Address">
                                    </div>
                                    
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Address 2</label>
                                    <div class="col-md-7">
                                        <input type="text" name="address2" id="address2" class="form-control input-circle" value="<?php echo $restaurants->address_2;?>">
                                    </div>
                                    
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">City</label>
                                    <div class="col-md-3">
                                         <input type="text" name="city" id="city" class="form-control input-circle" value="<?php echo $restaurants->city;?>" placeholder="City">
                                    </div>
                                    <label class="col-md-2 control-label">State</label>
                                    <div class="col-md-2">
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
                                    <div class="col-md-2">
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
                                    <div class="col-md-2">
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
                                    <label class="control-label col-md-3">Hours of Operation</label>
                                    <label class="control-label col-md-1">From</label>
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <input type="text" name="fromHours" value="<?php echo $restaurants->hours_of_operations_from;?>" class="form-control timepicker timepicker-no-seconds">
                                            <span class="input-group-btn">
                                                <button class="btn default" type="button">
                                                    <i class="fa fa-clock-o"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <label class="control-label col-md-1">To</label>
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <input type="text" name="toHours" value="<?php echo $restaurants->hours_of_operations_to;?>" class="form-control timepicker timepicker-no-seconds">
                                            <span class="input-group-btn">
                                                <button class="btn default" type="button">
                                                    <i class="fa fa-clock-o"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                        <label for="multiple" class="col-md-3 control-label"> Restaurant Category</label>
                                        <div class="col-md-7">
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
    
    
</script>