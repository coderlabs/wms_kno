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
<?php 
	$namauser = str_replace('_',' ',strtoupper($user));
	$namauser = str_replace('%20',' ',strtoupper($namauser));
?>
                   <h2>Laporan Transaksi Inbound Kasir : <?php echo $namauser; ?>, Tanggal : <?php echo mdate('%d-%m-%Y', strtotime($startdate))." s/d ".mdate('%d-%m-%Y', strtotime($enddate)); ?> <h2>
					 <table  border="1" class="gridtable" width="1024px">
                    	<tr>
                            <td><div align="center"><strong>Tgl Bayar</strong></div></td>
                            <td><div align="center"><strong>No BTB</strong></div></td>
                            <td><div align="center"><strong>No SMU</strong></div></td>
                            <td><div align="center"><strong>Koli</strong></div></td>
                            <td><div align="center"><strong>Berat Aktual</strong></div></td>
                            <td><div align="center"><strong>Berat Bayar</strong></div></td>
                            <td><div align="center"><strong>Hari</strong></div></td>
                            <td><div align="center"><strong>WHC</strong></div></td>
                            <td><div align="center"><strong>CSC</strong></div></td>
                            <td><div align="center"><strong>Adm</strong></div></td>
                            <td><div align="center"><strong>Sub Total</strong></div></td>
                            <td><div align="center"><strong>PPN</strong></div></td>
                            <td><div align="center"><strong>Total</strong></div></td>
                        </tr>
                       
                        <?php
						$tot_in = 0; 
						foreach($incoming as $row_in): 
						$tot_in=$tot_in+$row_in->total_biaya;
						?>
               			<tr>
                            <td><?php echo mdate("%d-%m-%Y",strtotime($row_in->tglbayar)); ?></td>
							<td><div align="center"><?php echo strtoupper($row_in->no_smubtb); ?></div></td>
                            <td><div align="center"><?php echo strtoupper($row_in->nosmu); ?></div></td>
                            <td><div align="center"><?php echo strtoupper($row_in->in_koli); ?></div></td>
                            <td><div align="right"><?php echo strtoupper($row_in->in_berat_datang); ?></div></td>
                            <td><div align="right"><?php echo strtoupper($row_in->in_berat_bayar); ?></div></td>
                            <td><div align="right"><?php echo strtoupper($row_in->hari); ?></div></td>
                            <td><div align="right"><?php echo strtoupper($row_in->sewagudang); ?></div></td>
                            <td><div align="right"><?php echo strtoupper($row_in->cargo_charge); ?></div></td>
                            <td><div align="right"><?php echo strtoupper($row_in->administrasi); ?></div></td>
                            <td><div align="right"><?php echo strtoupper($row_in->sewagudang_after_discount+$row_in->administrasi); ?></div></td>
                            <td><div align="right"><?php echo strtoupper($row_in->ppn); ?></div></td>
                            <td><div align="right"><?php echo strtoupper($row_in->total_biaya); ?></div></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
							<td colspan="12"></td>
                            <td colspan="1"><div align="right">Rp. <?php echo number_format($tot_in, 0, ',', '.'); ?></div></td>
                      	</tr>
                    </table>
					
				
              
                    
                   
</body>
</html>