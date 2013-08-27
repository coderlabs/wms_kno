<div id="content">
	<?php echo form_open('login/cek_login'); ?>
      <table>
      	<tr>
        	<td>Username</td>
            <td> : <input type='text' name='username'></td>
     	</tr>
      <tr>
      	<td>Password</td>
        <td> : <input type='password' name='password'></td>
  	  </tr>
      <tr>
      	<td colspan=2><input type='submit' value='Login'></td>
      </tr>
      </table>
      <?php echo form_close(); ?>
</div>

