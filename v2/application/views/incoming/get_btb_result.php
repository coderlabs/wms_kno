<div id="content">
	<h2>Cari BTB</h2>
    
    <div class="row">
    			
			
            <div class="col-lg-4">	
            <?php echo form_open('incoming/create_btb'); ?>    			
            
				<?php if(isset($result)) { foreach($result as $row){ ?>
                
                <?php
					if($row->inb_status_gudang == 'outstore')
					{
						$status_gudang = 'belum datang';
					}
					elseif($row->inb_status_gudang == 'instore')
					{
						$status_gudang = 'dalam gudang';
					}
					elseif($row->inb_status_gudang == 'pickup')
					{
						$status_gudang = 'sudah diambil';
					}
					else
					{
						$status_gudang = 'tidak diketahui';
					}
				?>
				
                <h3><?php echo "No BTB : " . strtoupper($row->in_btb); ?></h3>
                
                <table width="500">
                <tr>
                	<td><strong>Airline</strong></td><td>:</td><td><?php echo strtoupper($row->in_airline); ?></td>
                    <td><strong>Flight No</strong></td><td>:</td><td><?php echo $row->inb_flight_number?></td>
				</tr>
                
                <tr>
                	<td><strong>SMU</strong></td><td>:</td><td><?php echo $row->inb_no_smu; ?></td>
                	<td><strong>Agent</strong></td><td>:</td><td><?php echo $row->in_agent; ?></td>

                </tr>
				
                <tr>
                	<td><strong>Koli</strong></td><td>:</td><td><?php echo $row->inb_koli;?></td>
                    <td><strong>Nama</strong></td><td>:</td><td><?php echo $row->in_name;?></td>
                </tr>
                
                <tr>
                	<td><strong>Berat Aktual</strong></td><td>:</td><td><?php echo $row->inb_berat_aktual;?></td>
                    <td><strong>Jenis Barang</strong></td><td>:</td><td><?php echo $row->in_jenisbarang;?></td>
               	</tr>
                
                <tr>
                	<td><strong>Berat Volume</strong></td><td>:</td><td><?php echo $row->inb_berat_volume;?></td>
                    <td><strong>Status Barang</strong></td><td>:</td><td><?php echo $status_gudang;?></td>
				</tr>
                
				<tr>
                	<td><strong>Asal</strong></td><td>:</td><td><?php echo $row->in_asal;?></td>
                    <td><strong>Status Bayar</strong></td><td>:</td><td><?php if($row->in_status_bayar=='yes'){echo 'sudah bayar';}else{echo 'belum bayar';};?></td>
                </tr>
                
				<tr>
                	<td><strong>Tujuan</strong></td><td>:</td><td><?php echo $row->in_tujuan;?></td>
                    <td><strong>Status Cetak</strong></td><td>:</td><td><?php if($row->in_status_cetak==0){echo 'belum dicetak';}else{echo 'sudah dicetak';};?></td>
                </tr>
			
			</table> 
            
            <?php
				if($row->inb_status_gudang == 'instore' AND $row->inb_status_gudang == 'outstore')
				{  
				 	echo anchor('incoming/reprint_incoming_btb/' . $row->in_btb, 'Cetak Ulang', 'class="btn btn-success"'); 
				}
			?> 
			<?php
				if($row->inb_status_gudang == 'instore' AND $row->in_status_bayar == 'yes')
				{ 
					echo anchor('incoming/keluarkan_barang/' . $row->inb_id, 'Keluarkan Barang', 'class="btn btn-warning"');
				}
			?> 
			<?php
				if($row->in_status_bayar == 'no')
				{  
					echo anchor('','Void BTB', 'class="btn btn-danger"'); 
                }
            ?>
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


