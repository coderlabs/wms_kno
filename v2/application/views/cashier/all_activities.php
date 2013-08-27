<div id='content'>
            	<h2>Cashier Activity Report</h2>
					
                    
                    
                    <?php echo form_open('cashier/all_inbound_result'); ?>
    							<div class="row">
                                	<div class="form-inline">
                                			
                                            <div class="col-lg-2">
                                                <input type="text" class="form-control" id="datepicker" placeholder="select date" name="date" value="<?php echo mdate('%d-%m-%Y', time()); ?>">
                                            </div>
                                            <div class="col-lg-2">
                                                <?php echo form_submit('submit','Go!', 'class="btn btn-default"'); ?>
                                            </div>
                                  	</div>
                                </div>
                    
                   <?php echo form_close(); ?> 
                    
</div>
