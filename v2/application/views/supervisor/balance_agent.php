
<div id="content">
<?php foreach($agent as $row)
	{ ?>
	<h2>Balance Agent <?php echo $row->btb_agent;?></h2>
	<?php echo form_open('supervisor/add_balance');
		echo form_hidden('id_agent',$row->id_agent)?>
		<table>
    	<tr>
            <td><strong>Add Balance</strong></td><td><input type="text" name="balance"></td>
		</tr>
		<tr>
			<td colspan="2" align="right"><input type="submit" name="submit" value="Submit" class="btn-primary pull-right"></td>
		</tr>
		</table>
	</form>
	

<?php } ?>
    <table>
	<thead>
    	<tr>
        	<th><strong>No</strong></th>
            <th><strong>Debet</strong></th>
            <th><strong>Kredit</strong></th>
            <th><strong>Balance</strong></th>
            <th><strong>Keterangan</strong></th>
        </tr>
	</thead>
	<tbody>
	<?php 
	$number = $offset + 1;	
	foreach($result as $row){?>
		<tr>
        	<td><?php echo $number++; ?></td>
            <td align="right"><?php echo number_format($row->debet, 0, ',', '.'); ?></td>
            <td align="right"><?php echo number_format($row->kredit, 0, ',', '.'); ?></td>
            <td align="right"><?php echo number_format($row->balance, 0, ',', '.'); ?></td>
            <td align="right"><?php echo $row->ket; ?></td>
        </tr>
	<?php } ?>
	</tbody>
	<tfoot>
		<tr>
        	<td colspan="9"><center><?php echo $this->pagination->create_links();?></center></td>
        </tr>
	</tfoot>
   
    </table>
     
</div>	


