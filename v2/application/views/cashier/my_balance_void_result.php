<div id='content'>
	
            	
         <h2>Laporan Transaksi Void Kasir : <?php echo strtoupper($user); ?>, Tanggal : <?php echo mdate('%d-%m-%Y', strtotime($startdate))." s/d ".mdate('%d-%m-%Y', strtotime($enddate)); ?> <h2>
     		
                    <table class="table table-bordered">
                    	
                        <tr>
                        	
                            <th>Date</th>
                            <th>No BTB</th>
                            <th>No SMU</th>
                            <th>Koli</th>
                            <th>Berat Aktual</th>
                            <th>Berat Bayar</th>
                            <th>Hari</th>
                            <th>WHC</th>
                            <th>CSC</th>
                            <th>Adm</th>
                            <th>Sub Total</th>
                            <th>PPN</th>
                            <th>Total</th>
                        </tr>
                        <?php
						$tot_void = 0; 
						foreach($void as $row_void): 
						$tot_void=$tot_void+$row_void->total_biaya;
						?>
               			
        
                        	
                            <td><?php echo mdate("%d-%m-%Y",strtotime($row_void->tglbayar)); ?></td>
                            <td><?php echo strtoupper($row_void->no_smubtb); ?></td>
                            <td><?php echo strtoupper($row_void->nosmu); ?></td>
                            <td><?php #echo strtoupper($row_void->btb_totalkoli); ?></td>
                            <td><?php #echo strtoupper($row_void->btb_totalberat); ?></td>
                            <td><?php #echo strtoupper($row_void->btb_totalberatbayar); ?></td>
                            <td><?php echo strtoupper($row_void->hari); ?></td>
                            <td><?php echo strtoupper($row_void->sewagudang); ?></td>
                            <td><?php echo strtoupper($row_void->cargo_charge); ?></td>
                            <td><?php echo strtoupper($row_void->administrasi); ?></td>
                            <td><?php echo strtoupper($row_void->sewagudang+$row_void->cargo_charge+$row_void->administrasi); ?></td>
                            <td><?php echo strtoupper($row_void->ppn); ?></td>
                            <td><?php echo strtoupper($row_void->total_biaya); ?></td>
                          
                        </tr>
                        <?php endforeach; ?>
                        <tr>
							<th colspan="11"></th>
                            <th colspan="2">Rp. <?php echo number_format($tot_void, 0, ',', '.'); ?></th>
                      	</tr>
                    </table>
                    
                   <?php echo anchor('cashier/my_void_balance_detail_pdf_result/' . $user . '/' . $startdate . '/' . $enddate . '/', '<i class="icon-print"></i> EXPORT TO PDF'); ?>
</div>