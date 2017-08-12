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
                <span class="active">Restaurant -> Add Menu</span>
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
                        <form name="add" id="add" method="post" enctype="multipart/form-data" action="<?php echo site_url('admin/menus/editSuccess'); ?>" class="form-horizontal">
                            <input type="hidden" name="restaurant_id" value="<?php echo $restaurant_id;?>"/>
                            <input type="hidden" name="menu_id" value="<?php echo $_GET['id'];?>"/>
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Menu Name</label>
                                    <div class="col-md-8">
                                        <input type="text" name="title" id="title" value="<?php echo $menu->menu_title; ?>" class="form-control" placeholder="Enter Name">

                                    </div>
                                </div>
                                <div class="form-group">
                                        <label for="multiple" class="col-md-3 control-label"> Menu Category</label>
                                        <div class="col-md-8">
                                            <select id="categories" name="categories[]" class="form-control select2-multiple input-circle" multiple>
                                                  <?php
                                            if (count($categories) > 0) {
                                                foreach ($categories->result() as $category) {
                                                    ?>
                                                <option value="<?php echo $category->id;?>"><?php echo $category->name;?></option>
                                                <?php }
                                            }
                                            ?>
                                            </select>
                                    </div>
                                         </div>
                                <?php $Counter = 1;?>
                                <div id="addNewSeasonalRateRows" class="seasonal_rates_class">	
				<?php foreach($items->result() as $item){ ?>
				<div id="seasonalrate_<?php echo $Counter; ?>" class="row seasonalrate_row">
					<div class="col-md-2"><a onclick="removeSeasonalRate(<?php echo $Counter; ?>)" class="btn btn-sm red"> Remove <i class="fa fa-times"></i></a></div>				
					<div class="col-md-4">
						<div class="form-group">
						  <label class="col-md-3 control-label" for="available_dates">Item Name</label>
						  <div class="col-md-8">
							<input type="text" value="<?php echo $item->item_name; ?>" class="form-control input-sm" id="item_name" name="item_name[]" required>
						  </div>
						</div>
					</div>	
                                       
					<div class="col-md-4">
				<div class="form-group ">
                        <label class="control-label col-md-3">Item Price</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control input-sm" value="<?php echo $item->item_price; ?>" id="item_price" name="item_price[]" required>
                            </div>
                        </div>
				</div>
				<div style="clear:both;"></div>
				<div class="col-md-1"></div>				
				<div class="col-md-9">
					<div class="form-group">
					  <label class="col-md-3 control-label" for="available_dates">Item Description</label>
					  <div class="col-md-9">
                                               <textarea id="ckEditorDv_<?php echo $Counter; ?>" class="ckeditor form-control" name="description[]" rows="6" data-error-container="#editor2_error" required><?php echo $item->item_description;?></textarea>
                                              
					  </div>
					</div>
				</div>		
				</div>
				<?php $Counter++; } ?>
			</div>
                <div class="form-group seasonal_rates_class">
                  <label class="col-md-2 control-label" for="available_dates">Add Items</label>
                  <div class="col-md-2">
				    <input type="hidden" value="<?php echo $Counter; ?>" id="seasonalcounter" />
                    <a onclick="addNewSeasonalRate()" class="btn btn-sm purple"><i class="fa fa-plus"></i> ADD NEW </a>
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
<style>
.seasonalrate_row{background:#eee;padding-top:15px;margin-bottom:20px;}

</style>
<script src="<?php echo base_url() ;?>assets/admin/assets/ckeditor/ckeditor.js" type="text/javascript"></script>
<script>
   function addNewSeasonalRate(){
	var seasonalcounter = parseInt($("#seasonalcounter").val());
	var newcounter = seasonalcounter+1;
	$("#seasonalcounter").val(newcounter);
	$.post("<?php echo site_url('admin/menus/addnewItem');?>", {seasonalcounter:seasonalcounter}).done(function(e){
		$("#addNewSeasonalRateRows").append(e);
                CKEDITOR.replace( 'ckEditorDv_' + seasonalcounter );
	});
}
function removeSeasonalRate(rowid){
	$("#seasonalrate_"+rowid).remove();
}

</script>
<?php include(APPPATH . "views/admin/inc/footer.php"); ?>