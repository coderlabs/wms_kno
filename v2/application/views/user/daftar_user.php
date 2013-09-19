<div id="content">
<h2>Daftar User WMS</h2>
	
    <table class="table table-bordered">
    	<tr>
        	<th>Username</th>
            <th>Nama Lengkap</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Jabatan</th>
            <th>Level</th>
            <th>NIPP</th>
            <th>Action</th>
        </tr>
    <?php foreach($result as $row){ ?>
    	<tr>
        	<td><?php echo $row->id_user; ?></td>
            <td><?php echo $row->nama_lengkap; ?></td>
            <td><?php echo $row->email; ?></td>
            <td><?php echo $row->telpon; ?></td>
            <td><?php echo $row->jabatan; ?></td>
            <td><?php echo $row->level; ?></td>
            <td><?php echo $row->nipp; ?></td>
			<td>
			<?php echo anchor('user/edit/'.$row->id_user,'Edit')." --- ".anchor('user/ganti_password/'.$row->id_user,'Ganti Password');?>
			<?php 
				if(($level_user =='admin') OR ($level_user =='supervisor')){
					echo " --- ".anchor('user/delete_user/'.$row->id_user,'Delete','onclick="return confirm(\' Anda yakin akan menghapus '.$row->id_user.' ? \')"'); 
				}
			?>
			</td>
        </tr>
    <?php } ?>
    </table>
</div>	


