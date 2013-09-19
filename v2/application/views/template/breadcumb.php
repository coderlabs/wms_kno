<div class="bs-example">
      <div id="navbar-example" class="navbar navbar-static">
        <div class="container" style="width: auto;">
          <?php $session_data = $this->session->userdata('logged_in'); ?>
          <?php echo anchor('dashboard','WMS KNO', 'class="navbar-brand"'); ?>
         
          <div class="nav-collapse collapse bs-js-navbar-collapse">
            <ul class="nav navbar-nav" role="navigation">
            
            <li><?php echo anchor('tracking/smu', 'SMU Tracking'); ?></li>
            <li><?php echo anchor('tracking/btb', 'BTB Tracking'); ?></li>
            
            
              <?php if($session_data['level'] == 'kasir' OR $session_data['level'] == 'supervisor' OR $session_data['level'] == 'gp' OR $session_data['level'] == 'ap' OR $session_data['level'] == 'admin'){ ?>
              <!-- kasir --> 	
              <li class="dropdown">
                <a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Kasir <b class="caret"></b></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
                  <?php if($session_data['level'] == 'kasir' OR $session_data['level'] == 'supervisor' OR $session_data['level'] == 'admin'){ ?>
                  <li role="presentation">Kasir</li>
                  <li role="presentation"><?php echo anchor('cashier/new_receipt','NPJG Baru'); ?></li>
                  <li role="presentation"><?php echo anchor('cashier/my_balance','Transaksiku'); ?></li>
				  <li role="presentation"><?php echo anchor('piutang/piutang_agent','Piutang Incoming'); ?></li>
				  <li role="presentation"><?php echo anchor('piutang/piutang_out_agent','Piutang Outgoing'); ?></li>
				  <li role="presentation"><?php echo anchor('cashier/list_db','List Payment Receipt'); ?></li>
				  <li role="presentation" class="divider"></li>
                  <?php } ?>
                  <li role="presentation">Laporan Penjualan</li>	
                  <li role="presentation"><?php echo anchor('harian/incoming','LPKH Incoming'); ?></li>
                  <li role="presentation"><?php echo anchor('harian/outgoing','LPKH Outgoing');  ?></li>
                  <li role="presentation"><?php echo anchor('cashier/summary','Lap. Summary');  ?></li>
                  <li role="presentation"><?php echo anchor('cashier/reconciliation','Lap. Rekonsiliasi');  ?></li>
                </ul>
              </li>
              <!-- kasir --> 
              <?php } ?>
              
               <?php if($session_data['level'] == 'incoming' OR $session_data['level'] == 'supervisor' OR $session_data['level'] == 'store_in' OR $session_data['level'] == 'admin'){ ?>
              <!-- inbound --> 
              <li class="dropdown">
                <a href="#" id="drop2" role="button" class="dropdown-toggle" data-toggle="dropdown">Inbound <b class="caret"></b></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="drop2">
                  <li role="presentation">Inbound</li>	
                  <li role="presentation"><?php echo anchor('incoming/get_smu','Cetak BTB');  ?></li>
                  <li role="presentation"><?php echo anchor('incoming/get_smu','Cari SMU');  ?></li>
                  <li role="presentation"><?php echo anchor('incoming/get_btb','Cari BTB');  ?></li>
                  <li role="presentation"><?php echo anchor('incoming/get_btb_pickup','Keluarkan Barang');  ?></li>
                  <li role="presentation"><?php echo anchor('incoming/duplicate_smu','Cari Duplikat SMU'); ?></li>
                  <li role="presentation"><?php echo anchor('incoming/stock_opname','Stock Opname'); ?></li>
                  
                
                 
                  <?php if($session_data['level'] == 'store_in' OR $session_data['level'] == 'supervisor' OR $session_data['level'] == 'admin'){ ?>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation">Breakdown Checker</li>
                  <li role="presentation"><?php echo anchor('incoming/add_manifest_instore','Input Breakdown'); ?></li>
                  <li role="presentation"><?php echo anchor('incoming/my_breakdown','My Breakdown'); ?></li>
                  
                  
                  <?php } ?>
                </ul>
              </li>
              <!-- inbound -->
              <?php } ?>
              
              <?php if($session_data['level'] == 'outgoing' OR $session_data['level'] == 'supervisor' OR $session_data['level'] == 'admin' OR $session_data['level'] == 'btb' OR $session_data['level'] == 'buildup'){ ?>
              <!-- outbound --> 
              <li class="dropdown">
                <a href="#" id="drop2" role="button" class="dropdown-toggle" data-toggle="dropdown">Outbound <b class="caret"></b></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="drop2">
                  <?php if($session_data['level'] == 'btb'){ ?>
                  <li role="presentation">BTB</li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Manual BTB</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Laporan BTB</a></li>
                  <li role="presentation" class="divider"></li>
                  <?php } ?>
                  <?php if($session_data['level'] == 'outgoing' OR $session_data['level'] == 'admin' OR $session_data['level'] == 'supervisor'){ ?>
                  <!--<li role="presentation">Doc Pros</li>-->
                  <!--<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Outgoing SMU</a></li> -->
				  <li role="presentation">Inbound</li>	
                  <li role="presentation"><?php echo anchor('outgoing/form_buildup','Build Up Check List'); ?></li>
                  <li role="presentation" class="divider"></li>
                  <?php } ?>
                  <?php if($session_data['level'] == 'buildup'){ ?>
                  <li role="presentation">Buildup Checker</li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Buildup Check List</a></li>
                  <?php } ?>
                </ul>
              </li>
              <!-- outbound --> 
			 <?php } ?>
              
              <?php if($session_data['level'] == 'admin' OR $session_data['level'] == 'supervisor'){ ?>
              <!-- supervisor --> 
              <li class="dropdown">
                <a href="#" id="drop2" role="button" class="dropdown-toggle" data-toggle="dropdown">Supervisor <b class="caret"></b></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="drop2">
                  <li role="presentation"><?php echo anchor('login/register','Register User'); ?></li>
                  <li role="presentation"><?php echo anchor('user','Daftar User'); ?></li>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation"><?php echo anchor('harian/incoming','LPKH Incoming'); ?></li>
                  <li role="presentation"><?php echo anchor('harian/outgoing','LPKH Outgoing');  ?></li>
                  <li role="presentation"><?php echo anchor('cashier/summary','Lap. Summary');  ?></li>
                  <li role="presentation"><?php echo anchor('cashier/reconciliation','Lap. Rekonsiliasi');  ?></li>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation"><?php echo anchor('cek_report/form_cek','Cek DB Incoming Manual'); ?></li>
                  <li role="presentation"><?php echo anchor('cek_report/form_generate','Cek DB Incoming By Query'); ?></li>
                </ul>
              </li>
              </ul>
              <!-- supervisor --> 
              <?php } ?>
			  
			  <?php if(isset($session_data['level']) AND $session_data['level'] != 'admin' AND $session_data['level'] != 'supervisor'){ ?>
              <!-- user setting --> 
              <li class="dropdown">
                <a href="#" id="drop2" role="button" class="dropdown-toggle" data-toggle="dropdown">User <b class="caret"></b></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="drop2">
                  <li role="presentation"><?php echo anchor('user','Pengaturan Akun'); ?></li>
                  <li role="presentation" class="divider"></li>
				</ul>
              </li>
              </ul>
              <!-- user setting --> 
              <?php } ?>
			  
              
              <ul class="nav navbar-nav pull-right">
              <li>
				<?php 
                $session_data = $this->session->userdata('logged_in');
                if($this->session->userdata('logged_in'))
                {
                    echo anchor('dashboard', strtoupper($session_data['id_user']) . ' [ ' . $session_data['level'] . ' ]'); 
                }
                ?>
            </li>
            <li>
            	<?php
			#session_start();
			$session_data = $this->session->userdata('logged_in');
			if ($this->session->userdata('logged_in'))
			{
			 	echo anchor('login/logout','Logout'); 
			}
			else
			{
				echo anchor('login','Login'); 
			}
			?>
            </li>
              
            </ul>
          
          </div><!-- /.nav-collapse -->
        </div><!-- /.container -->
      </div> <!-- /navbar-example -->
    </div> <!-- /example -->