<div id='content'>
            	<h2>SEARCH DELIVERY BILL</h2>
					
                    <?php 
							echo form_open('cashier/do_search_db');
					?>
                    
                      <input name="db" size=40 placeholder="no db" type="text">
                    <?php 
						echo form_submit('submit', 'SEARCH' ); 
						echo form_close();
					?>
					 
					<table>
						<thead>
						<tr>
							<th>No</th>
							<th>No DB</th>
							<th>No BTB</th>
							<th>No SMU</th>
							<th>Tgl Bayar</th>
							<th>Sewa Gudang</th>
							<th>Cargo Charge</th>
							<th>Administrasi</th>
							<th>PPn</th>
							<th>Total Biaya</th>
						</tr>
						</thead>
						<tfoot>
						<tr><td colspan=10><center><div class="pagination"><?php echo $this->pagination->create_links();?></div></center></td></tr>
						</tfoot>
						<tbody>
					 <?php 
					 $num = $offset+1;
					 foreach ($result as $row)
					 { ?>
						<tr>
							<td><?php echo $num++?></td>
							<td><?php echo $row->nodb?></td>
							<td><?php echo $row->no_smubtb?></td>
							<td><?php echo $row->nosmu?></td>
							<td><?php echo $row->tglbayar?></td>
							<td><div align='right'><?php echo $row->sewagudang?></div></td>
							<td><div align='right'><?php echo $row->cargo_charge?></div></td>
							<td><div align='right'><?php echo $row->administrasi?></div></td>
							<td><div align='right'><?php echo $row->ppn?></div></td>
							<td><div align='right'><?php echo $row->total_biaya?></div></td>
						</tr>
					 <?php }?>
						</tbody>
					</table>
                
</div>