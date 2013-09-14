<div id='content'>
            	<h2>Summary Report</h2>
				
                <?php echo anchor('cashier/pdf_summary_result/' . $date, '<i class="icon-print"></i> Export PDF'); ?>
                	
                    <table>
                    		<tr>
                            	<td colspan="3" align="center"><strong><?php echo strtoupper(mdate("%d-%M-%Y", strtotime($date))); ?></strong></td>
                            	<td colspan="6" align="center"><strong>INBOUND SUMMARY INCOME</strong></td>
                            </tr>	
                            <tr>
                            	<td align="center"><strong>Airline</strong></td>
                            	<td align="center"><strong>Koli</strong></td>
                                <td align="center"><strong>Berat</strong></td>
                                <td align="center"><strong>WHC</strong></td>
                                <td align="center"><strong>CSC</strong></td>
                                <td align="center"><strong>ADM</strong></td>
                                <td align="center"><strong>Sub Total</strong></td>
                                <td align="center"><strong>PPN</strong></td>
                                <td align="center"><strong>Total</strong></td>
                            </tr>
                    <?php 
					$tot_koli_in = 0;
					$tot_berat_in = 0;
					$tot_whc_in = 0;
					$tot_csc_in = 0;
					$tot_adm_in = 0;
					$tot_sub_total_in = 0;
					$tot_ppn_in = 0;
					$in_grand_total = 0;
					foreach($incoming as $items): 	
					$tot_koli_in = $tot_koli_in + $items->koli;
					$tot_berat_in = $tot_berat_in +  $items->kilo;
					$tot_whc_in = $tot_whc_in + $items->whc;
					$tot_csc_in = $tot_csc_in + $items->csc;
					$tot_adm_in = $tot_adm_in + $items->adm;
					$tot_sub_total_in = $tot_sub_total_in + $items->whc+$items->csc+$items->adm;
					$tot_ppn_in = $tot_ppn_in + $items->ppn;
					$in_grand_total = $in_grand_total + $items->totbiaya;
					?>
    						
                            
                             <tr>
                             	<td align="center"><strong><?php echo strtoupper($items->in_airline); ?></strong></td>
                               <td align="right"><?php echo number_format($items->koli, 0, ',', '.'); ?></td>
                               <td align="right"><?php echo number_format($items->kilo, 1, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($items->whc, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($items->csc, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($items->adm, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($items->whc+$items->csc+$items->adm, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($items->ppn, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($items->totbiaya, 0, ',', '.'); ?></td>
                             </tr> 
                             
                             
                    <?php endforeach; ?>
                    
                    		<tr>
                             	<td><strong>GRAND TOTAL</strong></td>
                                <td><strong><?php echo number_format($tot_koli_in, 0, ',', '.'); ?> koli</strong></td>
                                <td><strong><?php echo number_format($tot_berat_in, 1, ',', '.'); ?> Kg</strong></td>
                                <td><strong>Rp. <?php echo number_format($tot_whc_in, 0, ',', '.'); ?></strong></td>
                                <td><strong>Rp. <?php echo number_format($tot_csc_in, 0, ',', '.'); ?></strong></td>
                                <td><strong>Rp. <?php echo number_format($tot_adm_in, 0, ',', '.'); ?></strong></td>
                                <td><strong>Rp. <?php echo number_format($tot_sub_total_in , 0, ',', '.'); ?></strong></td>
                                <td><strong>Rp. <?php echo number_format($tot_ppn_in , 0, ',', '.'); ?></strong></td>
                                <td><strong>Rp. <?php echo number_format($in_grand_total, 0, ',', '.'); ?></strong></td>
                            </tr>  
                    
                    </table>
                    
                    <table>
                    		<tr>
                            	<td colspan="3" align="center"><strong><?php echo strtoupper(mdate("%d-%M-%Y", strtotime($date))); ?></strong></td>
                            	<td colspan="6" align="center"><strong>OUTBOUND SUMMARY INCOME</strong></td>
                            </tr>	
                            <tr>
                            	<td align="center"><strong>Airline</strong></td>
                            	<td align="center"><strong>Koli</strong></td>
                                <td align="center"><strong>Berat</strong></td>
                                <td align="center"><strong>WHC</strong></td>
                                <td align="center"><strong>CSC</strong></td>
                                <td align="center"><strong>ADM</strong></td>
                                <td align="center"><strong>Sub Total</strong></td>
                                <td align="center"><strong>PPN</strong></td>
                                <td align="center"><strong>Total</strong></td>
                            </tr>
                    <?php 
					$tot_koli = 0;
					$tot_berat = 0;
					$tot_whc = 0;
					$tot_csc = 0;
					$tot_adm = 0;
					$tot_sub_total = 0;
					$tot_ppn = 0;
					$out_grand_total = 0;
					foreach($outgoing as $items):
					$tot_koli = $tot_koli + $items->koli;
					$tot_berat = $tot_berat +  $items->kilo;
					$tot_whc = $tot_whc + $items->whc;
					$tot_csc = $tot_csc + $items->csc;
					$tot_adm = $tot_adm + $items->adm;
					$tot_sub_total = $tot_sub_total + $items->whc+$items->csc+$items->adm;
					$tot_ppn = $tot_ppn + $items->ppn;
					$out_grand_total = $out_grand_total + $items->totbiaya;
					?>
    						
                            
                             <tr>
                             	<td align="center"><strong><?php echo strtoupper($items->airline); ?></strong></td>
                              	<td align="right"><?php echo number_format($items->koli, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($items->kilo, 1, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($items->whc, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($items->csc, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($items->adm, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($items->whc+$items->csc+$items->adm, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($items->ppn, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($items->totbiaya, 0, ',', '.'); ?></td>
                                
                             </tr> 
                             
                             
                    <?php endforeach; ?>
                    
                    		<tr>
                                <td><strong>GRAND TOTAL</strong></td>
                                <td><strong><?php echo number_format($tot_koli, 0, ',', '.'); ?> koli</strong></td>
                                <td><strong><?php echo number_format($tot_berat, 1, ',', '.'); ?> Kg</strong></td>
                                <td><strong>Rp. <?php echo number_format($tot_whc, 0, ',', '.'); ?></strong></td>
                                <td><strong>Rp. <?php echo number_format($tot_csc, 0, ',', '.'); ?></strong></td>
                                <td><strong>Rp. <?php echo number_format($tot_adm, 0, ',', '.'); ?></strong></td>
                                <td><strong>Rp. <?php echo number_format($tot_sub_total , 0, ',', '.'); ?></strong></td>
                                <td><strong>Rp. <?php echo number_format($tot_ppn , 0, ',', '.'); ?></strong></td>
                                <td><strong>Rp. <?php echo number_format($out_grand_total, 0, ',', '.'); ?></strong></td>
                             </tr>  
                    
                    </table>
					
                    <table>
                    		<tr>
                            	<td colspan="3" align="center"><strong><?php echo strtoupper(mdate("%d-%M-%Y", strtotime($date))); ?></strong></td>
                            	<td colspan="6" align="center"><strong>VOID SUMMARY</strong></td>
                            </tr>	
                            <tr>
                            	<td align="center"><strong>Type</strong></td>
                                <td align="center"><strong>WHC</strong></td>
                                <td align="center"><strong>CSC</strong></td>
                                <td align="center"><strong>ADM</strong></td>
                                <td align="center"><strong>Sub Total</strong></td>
                                <td align="center"><strong>PPN</strong></td>
                                <td align="center"><strong>Total</strong></td>
                            </tr>
                    <?php 
					$tot_whc = 0;
					$tot_csc = 0;
					$tot_adm = 0;
					$tot_sub_total = 0;
					$tot_ppn = 0;
					$void_grand_total = 0;
					foreach($void as $items):
					$tot_whc = $tot_whc + $items->whc;
					$tot_csc = $tot_csc + $items->csc;
					$tot_adm = $tot_adm + $items->adm;
					$tot_sub_total = $tot_sub_total + $items->whc+$items->csc+$items->adm;
					$tot_ppn = $tot_ppn + $items->ppn;
					$void_grand_total = $void_grand_total + $items->totbiaya;
					if($items->status == 0)
					{
						$status = 'incoming';
					} else { $status = 'outgoing'; }
					?>
    						
                            
                             <tr>
                             	<td align="center"><strong><?php echo strtoupper($status); ?></strong></td>
                                <td align="right"><?php echo number_format($items->whc, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($items->csc, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($items->adm, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($items->whc+$items->csc+$items->adm, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($items->ppn, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($items->totbiaya, 0, ',', '.'); ?></td>
                                
                             </tr> 
                             
                             
                    <?php endforeach; ?>
                    
                    		<tr>
                                <td><strong>GRAND TOTAL</strong></td>
                                <td><strong>Rp. <?php echo number_format($tot_whc, 0, ',', '.'); ?></strong></td>
                                <td><strong>Rp. <?php echo number_format($tot_csc, 0, ',', '.'); ?></strong></td>
                                <td><strong>Rp. <?php echo number_format($tot_adm, 0, ',', '.'); ?></strong></td>
                                <td><strong>Rp. <?php echo number_format($tot_sub_total , 0, ',', '.'); ?></strong></td>
                                <td><strong>Rp. <?php echo number_format($tot_ppn , 0, ',', '.'); ?></strong></td>
                                <td><strong>Rp. <?php echo number_format($void_grand_total, 0, ',', '.'); ?></strong></td>
                             </tr>  
                    
                    </table>
                    
                    <table>
                    	<tr>
                        	<td align="center" colspan="10"><strong>L E G E N D</strong></td>
                        </tr>
                    	<tr>
                        	<td align="center" colspan="3"><strong>Inbound</strong></td>
                            <td align="center" colspan="3"><strong>Outbound</strong></td>
                            <td align="center" colspan="3"><strong>Void</strong></td>
                            <td align="center" colspan="3"><strong>Total</strong></td>
                        </tr>
                        <tr>
                        	<td align="right" colspan="3"><strong><?php echo number_format($in_grand_total, 0, ',', '.'); ?></strong></td>
                            <td align="right" colspan="3"><strong><?php echo number_format($out_grand_total, 0, ',', '.'); ?></strong></td>
                            <td align="right" colspan="3"><strong><?php echo number_format($void_grand_total, 0, ',', '.'); ?></strong></td>
                            <td align="right" colspan="3"><strong><?php echo number_format($in_grand_total+$out_grand_total, 0, ',', '.'); ?></strong></td>
                        </tr>
                    </table>
                    
                    
</div>
