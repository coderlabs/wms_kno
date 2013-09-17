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
	width:270mm;
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
<div id="header">
<font size="15px">PT Gapura Angkasa - PT Angkasa Pura II<br/>
Cargo Warehouse Kualanamu International Airport</font><br/>
        <br />
</div>
<body>
<div id="content">
    	Laporan Pendapatan Harian Outgoing Airline : <?php echo strtoupper($airline); ?> <br/> Tanggal : <?php echo mdate('%d-%m-%Y',strtotime($startdate))." s/d ".mdate('%d-%m-%Y',strtotime($enddate)); ?><br />
        <table border="1" class="gridtable" width="100%">
		<thead>
        	<tr>
            	<th width="10"><div align="center"><?php echo strtoupper($airline); ?></div></th>
                <th width="40">Kasir</th>
            	<th width="70">Agen</th>
                <th width="50">NPJG</th>
                <th width="70">No SMU</th>
                <th width="50">No BTB</th>
                <th width="10">Hari</th>
                <th width="30">Koli</th>
                <th width="50">Berat</th>
                <th width="70">WHC</th>
                <th width="70">CSC</th>
                <th width="70">Adm</th>
                <th width="70">Sub Total</th>
                <th width="70">Ppn</th>
                <th width="70">Total </th>
				</tr>
			</thead>
			<tbody>
            <?php 
				$tot_whc = 0;
				$tot_csc = 0;
				$tot_adm = 0;
				$tot_ppn = 0;
				$tot_kol = 0;
				$tot_bbr = 0;
				$num=1;
				foreach($details as $item): 
				
				if (isset($item)) 
				{
					if($item->btb_totalberatbayar <= 10)
					{
						$berat_bayar=10;
					}
					else
					{
						$berat_bayar=$item->btb_totalberatbayar;
					}
					$tot_kol = $tot_kol + $item->btb_totalkoli;
					$tot_bbr = $tot_bbr + $berat_bayar;
					$tot_whc = $tot_whc + $item->sewagudang;
					$tot_csc = $tot_csc + $item->cargo_charge;
					$tot_adm = $tot_adm + $item->administrasi;
					$tot_ppn = $tot_ppn + $item->ppn;
				?>
             <tr>
             	<td><div align="left"><?php echo $num; ?></div></td>
            	<td><div align="left"><?php echo ucwords($item->user); ?></div></td>
                <td><div align="left"><?php echo $item->btb_agent; ?></div></td>
                <td><div align="center"><?php echo $item->nodb; ?></div></td>
                <td><div align="center"><?php echo $item->nosmu; ?></div></td>
                <td><div align="center"><?php echo $item->btb_nobtb; ?></div></td>
                <td><div align="right"><?php echo $item->hari; ?></div></td>
                <td><div align="right"><?php echo $item->btb_totalkoli; ?></div></td>
                <td><div align="right"><?php echo $berat_bayar; ?></div></td>
                <td><div align="right"><?php echo number_format($item->sewagudang, 0, ',', '.'); ?></div></td>
                <td><div align="right"><?php echo number_format($item->cargo_charge, 0, ',', '.'); ?></div></td>
                <td><div align="right"><?php echo number_format($item->administrasi, 0, ',', '.'); ?></div></td>
                <td><div align="right"><?php echo number_format($item->sewagudang+$item->cargo_charge+$item->administrasi, 0, ',', '.'); ?></div></td>
                <td><div align="right"><?php echo number_format($item->ppn, 0, ',', '.'); ?></div></td>
                <td><div align="right"><?php echo number_format($item->total_biaya, 0, ',', '.'); ?></div></td>
            </tr>
            <?php 
			}
			$num++;
			endforeach; 
			 ?>
			<tr>
            	<td colspan="7"><b>TOTAL</b></td>
                <td><div align="right"><strong><?php echo $tot_kol; ?>&nbsp;koli</strong></div></td>
                <td><div align="right"><strong><?php echo $tot_bbr; ?>&nbsp;kg</strong></div></td>
                <td><div align="right"><strong>Rp&nbsp;<?php echo number_format($tot_whc, 0, ',', '.'); ?></strong></div></td>
                <td><div align="right"><strong>Rp&nbsp;<?php echo number_format($tot_csc, 0, ',', '.'); ?></strong></div></td>
                <td><div align="right"><strong>Rp&nbsp;<?php echo number_format($tot_adm, 0, ',', '.'); ?></strong></div></td>
                <td><div align="right"><strong>Rp&nbsp;<?php echo number_format($tot_whc+$tot_csc+$tot_adm, 0, ',', '.'); ?></strong></div></td>
                <td><div align="right"><strong>Rp&nbsp;<?php echo number_format($tot_ppn, 0, ',', '.'); ?></strong></div></td>
                <td><div align="right"><strong>Rp&nbsp;<?php echo number_format($tot_ppn+$tot_whc+$tot_csc+$tot_adm, 0, ',', '.'); ?></strong></div></td>
            </tr>
        </table>
        
        
    
</div>
</body>
</html>