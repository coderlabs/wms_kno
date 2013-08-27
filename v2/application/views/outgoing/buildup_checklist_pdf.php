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
    <?php $flt_no = $row->btb_flt; ?>
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
   <?php } ?>   
    </table>
    
    
</div>	


