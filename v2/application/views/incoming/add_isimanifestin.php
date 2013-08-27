<div id="content">
	<?php echo form_open('incoming/save_isimanifestin'); ?>
      <table>
      	<tr>
			<td>
			Penerima
			</td>
			<td>
			<input type="text" name="penerima" placeholder="penerima" >
			</td>
        </tr>
		<tr>
			<td>
			Alamat Penerima
			</td>
			<td>
			<textarea name="alamat_penerima" placeholder="alamat penerima" ></textarea>
			</td>
        </tr>
		<tr>
			<td colspan="2">
				<input type="hidden" name="id_manifestin" value="<?php echo $id_manifestin ; ?>">
				<input type="hidden" name="no_smu" value="<?php echo $no_smu ; ?>">
				<input type="hidden" name="jenis_barang" value="<?php echo $jenis_barang ; ?>">
				<input type="hidden" name="asal" value="<?php echo $asal ; ?>">
				<input type="hidden" name="tujuan" value="<?php echo $tujuan ; ?>">
				<input type="hidden" name="berat_bayar" value="<?php echo $berat_bayar ; ?>">
				<input type="hidden" name="koli" value="<?php echo $koli ; ?>">
			</td>
		</tr>
		<tr>
			<td colspan=2><input type='submit' value='Save'></td>
		</tr>
      </table>
      <?php echo form_close(); ?>
</div>

