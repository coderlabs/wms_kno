<script type="text/javascript">
$(document).ready(function () {
   $("#c_password").blur(checkPasswordMatch);
});
function checkPasswordMatch() {
    var password = $("#password").val();
    var confirmPassword = $("#c_password").val();

    if (password != confirmPassword)
        $("#divCheckPasswordMatch").html("<font color='#ff0000'>Passwords do not match!</font>");
		
    else{
        $("#divCheckPasswordMatch").html("Passwords match.");
		$("#divShowSubmit").html("<input type='submit' value='change' class='btn btn-primary pull-right' >");
	}
}
</script>
<div id="content">
		<h4>Ganti Password</h4>
	
		<?php echo form_open('user/update_password'); ?>
                    <table>
						<?php foreach($result as $row){ ?>
                    	<tr>
                        	<td>Username</td>
                            <td><input type="text" name="id_user" value="<?php echo $row->id_user;?>" readonly></td>
                        </tr>
						<tr>
                        	<td>Password</td>
                            <td><input type="password" name="password" id="password" value="" /></td>
                        </tr>
						<tr>
                        	<td>Re-enter Password</td>
                            <td><input type="password" name="c_password" id="c_password" value="" />
								<div class="registrationFormAlert" id="divCheckPasswordMatch"></div>
							</td>
                        </tr>
                        <tr>
                        	<td>&nbsp;</td>
                            <td><div id="divShowSubmit"></div></td>
                        </tr>
						<?php } ?>
                    </table>
        <?php echo form_close(); ?>
	
</div>
