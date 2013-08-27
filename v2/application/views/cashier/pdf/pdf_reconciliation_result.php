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
<div id='content'>
            	<p align="center">Berita Acara Perhitungan Pendapatan Pengelolaan Gudang Kargo Domestik</p>
                <p align="center">Bandara Internasional Kualanamu</p>
                <p align="center">antara</p>
                <p align="center">PT Gapura Angkasa Cabang Bandara Internasional Kualanamu</p>
                <p align="center">dengan</p>
                <p align="center">PT.(PERSERO) Angkasa Pura II Cabang Bandara Internasional Kualanamu</p>
                <p align="center">Nomor : </p>
                <hr>
                
					
                    <table border="1" class="gridtable" width="100%">
                    		<tr>
                            	<td align="center" colspan="7"><strong>RECONCILIATION <?php echo strtoupper(mdate("%d-%M-%Y", strtotime($date))); ?></strong></td>
                            </tr>	
                            <tr>
                            	<td align="center"><strong>No</strong></td>
                            	<td align="center"><strong>Keterangan</strong></td>
                                <td align="center" colspan="2"><strong>Sharing</strong></td>
                                <td align="center"><strong>PT Angkasa Pura II</strong></td>
                                <td align="center"><strong>PT Gapura Angkasa</strong></td>
                                <td align="center"><strong>Jumlah</strong></td>
                            </tr>
                    <?php 
					$in_whc = 0;
					$in_csc = 0;
					$in_adm = 0;
					$in_ppn = 0;
					
					$out_whc = 0;
					$out_csc= 0;
					$out_adm = 0;
					$out_ppn=0;
					
					foreach($incoming as $items_in):
					$in_whc = $in_whc + $items_in->whc;  	
					$in_csc = $in_csc + $items_in->csc; 
					$in_adm = $in_adm + $items_in->adm; 
					$in_ppn = $in_ppn + $items_in->ppn; 
					endforeach;
					
					foreach($outgoing as $items_out):
					$out_whc = $out_whc + $items_out->whc; 
					$out_csc = $out_csc + $items_out->csc; 
					$out_adm = $out_adm + $items_out->adm;
					$out_ppn = $out_ppn + $items_out->ppn; 	
					endforeach;
					
					$tot_whc = $in_whc + $out_whc;
					$tot_csc = $in_csc + $out_csc;
					$tot_adm = $in_adm + $out_adm;
					$tot_ppn = $in_ppn + $out_ppn;
					?>
    						
                            
                             <tr>
                             	<td align="center">1</td>
                                <td>Cargo Service Charge</td>
                                <td>100 %</td>
                                <td>0 %</td>
                                <td align="right"><?php echo number_format($tot_csc, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format(0, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($tot_csc, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                             	<td align="center">2</td>
                                <td>Warehouse Charge</td>
                                <td>45 %</td>
                                <td>55 %</td>
                                <td align="right"><?php echo number_format($tot_whc*45/100, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($tot_whc*55/100, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($tot_whc, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                             	<td align="center">3</td>
                                <td>Administration</td>
                                <td>45 %</td>
                                <td>55 %</td>
                         		<td align="right"><?php echo number_format($tot_adm*45/100, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($tot_adm*55/100, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($tot_adm, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                             	<td align="center">4</td>
                                <td>Ppn</td>
                                <td>45 %</td>
                                <td>55 %</td>
             					<td align="right"><?php echo number_format($tot_ppn*45/100, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($tot_ppn*55/100, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($tot_ppn, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                            	<td colspan="4" align="center"><strong>Total</strong></td>
                                <td align="right"><strong><?php echo number_format($tot_csc+(($tot_whc+$tot_adm+$tot_ppn)*45/100), 0, ',', '.'); ?></strong></td>
                                <td align="right"><strong><?php echo number_format(($tot_whc+$tot_adm+$tot_ppn)*55/100, 0, ',', '.'); ?></strong></td>
                                <td align="right"><strong><?php echo number_format($tot_csc+$tot_whc+$tot_adm+$tot_ppn, 0, ',', '.'); ?></strong></td>
                            </tr>
                            
                    </table>      
                             
                 
</div>

</body>
</html>
