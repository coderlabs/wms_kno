<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cek_report_model extends CI_Model {

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
	public function get_diff_db_by_date($date)
	{
		$query = "
			SELECT in_dtbarang.in_btb,in_dtbarang.in_berat_bayar,in_dtbarang.in_status_bayar,
			in_dtbarang.in_koli,deliverybill.no_smubtb,deliverybill.nosmu,deliverybill.nodb,deliverybill.hari,deliverybill.isvoid,
			deliverybill.sewagudang,deliverybill.cargo_charge,deliverybill.administrasi,deliverybill.ppn,deliverybill.total_biaya,deliverybill.tglbayar
			FROM in_dtbarang, deliverybill
			WHERE in_dtbarang.in_status_bayar =  'yes'
			AND deliverybill.isvoid = 0
			AND deliverybill.tglbayar LIKE  '2013-08-13%'
			AND in_dtbarang.in_btb = deliverybill.no_smubtb
			AND (
			(
			(
			deliverybill.hari * in_dtbarang.in_berat_bayar *800 +5000
			) * 1.1
			) <> ( deliverybill.total_biaya )
			)
			ORDER BY  `in_dtbarang`.`in_btb` ASC 
		";
		
		$query = $this->db->query($query);
		return $query->result();
	}
	
	public function get_all_db_by_date($date)
	{
		$query = "
			SELECT in_dtbarang.in_btb,in_dtbarang.in_berat_bayar,in_dtbarang.in_status_bayar,
			in_dtbarang.in_koli,deliverybill.no_smubtb,deliverybill.nosmu,deliverybill.nodb,deliverybill.hari,deliverybill.isvoid,
			deliverybill.sewagudang,deliverybill.cargo_charge,deliverybill.administrasi,deliverybill.ppn,deliverybill.total_biaya,deliverybill.tglbayar
			FROM in_dtbarang, deliverybill
			WHERE in_dtbarang.in_status_bayar =  'yes'
			AND deliverybill.isvoid = 0
			AND deliverybill.tglbayar LIKE  '2013-08-13%'
			AND in_dtbarang.in_btb = deliverybill.no_smubtb
			ORDER BY  `in_dtbarang`.`in_btb` ASC 

		";
		
		$query = $this->db->query($query);
		return $query->result();
	}
	/*
	 SELECT in_dtbarang.in_btb,in_dtbarang.in_berat_bayar,in_dtbarang.in_status_bayar,
			in_dtbarang.in_koli,deliverybill.no_smubtb,deliverybill.nosmu,deliverybill.nodb,deliverybill.hari,
			deliverybill.sewagudang,deliverybill.cargo_charge,deliverybill.administrasi,deliverybill.ppn,deliverybill.total_biaya,deliverybill.tglbayar
			
			
			
			SELECT *
			FROM in_dtbarang, deliverybill
			WHERE in_dtbarang.in_status_bayar = 'yes'
			AND deliverybill.tglbayar LIKE '$date%'
			AND in_dtbarang.in_btb = deliverybill.no_smubtb
	 
	 SELECT *
			FROM deliverybill,in_dtbarang
			WHERE in_dtbarang.in_status_bayar = 'yes'
			AND deliverybill.isvoid = 0
			AND deliverybill.tglbayar LIKE '$date%'
			AND in_dtbarang.in_btb = deliverybill.no_smubtb
			AND ( (	(deliverybill.hari * in_dtbarang.in_berat_bayar *800 +5000) * 1.1 ) <> ( deliverybill.total_biaya )	)
	 
	 */
	
}

/* End of file cek_report_model.php */
/* Location: ./application/models/cek_report_model.php */