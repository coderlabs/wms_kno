<div id="content">
    	PT Gapura Angkasa - PT Angkasa Pura II<br />
        Cargo Warehouse Kualanamu International Airport<br />
        <br />
    	Laporan Pendapatan Harian Outgoing Airline : <?php echo strtoupper($airline); ?>  Tanggal : <?php echo $date; ?><br />
        <table>

        	<tr>
            	<th>Agent</th>
                <th>No BTB</th>
                <th>No SMU</th>
                <th>No Faktur</th>
                <th>Hari</th>
                <th>Koli</th>
                <th>Berat</th>
              
                
                <th>WHC</th>
                <th>CSC</th>
                <th>Adm</th>
                <th>Sub Total</th>
                <th>Ppn</th>
                <th>Total</th>
            </tr>
            <?php 
				$tot_whc = 0;
				$tot_csc = 0;
				$tot_adm = 0;
				$tot_ppn = 0;
				
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
				?>
            <tr>
            	<td><?php echo $item->btb_agent; ?></td>
                <td><?php echo $item->nodb; ?></td>
                <td><?php echo $item->nosmu; ?></td>
                <td><?php echo $item->nofaktur; ?></td>
                <td><?php echo $hari; ?></td>
                <td><?php echo $item->btb_totalkoli; ?></td>
                <td><?php echo $berat; ?></td>
                
               
                <td><?php echo number_format($whc, 0, ',', '.'); ?></td>
                <td><?php echo number_format($csc, 0, ',', '.'); ?></td>
                <td><?php echo number_format($adm, 0, ',', '.'); ?></td>
                <td><?php echo number_format($whc+$csc+$adm, 0, ',', '.'); ?></td>
                <td><?php echo number_format($ppn, 0, ',', '.'); ?></td>
                <td><?php echo number_format(($whc+$csc+$adm+$ppn), 0, ',', '.'); ?></td>
            </tr>
            <?php 
			}
			endforeach; 
				
			foreach($total as $row):
			if (isset($row)) {
			 ?>
			<tr>
            	<td colspan="5"><b>TOTAL</b></td>
                
                <?php
				/*$whc = 525 * $item->hari * $item->btb_totalberatbayar;
				$csc = 275 * $item->hari * $item->btb_totalberatbayar;*/
				?>
                
                <td><strong><?php echo $row->totalkoli; ?>&nbsp;koli</strong></td>
                
                <td><strong><?php echo $row->beratbayar; ?>&nbsp;kg</strong></td>
                <td><strong>Rp&nbsp;<?php echo number_format($tot_whc, 0, ',', '.'); ?></strong></td>
                <td><strong>Rp&nbsp;<?php echo number_format($tot_csc, 0, ',', '.'); ?></strong></td>
                <td><strong>Rp&nbsp;<?php echo number_format($tot_adm, 0, ',', '.'); ?></strong></td>
                <td><strong>Rp&nbsp;<?php echo number_format($tot_whc+$tot_csc+$tot_adm, 0, ',', '.'); ?></strong></td>
                <td><strong>Rp&nbsp;<?php echo number_format($tot_ppn, 0, ',', '.'); ?></strong></td>
                <td><strong>Rp&nbsp;<?php echo number_format($tot_ppn+$tot_whc+$tot_csc+$tot_adm, 0, ',', '.'); ?></strong></td>
            </tr>
			<?php 
			}	
			endforeach;
			?>
        </table>
        
        <?php echo anchor('harian/outgoing_pdf/' . $airline . '/' . $date . '/', 'export to pdf' ); ?>
    
</div>