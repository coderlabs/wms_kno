<div id="content">
	<h2>Create Inbound BTB</h2>
    
    <div class="row">
    			
			
            <div class="col-lg-2">	
            <?php echo form_open('incoming/create_btb'); ?>    			
            <table>
				<?php if(isset($result)) { foreach($result as $row){ 
				echo form_hidden('tgl_masuk', $row->inb_instore);?>
				
                <tr>
                	<td>Airline</td><td>:</td><td><input type="text" name="airline" value="<?php echo strtoupper($row->inb_airlines); ?>" readonly="readonly"></td>
                    <td>No Flight</td><td>:</td><td><input type="text" name="noflight" value="<?php echo $row->inb_flight_number?>"></td>
				</tr>
                
                <tr>
                	<td>SMU</td><td>:</td><td><input type="text" name="smu" value="<?php echo $row->inb_no_smu; ?>" readonly="readonly"></td>
                	                	<td>Agent</td><td>:</td>
					<td>
						<?php 
						$list_agent = array();
						$list_agent['personal'] = 'Personal'; 
						foreach ($agent as $row_agent)
						{
							$btbagent = $row_agent->btb_agent;
							$list_agent[$btbagent] = $row_agent->btb_agent; 
						}
						echo form_dropdown('agent',$list_agent);
						?>
					</td>

                </tr>
				
                <tr>
                	<td>Koli</td><td>:</td><td><input type="text" name="koli" value="<?php echo $row->inb_koli;?>" readonly="readonly"></td>
                    <td>Nama</td><td>:</td><td><input type="text" name="name" value=""></td>
                </tr>
                
                <tr>
                	<td>Berat Aktual</td><td>:</td><td><input type="text" name="berataktual" value="<?php echo $row->inb_berat_aktual;?>" readonly="readonly"></td>
                    <td>Jenis Barang</td>
					<td>:</td>
					<td>
						<?php
						$list_typebarang = array();
						$list_typebarang['consol'] = 'CONSOL'; 
						foreach($typebarang as $row_typebarang)
						{
							$list_typebarang[$row_typebarang->typebarang] = $row_typebarang->typebarang;
						}
						echo form_dropdown('typebarang',$list_typebarang);
						?>
					</td>
               	</tr>
                
                <tr>
                	<td>Berat Volume</td><td>:</td>
					<td>
						<input type="text" name="beratvolume" value="<?php echo $row->inb_berat_volume;?>">
						<input type="hidden" name="id_breakdown" value="<?php echo $row->inb_id;?>">
					</td>
                    <td colspan="3" rowspan="3" valign="middle" align="center"><input type="submit" value="Cetak BTB" class="btn btn-primary"></td>
				</tr>
                
				<tr>
                	<td>Asal</td><td>:</td><td><input type="text" name="asal" value="CGK"></td>
                </tr>
				<tr>
                	<td>Tujuan</td><td>:</td><td><input type="text" name="tujuan" value="KNO"></td>
               	</tr>
				
                
				
			</table> 
			<?php
			}
			}
			echo form_close();
			?>
			
		</tbody>
	  </table>
     </div>
</div>
</div>	


