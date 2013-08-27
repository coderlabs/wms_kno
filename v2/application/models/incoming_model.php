<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Incoming_model extends CI_Model {

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
	
	public function insert_data_in_breakdown($airlines,$smu,$koli,$berat,$status,$user)
	{
		$time = mdate("%Y-%m-%d %H:%i:%s", time());
		$data = array(
				"inb_airlines"	=> $airlines,
				"inb_no_smu"	=> $smu,
				"inb_koli"	=> $koli,
				"inb_berat_aktual"	=> $berat,
				"inb_status_gudang"	=>	$status,
				"inb_outstore" => $time,
				"inb_outstore_by" => $user,
				"inb_instore" => $time,
				"inb_instore_by" => $user,
				"inb_update_by" => $user,
			);
		$this->db->insert('in_breakdown',$data);
	}
	 
	public function daily_stock_opname($date, $airline)
	{
		$query = ("
		 SELECT * FROM in_breakdown as inbd
		 JOIN  in_dtbarang as indt ON indt.in_inb_id = inbd.inb_id
		 WHERE DATE(inbd.inb_instore) = '" . $date . "' 
		 AND inb_status_gudang = 'instore'
		 AND inbd.inb_status_void = 'no'
			
		");
		 $query = $this->db->query($query);
		return $query->result();
	}
	
	# ---------- check line ---------------
	
	public function insert_incoming($data)
	{
		$this->db->insert('in_dtbarang',$data);
	}
	
	public function get_manifestin($noflight,$tgl_manifest,$acregistration)
	{
		$where = array(
					'noflight' => $noflight,
					'tglmanifest' => $tgl_manifest,
					'acregistration' => $acregistration,
				);
		$this->db->where($where);
		$query = $this->db->get('manifestin');
		return $query->result();
	}
	
	public function generate_btb_no()
	{
		
		$yearmonth = date('m') . date('y');
		
		$query = " SELECT in_btb FROM in_dtbarang WHERE in_btb LIKE '$yearmonth%' ORDER BY in_btb DESC LIMIT 1 ";
		$query = $this->db->query($query);
		$result = $query->result();
		
		if($result)
		{
			foreach ($result as $row)
			{
				$btb = $row->in_btb + 1;
				if( strlen($btb) == 10 )
				{ $btb = '0'.$btb; }
			}
		} 
		else 
		{
			$btb = $yearmonth . '0000001';
		}
		
		return $btb;
	}
	
	public function get_last_list_incoming()
	{
		$query = "	SELECT * FROM manifestin 
					LEFT JOIN isimanifestin ON manifestin.id_manifestin = isimanifestin.id_manifestin
					ORDER BY manifestin.id_manifestin DESC LIMIT 10
				";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	/*
	
	public function get_detail_incoming($smu)
	{
		$where = array( 'in_smu' => $smu );
		$this->db->where($where);
		$query = $this->db->get('in_dtbarang');
		return $query->result();
	}	
	*/
	
	public function get_flight($noflight)
	{
		$where = array('noflight' => $noflight);
		$this->db->where($where);
		$query = $this->db->get('manifestin');
		return $query->num_rows();
	}
	
	
	public function get_smu($smu)
	{
		$where = array('no_smu' => $smu);
		$this->db->where($where);
		$query = $this->db->get('isimanifestin');
		return $query->num_rows();
	}
	public function insert_incoming_in_dtbarang($btb,$smu,$noflight,$tgl_manifest,$koli,$berat)	
	{ 
		$data = array(
				'in_btb'	=>	$btb,
				'in_smu'	=>	$smu,
				'in_noflight'	=>	$noflight,
				'in_tgl_manifest'	=>	$tgl_manifest,
				'in_koli'		=>	$koli,
				'in_berat_datang'	=>	$berat,
			);
		$this->db->insert('in_dtbarang',$data);
	}
	public function insert_manifestin($noflight,$tgl_manifest)
	{
		$data = array(
				'noflight'	=> 	$noflight,
				'tglmanifest'	=>	$tgl_manifest,
				'status'	=>	'waiting',
			);
		$this->db->insert('manifestin',$data);
		return $this->db->insert_id();
	}
	 
	public function get_id_manifestin($noflight,$tgl_manifest)
	{
		$where = array(
						'noflight'	=>  $noflight,
						'tglmanifest'	=>	$tgl_manifest,
		);
		$this->db->where($where);
		$query = $this->db->get('manifestin');
		$result = $query->result();
		foreach($result as $row){
			return $row->id_manifestin;
		}
	}
	
	public function get_isimanifestin($smu)
	{
		$this->db->where('no_smu',$smu);
		$query = $this->db->get('isimanifestin');
		return $query->result();
	}
	
	public function insert_isimanifestin($id_manifestin,$smu,$berat,$koli)
	{
		$data=array(
			'id_manifestin' => $id_manifestin,
			'no_smu'	=>	$smu,
			'totalberat'	=>	$berat,
			'totalkoli'	=>	$koli,
			'totalberatbayar' => $berat,
		);
		$this->db->insert('isimanifestin',$data);
		return $this->db->insert_id();
	}
	public function get_id_isimanifestin($id_manifestin,$smu)
	{
		$where = array(
						'id_manifestin'	=>  $id_manifestin,
						'no_smu'	=>	$smu,
				);
		$this->db->where($where);
		$query = $this->db->get('isimanifestin');
		$result = $query->result();
		foreach($result as $row){}
		return $row->id_isimanifestin;
	}
	public function insert_breakdown($id_isimanifestin,$id_manifestin,$berat,$koli)
	{
		$data = array(
					'id_isimanifestin' => $id_isimanifestin,
					'id_manifestin' => $id_manifestin,
					'beratdatang' => $berat,
					'kolidatang' => $koli,
				);
		$this->db->insert('breakdown',$data);
	}
	public function get_manifestin_by_id($id_manifestin)
	{
		$this->db->where('id_manifestin',$id_manifestin);
		$query = $this->db->get('manifestin');
		return $query->result();
	}
	public function update_manifestin($data,$id_manifestin)
	{
		$this->db->where('id_manifestin',$id_manifestin);
		$this->db->update('manifestin',$data);	
	}
	public function list_incoming_flight_no($date)
	{
		$this->db->group_by('noflight');
		$this->db->group_by('tglmanifest');
		$this->db->where('tglmanifest',$date);
		$query = $this->db->get('manifestin');
		return $query->result();
	}
	public function list_incoming_smu($date)
	{
		$this->db->group_by('no_smu');
		$this->db->where('tglmanifest',$date);
		$query = $this->db->get('isimanifestin');
		return $query->result();
	}
	public function delete_last_breakdown()
	{
		$query = "SELECT id_breakdown AS 'id' FROM breakdown ORDER BY id DESC LIMIT 1 ";
		$query = $this->db->query($query);
		$hasil = $query->result();
		
		foreach ($hasil as $row){}
		$query = "DELETE FROM breakdown WHERE id_breakdown = ".$row->id;
		$query = $this->db->query($query);
	} 
	public function get_breakdown($noflight)
	{
		$query = "	SELECT * FROM isimanifestin LEFT JOIN manifestin ON manifestin.id_manifestin = isimanifestin.id_manifestin 
					WHERE manifestin.noflight='$noflight' AND manifestin.status ='waiting' ";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	public function is_alphanumeric($string)
    {
		return !preg_match('#[^A-Za-z0-9]-#', $string);
	}
	
	public function get_id_isimanifestin_by_smu($smu)
	{
		$query = "SELECT id_isimanifestin,no_smu FROM isimanifestin";
		$query = $this->db->query($query);
		$hasil = $query->result();
		if ($query->num_rows() > 0){
			foreach ($hasil as $row)
			{
				return $row->id_isimanifestin;
			}
		} else {
			return 0;
		}
	}
	
	public function get_smu_breakdown($smu)
	{
		
		$query = "  SELECT * FROM breakdown
					LEFT JOIN isimanifestin ON isimanifestin.id_isimanifestin = breakdown.id_isimanifestin
					LEFT JOIN manifestin ON isimanifestin.id_manifestin = manifestin.id_manifestin
					WHERE isimanifestin.no_smu = '$smu'
				";
		$query = $this->db->query($query); 
		return $query->result();
	}
	
	public function insert_incoming_btb($data)
	{
		$this->db->insert('in_dtbarang',$data);
	}
	public function get_detail_btb($btb_no)
	{
		$query = "	SELECT * FROM in_dtbarang 
					WHERE in_btb = '$btb_no'
					GROUP BY in_btb";
		$query = $this->db->query($query);
		return $query->result();
	}
	public function get_detail_berat_btb($btb_no)
	{
		$query = "	SELECT * FROM in_dtbarang 
					WHERE in_btb = '$btb_no'
				";
		$query = $this->db->query($query);
		return $query->result();
	}
	public function update_status_print_incoming_dtb($btb_no)
	{
		$this->db->where('in_btb',$btb_no);
		$this->db->update('in_dtbarang',array('in_status_cetak' => 1));
	}
	public function cek_data_in_dtb($smu)
	{
		$this->db->where('in_smu',$smu);
		$query = $this->db->get('in_dtbarang');
		$hasil = $query->result();
		if($query->num_rows > 0)
		{
			foreach( $hasil as $row)
			{
				$btb_no = $row->in_btb;
			}
		}
		else
		{
			$btb_no = 0;
		}
		return $btb_no;
	}
	public function save_breakdown($data)
	{
		$this->db->insert('breakdown',$data);
	}
	public function update_status_manifestin($id_manifestin)
	{
		$this->db->where('id_manifestin',$id_manifestin);
		$this->db->update('manifestin',array('status' => 'checked'));
	}
	
	public function get_all_agent()
	{
		$this->db->order_by("btb_agent", "asc"); 
		$query = $this->db->get('btb_agent');
		return $query->result();
	}
	
	public function get_all_airline()
	{
		$query = $this->db->get('airline');
		return $query->result();
	}
	
	public function get_all_type_barang()
	{
		$query = $this->db->get('typebarang');
		return $query->result();
	}
	public function update_data_manifestin($data,$id)
	{
		$this->db->where('id_manifestin',$id);
		$this->db->update('manifestin',$data);
	}
	public function update_data_isimanifestin($data,$id)
	{
		$this->db->where('id_isimanifestin',$id);
		$this->db->update('isimanifestin',$data);
	}
	public function get_data_inbreakdown($smu)
	{
		$query ="	SELECT * FROM in_breakdown 
					WHERE inb_no_smu='$smu' AND inb_status_void='no'
					ORDER BY inb_id DESC LIMIT 10 
					";
		$query = $this->db->query($query);
		return $query->result();
	}
	public function get_data_inbreakdown_btb($smu)
	{
		$query ="	SELECT * FROM in_breakdown 
					LEFT JOIN in_dtbarang ON in_breakdown.inb_no_smu = in_dtbarang.in_smu  
					WHERE inb_no_smu='$smu'
					ORDER BY inb_id DESC LIMIT 10 
					";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	
	
	public function insert_data_in_breakdown_outstore($airlines,$flt, $smu,$koli,$berat,$status, $date)
	{
		$data = array(
				"inb_airlines"	=> $airlines,
				"inb_flight_number" => $flt,
				"inb_flight_date" => $date,
				"inb_no_smu"	=> $smu,
				"inb_koli"	=> $koli,
				"inb_berat_aktual"	=> $berat,
				"inb_status_gudang"	=>	$status,
			);
		$this->db->insert('in_breakdown',$data);
	}
	
	public function get_data_in_breakdown_by_id($id)
	{
		$query ="	SELECT * FROM in_breakdown 
					WHERE inb_id='$id'
					";
		$query = $this->db->query($query);
		return $query->result();
	}
	public function insert_data_btb($dtb)
	{
		$this->db->insert('in_dtbarang',$dtb);
	}
	public function get_detail_btb_by_btb_no($btb_no)
	{
		$query = "	SELECT * FROM in_dtbarang 
					WHERE in_btb = '$btb_no'
					GROUP BY in_btb
				";
		$query = $this->db->query($query);
		return $query->result();
	}
	public function get_detail_berat_btb_by_btb_no($btb_no)
	{
		$query = "	SELECT * FROM in_dtbarang 
					WHERE in_btb = '$btb_no'
				";
		$query = $this->db->query($query);
		return $query->result();
	}
	public function get_id_breakdown($smu)
	{
		$query = "	SELECT * FROM in_breakdown 
					WHERE inb_no_smu = '$smu'
				";
		$query = $this->db->query($query);
		if($query->num_rows() > 0){
			$hasil = $query->result();
			foreach($hasil as $row)
			{
				return $row->inb_id; 
			}
		} else{
			return 0 ;
		}
	}
	
	public function get_data_breakdown($smu)
	{
		$query = "	
			SELECT * FROM in_breakdown as bd
			LEFT JOIN in_dtbarang as indt ON  indt.in_smu = bd.inb_no_smu	
			WHERE inb_no_smu LIKE '%" . $smu . "%'
			AND bd.inb_status_void = 'no'
				";
		$query = $this->db->query($query);
		return	$query->result();
	}
	
	public function get_lastest_data_breakdown()
	{
		$query = "	
			SELECT * FROM in_breakdown as bd
			LEFT JOIN in_dtbarang as indt ON  indt.in_smu = bd.inb_no_smu
			WHERE bd.inb_status_void = 'no'	
			AND DATE(bd.inb_update_on) = CURDATE()
			ORDER BY bd.inb_id DESC
			LIMIT 10
				";
		$query = $this->db->query($query);
		return	$query->result();
	}
	
	public function update_status_void_breakdown($inb_id)
	{
		$this->db->where('inb_id',$inb_id);
		$this->db->update('in_breakdown',array('inb_status_void' => 'yes'));
	}
	public function get_data_inbreakdown_btb_by_date($date)
	{
		$query ="	
					SELECT * FROM in_breakdown 
					LEFT JOIN in_dtbarang ON inb_no_smu = in_smu  
					WHERE in_tgl_manifest='$date'
					ORDER BY inb_id DESC
					";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	public function get_list_smu_instore()
	{
		$query ="	
		SELECT * FROM in_breakdown as bd
		LEFT JOIN ( SELECT * from in_dtbarang WHERE in_status_bayar = 'no' ) as isi  ON isi.in_smu = bd.inb_no_smu
		WHERE inb_status_gudang = 'instore'
		AND inb_status_void = 'no'
				";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	public function get_list_smu_instore_by_date($date)
	{
		$query ="	
		
		SELECT * FROM in_breakdown as bd
		LEFT JOIN ( SELECT * from in_dtbarang WHERE in_status_bayar = 'no'  ) as isi  ON isi.in_smu = bd.inb_no_smu
		WHERE inb_status_gudang = 'instore'
		AND inb_flight_date = '" . $date . "'
		AND inb_status_void = 'no'
		
				";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	public function get_list_smu_outstore_by_date($date)
	{
		$query ="	
		
		SELECT * FROM in_breakdown as bd
		LEFT JOIN ( SELECT * from in_dtbarang WHERE in_status_bayar = 'no'  ) as isi  ON isi.in_smu = bd.inb_no_smu
		WHERE inb_status_gudang = 'outstore'
		AND inb_flight_date = '" . $date . "'
		AND inb_status_void = 'no'
		
				";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	public function get_list_smu_instore_incomplete_data()
	{
		$query ="	
		
		SELECT * FROM in_breakdown as bd
		LEFT JOIN ( SELECT * from in_dtbarang WHERE in_status_bayar = 'no'  AND in_btb = '') as isi  ON isi.in_smu = bd.inb_no_smu
		WHERE inb_status_gudang = 'instore'
		AND inb_status_void = 'no'
		ORDER BY inb_update_on DESC
				";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	public function duplicate_smu()
	{
		$query ="	
		
		SELECT *, COUNT(inb_no_smu) as smu FROM in_breakdown as bd
		LEFT JOIN ( SELECT * from in_dtbarang WHERE in_status_bayar = 'no'  AND in_btb = '') as isi  ON isi.in_smu = bd.inb_no_smu
		WHERE inb_status_gudang = 'instore'
		AND inb_status_void = 'no'
		HAVING smu > 1
		ORDER BY inb_update_on DESC
				";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	public function create_breakdown($flt_no,$date)
	{
		$query ="	
		SELECT * 
		FROM  `in_breakdown` 
		WHERE  `inb_status_void` =  'no'
		AND  `inb_status_gudang` =  'outstore'
		AND  `inb_flight_number` =  '" . $flt_no . "' 
		AND `inb_flight_date` = '" . $date . "'
		ORDER BY inb_no_smu ASC
				";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	public function my_breakdown($date, $user)
	{
		$query = "	
			SELECT * FROM in_breakdown as bd
			LEFT JOIN in_dtbarang as indt ON  indt.in_smu = bd.inb_no_smu	
			WHERE DATE(bd.inb_update_on) = '" . $date . "'
			AND bd.inb_update_by = '" . $user . "'
			AND bd.inb_status_void = 'no'
				";
		$query = $this->db->query($query);
		return	$query->result();
	}
	
	public function get_btb($btb_no)
	{
		$query = "	
			SELECT * FROM in_dtbarang as indt
			LEFT JOIN in_breakdown as bd ON  bd.inb_id = indt.in_inb_id	
			WHERE in_btb = '" . $btb_no . "'
				";
		$query = $this->db->query($query);
		return	$query->result();
	}
	
	public function pick_up_btb($inb_id, $user)
	{
		$time = mdate("%Y-%m-%d %H:%i:%s", time());
		$this->db->update('in_breakdown', array('inb_pickup' => $time, 'inb_status_gudang' => 'pickup', 'inb_pickup_by' => $user), array('inb_id' => $inb_id));
	}
	
}

/* End of file airline.php */
/* Location: ./application/models/airline.php */