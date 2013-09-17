<div id="content">
<h2>Input Breakdown Cargo</h2>


						<?php echo form_open('incoming/insert_manifest_instore'); ?>
    							<div class="input-group col-lg-3">
      								<input type="text" name="incoming" placeholder="GA/12611111111/1/10" size="66" class="form-control">
                                    <span class="input-group-btn">
                                    <?php echo form_submit('submit','Save', 'class="btn btn-primary"'); ?>
                                  </span>
                                </div>
                    	<?php echo form_close(); ?>
      
      
      <br /><br />
	  <?php 
		if(($this->uri->segment(4) == "error" ) OR ($this->uri->segment(3) == "error" ))
		{ 
			echo "<b> Proses Input Gagal <br> Input Data harus sesuai dengan format yang disediakan </b>";
		}
		elseif(($this->uri->segment(4) == "error1062" ) OR ($this->uri->segment(3) == "error1062" ))
		{ 
			echo "<b> Proses Input Gagal <br> Data yang anda input terindikasi sebagai <font color='#ff0000' >DUPLIKAT DATA</font> </b>";
		}
		elseif($this->uri->segment(4) == "success" )
		{ 
			echo "<b> Proses Input Berhasil </b>";
		?>
		<table>
			<tr>
				<th>No</th>
				<th>Airlines</th>
				<th>SMU</th>
				<th>Koli</th>
				<th>Berat</th>
				<th>Aksi</th>
			</tr>
			<?php
				$no = 0;
				foreach($result as $row)
				{ 
				$no++;
			?>
				<?php // echo form_open('incoming/create_btb');?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><input type="text" name="airlines" value="<?php echo strtoupper($row->inb_airlines);?>" readonly></td>
					<td><input type="text" name="no_smu" value="<?php echo $row->inb_no_smu;?>" readonly></td>
					<td><input type="text" name="koli" value="<?php echo $row->inb_koli;?>" readonly></td>
					<td><input type="text" name="berat_aktual" value="<?php echo $row->inb_berat_aktual;?>" readonly></td>
					<td><?php 
						echo anchor('incoming/void_breakdown/'.$row->inb_id,'VOID', 'class="btn btn-danger"'); 
						
						?>
					</td>
				</tr>
				<?php // echo form_close(); ?>
			<?php
				}
			?>
		</table>
		<?php
		}
	  ?>
      <?php echo form_close(); ?>
</div>

