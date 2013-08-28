<div id='content'>
	<p><h2>NPJG Incoming : <?php echo $nodb; ?></h2></p>
	<p>
    <b><?php 
	if($nodb == NULL)
	{
		echo 'Error !! Jangan gunakan tombol refresh.';
	}
	else
	{
		echo anchor('cashier/print_pdf_dbi/'.$nodb,'PRINT NPJG ', 'class="btn btn-warning"'); 
	}
	?></b>
    &nbsp; &nbsp;
    <b><?php echo anchor('cashier/new_receipt','NPJG Baru', 'class="btn btn-success"'); ?></b>
    </p>
					
</div>
