<div id="content">
<h2>Login Area</h2>
<?php echo form_open('login/cek_login', 'class="form-inline"'); ?>
  <div class="form-group">
    <div class="col-lg-2">
  
    <input type="text" class="form-control" id="exampleInputEmail2" placeholder="User Name" name="username">
    </div>
  </div>
  <div class="form-group">
  <div class="col-lg-2">
    
    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" name="password">
    </div>
  </div>
  <div class="form-group">
  <div class="col-lg-2">
  
  <button type="submit" class="btn btn-default" value="login">Login</button>
  </div>
  </div>
<?php echo form_close(); ?>
</div>

