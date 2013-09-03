<div id="content">
<h2>Duplikat SMU</h2>
	
    <table>
    	<tr>
        	<th>SMU</th>
            <th>BTB</th>
            <th>Airlines</th>
            <th>Flt No</th>
            <th>Asal</th>
            <th>Tujuan</th>
            <th>Agen</th>
            <th>Jenis</th>
            <th>Koli</th>
            <th>Berat Datang</th>
            <th>Berat Bayar</th>
            <th>Status Cetak</th>
            <th>Status Bayar</th>
            <th>Status Gudang</th>
            <th>Action</th>
        </tr>
    <?php foreach($result as $row): ?>
    	<tr>
        	<td><?php echo $row->inb_no_smu; ?></td>
            <td><?php echo $row->in_btb; ?></td>
            <td><?php echo strtoupper($row->inb_airlines); ?></td>
            <td><?php echo $row->in_noflight; ?></td>
            <td><?php echo $row->in_asal; ?></td>
            <td><?php echo $row->in_tujuan; ?></td>
            <td><?php echo strtoupper($row->in_agent); ?></td>
            <td><?php echo strtoupper($row->in_jenisbarang); ?></td>
            <td><?php echo $row->inb_koli; ?></td>
            <td><?php echo $row->inb_berat_aktual; ?></td>
            <td><?php echo $row->in_berat_bayar; ?></td>
            <td><?php echo $row->in_status_cetak; ?></td>
            <td><?php echo $row->in_status_bayar; ?></td>
            <td><?php echo $row->inb_status_gudang; ?></td>
            <td>
				<?php 
					if($row->in_status_bayar == 'no' OR $row->in_btb == NULL)
					{
						echo anchor('incoming/void_smu/' . $row->inb_id,'Void SMU');
					}
				?>
          	</td>
        </tr>
        
    <?php endforeach; ?>
    </table>
</div>	


