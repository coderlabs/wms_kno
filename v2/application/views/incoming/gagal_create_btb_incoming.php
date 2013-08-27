	
<script type="text/javascript">
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>	

<div id="content">
	Pencetakan BTB Gagal<br>
	Silahkan data dilengkapi terlebih dahulu <br>
	<?php echo anchor($link,'klik di sini !!!! '); ?>
	<br>
</div>