<div id="content">
<h2>Buildup Check List</h2>
	
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
    <?php 
	if($row->btb_flt == '')
	{
		$flt_no = $row->btb_flt;
	}
	else
	{
		$flt_no = $row->airline;
	}
	?>
    <?php $date = $row->btb_date; ?>
    
    
    	<tr>
        	<td align="center"><strong><?php echo strtoupper($row->btb_flt); ?></strong></td>
            <td align="center"><?php echo $row->btb_date; ?></td>
        	<td align="center"><?php echo $row->btb_smu; ?></td>
            <td align="center"><?php echo $row->btb_totalkoli; ?></td>
            <td align="center"><?php echo $row->btb_totalberat; ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
     
    <?php endforeach; ?>
   
    </table>
    
    <?php echo anchor('incoming/buildup_checklist_pdf/' . $flt_no . '/' . $date . '/', 'Print', 'class="btn btn-primary"'); ?>
    <?php } ?>    
</div>	


