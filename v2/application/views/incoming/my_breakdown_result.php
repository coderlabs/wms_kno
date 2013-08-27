<div id="content">
	<h2>My Breakdown</h2>
	<table class="table table-hover">
		<thead>
			<tr>
                <th align="center">SMU</th>
				<th align="center">Airline</th>
                <th align="center">Flight</th>
				<th align="center">Tgl Breakdown</th>
                <th align="center">Koli</th>
				<th align="center">Berat Aktual</th>
                <th align="center">Status Barang</th>
                <th align="center">Status Bayar</th>
				<th align="center">Checker</th>
                <th align="center">Action</th>
			</tr>
		</thead>
		<tbody>
        	<?php if(isset($result)) { ?>
			<?php foreach($result as $row): ?>
            
			<tr>
				<td align="center"><?php echo $row->inb_no_smu;?></td>
				<td align="center"><?php echo strtoupper($row->inb_airlines);?></td>
                <td align="center"><?php echo strtoupper($row->inb_flight_number);?></td>
				<td align="center"><?php echo $row->inb_update_on;?></td>
                <td align="center"><?php echo $row->inb_koli;?></td>
				<td align="center"><?php echo $row->inb_berat_aktual;?></td>
                <td align="center">
                		<?php
						if($row->inb_status_gudang == 'instore')
						{
							echo "Dalam Gudang";
						}
						elseif($row->inb_status_gudang == 'outstore')
						{
							echo "Belum Datang";
						}
						else
						{
							echo "Sudah Diambil";
						}
						?>
                </td>
                <td align="center">
                	<?php
						if($row->in_status_bayar == 'yes')
						{
							echo "Sudah Bayar";
						}
						else
						{
							echo "Belum Bayar";
						}
						?>
                </td>
				<td align="center"><?php echo $row->inb_update_by;?></td>
                <td align="center">
                	<?php 
					if($row->inb_status_gudang == 'instore' )
						{
							if($row->in_status_bayar == 'no')
							{
								echo anchor('incoming/void_breakdown/' . $row->inb_id, 'Void', 'class="btn btn-danger"');
							}
						}
					?>
                </td>
			</tr>
			<?php endforeach; ?>
            <?php } ?>
		</tbody>
	  </table>
     

</div>	



