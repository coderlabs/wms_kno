<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tracking_model extends CI_Model {

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
	 
	 public function btb($no_btb, $type)
	 {
		 if($type == 'outgoing')
		 {
			 $this->db->like('btb_nobtb', $no_btb); 
			 $this->db->from('out_dtbarang_h');
			 $query = $this->db->get();
			 return $query->result();
		 }
		 else
		 {
			 $this->db->like('in_btb', $no_btb); 
			 $this->db->from('in_dtbarang');
			 $query = $this->db->get();
			 return $query->result();
		 }
	 }
	 
	 
	 public function smu($no_smu, $type)
	 {
		 if($type == 'outgoing')
		 {
			 /*$this->db->like('btb_smu', $no_smu); 
			 $this->db->from('out_dtbarang_h');
			 $query = $this->db->get();
			 return $query->result();*/
			 $query = "	
			SELECT * FROM out_dtbarang_h 
			WHERE btb_smu LIKE '%" . $no_smu . "%'
				";
				
			$query = $this->db->query($query);
			return	$query->result();
		 }
		 else
		 {
			 $query = "	
			SELECT * FROM in_breakdown 
			WHERE inb_no_smu LIKE '%" . $no_smu . "%'
				";
				
			$query = $this->db->query($query);
			return	$query->result();
			 
			 /*$this->db->like('in_smu', $no_smu); 
			 $this->db->from('in_dtbarang');
			 $query = $this->db->get();
			 return $query->result();*/
		 }
	 }
	 
     
}

/* End of file tracking.php */
/* Location: ./application/models/tracking.php */