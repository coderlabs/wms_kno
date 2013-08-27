<div id='content'>
            	<h2>SEARCH BTB</h2>
					
                    <?php 
							echo form_open('cashier/do_search_receipt');
					?>
                    
                      <input name="btb_no" size=40 placeholder="EX : 11072013000001" type="text">
                      <?php echo form_submit('submit', 'SEARCH' ); ?>
					 
					 <p><strong>Note:</strong> <br/>
							No Agent Data</p>
</div>