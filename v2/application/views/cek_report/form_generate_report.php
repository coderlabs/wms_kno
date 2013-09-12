<div id="content">
	<?php echo form_open('cek_report/generate_report'); ?>
   <h2>Cek Report Incoming</h2>
      <table>
		
        <tr>
        	<td>Date</td><td><input type="text" name="date" id="datepicker" placeholder="select date"></td>
        </tr>
        
        <tr>
        	<td>&nbsp;</td>
            <td><input type='submit' value='Print' class="btn btn-primary"></td>
        </tr>
		
      </table>
      <?php echo form_close(); ?>
</div>

