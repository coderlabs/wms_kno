<div id='content'>
	
            	<h2>Laporan Transaksi Inbound Kasir : <?php echo strtoupper($user); ?>, Tanggal : <?php echo mdate('%d-%m-%Y', strtotime($startdate))." s/d ".mdate('%d-%m-%Y', strtotime($enddate)); ?> <h2>
     		
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
						$tot_in = 0; 
						foreach($incoming as $row_in): 
						$tot_in=$tot_in+$row_in->total_biaya;
						?>
               			
        
                        	
                            <td><?php echo mdate("%d-%m-%Y %H:%i",strtotime($row_in->tglbayar)); ?></td>
                            <td><?php echo strtoupper($row_in->no_smubtb); ?></td>
                            <td><?php echo strtoupper($row_in->nosmu); ?></td>
                            <td><?php echo strtoupper($row_in->in_koli); ?></td>
                            <td><?php echo strtoupper($row_in->in_berat_datang); ?></td>
                            <td><?php echo strtoupper($row_in->in_berat_bayar); ?></td>
                            <td><?php echo strtoupper($row_in->hari); ?></td>
                            <td><?php echo strtoupper($row_in->sewagudang); ?></td>
                            <td><?php echo strtoupper($row_in->cargo_charge); ?></td>
                            <td><?php echo strtoupper($row_in->administrasi); ?></td>
                            <td><?php echo strtoupper($row_in->sewagudang+$row_in->cargo_charge+$row_in->administrasi); ?></td>
                            <td><?php echo strtoupper($row_in->ppn); ?></td>
                            <td><?php echo strtoupper($row_in->total_biaya); ?></td>
                          
                        </tr>
                        <?php endforeach; ?>
                        <tr>
							<th colspan="11"></th>
                            <th colspan="2">Rp. <?php echo number_format($tot_in, 0, ',', '.'); ?></th>
                      	</tr>
                    </table>
                    
                    <?php echo anchor('cashier/my_incoming_balance_detail_pdf_result/' . $user . '/' . $startdate . '/' . $enddate . '/', '<i class="icon-print"></i> EXPORT TO PDF'); ?>
</div>