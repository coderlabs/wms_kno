<div id="content">
	<?php echo form_open('incoming/save_isimanifestin'); 
		foreach($isimanifestin as $row)
		{
	?>
      <table>
		<tr>
			<td>ID manifestin</td>
			<td><input type="text" name="id_manifestin" value="<?php echo $row->id_manifestin; ?>"></td>
		</tr>
      	<tr>
			<td>ID isimanifestin</td>
			<td><input type="text" name="id_isimanifestin" value="<?php echo $row->id_isimanifestin; ?>"></td>
		</tr>
      	<tr>
			<td>No SMU</td>
			<td><input type="text" name="no_smu" value="<?php echo $row->no_smu; ?>"></td>
		</tr>
      	<tr>
			<td>Jenis Barang</td>
			<td><input type="text" name="jenisbarang" value="<?php echo $row->jenisbarang; ?>"></td>
		</tr>
		<tr>
			<td>Asal</td>
			<td><input type="text" name="asal" value="<?php echo $row->asal;?>"></td>
		</tr>
		<tr>
			<td>Tujuan</td>
			<td><input type="text" name="tujuan" value="<?php echo $row->tujuan;?>"></td>
		</tr>
		<tr>
			<td>Total Berat</td>
			<td><input type="text" name="totalberat" value="<?php echo $row->totalberat;?>"></td>
		</tr>
		<tr>
			<td>Total Koli</td>
			<td><input type="text" name="totalkoli" value="<?php echo $row->totalkoli;?>"></td>
		</tr>
		<tr>
			<td>Total Berat Bayar</td>
			<td><input type="text" name="totalberatbayar" value="<?php echo $row->totalberatbayar;?>"></td>
		</tr>
		<tr>
			<td>Status Transit</td>
			<td><input type="text" name="statustransit" value="<?php echo $row->statustransit;?>"></td>
		</tr>
		<tr>
			<td>Tgl Manifest</td>
			<td><input type="text" name="tglmanifest" value="<?php echo $row->tglmanifest;?>"></td>
		</tr>
		
		
      	<tr>
			<td colspan=2><input type='submit' value='Save'></td>
		</tr>
      </table>
      <?php 
	  }
	  echo form_close(); ?>
</div>

