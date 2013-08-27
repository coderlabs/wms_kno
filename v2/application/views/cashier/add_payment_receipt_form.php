
<div id='content'>
				
                
                
            	<h2>Create Nota Pembayaran Jasa Gudang</h2>
				
                      <?php echo form_open('cashier/do_search_receipt', 'class="form-inline"');?>
                      
                      <div class="input-group col-lg-3">
                      	<input name="btb_no" size="40" placeholder="no btb" type="text" class="form-control">
                      	<span class="input-group-btn">
					  	<?php echo form_submit('submit', 'SEARCH', 'class="btn btn-primary"' ); ?>
					  	</span>
                      </div>
                      
                      
					  <?php if($this->uri->segment(4) == 'not_found')
						{ 
					  		echo "<p><strong>Note:</strong> Nomor yang dimasukkan salah.</p>";
						}
						 elseif($this->uri->segment(4) == 'duplicate_data')
						{ 
							echo "<p><strong>Note:</strong> Data double</p>";
					 	}
					?>
                    
        
                
</div>