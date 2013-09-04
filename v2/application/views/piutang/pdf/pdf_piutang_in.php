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
            	<h2>PIUTANG INBOUND <?php echo "<b>".strtoupper($agent)."</b>"; ?></h2>
					<table>
						<thead>
						<tr>
							<th width="30px"><div align="center">No</div></th>
							<th width="80px"><div align="center">Tgl Manifest</div></th>
							<th width="80px"><div align="center">Agent</div></th>
							<th width="80px"><div align="center">Penerima</div></th>
							<th width="120px"><div align="center">No. BTB</div></th>
							<th width="100px"><div align="left">No. SMU</div></th>
							<th width="80px"><div align="center">Airline</div></th>
						</tr>
						</thead>
						<tbody>
					 <?php 
					 $num = 1;
					 foreach ($result as $row)
					 { ?>
						<tr>
							<td><div align="center"><?php echo $num++?></div></td>
							<td><div align="center"><?php echo $row->in_tgl_manifest?></div></td>
							<td><div align="center"><?php echo $row->in_agent?></div></td>
							<td><div align="center"><?php echo $row->in_name?></div></td>
							<td><div align="center"><?php echo $row->in_btb?></div></td>
							<td><div align="left"><?php echo $row->in_smu?></div></td>
							<td><div align="center"><?php echo $row->in_airline?></div></td>
						</tr>
					 <?php }?>
						</tbody>
					</table>
				<br><br><br>
				<?php echo "Tanggal Cetak : ".mdate("%d-%m-%Y %H:%i:%s"); ?>
				
</body>
</html>