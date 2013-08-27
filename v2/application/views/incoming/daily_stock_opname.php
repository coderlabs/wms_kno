<div id="content">
	<h2>Stock Opname Harian</h2>
	<table class="table table-hover">
		<thead>
			<tr>
                <th align="center">BTB</th>
                <th align="center">SMU</th>
				<th align="center">Airline</th>
                <th align="center">Flight</th>
				<th align="center">Tgl Tiba</th>
                <th align="center">Koli</th>
				<th align="center">Berat</th>
                <th align="center">Agen</th>
                <th align="center">Komoditi</th>
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
				<td align="center"><?php echo $row->in_btb;?></td>
                <td align="center"><?php echo $row->inb_no_smu;?></td>
				<td align="center"><?php echo strtoupper($row->inb_airlines);?></td>
                <td align="center"><?php echo strtoupper($row->inb_flight_number);?></td>
				<td align="center"><?php echo mdate("%d-%m-%Y %H:%i:%s", strtotime($row->inb_instore));?></td>
                <td align="center"><?php echo $row->inb_koli;?></td>
				<td align="center"><?php echo $row->inb_berat_aktual;?></td>
                <td align="center"><?php echo $row->in_agent;?></td>
                <td align="center"><?php echo $row->in_jenisbarang;?></td>
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
								#echo anchor('incoming/form_create_btb/' . $row->inb_id, 'Cetak BTB', 'class="btn btn-success"');
							}
							else
							{
								echo anchor('incoming/stock_opname_pick_up/' . $row->inb_id, 'Keluar Gudang', 'class="btn btn-warning"');
								#echo anchor('incoming/form_create_btb/' . $row->inb_id, 'Cetak BTB', 'class="btn btn-success"');
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



