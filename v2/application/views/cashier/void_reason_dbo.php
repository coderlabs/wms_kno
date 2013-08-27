<div id='content'>
            	<h2>Void Delivery Bill</h2>
					
                    <?php 
							echo form_open('cashier/do_void_dbo/'.$no_btb);
							echo form_hidden('no_btb', $no_btb); 
					?>
                    
                      Alasan : <br/><input name="reason" size=100  type="text">
                      <?php echo form_submit('submit', 'Void' ); ?>
					 
</div>