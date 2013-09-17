<div id="content">
	    Cek Laporan Pendapatan Harian Incoming Tanggal : <?php echo $date; ?><br />
    	<table>
        	<tr>
            	<th>No</th>
				<th>NPJG</th>
                <th>No SMU</th>
                <th>No BTB</th>
                <th>Aktual Hari</th>
                <th>Hari</th>
                <th>Koli</th>
                <th>Berat</th>
                <th>WHC</th>
                <th>CSC</th>
                <th>Adm</th>
                <th>Sub Total</th>
                <th>Ppn</th>
                <th>Total Biaya</th>
				<th>Total Hitung( hari * berat * 800 + 5000 )</th>
				<th></th>
            </tr>
            <?php 
			$tot_whc = 0;
			$tot_csc = 0;
			$tot_kol = 0;
			$tot_bbr = 0;
			$tot_adm = 0;
			$tot_ppn = 0;
			$tot_hitung = 0;
			$no = 0;
			foreach($deliverybill as $row){ 
			
				$no++;
				$tot_kol = $tot_kol + $row->in_koli;
				$tot_bbr = $tot_bbr + $row->in_berat_bayar;
				$tot_whc = $tot_whc + $row->sewagudang;
				$tot_csc = $tot_csc + $row->cargo_charge;
				$tot_adm = $tot_adm + $row->administrasi;
				$tot_ppn = $tot_ppn + $row->ppn;
				

			?>
            <tr>
            	<td><?php echo $no; ?></td>
				<td><?php echo $row->nodb; ?></td>
				<td><?php echo $row->nosmu; ?></td>
				<td><?php echo $row->no_smubtb; ?></td>
				<td><?php echo $row->actual_days; ?></td>
				<td><?php echo $row->hari; ?></td>
				<td><?php echo $row->in_koli; ?></td>
				<td><?php echo $row->in_berat_bayar; ?></td>
				
				<td align="right"><?php echo number_format($row->sewagudang, 0, ',', '.'); ?></td>
                <td align="right"><?php echo number_format($row->cargo_charge, 0, ',', '.'); ?></td>
                <td align="right"><?php echo number_format($row->administrasi, 0, ',', '.'); ?></td>
                <td align="right"><?php echo number_format($row->sewagudang+$row->cargo_charge+$row->administrasi, 0, ',', '.'); ?></td>
                <td align="right"><?php echo number_format($row->ppn, 0, ',', '.'); ?></td>
                <td align="right"><?php echo number_format($row->total_biaya, 0, ',', '.'); ?></td>
				<td align="right"><?php 
						$total_hitung = ((($row->in_berat_bayar) * ($row->hari) * 800) + 5000) * 1.1 ; 
						echo number_format($total_hitung, 0, ',', '.');
				?>
				</td>
				<td><?php if(round($total_hitung) <> $row->total_biaya){ echo "<b>beda</b>";} ?></td>
			</tr>
			<?php 
				$tot_hitung = $tot_hitung + $total_hitung;
            }
			?>
			<tr>
            	<td colspan="5"><b>TOTAL</b></td>
                <td><?php echo number_format($tot_kol, 0, ',', '.'); ?></td>
                
                <td><?php echo number_format($tot_bbr, 1, ',', '.'); ?></td>
                <td><?php echo number_format($tot_whc, 0, ',', '.'); ?></td>
                <td><?php echo number_format($tot_csc, 0, ',', '.'); ?></td>
                <td><?php echo number_format($tot_adm, 0, ',', '.'); ?></td>
                <td><?php echo number_format($tot_whc+$tot_csc+$tot_adm, 0, ',', '.'); ?></td>
                <td><?php echo number_format($tot_ppn, 0, ',', '.'); ?></td>
                <td><?php echo number_format($tot_whc+$tot_csc+$tot_adm+$tot_ppn, 0, ',', '.'); ?></td>
				<td><?php echo number_format($tot_hitung, 0, ',','.'); ?></td>
				<td></td>
            </tr>
	  </table>
    
</div>