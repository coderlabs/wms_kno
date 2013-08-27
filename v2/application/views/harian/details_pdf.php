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
    	Laporan Pendapatan Harian Outgoing Airline : <?php echo strtoupper($airline); ?> <br/> Tanggal : <?php echo mdate('%d-%m-%Y',strtotime($date)); ?><br />
        <table border="1" class="gridtable" width="100%">
		<thead>
        	<tr>
            	<th width="3%"><?php echo strtoupper($airline); ?></th>
            	<th width="10%">Agent</th>
                <th width="10%">NPJG</th>
                <th width="10%">No SMU</th>
                <th width="10%">No Faktur</th>
                <th width="5%">Hari</th>
                <th width="5%">Koli</th>
                <th width="7%">Berat</th>
              
                
                <th width="10%">WHC</th>
                <th width="10%">CSC</th>
                <th width="10%">Adm</th>
                <th width="10%">Sub Total</th>
                <th width="10%">Ppn</th>
                <th width="10%">Total</th>
            </tr>
			</thead>
			<tbody>
            <?php 
				$tot_whc = 0;
				$tot_csc = 0;
				$tot_adm = 0;
				$tot_ppn = 0;
				$num=1;
				$tot_kol=0;
				$tot_bbr=0;
				
				foreach($details as $item): 
				if (isset($item)) 
				{
					if($item->btb_totalberat <= 10)
					{
						$berat = 10;
					} 
					else 
					{
						$berat = $item->btb_totalberat;
					} 
				
					if ($item->actual_days <= 3)
					{ 
						$hari = 1;
					} 
					else 
					{
						$hari = $item->actual_days-2;
					}
				
					/*$hari = $item->hari ;
					$berat= $item->btb_totalberatbayar;*/
					
				$whc = 525 * $hari * $berat;
				$tot_whc = $tot_whc + $whc;
				
				$csc = 275 * $hari * $berat;
				$tot_csc = $tot_csc + $csc;
				
				$adm = 5000;
				$tot_adm = $tot_adm + $adm;
				
				$ppn = ($whc+$csc+$adm)*0.1;
				$tot_ppn = $tot_ppn + $ppn;
				
				$tot_kol=$tot_kol + $item->btb_totalkoli;
				
				$tot_bbr = $tot_bbr + $item->btb_totalberatbayar;
				?>
            <tr>
				<td><center><?php echo $num;?></center></td>
            	<td><?php echo $item->btb_agent; ?></td>
                <td><?php echo $item->nodb; ?></td>
                <td><?php echo $item->nosmu; ?></td>
                <td><?php echo $item->nofaktur; ?></td>
                <td><center><?php echo $hari; ?></center></td>
                <td align="right"><?php echo $item->btb_totalkoli; ?></td>
                
                
                 <td align="right"><?php echo $item->btb_totalberatbayar; ?></td>
                <td align="right"><?php echo number_format($whc, 0, ',', '.'); ?></td>
                <td align="right"><?php echo number_format($csc, 0, ',', '.'); ?></td>
                <td align="right"><?php echo number_format($adm, 0, ',', '.'); ?></td>
                <td align="right"><?php echo number_format($whc+$csc+$adm, 0, ',', '.'); ?></td>
                <td align="right"><?php echo number_format($ppn, 0, ',', '.'); ?></td>
                <td align="right"><?php echo number_format(($whc+$csc+$adm+$ppn), 0, ',', '.'); ?></td>
            </tr>
            <?php 
			}
			$num++;
			endforeach; 
			?>
			</tbody>
			<tfoot>
			<?php 
			//foreach($total as $row)
			//{ ?>
			<tr>
            	<td colspan="6"><b>TOTAL</b></td>
                
                <?php
				//$whc = 525 * $item->hari * $item->btb_totalberatbayar;
				//$csc = 275 * $item->hari * $item->btb_totalberatbayar;
				?>
                
                <td><strong><div align="right"><?php echo $tot_kol; ?></div></strong></td>
                
                <td><strong><div align="right"><?php echo $tot_bbr; ?></div></strong></td>
                <td><strong><div align="right"><?php echo number_format($tot_whc, 0, ',', '.'); ?></strong></div></td>
                <td><strong><div align="right"><?php echo number_format($tot_csc, 0, ',', '.'); ?></strong></div></td>
                <td><strong><div align="right"><?php echo number_format($tot_adm, 0, ',', '.'); ?></strong></div></td>
                <td><strong><div align="right"><?php echo number_format($tot_whc+$tot_csc+$tot_adm, 0, ',', '.'); ?></strong></div></td>
                <td><strong><div align="right"><?php echo number_format($tot_ppn, 0, ',', '.'); ?></strong></div></td>
                <td><strong><div align="right"><?php echo number_format($tot_whc+$tot_csc+$tot_adm+$tot_ppn, 0, ',', '.'); ?></strong></div></td>
            </tr>
			<?php //}	?>
			</tfoot>
        </table>
        
        
    
</div>
</body>
</html>