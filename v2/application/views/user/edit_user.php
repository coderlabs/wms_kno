<div id="content">
		<h4>Edit Data User</h4>

		<?php echo form_open('user/update_data_user'); ?>
                    <table>
						<?php foreach($result as $row){ ?>
                    	<tr>
                        	<td>Username</td>
                            <td><input type="text" name="id_user" value="<?php echo $row->id_user;?>" readonly></td>
                        </tr>
                        <tr>
                        	<td>Nama Lengkap</td>
                            <td><input type="text" name="nama_lengkap" value="<?php echo $row->nama_lengkap;?>" /></td>
                        </tr>
                        <tr>
                        	<td>Email</td>
                            <td><input type="text" name="email" value="<?php echo $row->email;?>" /></td>
                        </tr>
                        <tr>
                        	<td>Level</td>
                            <td>
                            	<select name="level">
                                	<option value="btb" name="btb" <?php if($row->level == 'btb'){echo 'selected';}?>>btb staff</option>
                                    <option value="store_in" name="store_in" <?php if($row->level == 'store_in'){echo 'selected';}?>>break down checker</option>
                                    <option value="incoming" name="incoming" <?php if($row->level == 'incoming'){echo 'selected';}?>>incoming staff</option>
                                    <option value="store_out" name="store_out" <?php if($row->level == 'store_out'){echo 'selected';}?>>build up checker</option>
                                    <option value="outgoing" name="outgoing" <?php if($row->level == 'outgoing'){echo 'selected';}?>>outgoing staff</option>
                                    <option value="kasir" name="kasir" <?php if($row->level == 'kasir'){echo 'selected';}?>>kasir staff</option>
                                    <option value="supervisor" name="supervisor" <?php if($row->level == 'supervisor'){echo 'selected';}?>>supervisor</option>
                                    <option value="gapura" name="gapura" <?php if($row->level == 'gapura'){echo 'selected';}?>>management gp</option>
                                    <option value="angkasa_pura" name="angkasa_pura" <?php if($row->level == 'angkasa_pura'){echo 'selected';}?>>angkasa pura</option>
                            	</select>
                            </td>
                        </tr>
                        <tr>
                        	<td>NIPP</td>
                            <td><input type="text" name="nipp" value="<?php echo $row->nipp;?>" /></td>
                        </tr>
                        <tr>
                        	<td>Jabatan</td>
                            <td><input type="text" name="jabatan" value="<?php echo $row->jabatan;?>" /></td>
                        </tr>
						<tr>
                        	<td>Telepon</td>
                            <td><input type="text" name="telpon" value="<?php echo $row->telpon;?>" /></td>
                        </tr>
                        <tr>
                        	<td>&nbsp;</td>
                            <td><?php echo form_submit('submit', 'Update', 'class = "btn btn-primary pull-right"'); ?></td>
                        </tr>
						<?php } ?>
                    </table>
                	<?php echo form_close(); ?>
</div>
