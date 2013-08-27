<div id="content">
	<?php 	echo form_open('incoming/search_form_breakdown');?>
			<input type="text" name="no_flight" placeholder="no flight">
			<input type="submit" value="search">
			<input type="button" onclick="printDiv('printableArea')" value="Print" />
	<?php	
			echo form_close();?>
<div id="printableArea" >    
	<table>
		<thead>
			<tr>
				<td align="center" rowspan="2" width="200px">No SMU</td>
				<td align="center" colspan="2">Manifest</td>
				<td align="center" colspan="2">Aktual</td>
				<td rowspan="2"> Action </td>
			</tr>
			<tr>
				<td align="center" width="70px">Koli</td>
				<td align="center" width="70px">Berat</td>
				<td align="center" width="70px">Koli</td>
				<td align="center" width="70px">Berat</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach($result as $row){
			
			echo form_open('incoming/save_breakdown');
			?>
			<tr>
				<td><?php echo $row->no_smu; ?>
					<input type="hidden" name="id_isimanifestin" value="<?php echo $row->id_isimanifestin; ?>" > 
					<input type="hidden" name="id_manifestin" value="<?php echo $row->id_manifestin; ?>" > 
					<input type="hidden" name="no_flight" value="<?php echo $no_flight; ?>" > 
					<input type="hidden" name="smu" value="<?php echo $row->no_smu; ?>" > 
				</td>
				<td><?php echo $row->totalkoli; ?></td>
				<td><?php echo $row->totalberat; ?></td>
				<td><input type="text" name="koli" value="<?php echo $row->totalkoli; ?>" ></td>
				<td><input type="text" name="berat" value="<?php echo $row->totalberat; ?>" ></td>
				<td><input type="submit" value="OK" ></td>
			</tr>
			<?php 
			echo form_close();
			} ?>
		</tbody>
	  </table>
     
</div>
</div>	


