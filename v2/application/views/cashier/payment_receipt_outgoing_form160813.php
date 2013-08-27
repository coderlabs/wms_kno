<div id='content'>
<script type="text/javascript">
function hitungtotal()
{
var admin=document.getElementById("administrasi");
var sewa =document.getElementById("sewa_gudang");
var ppn=document.getElementById("ppn");
var total=document.getElementById("total");
var disc=document.getElementById("discount");
var day=document.getElementById("day");
var berat=document.getElementById("berat_bayar");

var tsg = Number(sewa_gudang.value)*Number(day.value)*Number(berat.value);
var total_bayar = Number(admin.value) + tsg;
var ppn_value = Number(ppn.value) * total_bayar/100;
var total_all = total_bayar + ppn_value;


document.getElementById("ppn_rp").value = ppn_value;
document.getElementById("total_bayar").value = total_all;
document.getElementById("total").value = tsg;
}
</script>


            	<h2>Payment Receive BTB - Outgoing</h2>
				
				<table>
				
                    <?php 
					//print_r($weighing_details);
					foreach ($outgoing as $row)
					{
					if ($row->status_bayar == 'no')
					{
						echo form_open('cashier/payment/save_payment/dbo'); 
					} else
					{
						echo form_open('cashier/payment/reprint_db/'.$row->btb_nobtb);
					}
					//echo form_hidden('btb_type',strtoupper($type));
					?>
					<input name="day" id="day" class="span2" placeholder="ALL" type="hidden" value="<?php echo $jumhari; ?>" >
					<input name="type" id="type" class="span2" placeholder="ALL" type="hidden" value="1" >
					<input name="minc" id="minc" class="span2" placeholder="ALL" type="hidden" value="<?php echo $mincharge; ?>" >
					<input name="minw" id="minw" class="span2" placeholder="ALL" type="hidden" value="<?php echo $minweight; ?>" >
					<input name="overtime" id="overtime" class="span2" placeholder="ALL" type="hidden" value="<?php echo $overtime; ?>" >
					<input name="whc" id="whc" class="span2" placeholder="ALL" type="hidden" value="<?php echo $whc; ?>" >
					<input name="csc" id="csc" class="span2" placeholder="ALL" type="hidden" value="<?php echo $csc; ?>" >
					<tr><td>
					<table>
					<tr>
						<td>Tanggal BTB</td>
						<td><input name="date" class="span2" placeholder="ALL" type="text" value="<?php echo mdate('%d-%m-%Y', strtotime($row->btb_date)); ?>" readonly></td>
					</tr><tr>
						<td>BTB No</td>
							<td><input name="btb_no" class="span2" placeholder="ALL" type="text" value="<?php echo $row->btb_nobtb; ?>" readonly></td>
					</tr>
					<tr>
						<td>Pengirim/Agent</td>
						<td><input name="agent" class="span2" placeholder="ALL" type="text" value="<?php echo $row->btb_agent; ?>" readonly></td>
					</tr>
					<tr>
						<td>NO SMU</td>
						<td><input name="awb_no" class="span2" placeholder="-" type="text" value="<?php echo $row->btb_smu; ?>" readonly></td>
					</tr>
					<tr>
						<td>Airline / Tujuan</td>
						<td><input name="airline" size="5" placeholder="ALL" type="text" value="<?php echo $row->airline; ?>" readonly> / <input name="airline" size="5" placeholder="ALL" type="text" value="<?php echo $row->btb_tujuan; ?>" readonly></td>
					</tr>
					<tr>
						<td>Tanggal Masuk</td>
						<td><input name="date_in" class="span2" placeholder="ALL" type="text" value="<?php echo mdate('%d-%m-%Y %h:%i', strtotime($row->btb_date)); ?>" readonly></td>
					</tr>
					<tr>
						<td>Tanggal Keluar</td>
						<td><input name="date_out" class="span2" placeholder="ALL" type="text" value="<?php echo mdate('%d-%m-%Y %h:%i'); ?>" readonly></td>
					</tr>
					<tr>
						<td>Total Hari</td>
						<td><input name="jum_hari" class="span2" placeholder="ALL" type="text" value="<?php echo $jumhari ?>" readonly></td>
						<input name="min_hari" class="span2" placeholder="ALL" type="hidden" value="<?php echo $minhari ?>" readonly>
					</tr>
					<tr>
					<td>Payment Type</td>
						<td><?php
							foreach ($payment_type as $row_pt ){
									$pt[$row_pt->payment_type_name]=strtoupper($row_pt->payment_type_name);
							}
							echo form_dropdown('payment_type',$pt);
						?>
						</td>
					</tr>
					</table>
				</td><td>
					<table>	
					<tr>
						<td>Total Berat Bayar (Kg)</td>
						<td><input name="berat_bayar" id="berat_bayar" class="span2" placeholder="" type="text" value="<?php echo $totalberat; ?>"onchange='javascript:hitungtotal(this.value)'></td>
					</tr>
					<tr>
						<td>Sewa Gudang/Hari (Rp)</td>
						<td><input name="sewa_gudang" id="sewa_gudang" class="span2" placeholder="ALL" type="text" value="<?php echo $sph; ?>" onchange='javascript:hitungtotal(this.value)'></td>
					</tr>
					<tr>
					<td>Disc. (% | Rp)</td>
						<td><input name="discount" size="5" onchange='javascript:hitungtotal(this.value)' type="text" readonly><input type="text" name="disc_rp" id="disc_rp" size="20" readonly></td>
					</tr>
					<tr>
						<td>Total Sewa Gudang (Rp)</td>
						<td><input name="total" id="total" class="span2" placeholder="ALL" type="text" value="<?php echo $total; ?>" onchange='javascript:hitungtotal(this.value)'> *<?php echo $minhari; ?> hari</td>
					</tr>
					<tr>
						<td>Administrasi (Rp)</td>
						<td><input name="administrasi" id="administrasi" class="span2" placeholder="" type="text" onchange='javascript:hitungtotal(this.value)' value="<?php echo $admin; ?>"></td>
					</tr>
					<tr>
						<td>PPn (%)</td>
						<td><input name="ppn" id="ppn" size="5" onchange='javascript:hitungtotal(this.value)' type="text" value="<?php echo $ppn; ?>"><input type="text" name="ppn_rp" id="ppn_rp" size="20" value="<?php echo $ppn*($total+$admin)/100; ?>" readonly></td>
					</tr>
					<tr>
						<td>Biaya Total (Rp)</td>
						<td><input name="total_bayar" id="total_bayar" class="span2" placeholder="ALL" type="text" value="<?php echo $ppn*($total+$admin)/100 + $total + $admin; ?>"></td>
					</tr>
					
					<tr>
						<td colspan="2" >Keterangan : <br/><textarea name="ket" cols="40"></textarea></td>
					</tr>
					<tr>
					</tr>
				</table>
				</td></tr>
				<tr>
					<td></td><td>
					<?php if($row->status_bayar == 'no')
						{ echo form_submit('submit', 'SAVE & PRINT' , 'class="btn btn-primary"'); }
						else {
							echo form_submit('submit', 'PRINT ULANG' , 'class="btn btn-primary"');
							echo '&nbsp';
							echo '&nbsp';
							echo anchor('cashier/payment/void_dbo/'.$row->btb_nobtb,'VOID');
						}?>
</td>
				</tr>
				</table>
			
					<?php 
					}
					
					?>
					
        </div>
