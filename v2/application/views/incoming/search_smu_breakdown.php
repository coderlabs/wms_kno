<div id="content">
	<?php 
		echo form_open('incoming/search_smu_breakdown');
	?>
		<table>
			<tr>
				<td>No SMU</td>
				<td><input type="text" name="smu" ></td>
				<td><input type="submit" value="Search"></td>
			</tr>
		</table>
	<?php 
	
		echo form_close();
	?>
</div>

