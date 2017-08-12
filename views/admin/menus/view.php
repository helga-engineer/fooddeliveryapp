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
                <span class="active">View All Menu Categories</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12">
               
                    
                   
                        <?php echo $this->session->flashdata('error'); ?>
                      
                         <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase"><?php echo $title; ?></span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Menu Name</th>
                                                <th>Date Created</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Menu Name</th>
                                                <th>Date Created</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                       <?php   if (count($menus) > 0) {
                                                foreach ($menus->result() as $menu) {
                                                    ?>
                                            <tr>
                                                <td><?php echo $menu->id; ?></td>
                                                <td><?php echo $menu->menu_title; ?></td>
                                                <td><?php echo $menu->created_at; ?></td>
                                                <td><a href="<?php echo site_url();?>admin/menus/edit?id=<?php echo  $menu->id;?>&restaurant_id=<?php echo $menu->restaurant_id;?>" class="btn btn-circle btn-icon-only blue"> <i class="fa fa-edit"></i> </a>
                                                    <a href="<?php echo site_url();?>admin/menus/delete?id=<?php echo  $menu->id;?>&restaurant_id=<?php echo $menu->restaurant_id;?>" class="btn btn-circle btn-icon-only red"> <i class="fa fa-times"></i> </a>
                                                </td>
                                            </tr>
                                            
                                       <?php } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        
                      
               
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