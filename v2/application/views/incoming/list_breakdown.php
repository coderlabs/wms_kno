<div id="content">
	<?php 	echo form_open('incoming/search_breakdown');?>
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
			</tr>
			<tr>
				<td align="center" width="70px">Koli</td>
				<td align="center" width="70px">Berat</td>
				<td align="center" width="70px">Koli</td>
				<td align="center" width="70px">Berat</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach($result as $row){?>
			<tr>
				<td><?php echo $row->no_smu; ?></td>
				<td><?php echo $row->totalkoli; ?></td>
				<td><?php echo $row->totalberat; ?></td>
				<td></td>
				<td></td>
			</tr>
			<?php } ?>
		</tbody>
	  </table>
     
</div>
</div>	


