<div id="content">
	<?php 
		echo form_open('incoming/insert_breakdown'); 
	?>
		  <table>
			<tr>
				<td>Breakdown </td>
				<td>
				<input type="text" name="breakdown" placeholder="" size="77">
				<br>
				Format : no smu/koli/berat
				Contoh : 11092900/2/100
				</td>
			</tr>
			<tr>
				<td colspan=2><input type='submit' value='Save'></td>
			</tr>
		  </table>
	<?php 
		echo form_close();
	?>
</div>

