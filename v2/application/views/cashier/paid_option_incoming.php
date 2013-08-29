<div id='content'>
	<p><b><?php echo 'BTB No : ' . $search . ' sudah terbayar '; ?></b></p>
    <p><strong>Pilihan yang tersedia</strong></p>
    <ol>
    	<li><?php echo anchor('cashier/print_pdf_dbi/'. $db, 'CETAK ULANG');?></li>
        <li><?php echo anchor('cashier/void_dbi/'.$search.'/'.$db,'VOID'); ?></li>
    </ol>
</div>
