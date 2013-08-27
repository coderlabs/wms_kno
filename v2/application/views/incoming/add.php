<div id="content">
	<?php echo form_open('incoming/insert_in'); ?>
    
		<strong>
		<font size="2pt">Format : No Flight / Tgl Manifest (ddmmYYYY) / No SMU / Koli / Berat
		<br>
		Contoh : GA077/17081945/11092900/2/100
		</font>
		</strong>
	  <table>
		<tr>
			<td>Incoming Manifest </td>
			<td>
			<input type="text" name="incoming" placeholder="" size="66">
			<br>
			</td>
        </tr>
		<tr>
			<td colspan=2><input type='submit' value='Save'></td>
		</tr>
      </table>
      <?php echo form_close(); ?>
</div>

