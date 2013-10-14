<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Harian_model extends CI_Model {

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
	 
	 public function details_outgoing($startdate,$enddate, $airline)
	 {
		 
		 $this->db->where('deliverybill.isvoid', 0);
		 $this->db->where('out_dtbarang_h.isvoid', 0);
		 $this->db->where('DATE(tglbayar) >= ', $startdate);
		 $this->db->where('DATE(tglbayar) <= ', $enddate);
		 $this->db->where('airline', $airline);
		 $this->db->order_by("tglbayar", "asc"); 
		 
		 $this->db->join('out_dtbarang_h', 'out_dtbarang_h.btb_nobtb = deliverybill.no_smubtb');
		 $query = $this->db->get('deliverybill');
		 
		 return $query->result();
		 
		 
	 } 
	 
	 public function get_total_outgoing($startdate,$enddate, $airline)
	 {
		 $this->db->select('SUM(btb_totalberat) as totalberat, SUM(btb_totalvolume) as totalvolume, SUM(btb_totalberatbayar) as beratbayar, SUM(btb_totalkoli) as totalkoli, SUM(sewagudang) as sewagudang, SUM(administrasi) as administrasi, SUM(cargo_charge) as cargo_charge, SUM(ppn) as ppn, SUM(total_biaya) as total_biaya');
		 $this->db->where('deliverybill.isvoid', 0);
		 $this->db->where('out_dtbarang_h.isvoid', 0);
		 $this->db->where('DATE(tglbayar) >= ', $startdate);
		 $this->db->where('DATE(tglbayar) <= ', $enddate);
		 $this->db->where('airline', $airline);
		 $this->db->join('out_dtbarang_h', 'out_dtbarang_h.btb_nobtb = deliverybill.no_smubtb');
		 $query = $this->db->get('deliverybill');
		 
		 return $query->result();
		 
	 }
	 
	 public function details_incoming($startdate, $enddate, $airline, $data_type)
	 {
		/*$this->db->where('DATE(manifestin.tglmanifest)', $date);
		$this->db->where('airline', $airline);
		$this->db->join('isimanifestin', 'manifestin.id_manifestin = isimanifestin.id_manifestin');
		$this->db->join('deliverybill', 'no_smu = nosmu');
		$this->db->where('deliverybill.isvoid',0);
		$this->db->or_where('isimanifestin.isvoid',0);
		$this->db->or_where('manifestin.isvoid',0);
		$query = $this->db->get('manifestin');
		return $query->result();*/
		/**/
		if($data_type == 'v2')
		{
			$query = ("
			SELECT * FROM deliverybill as db
			JOIN isimanifestin AS isi  ON isi.no_smu = db.nosmu
			JOIN manifestin AS mani ON mani.id_manifestin = isi.id_manifestin
			WHERE db.isvoid = 0
			AND mani.airline = '" . $airline . "' 
			AND mani.isvoid = 0
			AND isi.isvoid = 0
			AND DATE(db.tglbayar) >= '" . $startdate . "'
			AND DATE(db.tglbayar) <= '" . $enddate . "'
			AND db.status = 0
			ORDER BY db.tglbayar ASC
			");
		}
		else
		{
			$query = ("
			SELECT * FROM deliverybill as db
			JOIN in_dtbarang as indt ON indt.in_btb = db.no_smubtb
			WHERE db.isvoid = 0
			AND indt.in_airline = '" . $airline . "' 
			AND indt.in_status_bayar = 'yes'
			AND DATE(db.tglbayar) >= '" . $startdate . "'
			AND DATE(db.tglbayar) <= '" . $enddate . "'
			AND db.status = 0
			ORDER BY db.tglbayar ASC
			");
		}
		
		$query = $this->db->query($query);
		return $query->result();
		
	 }
     
	public function get_total_incoming($startdate, $enddate, $airline)
	{
		$this->db->select('SUM(totalberat) as totalberat, SUM(totalberatbayar) as beratbayar, SUM(totalkoli) as totalkoli, SUM(sewagudang) as sewagudang, SUM(administrasi) as administrasi, SUM(cargo_charge) as cargo_charge, SUM(ppn) as ppn, SUM(total_biaya) as total_biaya');
		$this->db->where('DATE(manifestin.tglmanifest) >=', $startdate);
		$this->db->where('DATE(manifestin.tglmanifest) <=', $enddate);
		$this->db->where('airline', $airline);
		$this->db->where('deliverybill.isvoid',0);
		$this->db->where('isimanifestin.isvoid',0);
		$this->db->where('manifestin.isvoid',0);
		$this->db->join('isimanifestin', 'manifestin.id_manifestin = isimanifestin.id_manifestin', 'LEFT');
		$this->db->join('deliverybill', 'no_smu = nosmu', 'LEFT');
		$query = $this->db->get('manifestin');
		return $query->result();
   }
}

/* End of file airline.php */
/* Location: ./application/models/airline.php */