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
                <span class="active">Add</span>
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
                        <form name="add" id="add" method="post" enctype="multipart/form-data" action="<?php echo site_url('admin/restaurants/addSuccess'); ?>" class="form-horizontal">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Title</label>
                                    <div class="col-md-6">
                                        <input type="text" name="title" id="title" class="form-control input-circle" placeholder="Enter title">

                                    </div>
                                </div>
                                
                                <div class="form-group">
                                        <label for="multiple" class="col-md-3 control-label">Select Categories</label>
                                        <div class="col-md-6">
                                            <select id="categories" name="categories[]" class="form-control select2-multiple input-circle" multiple>
                                                  <?php
                                            if (count($categories) > 0) {
                                                foreach ($categories->result() as $category) {
                                                    ?>
                                                <option value="<?php echo $category->name;?>"><?php echo $category->name;?></option>
                                                <?php }
                                            }
                                            ?>
                                            </select>
                                    </div>
                                         </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Address</label>
                                    <div class="col-md-6">
                                        <input type="text" name="address" id="address" class="form-control input-circle" placeholder="Address">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Country</label>
                                    <div class="col-md-2">
                                        <select class="form-control input-circle" name="country" id="country" onchange="getCities()">
                                            <?php
                                            if (count($countries) > 0) {
                                                foreach ($countries->result() as $country) {
                                                    ?>
                                                    <option value="<?php echo $country->id; ?>"><?php echo $country->name; ?></option>
                                                <?php }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <label class="col-md-1 control-label">State</label>
                                    <div class="col-md-2">
                                        <select class="form-control input-circle" name="state" id="state">


                                        </select>
                                    </div>
                                </div>
                                

                                <div class="form-group">
                                    <label class="col-md-3 control-label">City</label>
                                    <div class="col-md-6">
                                        <input type="text" name="city" id="city" class="form-control input-circle" placeholder="City">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Zip/Postal Code</label>
                                    <div class="col-md-6">
                                        <input type="text" name="zipcode" id="zipcode" class="form-control input-circle" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Notified Type</label>
                                    <div class="col-md-6">
                                        <div class="mt-radio-list">
                                            <label class="mt-radio mt-radio-outline">
                                                <input type="radio" onclick="checkNotifiy('email')" name="notified_via" id="optionsRadios22" value="email" checked="checked" > Email
                                                <span></span>
                                            </label>
                                            <label class="mt-radio mt-radio-outline">
                                                <input type="radio" onclick="checkNotifiy('call')" name="notified_via" id="optionsRadios23" value="call" > Call
                                                <span></span>
                                            </label>
                                            <label class="mt-radio mt-radio-outline">
                                                <input type="radio" onclick="checkNotifiy('sms')" name="notified_via" id="optionsRadios24" value="sms" > SMS
                                                <span></span>
                                            </label>
                                            <label class="mt-radio mt-radio-outline">
                                                <input type="radio" onclick="checkNotifiy('notification')" name="notified_via" id="optionsRadios25" value="push notification" > Push Notification
                                                <span></span>
                                            </label>
                                            <label class="mt-radio mt-radio-outline">
                                                <input type="radio" onclick="checkNotifiy('fax')" name="notified_via" id="optionsRadios26" value="fax" > Fax
                                                <span></span>
                                            </label>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Email</label>
                                    <div class="col-md-6">
                                        <input type="email" name="email" id="email" class="form-control input-circle" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Phone</label>
                                    <div class="col-md-6">
                                        <input type="text" name="phone" id="phone" class="form-control input-circle" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Hours of Operation</label>
                                    <label class="control-label col-md-1">From</label>
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <input type="text" name="fromHours" class="form-control timepicker timepicker-no-seconds">
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
                                            <input type="text" name="toHours" class="form-control timepicker timepicker-no-seconds">
                                            <span class="input-group-btn">
                                                <button class="btn default" type="button">
                                                    <i class="fa fa-clock-o"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Description</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Upload Restaurants Logo</label>
                                    <div class="col-md-6">
                                        <input type="file" name="logo" id="logo" class="">
                                    </div>
                                </div>
                                
                                
                                
                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Status</label>
                                    <div class="col-md-2">
                                        <select class="form-control input-circle" name="status" id="status">
                                           
                                                    <option value="Active">Active</option>
                                                    <option value="Not Active">Inactive</option>
                                               
                                        </select>
                                    </div>
                                   
                                </div>
                                
                                

                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn btn-circle green">Submit</button>
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
<script>
    function getCities() {
        var country_id = $('#country').val();
        $.post("<?php echo site_url('admin/restaurants/getCities'); ?>", {country_id: country_id}).done(function (data) {
            $('#state').html(data);
        });
    }
</script>
<?php include(APPPATH . "views/admin/inc/footer.php"); ?>