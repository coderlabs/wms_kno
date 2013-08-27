<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hospitality Service Traveller Detail | PT Gapura Angkasa Denpasar</title>

<style type="text/css">
table.gridtable {
	font-family: verdana,arial,sans-serif;
	font-size:13px;
	color:#333333;
	border-width: 1px;
	border-color: #666666;
	border-collapse: collapse;
	
}
table.gridtable th {
	border-width: 1px;
	padding: 4px;
	border-style: solid;
	border-color: #666666;
	background-color: #dedede;
}
table.gridtable td {
	border-width: 1px;
	padding: 4px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
	text-align: right;
}

table.gridtable2 {
	font-family: verdana,arial,sans-serif;
	font-size:13px;
	color:#333333;
	border-width: 1px;
	border-color: #666666;
	border-collapse: collapse;
	
}
table.gridtable2 th {
	border-width: 1px;
	padding: 4px;
	border-style: solid;
	border-color: #666666;
	background-color: #dedede;
}
table.gridtable2 td {
	border-width: 1px;
	padding: 4px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
	text-align: right;
}
table.footer {
font-family: verdana,arial,sans-serif;
	font-size:8px;
	color:#333333;
}
table.header {
font-family: verdana,arial,sans-serif;
	font-size:13px;
	color:#333333;
}
table.sign{
	font-family: verdana,arial,sans-serif;
	font-size:13px;
	color:#333333;
	border-color: #666666;
	border-collapse: collapse;
	margin-top:30px;
}
table.sign td{
	font-family: verdana,arial,sans-serif;
	font-size:13px;
	color:#333333;
	border-color: #666666;
	border-collapse: collapse;
	text-align:center;
}
</style>
	
</head>
<body>
<h2>Laporan Pendapatan Sewa Gudang Domestik</h2>

<table class="header">
<tr>
	<td>Tanggal</td><td> : </td><td><?php echo mdate('%d-%M-%Y', strtotime($report_detail['p_rep_start_date'])).' s/d '.mdate('%d-%M-%Y', strtotime($report_detail['p_rep_end_date'])); ?></td>
</tr>
<tr>
	<td>Tipe Bayar</td><td> : </td><td><?php echo ucfirst($report_detail['p_rep_paid_type']);?></td>
</tr>
<tr>
	<td>Airline</td><td> : </td><td><?php echo ucfirst($report_detail['p_rep_airline']);?></td>
</tr>
<tr>
	<td>Agent</td><td> : </td><td><?php echo ucfirst($report_detail['p_rep_agent']);?></td>
</tr></table>
<table width="100%">
<?php if(isset($outgoing))
{ ?>
<tr>
	<td><h3>Outgoing Report</h3></td>
</tr>
<tr><td>
<table border="1" align="left" class="gridtable" width="80%">

	<tr>
		<th>No.</th>
		<th>Tanggal</th>
		<th>Koli</th>
		<th>Berat (Kg)</th>
		<th>Sewa Gudang (Rp)</th>
		<th>Administrasi (Rp)</th>
		<th>PPn (Rp)</th>
		<th>Total (Rp)</th>
	</tr>
	<tbody> 
<?php
$number = 1;
$total_koli = 0;
$total_weight = 0;
$total_sg = 0;
$total_adm = 0;
$total_ppn = 0;
$total_all = 0;
foreach($outgoing as $ro){?>
	<tr>
		<td><center><?php echo $number++?></center></td>
		<td><?php echo $ro->prd_date;?></td>
		<td><?php echo $ro->total_koli;?></td>
		<td><?php echo number_format($ro->total_weight,2,",",".");?></td>
		<td><?php echo number_format($ro->total_sg,2,",",".");?></td>
		<td><?php echo number_format($ro->total_adm,2,",",".");?></td>
		<td><?php echo number_format($ro->total_ppn,2,",",".");?></td>
		<td><?php echo number_format($ro->total_all,2,",",".");?></td>
	</tr>
<?php 
$total_koli = $total_koli + $ro->total_koli;
$total_weight = $total_weight + $ro->total_weight;
$total_sg = $total_sg + $ro->total_sg;
$total_adm = $total_adm + $ro->total_adm;
$total_ppn = $total_ppn + $ro->total_ppn;
$total_all = $total_all + $ro->total_all;
}?> 
	</tbody>
	<tfoot>
	<tr>
		<td colspan="2">Total</td>
		<td><?php echo $total_koli;?></td>
		<td><?php echo number_format($total_weight,2,",",".");?></td>
		<td><?php echo number_format($total_sg,2,",",".");?></td>
		<td><?php echo number_format($total_adm,2,",",".");?></td>
		<td><?php echo number_format($total_ppn,2,",",".");?></td>
		<td><?php echo number_format($total_all,2,",",".");?></td>
	</tr>
	</tfoot>
</table>
</td></tr>
<?php }?>


<?php if(isset($incoming))
{ ?>
<tr><td>
<h3>Incoming Report</h3></td>
</tr>
<tr><td>
<table border="1" class="gridtable2" width="80%">

	<tr>
		<th>No.</th>
		<th>Tanggal</th>
		<th>Koli</th>
		<th>Berat (Kg)</th>
		<th>Sewa Gudang (Rp)</th>
		<th>Administrasi (Rp)</th>
		<th>PPn (Rp)</th>
		<th>Total (Rp)</th>
	</tr>
	<tbody> 
<?php
$number = 1;
$total_koli = 0;
$total_weight = 0;
$total_sg = 0;
$total_adm = 0;
$total_ppn = 0;
$total_all = 0;
foreach($incoming as $ro){?>
	<tr>
		<td><center><?php echo $number++?></center></td>
		<td><?php echo $ro->prd_date;?></td>
		<td><?php echo $ro->total_koli;?></td>
		<td><?php echo number_format($ro->total_weight,2,",",".");?></td>
		<td><?php echo number_format($ro->total_sg,2,",",".");?></td>
		<td><?php echo number_format($ro->total_adm,2,",",".");?></td>
		<td><?php echo number_format($ro->total_ppn,2,",",".");?></td>
		<td><?php echo number_format($ro->total_all,2,",",".");?></td>
	</tr>
<?php 
$total_koli = $total_koli + $ro->total_koli;
$total_weight = $total_weight + $ro->total_weight;
$total_sg = $total_sg + $ro->total_sg;
$total_adm = $total_adm + $ro->total_adm;
$total_ppn = $total_ppn + $ro->total_ppn;
$total_all = $total_all + $ro->total_all;
}?> 
	</tbody>
	<tfoot>
	<tr>
		<td colspan="2">Total</td>
		<td><?php echo $total_koli;?></td>
		<td><?php echo number_format($total_weight,2,",",".");?></td>
		<td><?php echo number_format($total_sg,2,",",".");?></td>
		<td><?php echo number_format($total_adm,2,",",".");?></td>
		<td><?php echo number_format($total_ppn,2,",",".");?></td>
		<td><?php echo number_format($total_all,2,",",".");?></td>
	</tr>
	</tfoot>
</table>
</td></tr>
<?php }?>
<tr><td>
<table width="80%" class="sign">
<tr>
<td width="33%">
	Diperiksa Oleh Manager :
</td>
<td width="33%">
	Diperiksa Oleh Supervisor :
</td>
<td width="33%">
	Dibuat Oleh :
</td>
</tr>
<tr>
<td height="70px">
</td>
<td height="70px">
</td>
<td height="70px">
</td>
</tr>
<tr>
<td>
	(....................................)
</td>
<td>
	(....................................)
</td>
<td>
	<?php echo $report_detail['p_rep_update_by']?>
</td>
</tr>
</table>
</td></tr>
</table>
</body>
</html>