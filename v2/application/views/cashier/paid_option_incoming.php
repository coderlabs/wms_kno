<div id='content'>
	<p><b><?php echo 'BTB No : ' . $search . ' sudah terbayar '; ?></b></p>
    <p><strong>Pilihan yang tersedia</strong></p>
    <ol>
    	<li><?php #echo anchor('cashier/reprint_db/'. $search, 'CETAK ULANG');?></li>
        <li><?php echo anchor('cashier/void_dbi/'.$search,'VOID'); ?></li>
    </ol>
</div>
