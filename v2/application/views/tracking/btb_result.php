<div id="content">
	
    <h4>BTB <strong><?php echo strtoupper($type); ?></strong> Search Result</h4>
      <table>
      	<tr>
        	<th>Airline</th>
            <th>Flt No</th>
            <th>Date</th>
            <th>No BTB</th>
            <th>No SMU</th>
            <th>Agent</th>
            <th>Tujuan</th>
            <th>Koli</th>
            <th>Berat Aktual</th>
            
            <th>Berat Bayar</th>
            <th>Status Cetak</th>
            <th>Status Gudang</th>
            <th>Status Bayar</th>
            <th>Status BTB</th>
            
     	</tr>
      
      <?php if($type =='outgoing'){ ?>
      <?php foreach($query as $item): ?>
      <tr>
      	<td><?php echo $item->airline; ?></td>
        <td><?php echo $item->btb_flt; ?></td>
        <td><?php echo $item->btb_date; ?></td>
        <td><?php echo $item->btb_nobtb; ?></td>
        <td><?php echo $item->btb_smu; ?></td>
        <td><?php echo $item->btb_agent; ?></td>
        <td><?php echo $item->btb_tujuan; ?></td>
        <td><?php echo $item->btb_totalkoli; ?></td>
        <td><?php echo $item->btb_totalberat; ?></td>
        
        <td><?php echo $item->btb_totalberatbayar; ?></td>
        <td><?php if($item->posted=='1'){echo 'sudah dicetak';}else{echo 'belum dicetak';}; ?></td>
        <td><?php if($item->status_keluar=='INSTORE'){echo 'dalam gudang';}else{echo 'sudah keluar gudang';}; ?></td>
        <td><?php if($item->status_bayar=='yes'){echo 'sudah bayar';}else{echo 'belum bayar';}; ?></td>
        <td><?php if($item->isvoid=='1'){echo 'dibatalkan';}else{echo 'aktif';}; ?></td>
  	  </tr>
      <?php endforeach; ?>
      <?php }else{ ?>
      <?php foreach($query as $item): ?>
      <tr>
      	<td><?php echo $item->in_airline; ?></td>
        <td><?php echo $item->in_noflight; ?></td>
        <td><?php echo $item->in_tgl_manifest; ?></td>
        <td><?php echo $item->in_btb; ?></td>
        <td><?php echo $item->in_smu; ?></td>
        <td><?php echo $item->in_agent; ?></td>
        <td><?php echo $item->in_tujuan; ?></td>
        <td><?php echo $item->in_koli; ?></td>
        <td><?php echo $item->in_berat_datang; ?></td>
       
        <td><?php echo $item->in_berat_bayar; ?></td>
        <td><?php if($item->in_status_cetak=='1'){echo 'sudah dicetak';}else{echo 'belum dicetak';}; ?></td>
        <td></td>
        <td></td>
        <td></td>
  	  </tr>
      <?php endforeach; ?>
      <?php } ?>
      </table>
      
</div>

