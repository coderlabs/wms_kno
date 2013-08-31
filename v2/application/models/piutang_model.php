<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Piutang_model extends CI_Model {

	/**
	 * PT Gapura Angkasa
	 * Warehouse Management System.
	 * ver 3.0
	 * 
	 * App id :
	 * App code :
	 *
	 * cashier model
	 *
	 * url : http://dom.kno.wms.gapura.co.id/
	 * design : SIGAP Team
	 * project head : mantara@gapura.co.id
	 *
	 * developer : pandhawa digital
	 * phone : 0361 853 2400
	 * email : pandhawa.digital@gmail.com
	 */
	 
	#incoming
	public function get_all_piutang($num,$offset)
	{
		$query = " 	SELECT * FROM in_dtbarang AS indt 
					LEFT JOIN (SELECT inb_id,inb_status_void FROM in_breakdown ) AS inb 
					ON indt.in_inb_id = inb.inb_id
					WHERE indt.in_status_bayar = 'no' AND inb.inb_status_void='no'
					ORDER BY indt.in_tgl_manifest DESC,
					indt.in_agent DESC, indt.in_name DESC , indt.in_smu DESC
					LIMIT $offset , $num
					";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	public function count_all_piutang()
	{
		$query = " 	SELECT * FROM in_dtbarang AS indt 
					LEFT JOIN (SELECT inb_id,inb_status_void FROM in_breakdown ) AS inb 
					ON indt.in_inb_id = inb.inb_id
					WHERE indt.in_status_bayar = 'no' AND inb.inb_status_void='no'
					";
		$query = $this->db->query($query);
		return $query->num_rows();
	}
	
	public function get_piutang_by_agent($agent,$num,$offset)
	{
		
		if($agent == 'ALL'){$agent = '';}
		$query = " 	SELECT * FROM in_dtbarang AS indt 
					LEFT JOIN (SELECT inb_id,inb_status_void FROM in_breakdown ) AS inb 
					ON indt.in_inb_id = inb.inb_id
					WHERE indt.in_status_bayar = 'no' AND inb.inb_status_void='no'
					AND ( (indt.in_agent LIKE '%$agent%') OR (indt.in_name LIKE '%$agent%') )
					ORDER BY indt.in_tgl_manifest DESC,
					indt.in_smu DESC
					LIMIT $offset , $num
					";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	public function count_piutang_by_agent($agent)
	{
		if($agent == 'ALL'){$agent = '';}
		$query = " 	SELECT * FROM in_dtbarang AS indt 
					LEFT JOIN (SELECT inb_id,inb_status_void FROM in_breakdown ) AS inb 
					ON indt.in_inb_id = inb.inb_id
					WHERE indt.in_status_bayar = 'no' AND inb.inb_status_void='no'
					AND ( (indt.in_agent LIKE '%$agent%') OR (indt.in_name LIKE '%$agent%') )
					";
		$query = $this->db->query($query);
		return $query->num_rows();
	}
	
	#outgoing
	public function get_all_piutang_out($num,$offset)
	{
		$query = " 	SELECT * FROM out_dtbarang_h AS outdt 
					WHERE outdt.status_bayar = 'no' 
					AND outdt.isvoid='0'
					ORDER BY outdt.btb_date DESC
					LIMIT $offset , $num
					";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	public function count_all_piutang_out()
	{
		$query = " 	SELECT * FROM out_dtbarang_h AS outdt 
					WHERE outdt.status_bayar = 'no' 
					AND outdt.isvoid='0'
					";
		$query = $this->db->query($query);
		return $query->num_rows();
	}
	
	public function get_piutang_out_by_agent($agent,$num,$offset)
	{
		if($agent == 'ALL'){$agent = '';}
		$query = " 	SELECT * FROM out_dtbarang_h AS outdt 
					WHERE outdt.status_bayar = 'no' 
					AND outdt.isvoid='0'
					AND outdt.btb_agent LIKE '%$agent%'
					ORDER BY outdt.btb_date DESC
					LIMIT $offset , $num
					";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	public function count_piutang_out_by_agent($agent)
	{
		if($agent == 'ALL'){$agent = '';}
		$query = " 	SELECT * FROM out_dtbarang_h AS outdt 
					WHERE outdt.status_bayar = 'no' 
					AND outdt.isvoid='0'
					AND outdt.btb_agent LIKE '%$agent%'
					";
		$query = $this->db->query($query);
		return $query->num_rows();
	}
		
}

/* End of file cashier.php */
/* Location: ./application/models/cashier.php */