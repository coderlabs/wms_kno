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
<center><strong>Breakdown Check List</strong></center>
	
    <table  border="1" class="gridtable" width="100%">
    	<tr>
        	<td colspan="5" align="center"><div align="center"><strong>Rencana</strong></div></td>
            <td colspan="3" align="center"><div align="center"><strong>Aktual</strong></div></td>
        </tr>
    	<tr>
        	<td><div align="center"><strong>Flt No</strong></div></td>
            <td><div align="center"><strong>Tanggal</strong></div></td>
            <td><div align="center"><strong>No SMU</strong></div></td>
            <td><div align="center"><strong>Koli</strong></div></td>
            <td><div align="center"><strong>Berat</strong></div></td>
            <td><div align="center"><strong>Aktual Koli</strong></div></td>
            <td><div align="center"><strong>Aktual Berat</strong></div></td>
            <td><div align="center"><strong>Keterangan</strong></div></td>
        </tr>
    <?php foreach($result as $row): ?>
    	<tr>
        	<td><div align="center"><?php echo strtoupper($row->inb_flight_number); ?></div></td>
            <td><div align="center"><?php echo $row->inb_flight_date; ?></div></td>
        	<td><div align="center"><?php echo $row->inb_no_smu; ?></div></td>
            <td><div align="center"><?php echo $row->inb_koli; ?></div></td>
            <td><div align="center"><?php echo $row->inb_berat_aktual; ?></div></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        
    <?php endforeach; ?>
    </table>
    
    
</div>	


