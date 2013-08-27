<div id='content'>
            	<h2>Reconciliation Report</h2>
					
                    <?php echo form_open('cashier/reconciliation_result'); 	?>
    							<div class="input-group col-lg-3">
      								<input type="text" class="form-control" id="datepicker" placeholder="select date" name="date" value="<?php echo mdate('%d-%m-%Y', time()); ?>">
      								<span class="input-group-btn">
                                    <?php echo form_submit('submit','Go!', 'class="btn btn-primary"'); ?>
                                  </span>
                                </div>
                             
                    <?php echo form_close(); ?>
</div>
