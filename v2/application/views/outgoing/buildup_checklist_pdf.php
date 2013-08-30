<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PT Gapura Angkasa Kualanamu | Warehouse Management System</title>
<style type="text/css">
html{
	margin:15px;
}


table.gridtable {
	font-family: times,arial,sans-serif;
	font-size:14px;
	color:#333333;
	border-width: 1px;
	border-color: #666666;
	border-collapse: collapse;
	margin-top:10px;
	margin-bottom:2px;
	border-top: 1px solid;
	
	height:auto;
	
}
table.gridtable th {
	border-width: 1px;
	padding: 4px;
	border-style: solid;
	border-color: #666666;
	height:auto;
	border-bottom:1px solid;
	border-top:1px solid;
	text-align:center;
}
table.gridtable td {
	border-width: 1px;
	padding: 2px;
	border-style: solid;
	border-color: #666666;
	border-bottom: 1px solid;
	background-color: #ffffff;
	text-align: left;
	height:auto;
}
</style>

</head>
<body>
<div id="content">
<h2>Buildup Check List <?php echo $flight.'/'.$tanggal;?></h2>
	
    <table border="1" align="left" class="gridtable" >
    	<tr>
        	<th rowspan="2" align="center"><strong>No</strong></th>
			<th colspan="5" align="center"><strong>Rencana</strong></th>
            <th colspan="3" align="center"><strong>Aktual</strong></th>
        </tr>
    	<tr>
        	<th><strong>Flt No</strong></th>
            <th><strong>Tanggal</strong></th>
            <th><strong>No SMU</strong></th>
            <th><strong>Koli</strong></th>
            <th><strong>Berat</strong></th>
            <th><strong>Aktual Koli</strong></th>
            <th><strong>Aktual Berat</strong></th>
            <th><strong>Keterangan</strong></th>
        </tr>
    <?php if(isset($result)) { 
			$no = 1;
	?>
		<tbody>
	<?php foreach($result as $row): ?>
    <?php $flt_no = $row->btb_flt; ?>
    <?php $date = $row->btb_date; ?>
    
    
    	<tr>
        	<td ><div align="center"> <?php echo $no++; ?></div></td>
        	<td ><strong><?php echo strtoupper($row->btb_flt); ?></strong></td>
            <td ><?php echo $row->btb_date; ?></td>
        	<td ><?php echo $row->btb_smu; ?></td>
            <td ><div align="right"><?php echo $row->btb_totalkoli; ?></div></td>
            <td ><div align="right"><?php echo $row->btb_totalberat; ?></div></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
     
	<?php endforeach; ?>
		</tbody>
   <?php } ?>   
    </table>
    
    
</div>	


