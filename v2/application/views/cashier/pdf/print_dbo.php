<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hospitality Service Traveller Detail | PT Gapura Angkasa Denpasar</title>
<style type="text/css">

html {
	margin : 0px;
}

table.gridtable {
	font-family: times,arial,sans-serif;
	font-size:12px;
	color:#333333;
	border-width: 0px;
	border-color: #666666;
	border-collapse: collapse;
	width:70mm;
	
}
table.gridtable th {
	border-width: 0px;
	padding: 4px;
	border-style: solid;
	border-color: #666666;
	background-color: #dedede;
}
table.gridtable td {
	border-width: 0px;
	padding: 2px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
	text-align: left;
}
</style>

</head>
<body>
<table class="gridtable">
<?php foreach($query as $db)
	{?>
	<tr>
		<td><?php #echo '010-900-'.$db->nofaktur;?></td>
		<td></td>
		<td><?php #echo 'No. DBO '.$db->nodb; ?></td>
	</tr>
	<tr>
		<td colspan="3"><center>PT. GAPURA ANGKASA</center></td>
	</tr>
	<tr>
		<td colspan="3"><center>GEDUNG DANPERA LT 1,2 & 3 KOTA BARU</center></td>
	</tr>
	<tr>
		<td colspan="3"><center>BANDAR KEMAYORAN BLOK B 12 KAV No.8</center></td>
	</tr>
	<tr>
		<td colspan="3"><center>KEMAYORAN JAKARTA PUSAT 10610</center></td>
	</tr>
	<tr>
		<td colspan="3"><center>NPWP : 01.061.170.5-093.000</center></td>
	</tr>
	<tr>
		<td colspan="3"><center><hr/></center></td>
	</tr>
	<tr>
		<td colspan="3"><center>NOTA PEMBAYARAN JASA GUDANG</center></td>
	</tr>
	<?php if($db->posted == 1) {?>
	<tr>
		<td colspan="3"><center>(Reprinted Version)</center></td>
	</tr>
	<?php }?>
	<tr>
		<td colspan="3"><center><hr/></center></td>
	</tr>
	<!-- PENGIRIRIM -->
	<tr>
		<td colspan="3"><center>PENGIRIM</center></td>
	</tr>
	<tr>
		<td>Nama</td><td>:</td><td><?php echo $db->btb_agent;?></td>
	</tr>
	<tr>
		<td>NPWP</td><td>:</td><td><?php echo $db->npwp;?></td>
	</tr>
	<tr>
		<td>Alamat</td><td>:</td><td><?php echo $db->address;?></td>
	</tr>
	<tr>
		<td colspan="3"><br/><center>DATA BARANG</center></td>
	</tr>
    <tr>
		<td>No. NPJG</td><td>:</td><td><?php echo 'DBO-'.$db->nodb; ?></td>
	</tr>
	<tr>
		<td>No. BTB</td><td>:</td><td><?php echo $db->no_smubtb;?></td>
	</tr>
    <tr>
		<td>No. SMU</td><td>:</td><td><?php echo $db->nosmu;?></td>
	</tr>
	<tr>
		<td>Tujuan Airport</td><td>:</td><td><?php echo $db->btb_tujuan;?></td>
	</tr>
	<tr>
		<td>Tgl Masuk/Keluar</td><td>:</td><td><?php echo mdate('%d-%m-%Y',strtotime($db->btb_date)).'/'.mdate('%d-%m-%Y',strtotime($db->tglbayar));?></td>
	</tr>
	<tr>
		<td>Koli/Berat Aktual</td><td>:</td><td><?php echo $db->btb_totalkoli.' Koli / '.$db->btb_totalberat.' Kg';?></td>
	</tr>
	<tr>
		<td>Koli/Berat Bayar</td><td>:</td><td><?php echo $db->btb_totalkoli.' Koli / '.$db->btb_totalberatbayar.' Kg';?></td>
	</tr>	
	<tr>
		<td colspan="3"><br/><center>PERINCIAN BIAYA</center></td>
	</tr>
	<tr>
		<td>Jumlah Hari</td><td>:</td><td><?php echo $db->hari;?> Hari</td>
	</tr>
	<tr>
		<td>Sewa Gudang</td><td>:</td><td>Rp. <?php echo number_format($db->sewagudang+$db->cargo_charge,2,'.',',');?></td>
	</tr>
	<tr>
		<td>Administrasi</td><td>:</td><td>Rp. <?php echo number_format($db->document,2,'.',',');?></td>
	</tr>
	<tr>
		<td>Diskon</td><td>:</td><td>Rp. <?php echo number_format($db->diskon,2,'.',',');?></td>
	</tr>
	<tr>
		<td>PPn (10%)</td><td>:</td><td>Rp. <?php echo number_format($db->lain,2,'.',',');?></td>
	</tr>
	<tr>
		<td>Total</td><td>:</td><td>Rp. <?php echo number_format($db->total_biaya,2,'.',',');?></td>
	</tr>
	<tr>
		<td>Terbilang</td><td>:</td><td></td>
	</tr>
	<tr>
		<td colspan="3"><div align="center"><b><?php echo strtoupper($terbilang);?></b></div></td>
	</tr>
	<tr>
		<td></td><td></td><td><br/><center><?php echo mdate('%d-%m-%Y %h:%i',strtotime($db->tglbayar));?></center></td>
	</tr>
	<tr>
		<td><center>Kasir</center></td><td></td><td><center>Pengirim</center></td>
	</tr>
	<tr>
		<td height="35px"></td><td></td><td></td>
	</tr>
	<tr>
		<td><center><?php echo strtoupper($db->user);?></center></td><td></td><td><center>_________________</center></td>
	</tr>
	<tr>
		<td colspan="3"><center><br/>TERIMA KASIH</center></td>
	</tr>
	<tr>
		<td colspan="3"><div align="right">KNO</div></td>
	</tr>
	
	<?php } ?>
</table>
</body>
</html>