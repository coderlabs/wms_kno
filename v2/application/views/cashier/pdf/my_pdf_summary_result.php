<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PT Gapura Angkasa Kualanamu | Warehouse Management System</title>
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
<body>

            	<p><strong>PT Gapura Angkasa - PT Angkasa Pura II (persero)</strong></p>
                <p><strong>Domestic Cargo Warehouse - Kualanamu International Airport</strong></p>
                <p><strong>Income Summary Report - <?php echo strtoupper(mdate("%d %F %Y", strtotime($date))); ?></strong></p>
                <p><strong>Cashier - <?php echo strtoupper($user); ?></strong></p>
					
                    <table  border="1" class="gridtable" width="1024px">
                    		<tr>
                            	<td colspan="3" width="30%"><div align="center"><strong><?php echo strtoupper(mdate("%d-%M-%Y", strtotime($date))); ?></strong></div></td>
                            	<td colspan="6" width="70%"><div align="center"><strong>INBOUND SUMMARY INCOME</strong></div></td>
                            </tr>	
                            <tr>
                            	<td><div align="center"><strong>Airline</strong></div></td>
                            	<td><div align="center"><strong>Koli</strong></div></td>
                                <td><div align="center"><strong>Berat</strong></div></td>
                                <td><div align="center"><strong>WHC</strong></div></td>
                                <td><div align="center"><strong>CSC</strong></div></td>
                                <td><div align="center"><strong>ADM</strong></div></td>
                                <td><div align="center"><strong>Sub Total</strong></div></td>
                                <td><div align="center"><strong>PPN</strong></div></td>
                                <td><div align="center"><strong>Total</strong></div></td>
                            </tr>
                    <?php 
					$tot_koli = 0;
					$tot_berat = 0;
					$tot_whc = 0;
					$tot_csc = 0;
					$tot_adm = 0;
					$tot_sub_total = 0;
					$tot_ppn = 0;
					$in_grand_total = 0;
					foreach($incoming as $items):
					$tot_koli = $tot_koli + $items->koli;
					$tot_berat = $tot_berat +  $items->kilo;
					$tot_whc = $tot_whc + $items->whc;
					$tot_csc = $tot_csc + $items->csc;
					$tot_adm = $tot_adm + $items->adm;
					$tot_sub_total = $tot_sub_total + $items->whc+$items->csc+$items->adm;
					$tot_ppn = $tot_ppn + $items->ppn;
					$in_grand_total = $in_grand_total + $items->totbiaya;
					?>
    						
                            
                             <tr>
                             	<td><div align="center"><strong><?php echo strtoupper($items->in_airline); ?></strong></div></td>
                              	<td><div align="right"><?php echo number_format($items->koli, 0, ',', '.'); ?></div></td>
                              	<td><div align="right"><?php echo number_format($items->kilo, 1, ',', '.'); ?></div></td>
                                <td><div align="right"><?php echo number_format($items->whc, 0, ',', '.'); ?></div></td>
                                <td><div align="right"><?php echo number_format($items->csc, 0, ',', '.'); ?></div></td>
                                <td><div align="right"><?php echo number_format($items->adm, 0, ',', '.'); ?></div></td>
                                <td><div align="right"><?php echo number_format($items->whc+$items->csc+$items->adm, 0, ',', '.'); ?></div></td>
                                <td><div align="right"><?php echo number_format($items->ppn, 0, ',', '.'); ?></div></td>
                                <td><div align="right"><?php echo number_format($items->totbiaya, 0, ',', '.'); ?></div></td>
                             </tr> 
                             
                             
                    <?php endforeach; ?>
                    
                    		<tr>
                             	<td><div align="center"><strong>GRAND TTL</strong></div></td>
                                <td><div align="right"><strong><?php echo number_format($tot_koli, 0, ',', '.'); ?> koli</strong></div></td>
                                <td><div align="right"><strong><?php echo number_format($tot_berat, 1, ',', '.'); ?> Kg</strong></div></td>
                                <td><div align="right"><strong>Rp. <?php echo number_format($tot_whc, 0, ',', '.'); ?></strong></div></td>
                                <td><div align="right"><strong>Rp. <?php echo number_format($tot_csc, 0, ',', '.'); ?></strong></div></td>
                                <td><div align="right"><strong>Rp. <?php echo number_format($tot_adm, 0, ',', '.'); ?></strong></div></td>
                                <td><div align="right"><strong>Rp. <?php echo number_format($tot_sub_total , 0, ',', '.'); ?></strong></div></td>
                                <td><div align="right"><strong>Rp. <?php echo number_format($tot_ppn , 0, ',', '.'); ?></strong></div></td>
                                <td><div align="right"><strong>Rp. <?php echo number_format($in_grand_total, 0, ',', '.'); ?></strong></div></td>
                             </tr>  
                    
                    </table>
                    
                     <table  border="1" class="gridtable" width="1024px">
                    		<tr>
                            	<td colspan="3" width="30%"><div align="center"><strong><?php echo strtoupper(mdate("%d-%M-%Y", strtotime($date))); ?></strong></div></td>
                            	<td colspan="6" width="70%"><div align="center"><strong>OUTBOUND SUMMARY INCOME</strong></div></td>
                            </tr>	
                           <tr>
                            	<td><div align="center"><strong>Airline</strong></div></td>
                            	<td><div align="center"><strong>Koli</strong></div></td>
                                <td><div align="center"><strong>Berat</strong></div></td>
                                <td><div align="center"><strong>WHC</strong></div></td>
                                <td><div align="center"><strong>CSC</strong></div></td>
                                <td><div align="center"><strong>ADM</strong></div></td>
                                <td><div align="center"><strong>Sub Total</strong></div></td>
                                <td><div align="center"><strong>PPN</strong></div></td>
                                <td><div align="center"><strong>Total</strong></div></td>
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
                             	<td><div align="center"><strong><?php echo strtoupper($items->airline); ?></strong></div></td>
                              <td><div align="right"><?php echo number_format($items->koli, 0, ',', '.'); ?></div></td>
                              <td><div align="right"><?php echo number_format($items->kilo, 1, ',', '.'); ?></div></td>
                                <td><div align="right"><?php echo number_format($items->whc, 0, ',', '.'); ?></div></td>
                                <td><div align="right"><?php echo number_format($items->csc, 0, ',', '.'); ?></div></td>
                                <td><div align="right"><?php echo number_format($items->adm, 0, ',', '.'); ?></div></td>
                                <td><div align="right"><?php echo number_format($items->whc+$items->csc+$items->adm, 0, ',', '.'); ?></div></td>
                                <td><div align="right"><?php echo number_format($items->ppn, 0, ',', '.'); ?></div></td>
                                <td><div align="right"><?php echo number_format($items->totbiaya, 0, ',', '.'); ?></div></td>
                             </tr> 
                             
                             
                    <?php endforeach; ?>
                    
                    		<tr>
                             	<td><div align="center"><strong>GRAND TTL</strong></div></td>
                                <td><div align="right"><strong><?php echo number_format($tot_koli, 0, ',', '.'); ?> koli</strong></div></td>
                                <td><div align="right"><strong><?php echo number_format($tot_berat, 1, ',', '.'); ?> Kg</strong></div></td>
                                <td><div align="right"><strong>Rp. <?php echo number_format($tot_whc, 0, ',', '.'); ?></strong></div></td>
                                <td><div align="right"><strong>Rp. <?php echo number_format($tot_csc, 0, ',', '.'); ?></strong></div></td>
                                <td><div align="right"><strong>Rp. <?php echo number_format($tot_adm, 0, ',', '.'); ?></strong></div></td>
                                <td><div align="right"><strong>Rp. <?php echo number_format($tot_sub_total , 0, ',', '.'); ?></strong></div></td>
                                <td><div align="right"><strong>Rp. <?php echo number_format($tot_ppn , 0, ',', '.'); ?></strong></div></td>
                                <td><div align="right"><strong>Rp. <?php echo number_format($out_grand_total, 0, ',', '.'); ?></strong></div></td>
                             </tr>  
                    
                    </table>
					
					<table border="1" class="gridtable" width="1024px">
                    		<tr>
                            	<td colspan="3" align="center"><strong><?php echo strtoupper(mdate("%d-%M-%Y", strtotime($date))); ?></strong></td>
                            	<td colspan="4" align="center"><strong>VOID SUMMARY</strong></td>
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
                    
                    <table border="1" class="gridtable" width="1024px">
                    	<tr>
                        	<td align="center" colspan="12"><strong>L E G E N D</strong></td>
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

</body>
</html>
