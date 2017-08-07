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
                <span class="active">Add Category</span>
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
                        <form name="add" id="add" method="post" enctype="multipart/form-data" action="<?php echo site_url('admin/restaurant_menu_categories/editSuccess'); ?>" class="form-horizontal">
                            <input type="hidden" name="cat_id" value="<?php echo $_GET['id'];?>"/>
                            <input type="hidden" name="restaurant_id" value="<?php echo $_GET['restaurant_id'];?>"/>
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Category Name</label>
                                    <div class="col-md-4">
                                        <input type="text" name="title" id="title" class="form-control input-circle" value="<?php echo $categories->name;?>">

                                    </div>
                                </div>
                                
                               
                                 
                                
                                 <div class="form-group">
                                    <label class="col-md-3 control-label">Status</label>
                                    <div class="col-md-2">
                                        <select class="form-control input-circle" name="status" id="status">
                                           
                                                     <option value="Active" <?php if($categories->status == 'Active'){ echo 'selected="selected"'; }?>>Active</option>
                                                    <option value="Not Active" <?php if($categories->status == 'Not Active'){ echo 'selected="selected"'; }?>>Not Active</option>
                                               
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