<div id="content">
	<?php echo form_open('incoming/insert_in'); ?>
      <table>
		<thead>
			<tr>
				<td>Airline</td>
				<td>No Flight</td>
				<td>Tgl Manifest</td>
				<td>Ac Registration</td>
				<td>Koli</td>
				<td>Berat</td>
				<td>Detail</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach($result as $row){?>
			<tr>
				<td><?php echo $row->airline; ?></td>
				<td><?php echo $row->noflight; ?></td>
				<td><?php echo $row->tglmanifest; ?></td>
				<td><?php echo $row->acregistration; ?></td>
				<td><?php echo $row->koli; ?></td>
				<td><?php echo $row->berat; ?></td>
				<td><?php echo "detail"; ?></td>
			</tr>
			<?php } ?>
		</tbody>
	  </table>
      <?php echo form_close(); ?>
</div>

