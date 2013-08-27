<div id="content">
		<h4>Register User Baru</h4>
		<?php echo form_open('login/save_user'); ?>
                    <table>
                    	<tr>
                        	<td>Username</td>
                            <td><input type="text" name="id_user" /></td>
                        </tr>
                        <tr>
                        	<td>Password</td>
                            <td><input type="password" name="password" /></td>
                        </tr>
                        <tr>
                        	<td>Nama Lengkap</td>
                            <td><input type="text" name="nama_lengkap" /></td>
                        </tr>
                        <tr>
                        	<td>Email</td>
                            <td><input type="text" name="email" /></td>
                        </tr>
                        <tr>
                        	<td>Level</td>
                            <td>
                            	<select name="level">
                                	<option value="btb" name="btb">btb staff</option>
                                    <option value="store_in" name="store_in">break down checker</option>
                                    <option value="incoming" name="incoming">incoming staff</option>
                                    <option value="store_out" name="store_out">build up checker</option>
                                    <option value="outgoing" name="outgoing">outgoing staff</option>
                                    <option value="kasir" name="kasir">kasir staff</option>
                                    <option value="supervisor" name="supervisor">supervisor</option>
                                    <option value="gapura" name="gapura">management gp</option>
                                    <option value="angkasa_pura" name="angkasa_pura">angkasa pura</option>
                            	</select>
                            </td>
                        </tr>
                        <tr>
                        	<td>NIPP</td>
                            <td><input type="text" name="nipp" /></td>
                        </tr>
                        <tr>
                        	<td>Jabatan</td>
                            <td><input type="text" name="jabatan" /></td>
                        </tr>
                        <tr>
                        	<td>&nbsp;</td>
                            <td><?php echo form_submit('submit', 'Sign Up!', 'class = "btn btn-primary pull-right"'); ?></td>
                        </tr>
                    </table>
                	<?php echo form_close(); ?>
</div>
