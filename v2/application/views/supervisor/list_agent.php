
<div id="content">
<h2>Agent List</h2>
	
    <table>
	<thead>
    	<tr>
        	<th><strong>No</strong></th>
            <th><strong>Agent</strong></th>
            <th><strong>Nama Agent</strong></th>
            <th><strong>Alamat</strong></th>
            <th><strong>Telp</strong></th>
            <th><strong>Fax</strong></th>
            <th><strong>Contact Person</strong></th>
            <th><strong>NPWP</strong></th>
            <th><strong>Action</strong></th>
        </tr>
	</thead>
	<tbody>
	<?php 
	$number = $offset + 1;	
	foreach($result as $row){?>
		<tr>
        	<td><?php echo $number++; ?></td>
            <td><?php echo $row->btb_agent; ?></td>
            <td><?php echo $row->agentfullname; ?></td>
            <td><?php echo $row->address; ?></td>
            <td><?php echo $row->phone; ?></td>
            <td><?php echo $row->fax; ?></td>
            <td><?php echo $row->contactpeson; ?></td>
            <td><?php echo $row->npwp; ?></td>
            <td>
				<?php 
					echo anchor('supervisor/edit_agent/'.$row->id_agent,'Edit ');
					echo anchor('supervisor/delete_agent/'.$row->id_agent,'Delete ');
					echo anchor('supervisor/balance_agent/'.$row->id_agent,'Balance');
				?>
			</td>
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


