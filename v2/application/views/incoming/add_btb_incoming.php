<div id="content">
	<table>
	<?php 
		echo form_open('incoming/submit_incoming_btb'); 
		foreach ($result as $row)
		{
	?>
		<tr>
			<td>Agent </td>
			<td><?php 
					 foreach($agent as $row_agent)
					 {
						$var_agent[ $row_agent->btb_agent ] =  $row_agent->btb_agent;
					 } 
					 echo form_dropdown('agent' ,$var_agent ,$row->agent);
				?>
			</td>
		</tr>	
		<tr>
			<td>Airline </td>
			<td><input type="text" name="airline" value="<?php echo $row->airline;?>" ></td>
		</tr>	
		<tr>
			<td>Asal </td>
			<td><input type="text" name="asal" value="<?php echo $row->asal;?>" ></td>
		</tr>	
		<tr>
			<td>Tujuan </td>
			<td><input type="text" name="tujuan" value="<?php echo $row->tujuan;?>"></td>
		</tr>	
		<tr>
			<td>SMU </td>
			<td><input type="text" name="smu" value="<?php echo $row->no_smu;?>" readonly></td>
		</tr>	
		<tr>
			<td>Jenis Barang </td>
			<td>
			<?php 
				foreach($typebarang as $row_typebarang)
				{
					$var_typebarang[$row_typebarang->typebarang] = $row_typebarang->typebarang ;
				}
				echo form_dropdown('jenisbarang',$var_typebarang,$row->jenisbarang);
			?>
			</td>
		</tr>	
		<tr>
			<td>No Flight </td>
			<td><input type="text" name="noflight" value="<?php echo $row->noflight;?>" ></td>
		</tr>	
		<tr>
			<td>Tgl Manifest </td>
			<td><input type="text" name="tglmanifest" value="<?php echo $row->tglmanifest;?>" readonly></td>
		</tr>	
		<tr>
			<td>Koli </td>
			<td><input type="text" name="koli" value="<?php echo $row->kolidatang ?>" readonly></td>
		</tr>	
		<tr>
			<td>Berat  </td>
			<td><input type="text" name="berat" value="<?php echo $row->beratdatang;?>" readonly></td>
		</tr>	
		<tr>
			<td>Berat Bayar </td>
			<td><input type="text" name="beratbayar" value="<?php echo $row->totalberatbayar;?>" ></td>
		</tr>	
		<tr>
			<td colspan="2"> 
				<input type="hidden" name="id_manifestin" value="<?php echo $row->id_manifestin ?>" >
				<input type="hidden" name="id_isimanifestin" value="<?php echo $row->id_isimanifestin ?>" >
			</td>
		</tr>
		<tr>
			<td colspan="2"> <input type="submit" value="Print";> </td>
		</tr>
	<?php 
		}
		echo form_close();
	?>
	</table>
</div>

