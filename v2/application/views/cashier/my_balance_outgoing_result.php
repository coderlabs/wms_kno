<div id='content'>
	
              <h2>Laporan Transaksi Outbound Kasir : <?php echo strtoupper($user); ?>, Tanggal : <?php echo mdate('%d-%m-%Y', strtotime($startdate))." s/d ".mdate('%d-%m-%Y', strtotime($enddate)); ?><h2>
     		
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
						$tot_out = 0; 
						foreach($outgoing as $row_out): 
						$tot_out=$tot_out+$row_out->total_biaya;
						?>
               			
        
                        	
                            <td><?php echo mdate("%d-%m-%Y %H:%i",strtotime($row_out->tglbayar)); ?></td>
                            <td><?php echo strtoupper($row_out->no_smubtb); ?></td>
                            <td><?php echo strtoupper($row_out->nosmu); ?></td>
                            <td><?php echo strtoupper($row_out->btb_totalkoli); ?></td>
                            <td><?php echo strtoupper($row_out->btb_totalberat); ?></td>
                            <td><?php echo strtoupper($row_out->btb_totalberatbayar); ?></td>
                            <td><?php echo strtoupper($row_out->hari); ?></td>
                            <td><?php echo strtoupper($row_out->sewagudang); ?></td>
                            <td><?php echo strtoupper($row_out->cargo_charge); ?></td>
                            <td><?php echo strtoupper($row_out->administrasi); ?></td>
                            <td><?php echo strtoupper($row_out->sewagudang+$row_out->cargo_charge+$row_out->administrasi); ?></td>
                            <td><?php echo strtoupper($row_out->ppn); ?></td>
                            <td><?php echo strtoupper($row_out->total_biaya); ?></td>
                          
                        </tr>
                        <?php endforeach; ?>
                        <tr>
							<th colspan="11"></th>
                            <th colspan="2">Rp. <?php echo number_format($tot_out, 0, ',', '.'); ?></th>
                      	</tr>
                    </table>
                    
                    <?php echo anchor('cashier/my_outgoing_balance_detail_pdf_result/' . $user . '/' . $startdate . '/' . $enddate . '/', '<i class="icon-print"></i> EXPORT TO PDF'); ?>
					
</div>