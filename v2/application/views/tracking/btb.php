<div id="content">
<h2>Pencarian Bukti Timbang Barang (BTB)</h2>
	<?php echo form_open('tracking/btb_search'); ?>
      <table border="0">
      	<tr>
        	<td>No BTB</td>
            <td><input type='text' name='no_btb'></td>
     	</tr>
        <tr>
            <td>Type</td>
            <td>
                <select name="type">
                    <option name="outgoing">outgoing</option>
                    <option name="incoming" selected="selected">incoming</option>
                </select>
            </td>
        </tr>
      <tr>
      	<td colspan="2"><input type='submit' value='Search' class="btn btn-primary"></td>
      </tr>
      </table>
      <?php echo form_close(); ?>
</div>

