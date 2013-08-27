<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Airline_model extends CI_Model {

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
	 
	 public function get_all_airline()
	 {
		 $query = $this->db->get('airline');
		 return $query->result();
	 }
	 
	 public function cek_airline($airlines)
	{
		$this->db->where('airlinecode', $airlines);
		$this->db->from('airline');
		return $this->db->count_all_results();
	}
     
}

/* End of file airline.php */
/* Location: ./application/models/airline.php */