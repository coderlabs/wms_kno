
<div id="content">
<h4>Add Agent</h4>
<?php echo form_open('supervisor/add_agent')?>
    <table>
    	<tr>
            <td><strong>Agent</strong></td><td><input type="text" name="agent"></td>
		</tr><tr>
            <td><strong>Nama Agent</strong></td><td><input type="text" name="full"></td>
		</tr><tr>
            <td><strong>Alamat</strong></td><td><input type="text" name="address"></td>
		</tr><tr>
            <td><strong>Telp</strong></td><td><input type="text" name="phone"></td>
		</tr><tr>
            <td><strong>Fax</strong></td><td><input type="text" name="fax"></td>
		</tr><tr>
            <td><strong>Contact Person</strong></td><td><input type="text" name="cp"></td>
		</tr><tr>
            <td><strong>NPWP</strong></td><td><input type="text" name="npwp"></td>
        </tr>
		<tr>
			<td colspan="2" align="right"><input type="submit" name="submit" value="Submit" class="btn-primary pull-right"></td>
		</tr>
    </table>
 </form>    


