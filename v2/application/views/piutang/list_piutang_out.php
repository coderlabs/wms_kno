<div id='content'>
            	<h2>SEARCH PIUTANG OUTBOUND</h2>
					
                    <?php 
							echo form_open('piutang/do_search_piutang_out');
					?>
                    
                      <input name="agent" size=40 placeholder="nama agent" type="text">
                    <?php 
						echo form_submit('submit', 'SEARCH' ); 
						echo form_close();
					?>
					 
					<table>
						<thead>
						<tr>
							<th>No</th>
							<th>Tgl BTB</th>
							<th>Agent</th>
							<th>No. BTB</th>
							<th>No. SMU</th>
							<th>Airline</th>
							<th>Tujuan</th>
							
						</tr>
						</thead>
						<tfoot>
						<tr><td colspan=7><center><div class="pagination"><?php echo $this->pagination->create_links();?></div></center></td></tr>
						</tfoot>
						<tbody>
					 <?php 
					 $num = $offset+1;
					 foreach ($result as $row)
					 { ?>
						<tr>
							<td><?php echo $num++?></td>
							<td><?php echo $row->btb_date?></td>
							<td><?php echo $row->btb_agent?></td>
							<td><?php echo $row->btb_nobtb?></td>
							<td><?php echo $row->btb_smu?></td>
							<td><?php echo $row->airline?></td>
							<td><?php echo $row->btb_tujuan?></td>
						</tr>
					 <?php }?>
						</tbody>
					</table>
				
				 <?php echo anchor('piutang/pdf_piutang_outgoing/'.$agent.'/', '<i class="icon-print"></i> EXPORT TO PDF'); ?>
                
</div>