<div id='content'>
            	<h2>Cashier Activity Report</h2>
					
                    
                    
                    <?php echo form_open('cashier/my_balance_result'); 	?>
    							<div class="row">
                                	<div class="form-inline">
                                			<div class="col-lg-2">
                                            <select name="kasir" class="form-control">
                                                <?php foreach($query as $row){ ?>
                                                    <option value = "<?php echo $row->id_user; ?>"><?php echo $row->nama_lengkap; ?></option>
                                                <?php } ?>
                                            </select>
                                			</div>
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
