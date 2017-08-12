			<div id="seasonalrate_<?php echo $Counter; ?>" class="row seasonalrate_row">
				<div class="col-md-2"><a onclick="removeSeasonalRate(<?php echo $Counter; ?>)" class="btn btn-sm red"> Remove <i class="fa fa-times"></i></a></div>				
				<div class="col-md-4">
					<div class="form-group">
					  <label class="col-md-3 control-label" for="available_dates">Item Name</label>
					  <div class="col-md-8">
						<input type="text" class="form-control input-sm" id="item_name" name="item_name[]" required>
					  </div>
					</div>
				</div>	
				<div class="col-md-4">
				<div class="form-group ">
                        <label class="control-label col-md-3">Item Price</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control input-sm" id="item_price" name="item_price[]" required>
                            </div>
                        </div>
				</div>
				<div style="clear:both;"></div>
				<div class="col-md-1"></div>				
				<div class="col-md-9">
					<div class="form-group">
					  <label class="col-md-3 control-label" for="available_dates">Item Description</label>
					  <div class="col-md-9">
                                              <textarea id="ckEditorDv_<?php echo $Counter;?>" class="ckeditor form-control" name="description[]" rows="6" data-error-container="#editor2_error" required></textarea>
                                              
					  </div>
					</div>
				</div>
							
			</div>
			
			<script src="<?php echo base_url() ;?>assets/admin/assets/ckeditor/ckeditor.js" type="text/javascript"></script>
<script type="text/javascript"> 
$(document).ready(function(){
    
	$('#reportrange<?php echo $Counter; ?>').daterangepicker({
                opens: (App.isRTL() ? 'left' : 'right'),
                startDate: moment().subtract('days', 29),
                endDate: moment(),
                //minDate: '01/01/2012',
                //maxDate: '12/31/2014',
                dateLimit: {
                    days: 365
                },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    'Last 7 Days': [moment().subtract('days', 6), moment()],
                    'Last 30 Days': [moment().subtract('days', 29), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                },
                buttonClasses: ['btn'],
                applyClass: 'green',
                cancelClass: 'default',
                format: 'MM/DD/YYYY',
                separator: ' to ',
                locale: {
                    applyLabel: 'Apply',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom Range',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            },
            function (start, end) { 
				$("#start_date_<?php echo $Counter; ?>").val(start.format('YYYY-MM-D'));
				$("#end_date_<?php echo $Counter; ?>").val(end.format('YYYY-MM-D'));
                $('#reportrange<?php echo $Counter; ?> span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
		);
        //Set the initial state of the picker label
        $('#reportrange<?php echo $Counter; ?> span').html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
});
</script>			