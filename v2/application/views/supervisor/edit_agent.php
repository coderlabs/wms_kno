
<div id="content">
<h4>Add Agent</h4>
<?php foreach ($agent as $row) {?>
<?php echo form_open('supervisor/update_data_agent');
	echo form_hidden('id_agent', $row->id_agent);?>
    <table>
    	<tr>
            <td><strong>Agent</strong></td><td><input type="text" name="agent" value="<?php echo $row->btb_agent?>"></td>
		</tr><tr>
            <td><strong>Nama Agent</strong></td><td><input type="text" name="full" value="<?php echo $row->agentfullname?>"></td>
		</tr><tr>
            <td><strong>Alamat</strong></td><td><input type="text" name="address" value="<?php echo $row->address?>"></td>
		</tr><tr>
            <td><strong>Telp</strong></td><td><input type="text" name="phone" value="<?php echo $row->phone?>"></td>
		</tr><tr>
            <td><strong>Fax</strong></td><td><input type="text" name="fax" value="<?php echo $row->fax?>"></td>
		</tr><tr>
            <td><strong>Contact Person</strong></td><td><input type="text" name="cp" value="<?php echo $row->contactpeson?>"></td>
		</tr><tr>
            <td><strong>NPWP</strong></td><td><input type="text" name="npwp" value="<?php echo $row->npwp?>"></td>
        </tr>
		<tr>
			<td colspan="2" align="right"><input type="submit" name="submit" value="Submit" class="btn-primary pull-right"></td>
		</tr>
    </table>
 </form> <? } ?> 


