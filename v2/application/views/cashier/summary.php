<div id='content'>
            	<h2>Summary Report</h2>
					
                    <?php echo form_open('cashier/summary_result'); 	?>
    							<div class="col-lg-2">
									<label for="datepicker_start"> From</label>
									<input type="text" class="form-control" id="datepicker_start" placeholder="select date" name="startdate" value="<?php echo mdate('%d-%m-%Y', time()); ?>">
                                </div>
								<div class="col-lg-2">
									<label for="datepicker_end"> Until</label>
                                    <input type="text" class="form-control" id="datepicker_end" placeholder="select date" name="enddate" value="<?php echo mdate('%d-%m-%Y', time()); ?>">
                                </div>
      							<div class="input-group col-lg-1">
      								<span class="input-group-btn">
									<br>
                                    <?php echo form_submit('submit','Go!', ' class="btn btn-primary"'); ?>
                                  </span>
                                </div>
                    <?php echo form_close(); ?>
</div>
