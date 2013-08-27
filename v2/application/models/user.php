<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {

	/**
	 * PT Gapura Angkasa
	 * Warehouse Management System.
	 * ver 3.0
	 * 
	 * App id :
	 * App code :
	 *
	 * airline model
	 *
	 * url : http://dom.kno.wms.gapura.co.id/
	 * design : SIGAP Team
	 * project head : mantara@gapura.co.id
	 *
	 * developer : pandhawa digital
	 * phone : 0361 853 2400
	 * email : pandhawa.digital@gmail.com
	 */
	 
	 public function login($username, $password)
	 {
		 #$password = $this->encrypt->sha1($password, $this->config->item('encryption_key'));
		 $password = sha1($password);
		 
		 $this->db->where('id_user', $username);
		 $this->db->where('psw', $password);
		 $query = $this->db->get('user');
		 if ($query->num_rows() > 0 )
		 {
		 	#return $query->result();
			foreach($query->result() as $item):
				$id_user = $item->id_user;
				$nipp = $item->nipp;
				$level = $item->level;
				$nama = $item->nama_lengkap;
			endforeach;
			
			$newdata = array(
                   'id_user'  => $id_user,
                   'nipp'     => $nipp,
                   'level' => $level,
				   'name' => $nama,
               );

			$this->session->set_userdata($newdata);
			
			return TRUE;
		 }
		 else
		 {
			 return FALSE;
		 }
		 
	 }
     
}

/* End of file user.php */
/* Location: ./application/models/user.php */