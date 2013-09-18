<div id='content'>
            	<h2>Reconciliation Report</h2>
					
                    <table>
                    		<tr>
                            	<td align="center" colspan="7"><strong>INCOMING RECONCILIATION <?php echo strtoupper(mdate("%d-%M-%Y", strtotime($startdate)))." s/d ".strtoupper(mdate("%d-%M-%Y", strtotime($enddate))); ?></strong></td>
                            </tr>	
                            <tr>
                            	<td align="center"><strong>No</strong></td>
                            	<td align="center"><strong>Keterangan</strong></td>
                                <td align="center" colspan="2"><strong>Sharing</strong></td>
                                <td align="center"><strong>PT Angkasa Pura II</strong></td>
                                <td align="center"><strong>PT Gapura Angkasa</strong></td>
                                <td align="center"><strong>Jumlah</strong></td>
                            </tr>
                    <?php 
					$in_whc = 0;
					$in_csc = 0;
					$in_adm = 0;
					$in_ppn = 0;
										
					foreach($incoming as $items_in):
					$in_whc = $in_whc + $items_in->whc;  	
					$in_csc = $in_csc + $items_in->csc; 
					$in_adm = $in_adm + $items_in->adm; 
					$in_ppn = $in_ppn + $items_in->ppn; 
					endforeach;
					
					$ppn_in_whc = $in_whc * 10/100;
					$ppn_in_csc = $in_csc * 10/100;
					$ppn_in_adm = $in_adm * 10/100;
					$ppn_in_ap = $ppn_in_csc + ($ppn_in_whc * 45/100) + ($ppn_in_adm * 45/100); 
					$ppn_in_gp = ($ppn_in_whc * 55/100) + ($ppn_in_adm * 55/100);
					$ppn_in_total 	= $ppn_in_whc + $ppn_in_csc + $ppn_in_adm ;
					
					?>
    						
                            
                            <tr>
                             	<td align="center" rowspan="2">1</td>
                                <td>Cargo Service Charge</td>
                                <td>100 %</td>
                                <td>0 %</td>
                                <td align="right"><?php echo number_format($in_csc, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format(0, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($in_csc, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                             	<td>Ppn Cargo Service Charge</td>
                                <td>100 %</td>
                                <td>0 %</td>
                                <td align="right"><?php echo number_format($ppn_in_csc, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format(0, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($ppn_in_csc, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                             	<td align="center" rowspan="2">2</td>
                                <td>Warehouse Charge</td>
                                <td>45 %</td>
                                <td>55 %</td>
                                <td align="right"><?php echo number_format($in_whc*45/100, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($in_whc*55/100, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($in_whc, 0, ',', '.'); ?></td>
                            </tr>
							<tr>
                             	<td>Ppn Warehouse Charge</td>
                                <td>45 %</td>
                                <td>55 %</td>
                                <td align="right"><?php echo number_format($ppn_in_whc*45/100, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($ppn_in_whc*55/100, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($ppn_in_whc, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                             	<td align="center" rowspan="2">3</td>
                                <td>Administration</td>
                                <td>45 %</td>
                                <td>55 %</td>
                         		<td align="right"><?php echo number_format($in_adm*45/100, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($in_adm*55/100, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($in_adm, 0, ',', '.'); ?></td>
                            </tr>
							<tr>
                             	<td>PpnAdministration</td>
                                <td>45 %</td>
                                <td>55 %</td>
                         		<td align="right"><?php echo number_format($ppn_in_adm*45/100, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($ppn_in_adm*55/100, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($ppn_in_adm, 0, ',', '.'); ?></td>
                            </tr>
							<?php /**/?>
                            <tr>
                             	<td align="center">4</td>
                                <td>Ppn</td>
                                <td></td>
                                <td></td>
             					<td align="right"><?php echo number_format($ppn_in_ap, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($ppn_in_gp, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($in_ppn, 0, ',', '.'); ?></td>
                            </tr>
							<?php /**/ ?>
                            <tr>
                            	<td colspan="4" align="center"><strong>Total</strong></td>
                                <td align="right"><strong><?php echo number_format($in_csc+(($in_whc+$in_adm)*45/100)+$ppn_in_ap, 0, ',', '.'); ?></strong></td>
                                <td align="right"><strong><?php echo number_format((($in_whc+$in_adm)*55/100)+$ppn_in_gp, 0, ',', '.'); ?></strong></td>
                                <td align="right"><strong><?php echo number_format($in_csc+$in_whc+$in_adm+$in_ppn, 0, ',', '.'); ?></strong></td>
                            </tr>
                            
                    </table>      
                             
                    <table>
                    		<tr>
                            	<td align="center" colspan="7"><strong>OUTGOING RECONCILIATION <?php echo strtoupper(mdate("%d-%M-%Y", strtotime($startdate)))." s/d ".strtoupper(mdate("%d-%M-%Y", strtotime($enddate))); ?></strong></td>
                            </tr>	
                            <tr>
                            	<td align="center"><strong>No</strong></td>
                            	<td align="center"><strong>Keterangan</strong></td>
                                <td align="center" colspan="2"><strong>Sharing</strong></td>
                                <td align="center"><strong>PT Angkasa Pura II</strong></td>
                                <td align="center"><strong>PT Gapura Angkasa</strong></td>
                                <td align="center"><strong>Jumlah</strong></td>
                            </tr>
                    <?php 
					
					$out_whc = 0;
					$out_csc= 0;
					$out_adm = 0;
					$out_ppn=0;
					
					foreach($outgoing as $items_out):
					$out_whc = $out_whc + $items_out->whc; 
					$out_csc = $out_csc + $items_out->csc; 
					$out_adm = $out_adm + $items_out->adm;
					$out_ppn = $out_ppn + $items_out->ppn; 	
					endforeach;
					
					$ppn_out_whc = $out_whc * 10/100;
					$ppn_out_csc = $out_csc * 10/100;
					$ppn_out_adm = $out_adm * 10/100;
					$ppn_out_ap = $ppn_out_csc + ($ppn_out_whc * 45/100) + ($ppn_out_adm * 45/100); 
					$ppn_out_gp = ($ppn_out_whc * 55/100) + ($ppn_out_adm * 55/100);
					$ppn_out_total 	= $ppn_out_whc + $ppn_out_csc + $ppn_out_adm ;
					
					?>
    						
                            
                            <tr>
                             	<td align="center" rowspan="2">1</td>
                                <td>Cargo Service Charge</td>
                                <td>100 %</td>
                                <td>0 %</td>
                                <td align="right"><?php echo number_format($out_csc, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format(0, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($out_csc, 0, ',', '.'); ?></td>
                            </tr>
							<tr>
                             	<td>Ppn Cargo Service Charge</td>
                                <td>100 %</td>
                                <td>0 %</td>
                                <td align="right"><?php echo number_format($ppn_out_csc, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format(0, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($ppn_out_csc, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                             	<td align="center" rowspan="2">2</td>
                                <td>Warehouse Charge</td>
                                <td>45 %</td>
                                <td>55 %</td>
                                <td align="right"><?php echo number_format($out_whc*45/100, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($out_whc*55/100, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($out_whc, 0, ',', '.'); ?></td>
                            </tr>
							<tr>
                             	<td>Ppn Warehouse Charge</td>
                                <td>45 %</td>
                                <td>55 %</td>
                                <td align="right"><?php echo number_format($ppn_out_whc*45/100, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($ppn_out_whc*55/100, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($ppn_out_whc, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                             	<td align="center" rowspan="2">3</td>
                                <td>Administration</td>
                                <td>45 %</td>
                                <td>55 %</td>
                         		<td align="right"><?php echo number_format($out_adm*45/100, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($out_adm*55/100, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($out_adm, 0, ',', '.'); ?></td>
                            </tr>
							<tr>
                             	<td>Ppn Administration</td>
                                <td>45 %</td>
                                <td>55 %</td>
                         		<td align="right"><?php echo number_format($ppn_out_adm*45/100, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($ppn_out_adm*55/100, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($ppn_out_adm, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                             	<td align="center">4</td>
                                <td>Ppn</td>
                                <td>45 %</td>
                                <td>55 %</td>
             					<td align="right"><?php echo number_format($ppn_out_ap, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($ppn_out_gp, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($out_ppn, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                            	<td colspan="4" align="center"><strong>Total</strong></td>
                                <td align="right"><strong><?php echo number_format($out_csc+(($out_whc+$out_adm+$out_ppn)*45/100), 0, ',', '.'); ?></strong></td>
                                <td align="right"><strong><?php echo number_format(($out_whc+$out_adm+$out_ppn)*55/100, 0, ',', '.'); ?></strong></td>
                                <td align="right"><strong><?php echo number_format($out_csc+$out_whc+$out_adm+$out_ppn, 0, ',', '.'); ?></strong></td>
                            </tr>
                            
                    </table>            
                    
					<table>
                    		<tr>
                            	<td align="center" colspan="7"><strong>TOTAL RECONCILIATION <?php echo strtoupper(mdate("%d-%M-%Y", strtotime($startdate)))." s/d ".strtoupper(mdate("%d-%M-%Y", strtotime($enddate))); ?></strong></td>
                            </tr>	
                            <tr>
                            	<td align="center"><strong>No</strong></td>
                            	<td align="center"><strong>Keterangan</strong></td>
                                <td align="center" colspan="2"><strong>Sharing</strong></td>
                                <td align="center"><strong>PT Angkasa Pura II</strong></td>
                                <td align="center"><strong>PT Gapura Angkasa</strong></td>
                                <td align="center"><strong>Jumlah</strong></td>
                            </tr>
                    <?php 
					$tot_whc = $in_whc + $out_whc;
					$tot_csc = $in_csc + $out_csc;
					$tot_adm = $in_adm + $out_adm;
					$tot_ppn = $in_ppn + $out_ppn;
					
					$ppn_tot_whc = $tot_whc *10/100;
					$ppn_tot_csc = $tot_csc *10/100;
					$ppn_tot_adm = $tot_adm *10/100;
					
					$ppn_tot_ap = $ppn_in_ap + $ppn_out_ap;
					$ppn_tot_gp = $ppn_in_gp + $ppn_out_gp;
					
					
					?>
    						
                            
                            <tr>
                             	<td align="center" rowspan="2">1</td>
                                <td>Cargo Service Charge</td>
                                <td>100 %</td>
                                <td>0 %</td>
                                <td align="right"><?php echo number_format($tot_csc, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format(0, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($tot_csc, 0, ',', '.'); ?></td>
                            </tr>
							 <tr>
                             	<td>Ppn Cargo Service Charge</td>
                                <td>100 %</td>
                                <td>0 %</td>
                                <td align="right"><?php echo number_format($ppn_tot_csc, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format(0, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($ppn_tot_csc, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                             	<td align="center" rowspan="2">2</td>
                                <td>Warehouse Charge</td>
                                <td>45 %</td>
                                <td>55 %</td>
                                <td align="right"><?php echo number_format($tot_whc*45/100, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($tot_whc*55/100, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($tot_whc, 0, ',', '.'); ?></td>
                            </tr>
							<tr>
                             	<td>Ppn Warehouse Charge</td>
                                <td>45 %</td>
                                <td>55 %</td>
                                <td align="right"><?php echo number_format($ppn_tot_whc*45/100, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($ppn_tot_whc*55/100, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($ppn_tot_whc, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                             	<td align="center" rowspan="2">3</td>
                                <td>Administration</td>
                                <td>45 %</td>
                                <td>55 %</td>
                         		<td align="right"><?php echo number_format($tot_adm*45/100, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($tot_adm*55/100, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($tot_adm, 0, ',', '.'); ?></td>
                            </tr>
							<tr>
                             	<td>Ppn Administration</td>
                                <td>45 %</td>
                                <td>55 %</td>
                         		<td align="right"><?php echo number_format($ppn_tot_adm*45/100, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($ppn_tot_adm*55/100, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($ppn_tot_adm, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                             	<td align="center">4</td>
                                <td>Ppn</td>
                                <td>45 %</td>
                                <td>55 %</td>
             					<td align="right"><?php echo number_format($ppn_tot_ap, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($ppn_tot_gp, 0, ',', '.'); ?></td>
                                <td align="right"><?php echo number_format($tot_ppn, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                            	<td colspan="4" align="center"><strong>Total</strong></td>
                                <td align="right"><strong><?php echo number_format($tot_csc+(($tot_whc+$tot_adm)*45/100)+$ppn_tot_ap, 0, ',', '.'); ?></strong></td>
                                <td align="right"><strong><?php echo number_format(($tot_whc+$tot_adm)*55/100 + $ppn_tot_gp, 0, ',', '.'); ?></strong></td>
                                <td align="right"><strong><?php echo number_format($tot_csc+$tot_whc+$tot_adm+$tot_ppn, 0, ',', '.'); ?></strong></td>
                            </tr>
                            
                    </table>    
                    
                    <?php echo anchor('cashier/pdf_reconciliation_result/' . $startdate.'/'.$enddate, 'EXPORT TO PDF'); ?>
</div>
