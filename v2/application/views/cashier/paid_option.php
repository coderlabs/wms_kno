<div id='content'>
	<p><b><?php echo 'NPJG dengan BTB No : ' . $search . ' sudah terbayar '; ?></b></p>
    <p><b><?php echo anchor('cashier/reprint_db/'. $search, 'CETAK ULANG');?></b></p>
    <p><b><?php echo anchor('cashier/void_dbo/'.$search,'VOID'); ?></b></p>
</div>
