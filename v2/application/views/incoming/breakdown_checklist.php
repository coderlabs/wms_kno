<div id="content">
<h2>Breakdown Check List</h2>
	
    <table>
    	<tr>
        	<td colspan="5" align="center"><strong>Rencana</strong></td>
            <td colspan="3" align="center"><strong>Aktual</strong></td>
        </tr>
    	<tr>
        	<td><strong>Flt No</strong></td>
            <td><strong>Tanggal</strong></td>
            <td><strong>No SMU</strong></td>
            <td><strong>Koli</strong></td>
            <td><strong>Berat</strong></td>
            <td><strong>Aktual Koli</strong></td>
            <td><strong>Aktual Berat</strong></td>
            <td><strong>Keterangan</strong></td>
        </tr>
    <?php if(isset($result)) { ?>
	<?php foreach($result as $row): ?>
    <?php $flt_no = $row->inb_flight_number; ?>
    <?php $date = $row->inb_flight_date; ?>
    
    
    	<tr>
        	<td align="center"><strong><?php echo strtoupper($row->inb_flight_number); ?></strong></td>
            <td align="center"><?php echo $row->inb_flight_date; ?></td>
        	<td align="center"><?php echo $row->inb_no_smu; ?></td>
            <td align="center"><?php echo $row->inb_koli; ?></td>
            <td align="center"><?php echo $row->inb_berat_aktual; ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
     
    <?php endforeach; ?>
   
    </table>
    
    <?php echo anchor('incoming/breakdown_checklist_pdf/' . $flt_no . '/' . $date . '/', 'Print', 'class="btn btn-primary"'); ?>
    <?php } ?>    
</div>	


