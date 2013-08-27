<div id="content">
	<?php echo form_open('incoming/edit_data_manifestin'); 
		foreach ($manifest as $row){
	?>
      <table>
      	<tr>
			<td>Id Manifestin</td>
        	<td><input type="text" name="id_manifestin"  value="<?php echo $row->id_manifestin; ?>" size="10"></td>
        </tr>
		<tr>
			<td>Airline</td>
			<td><input type="text" name="airline"  value="<?php echo $row->airline; ?>"></td>
		</tr>
		<tr>
			<td>No Flight</td>
			<td><input type="text" name="no_flight"  value="<?php echo $row->noflight; ?>"></td>
		</tr>
		<tr>
			<td>Tgl Manifest</td>
			<td><input type="text" name="tglmanifest" placeholder="YYYY-mm-dd" value="<?php echo $row->tglmanifest; ?>"></td>
		</tr>
		<tr>
			<td>Ac Regristration</td>
			<td><input type="text" name="acregistration"  value="<?php echo $row->acregistration; ?>"></td>
		</tr>
		
		
		<tr>
			<td colspan=2><input type='submit' value='Save'></td>
		</tr>
      </table>
      <?php 
		}
	  echo form_close(); 
	  ?>
</div>

