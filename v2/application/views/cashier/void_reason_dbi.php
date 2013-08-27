<div id='content'>
            	<h2>Void Delivery Bill</h2>
					
                    <?php 
						foreach ($cek_barang as $cb)
						{
							if (($cb['inb_status_gudang'] == 'outstore') || ($cb['inb_status_gudang'] == 'pickup'))
							{
								echo '<h4><strong>Delivery Bill tidak bisa di void, Barang tidak ada di gudang</strong></h4>';
							} 
							else 
							{
								echo form_open('cashier/do_void_dbi/'.$no_btb);
								echo 'Alasan : <br/><input name="reason" size=100  type="text">';
								echo form_submit('submit', 'Void' ); } 
								echo form_close();
							}
					?>
                    
                      
					 
</div>
