<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hospitality Service Traveller Detail | PT Gapura Angkasa Denpasar</title>
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
Domestic Cargo Warehouse Kualanamu International Airport</font><br/>
        <br />
</div>
<body>
<div id="content">
    	Laporan Pendapatan Harian Incoming <br/> Airline : <?php echo strtoupper($airline); ?>  Tanggal : <?php echo mdate('%d-%m-%Y',strtotime($startdate))." s/d ".mdate('%d-%m-%Y',strtotime($enddate)); ?><br />
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
			$tot_kol = 0;
			$tot_bbr = 0;
			$tot_adm = 0;
			$tot_ppn = 0;
			$num=1;
			foreach($detail_v2 as $item): 
			if (isset($item)) 
			{
				if($item->totalberatbayar <= 10)
				{
					$berat = 10;
				} 
				else 
				{
					$berat = $item->totalberatbayar;
				} 
				
				if ($item->hari <= 3)
				{ $hari = 1;} else {$hari = $item->hari-2;}
			?>
            <tr>
            	<td><?php echo $num; ?></td>
                <td><?php echo ucwords($item->user); ?></td>
                <td><?php echo $item->agent; ?></td>
                <td><?php echo $item->nodb; ?></td>
                <td><?php echo $item->no_smu; ?></td>
                <td><?php echo $item->nofaktur; ?></td>
                <td><center><?php echo $item->hari; ?></center></td>
                <td><div align="right"><?php echo number_format($item->totalkoli, 0, ',', '.'); ?></div></td>
                <?php
					
					$whc = 525 * $hari * $berat;
					$tot_whc = $tot_whc + $whc;
					
					$csc = 275 * $hari * $berat;
					$tot_csc = $tot_csc + $csc;
					
					$adm = 5000;
					$tot_adm = $tot_adm + $adm;
					
					$ppn = ($whc + $csc + $adm)*0.1;
					$tot_ppn = $tot_ppn + $ppn;
					
					$tot_kol = $tot_kol + $item->totalkoli;
					$tot_bbr = $tot_bbr + $berat;
					
					
				?>
                <td><div align="right"><?php echo number_format($berat, 1, ',', '.'); ?></div></td>
                <td><div align="right"><?php echo number_format($whc, 0, ',', '.'); ?></div></td>
                <td><div align="right"><?php echo number_format($csc, 0, ',', '.'); ?></div></td>
                <td><div align="right"><?php echo number_format($adm, 0, ',', '.'); ?></div></td>
                <td><div align="right"><?php echo number_format($whc+$csc+$adm, 0, ',', '.'); ?></div></td>
                <td><div align="right"><?php echo number_format($ppn, 0, ',', '.'); ?></div></td>
                <td><div align="right"><?php echo number_format($whc+$csc+$adm+$ppn, 0, ',', '.'); ?></div></td>
            </tr>
            <?php 
			}
			$num++;
			endforeach;
			
			foreach($detail_v3 as $item2): 
			if (isset($item2)) 
			{
			echo "test<br>";
			/*	$tot_kol = $tot_kol + $item->in_koli;
				$tot_bbr = $tot_bbr + $item->in_berat_bayar;
				$tot_whc = $tot_whc + $item->sewagudang;
				$tot_csc = $tot_csc + $item->cargo_charge;
				$tot_adm = $tot_adm + $item->administrasi;
				$tot_ppn = $tot_ppn + $item->ppn;
			?>
            <tr>
            	<td><div align="center"><?php echo $num; ?></div></td>
                <td><?php echo ucwords($item->user); ?></td>
                <td><?php echo $item->in_agent; ?></td>
                <td><div align="center"><?php echo $item->nodb; ?></div></td>
                <td><div align="center"><?php echo $item->nosmu; ?></div></td>
                <td><div align="center"><?php echo $item->in_btb; ?></div></td>
                <td><div align="right"><?php echo $item->hari; ?></div></td>
                <td><div align="right"><?php echo number_format($item->in_koli, 0, ',', '.'); ?></div></td>
                <td><div align="right"><?php echo number_format($item->in_berat_bayar, 1, ',', '.'); ?></div></td>
                <td><div align="right"><?php echo number_format($item->sewagudang, 0, ',', '.'); ?></div></td>
                <td><div align="right"><?php echo number_format($item->cargo_charge, 0, ',', '.'); ?></div></td>
                <td><div align="right"><?php echo number_format($item->administrasi, 0, ',', '.'); ?></div></td>
                <td><div align="right"><?php echo number_format($item->sewagudang+$item->cargo_charge+$item->administrasi, 0, ',', '.'); ?></div></td>
                <td><div align="right"><?php echo number_format($item->ppn, 0, ',', '.'); ?></div></td>
                <td><div align="right"><?php echo number_format($item->total_biaya, 0, ',', '.'); ?></div></td>

            </tr>
            <?php 
			*/
			}
			$num++;
			endforeach;  
			
			?>
			</tbody>
			<tfoot>
			
			<tr>
            	<td colspan="7"><strong>TOTAL</strong></td>
                <td><div align="right"><strong><?php echo number_format($tot_kol, 0, ',', '.'); ?></strong> koli</div></td>
                <td><div align="right"><strong><?php echo number_format($tot_bbr, 1, ',', '.'); ?></strong> Kg</div></td>
                <td><div align="right">Rp. <strong><?php echo number_format($tot_whc, 0, ',', '.'); ?></strong></div></td>
                <td><div align="right">Rp. <strong><?php echo number_format($tot_csc, 0, ',', '.'); ?></strong></div></td>
                <td><div align="right">Rp. <strong><?php echo number_format($tot_adm, 0, ',', '.'); ?></strong></div></td>
                <td><div align="right">Rp. <strong><?php echo number_format($tot_whc+$tot_csc+$tot_adm, 0, ',', '.'); ?></strong></div></td>
                <td><div align="right">Rp. <strong><?php echo number_format($tot_ppn, 0, ',', '.'); ?></strong></div></td>
                <td><div align="right">Rp. <strong><?php echo number_format($tot_whc+$tot_csc+$tot_adm+$tot_ppn, 0, ',', '.'); ?></strong></div></td>
            </tr>
		
			</tfoot>
        </table>
</div>
</body>
</html>