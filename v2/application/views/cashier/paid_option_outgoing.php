<div id='content'>
	<p><b><?php echo 'BTB No : ' . $search . ' sudah terbayar '; ?></b></p>
    
    <ol>
    	<?php
		if($void == 'yes')
		{
			echo '<li>' . 'NPJG sudah di VOID'. '</li>';
		}
		else
		{
			echo '<li>' . anchor('cashier/print_pdf_dbo/'. $db, 'CETAK ULANG') . '</li>';
			echo '<li>' . anchor('cashier/void_dbo/'.$search.'/'.$db,'VOID'). '</li>';
		}
		?>
        
    </ol>
</div>
