<div id="content">
<h2>Duplikat BTB ( SMU yang memiliki lebih dari 1 BTB )</h2>
	
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
            <th>Action</th>
        </tr>
    <?php foreach($result as $row): ?>
    	<tr>
        	<td><?php echo $row->in_smu; ?></td>
            <td><?php echo $row->in_btb; ?></td>
            <td><?php echo $row->in_airline; ?></td>
            <td><?php echo $row->in_noflight; ?></td>
            <td><?php echo $row->in_asal; ?></td>
            <td><?php echo $row->in_tujuan; ?></td>
            <td><?php echo $row->in_agent; ?></td>
            <td><?php echo $row->in_jenisbarang; ?></td>
            <td><?php echo $row->in_koli; ?></td>
            <td><?php echo $row->in_berat_datang; ?></td>
            <td><?php echo $row->in_berat_bayar; ?></td>
            <td><?php echo $row->in_status_cetak; ?></td>
            <td><?php echo $row->in_status_bayar; ?></td>
            <td><?php #echo $row->inb_status_gudang; ?></td>
        </tr>
        
    <?php endforeach; ?>
    </table>
</div>	


