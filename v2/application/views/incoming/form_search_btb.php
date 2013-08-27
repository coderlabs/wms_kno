<div id="content">
	<h2>Pencarian Berdasarkan No SMU</h2>
	<?php 	echo form_open('incoming/search_btb');?>
    		<div class="input-append">
			<input type="text" name="smu" placeholder="masukan no smu">
			<input type="submit" value="search" class="btn btn-primary">
            </div>
	<?php	echo form_close();?>
   
	<table>
		<thead>
			<tr>
                <th>SMU</th>
				<th>Airline</th>
				<th>Tgl Manifest</th>
                <th>Koli</th>
				<th>Berat Aktual</th>
                <th>Status Gudang</th>
				<th>Checker</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($result as $row): ?>
			<tr>
				<td><?php echo $row->inb_no_smu;?></td>
				<td><?php echo strtoupper($row->inb_airlines);?></td>
				<td><?php echo $row->inb_update_on;?></td>
                <td><?php echo $row->inb_koli;?></td>
				<td><?php echo $row->inb_berat_aktual;?></td>
                <td>Barang di Gudang<td>
				<td><?php echo $row->inb_update_by;?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	  </table>
     

</div>	



