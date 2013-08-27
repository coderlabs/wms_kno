<div id='content'>
            	<h2>SEARCH BTB</h2>
					
                    <?php 
							echo form_open('cashier/do_search_receipt');
					?>
                    
                      <input name="btb_no" size=40 placeholder="EX : 11072013000001" type="text">
                      <?php echo form_submit('submit', 'SEARCH' ); ?>
					 
					 <p><br/>INFO: <BR>Masukkan Nomor Bukti Timbang Barang (<B>No. BTB</B>) untuk DeliveryBill
		<B>OUTGOING</B>. <BR>Masukkan nomor Surat Muatan Udara/Airway Bill (<B>No. SMU/AWB</B>) untuk 
		DeliveryBill <B>INCOMING</B></p>
					 <table>
						<tr>
							<th>No</th>
							<th>Tanggal</th>
							<th>No. BTB</th>
							<th>No. SMU</th>
							<th>Total Berat</th>
							<th>Agent</th>
							<th>Cara Bayar</th>
							<th>No. Delivery Bill</th>
							<th>Action</th>
						</tr>
				
					 <?php 
					 $num = 1;
					 foreach ($outgoing as $row_out)
					 { ?>
					 <tr>
						<td><?php echo $num++?></td>
						<td><?php echo $row_out->btb_date?></td>
						<td><?php echo $row_out->btb_nobtb?></td>
						<td><?php echo $row_out->btb_smu?></td>
						<td><?php echo $row_out->btb_totalberat?></td>
						<td><?php echo $row_out->btb_agent?></td>
						<td>cara bayar</td>
						<td>no dev bil</td>
					</tr>
					 <?php }?>
					 </table>
                
</div>