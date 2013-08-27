<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Harian extends CI_Model {

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
	 
	 public function details_outgoing($date)
	 {
		 
		 $this->db->where('tglbayar', $date);
		 $this->db->join('out_dtbarang_h', 'out_dtbarang_h.btb_nobtb = deliverybill.no_smubtb');
		 $query = $this->db->get('deliverybill');
		 
		 return $query->result();
		 
		 
	 }
     
}

/* End of file airline.php */
/* Location: ./application/models/airline.php */