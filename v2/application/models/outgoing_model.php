<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Outgoing_model extends CI_Model {

	public function create_buildup($flt_no,$date)
	{
		$query ="	
		SELECT * 
		FROM  `out_dtbarang_h` 
		WHERE  `isvoid` =  0
		AND  `status_keluar` =  'INSTORE'
		AND  `btb_flt` LIKE  '" . $flt_no . "%' 
        OR  `airline` =  '" . $flt_no . "' 
		AND DATE(`btb_date`) = '" . $date . "'
		AND `status_bayar` = 'yes'
		ORDER BY `btb_date` DESC
				";
		$query = $this->db->query($query);
		return $query->result();
	}


}