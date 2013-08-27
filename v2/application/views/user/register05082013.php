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
                        	<td>NIPP</td>
                            <td><input type="text" name="nipp" /></td>
                        </tr>
                        <tr>
                        	<td>Jabatan</td>
                            <td><input type="text" name="jabatan" /></td>
                        </tr>
                        <tr>
                        	<td>Level</td>
                            <td>
                            	<select name="level">
                                	<option name="btb">btb staff</option>
                                    <option name="store_in">break down checker</option>
                                    <option name="incoming">incoming staff</option>
                                    <option name="store_out">build up checker</option>
                                    <option name="outgoing">outgoing staff</option>
                                    <option name="kasir">kasir staff</option>
                                    <option name="supervisor">supervisor</option>
                                    <option name="gapura">management gp</option>
                                    <option name="angkasa_pura">angkasa pura</option>
                            	</select>
                            </td>
                        </tr>
                        <tr>
                        	<td>&nbsp;</td>
                            <td><?php echo form_submit('submit', 'Sign Up!', 'class = "btn btn-primary pull-right"'); ?></td>
                        </tr>
                    </table>
                	<?php echo form_close(); ?>
</div>
