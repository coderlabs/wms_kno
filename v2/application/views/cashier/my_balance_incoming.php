<div id='content'>
	
            	<h2>Laporan Transaksi Inbound Kasir : <?php echo strtoupper($user); ?>, Tanggal : <?php echo mdate('%d-%m-%Y', strtotime($date)); ?> <h2>
     		
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
              
              <h2>Laporan Transaksi Outbound Kasir : <?php echo strtoupper($user); ?>, Tanggal : <?php echo mdate('%d-%m-%Y', strtotime($date)); ?> <h2>
     		
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
                    
         <h2>Laporan Transaksi Void Kasir : <?php echo strtoupper($user); ?>, Tanggal : <?php echo mdate('%d-%m-%Y', strtotime($date)); ?> <h2>
     		
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
                    
                    <?php echo anchor('cashier/my_balance_pdf_result/' . $user . '/' . $date . '/', '<i class="icon-print"></i> EXPORT TO PDF'); ?>
</div>