<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	/**
	 * PT Gapura Angkasa
	 * Warehouse Management System.
	 * ver 3.0
	 * 
	 * App id :
	 * App code :
	 *
	 * user model
	 *
	 * url : http://dom.wms.kno.gapura.co.id/
	 * design : SIGAP Team
	 * project head : mantara@gapura.co.id
	 *
	 * developer : pandhawa digital
	 * phone : 0361 853 2400
	 * email : pandhawa.digital@gmail.com
	 */
	 
	 public function login($username, $password)
	 {
		 # encrypt password 
		 $password = sha1($password);
		 
		 $this->db->where('id_user', $username);
		 $this->db->where('approve_by', $password);
		 $query = $this->db->get('user');
		 if ($query->num_rows() > 0 )
		 {
			foreach($query->result() as $item):
				$name = $item->id_user;
				$nipp = $item->nipp;
				$level = $item->level;
				$nama_lengkap = $item->nama_lengkap;
			endforeach;
			
			$newdata = array(
                   'id_user'  => $name,
                   'nipp'     => $nipp,
                   'level' => $level,
               );

			# set session
			$this->session->set_userdata('logged_in', $newdata);
			
			return TRUE;
		 }
		 else
		 {
			 return FALSE;
		 }
		 
	 }
	 
	 public function save($id_user , $password, $nama_lengkap, $email, $nipp, $level, $jabatan)
	 {
		 $md5 = md5($password);
		 $sha1 = sha1($password);
		 
		 $data = array(
                  'id_user'  => $id_user,
				  'password'  => $md5,
				  'nama_lengkap'  => $nama_lengkap,
				  'email'  => $email,
				  'level'   => $level,
				  'nipp'   => $nipp,
				  'jabatan'   => $jabatan,
				  'telpon'   => '',
				  'logon'   => '',
				  'username'  => $id_user,
				  'userfullname'   => $nama_lengkap,
				  'approve_by'   => $sha1,
               );
			   
		$this->db->insert('user', $data);	   
  
  
	 }
	
	public function update_user($id_user, $nama_lengkap, $email, $nipp, $level, $jabatan, $telpon)
	{
		 $data = array(
                  'nama_lengkap'  => $nama_lengkap,
				  'email'  => $email,
				  'level'   => $level,
				  'nipp'   => $nipp,
				  'jabatan'   => $jabatan,
				  'telpon'   => $telpon,
				  'username'  => $id_user,
				  'userfullname'   => $nama_lengkap,
			   );
		$this->db->where('id_user',$id_user);	   
		$this->db->update('user', $data);	   
	}
	
	public function update_password($id_user , $password)
	{
		 $md5 = md5($password);
		 $sha1 = sha1($password);
		 
		 $data = array(
                  'password'  => $md5,
				  'username'  => $id_user,
				  'approve_by'   => $sha1,
               );
			   
		$this->db->where('id_user',$id_user);	   
		$this->db->update('user', $data);	   
	}
	
	public function get_all_user()
	{
		$query = $this->db->get('user');
		return $query->result();
	}
	
	public function get_user_by_id($id_user)
	{
		$this->db->where('id_user', $id_user);
		$query = $this->db->get('user');
		return $query->result();
	}
	
	public function delete_user($id_user)
	{
		$this->db->delete('user', array('id_user' => $id_user));
	}
     
}

/* End of file user.php */
/* Location: ./application/models/user.php */