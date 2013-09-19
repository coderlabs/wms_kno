<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cashier_model extends CI_Model {

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
	 
	public function get_delivery_bill_in($no_db)
	{
		 $query = ("
		 SELECT * FROM deliverybill as db
		 JOIN  ( SELECT * FROM in_dtbarang ) as indt ON indt.in_btb = db.no_smubtb
		 LEFT JOIN ( SELECT * FROM btb_agent ) as agent ON agent.btb_agent = indt.in_agent
			WHERE db.nodb = '" . $no_db . "' 
			AND db.isvoid = 0
			ORDER BY db.nodb DESC
			LIMIT 1
		");
		 $query = $this->db->query($query);
		return $query->result();
	}
	
	public function get_delivery_bill_out($no_db)
	{
		 $query = ("
		 SELECT * FROM deliverybill as db
		 JOIN  ( SELECT * FROM out_dtbarang_h ) as outdt ON outdt.btb_nobtb = db.no_smubtb
		 LEFT JOIN ( SELECT * FROM btb_agent ) as agent ON agent.btb_agent = outdt.btb_agent
			WHERE db.nodb = '" . $no_db . "' 
			AND db.isvoid = 0
			ORDER BY db.nodb DESC
			LIMIT 1
		");
		 $query = $this->db->query($query);
		return $query->result();
	}
	
	public function payment_receipt_incoming($search)
	{
		$this->db->select('*');
		$this->db->where('in_btb',$search);
		$query = $this->db->get('in_dtbarang');
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return FALSE;
		}
	}
	
	public function payment_receipt_outgoing($search)
	{
		$this->db->select('*');
		$this->db->where('btb_nobtb', $search);
		$query = $this->db->get('out_dtbarang_h');
		
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
		
	}
	
	public function get_payment_status_outgoing($search)
	{
		$this->db->select('*');
		$this->db->where('btb_nobtb', $search);
		$this->db->where('status_bayar', 'yes');
		$query = $this->db->get('out_dtbarang_h');
		
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	public function get_dtbarang_outgoing($search)
	{
		$this->db->select('*');
		$this->db->where('btb_nobtb', $search);
		$query = $this->db->get('out_dtbarang_h');
		return $query->result();
	}
	
	public function get_payment_status_incoming($search)
	{
		$this->db->select('*');
		$this->db->where('in_btb', $search);
		$this->db->where('in_status_bayar', 'yes');
		$query = $this->db->get('in_dtbarang');
		
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	public function get_void_status($search)
	{
		$this->db->select('*');
		$this->db->where('no_smubtb', $search);
		$this->db->where('isvoid', '0');
		$this->db->order_by('id_deliverybill', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('deliverybill');
		
		return $query->result();
		/*if($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}*/
	}
	
	public function get_dtbarang_incoming($search)
	{
		$this->db->select('*');
		$this->db->where('in_btb', $search);
		$query = $this->db->get('in_dtbarang');
		return $query->result();
	}
	
	public function get_harga_sewa($agent, $type)
	{
		$this->db->select('*');
		$this->db->join('btb_agent', 'btb_agent.asperindo = hargasewa.asperindo', 'LEFT');
		$this->db->where('btb_agent.btb_agent', $agent);
		$this->db->where('type', $type);
		$this->db->order_by('hargasewa.id', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('hargasewa');
		return $query->result();
	}
	
	public function get_harga_sewa_non_agent($type)
	{
		$this->db->where('type', $type);
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('hargasewa');
		return $query->result();
	}
	
	public function get_nodb($nobtb)
	{
		$this->db->select('nodb');
		$this->db->where('no_smubtb', $nobtb);
		$query = $this->db->get('deliverybill');
		return $query->result();
	}
	
	public function update_status_print($no_db)
	{
		$this->db->update('deliverybill', array('posted'=>'1'), array('nodb'=>$no_db));
	}
	
	public function update_status_dbo($no_btb)
	{
		$this->db->update('out_dtbarang_h', array('posted'=>'1','status_bayar'=>'yes'), array('btb_nobtb'=>$no_btb));
	}
	
	public function get_laporan_outgoing()
	{
		$this->db->select('*');
		$this->db->join('out_dtbarang', 'out_dtbarang.id_h = out_dtbarang_h.id', 'LEFT');
		$this->db->join('deliverybill', 'deliverybill.no_smubtb = out_dtbarang_h.btb_nobtb', 'LEFT');
		$this->db->where('deliverybill.isvoid',0);
		$this->db->where('out_dtbarang_h.isvoid',0);
		$this->db->where('out_dtbarang_h.airline',$airline);
		$this->db->where('out_dtbarang_h.date <=',$start_date);
		$this->db->where('out_dtbarang_h.date >=',$end_date);
		$query = $this->db->get('out_dtbarang_h');
		return $query->result();
	}
	
	public function get_all_payment_type()
	{
		$this->db->where('payment_status', 'enable');
		$query = $this->db->get('var_payment_type');
		return $query->result();
	}
	
	public function get_all_agent()
	{
		$query = $this->db->get('var_agent');
		return $query->result();
	}
	
	public function get_all_airline()
	{
		$query = $this->db->get('var_airline');
		return $query->result();
	}
	
	public function get_deposit_agent($agent_id)
	{
		$this->db->where('agent_id', $agent_id);
		$query = $this->db->get('var_agent');
		return $query->result_array();
	}
	
	public function get_dev_bill_out_detail($devbill)
	{
		$this->db->join('out_dtbarang_h','btb_nobtb = no_smubtb', 'LEFT');
		$this->db->join('btb_agent','btb_agent.btb_agent = out_dtbarang_h.btb_agent', 'LEFT');
		$this->db->where('nodb', $devbill);
		$this->db->where('status', 1);
		$this->db->where('deliverybill.isvoid', 0);
		$query = $this->db->get('deliverybill');
		return $query->result();
	}
	
	public function get_dev_bill_in_detail($devbill)
	{
		$this->db->join('in_dtbarang','no_smubtb = in_btb', 'LEFT');
		$this->db->join('btb_agent','btb_agent.btb_agent = in_dtbarang.in_agent', 'LEFT');
		$this->db->where('nodb', $devbill);
		$this->db->where('status', 0);
		$this->db->where('deliverybill.isvoid', 0);
		$query = $this->db->get('deliverybill');
		return $query->result();
	}
     
	public function save_db($data)
	{
		$this->db->insert('deliverybill',$data);
	}
	
	public function update_out_dtbarang_h($nobtb)
	{
		$this->db->update('out_dtbarang_h', array('status_bayar'=>'yes'), array('btb_nobtb'=>$nobtb));
	}
	
	public function update_out_dtbarang_h_berat($nobtb, $berat)
	{
		$this->db->update('out_dtbarang_h', array('btb_totalberatbayar'=>$berat), array('btb_nobtb'=>$nobtb));
	}
	
	public function update_in_dtbarang($nobtb)
	{
		$this->db->update('in_dtbarang', array('in_status_bayar'=>'yes'), array('in_btb'=>$nobtb));
	}
	
	public function update_in_dtbarang_berat($nobtb, $berat)
	{
		$this->db->update('in_dtbarang', array('in_berat_bayar'=>$berat), array('in_btb'=>$nobtb));
	}
	
	public function deposit_update($agent_id, $deposit_cash)
	{
		$this->db->update('var_agent', array('agent_deposit'=>$deposit_cash), array('agent_id'=>$agent_id));
	}
	
	public function get_last_db()
	 {
		
		# prepare value
		$pr_date = mdate("%Y", time());
		$pr_start = '0000000';
		
		#$this->db->select_max('wo_id');
		$this->db->order_by('nodb','DESC');
		$this->db->limit(1);
		$query = $this->db->get('deliverybill');
		
		
		
		if($query-> num_rows() > 0)
   		{
			# handling not empty record
			foreach($query->result() as $item):
				$query = $item->nodb;
			endforeach;
			
			# handling same date
			if(substr($query, 0, 4) == mdate("%Y", time()))
			{
				/*$date_serial = substr($query, 0, 4);
				$serial_number = substr($query, 7) + 1;
				$serial_number =  sprintf("%1$07d", $serial_number);
				$query = $date_serial . $serial_number;*/
				$query = $query + 1;
			}
			else # handling different date / restart new serial number
			{
				$query = $pr_date  . $pr_start;	
			}
			return $query;
			
			
		}
		else
		{
			# handling empty record
			$query = $pr_date . $pr_start;
			return $query;
		}
	 }
	 
	 public function get_last_faktur()
	 {
		#$this->db->select_max('wo_id');
		$this->db->order_by('nofaktur','DESC');
		$this->db->limit(1);
		$query = $this->db->get('deliverybill');
		
		# prepare value
		$pr_date = mdate("%y", time());
		$pr_start = '00000000';
		
		if($query -> num_rows() == 0)
   		{
			# handling empty record
			$query = $pr_date . $pr_start;
			return $query;
		}
		else
		{
			# handling not empty record
			foreach($query->result() as $item):
				$query = $item->nofaktur;
			endforeach;
			
			# handling same date
			if(substr($query, 0, 2) == mdate("%y", time()))
			{
				$date_serial = substr($query, 0, 2);
				$serial_number = substr($query, 6) + 1;
				$serial_number =  sprintf("%1$08d", $serial_number);
				$query = $date_serial . $serial_number;
			}
			else # handling different date / restart new serial number
			{
				$query = $pr_date  . $pr_start;	
			}
			return $query;
		}
	 }
	 
	 function do_void_dbi($no_btb, $no_db, $user)
	 {
		if($this->input->post('status_kembali') == 1){
			$status_kembali = " (uang kembali) ";
		} else {
			$status_kembali = " (uang tidak dikembalikan) ";
		}
		$keterangan = $this->input->post('reason');
		
		$this->db->update('in_dtbarang', array('in_status_bayar'=>'no'), array('in_btb'=>$no_btb));
		$this->db->update('deliverybill', array('isvoid'=>'1', 'keterangan'=>$keterangan.$status_kembali,'voidby'=>$user, 'tglvoid' => date("Y-m-d H:i:s")), array('nodb'=>$no_db));
	 }
	 
	 function do_void_dbo($no_btb, $no_db, $user)
	 {
		if($this->input->post('status_kembali') == 1){
			$status_kembali = " (uang kembali) ";
		} else {
			$status_kembali = " (uang tidak dikembalikan) ";
		}
		$keterangan = $this->input->post('reason');
		
		$keterangan = $this->input->post('reason');$this->db->update('out_dtbarang_h', array('status_bayar'=>'no', 'posted'=>0), array('btb_nobtb'=>$no_btb));
		$this->db->update('deliverybill', array('isvoid'=>'1', 'keterangan'=>$keterangan.$status_kembali,'voidby'=>$user, 'tglvoid' => date("Y-m-d H:i:s")), array('nodb'=>$no_db));
	 }
	 
	 function cek_barang_instore($no_btb)
	 {
		$this->db->select('inb_status_gudang');
		$this->db->join('in_breakdown', 'inb_no_smu = in_smu', 'LEFT');
		$this->db->where('in_btb', $no_btb);
		$query = $this->db->get('in_dtbarang');
		return $query->result_array();
	 }
	 
	 
	 
	 public function my_balance_incoming($user, $startdate, $enddate)
	 {
		 $query = ("
		 SELECT * FROM `deliverybill` as db
		 JOIN  ( SELECT * FROM in_dtbarang ) as indt ON indt.in_btb = db.no_smubtb
			WHERE db.user = '" . $user . "' 
			AND (DATE(db.tglbayar) >= '".$startdate."') 	
			AND (DATE(db.tglbayar) <= '".$enddate."')
			AND db.isvoid = 0
			ORDER BY db.tglbayar ASC
		");
		 $query = $this->db->query($query);
		return $query->result();
	 }
	 
	 public function my_balance_outgoing($user, $startdate, $enddate)
	 {
		 $query = ("
		 SELECT * FROM `deliverybill` as db
		 JOIN  out_dtbarang_h ON btb_nobtb = db.no_smubtb
			WHERE db.user = '" . $user . "' 
			AND (DATE(db.tglbayar) >= '".$startdate."') 	
			AND (DATE(db.tglbayar) <= '".$enddate."')
			AND db.isvoid = 0
			ORDER BY db.tglbayar ASC
		");
		 $query = $this->db->query($query);
		return $query->result();
	 }
	 
	 public function my_void($user, $startdate, $enddate)
	 {
		 $query = ("
		 SELECT * FROM `deliverybill` WHERE voidby = '" . $user . "' 
			AND (DATE(tglvoid) >= '".$startdate."') 	
			AND (DATE(tglvoid) <= '".$enddate."')
			AND isvoid = 1
		");
		 $query = $this->db->query($query);
		return $query->result();
	 }
	 
	 public function my_summary_incoming_result($user,$startdate,$enddate,$type)
	 {
		if($type == 'v2')
		{
		
		$query = ("
		SELECT * , SUM(sewagudang) as whc, SUM(cargo_charge) as csc, SUM(ppn) as ppn, SUM(administrasi) as adm, SUM(total_biaya) as totbiaya, SUM(totalkoli) as koli, ROUND(SUM(totalberatbayar),1) as kilo FROM deliverybill as db
			JOIN ( SELECT * from isimanifestin WHERE isvoid = 0) as isi  ON isi.no_smu = db.nosmu
			JOIN ( SELECT *, airline as in_airline from manifestin WHERE isvoid = 0) as mani ON mani.id_manifestin = isi.id_manifestin
			WHERE db.isvoid = 0
			AND db.user = '".$user."' 
			AND DATE(db.tglbayar) >= '" . $startdate . "'
			AND DATE(db.tglbayar) <= '" . $enddate . "'
			AND db.status = 0
			GROUP BY mani.in_airline
		");
		
		}
		else
		{
		$query = ("
			SELECT *, SUM(sewagudang) as whc, SUM(cargo_charge) as csc, SUM(ppn) as ppn, SUM(administrasi) as adm, SUM(total_biaya) as totbiaya, SUM(in_koli) as koli, SUM(in_berat_bayar) as kilo FROM deliverybill as db
			JOIN ( SELECT * from in_dtbarang WHERE in_status_bayar = 'yes' ) as indt ON indt.in_btb = db.no_smubtb
			WHERE db.isvoid = 0
			AND db.user = '".$user."' 
			AND DATE(db.tglbayar) >= '" . $startdate . "'
			AND DATE(db.tglbayar) <= '" . $enddate . "'
			AND db.status = 0
			GROUP BY indt.in_airline
		 ");
		}
		
		$query = $this->db->query($query);
		return $query->result();
	 }
	 
	 public function my_summary_outgoing_result($user,$startdate,$enddate)
	 {
		$query = ("
		SELECT *, SUM(sewagudang) as whc, SUM(cargo_charge) as csc, SUM(ppn) as ppn, SUM(administrasi) as adm, SUM(total_biaya) as totbiaya, SUM(btb_totalkoli) as koli, ROUND(SUM(btb_totalberatbayar),1) as kilo FROM deliverybill as db
		JOIN ( SELECT * from out_dtbarang_h WHERE status_bayar = 'yes' AND isvoid = 0 ) as outdt ON outdt.btb_nobtb = db.no_smubtb
		WHERE db.isvoid = 0
		AND db.user = '" . $user . "' 
		AND (date(db.tglbayar) >= '".$startdate."') 	
		AND (date(db.tglbayar) <= '".$enddate."')
		AND db.status = 1
		GROUP BY outdt.airline
		");
		
		 $query = $this->db->query($query);
		return $query->result();
	 }
	 
	 public function my_summary_void_result($user,$startdate,$enddate)
	 {
		$query = ("
		SELECT *, SUM(sewagudang) as whc, SUM(cargo_charge) as csc, SUM(ppn) as ppn, SUM(administrasi) as adm, SUM(total_biaya) as totbiaya FROM deliverybill as db
		WHERE db.isvoid = 1
		AND db.user = '" . $user . "' 
		AND db.voidby = '" . $user . "' 
		AND (date(db.tglbayar) >= '".$startdate."') 	
		AND (date(db.tglbayar) <= '".$enddate."')
		GROUP BY db.status
		");
		
		 $query = $this->db->query($query);
		return $query->result();
	 }
	 
	 #############################################
	 ### In Out Summary Income (start-enddate) ###
	 #############################################
	 public function incoming_summary_income($startdate, $enddate , $type)
	 {
		if($type == 'v2')
		{
		
		$query = ("
		SELECT * , SUM(sewagudang) as whc, SUM(cargo_charge) as csc, SUM(ppn) as ppn, SUM(administrasi) as adm, SUM(total_biaya) as totbiaya, SUM(totalkoli) as koli, ROUND(SUM(totalberatbayar),1) as kilo FROM deliverybill as db
			JOIN ( SELECT * from isimanifestin WHERE isvoid = 0) as isi  ON isi.no_smu = db.nosmu
			JOIN ( SELECT *, airline as in_airline from manifestin WHERE isvoid = 0) as mani ON mani.id_manifestin = isi.id_manifestin
			WHERE db.isvoid = 0
			AND DATE(db.tglbayar) >= '" . $startdate . "'
			AND DATE(db.tglbayar) <= '" . $enddate . "'
			AND db.status = 0
			GROUP BY mani.in_airline
		");
		
		}
		else
		{
		$query = ("
			SELECT *, SUM(sewagudang) as whc, SUM(cargo_charge) as csc, SUM(ppn) as ppn, SUM(administrasi) as adm, SUM(total_biaya) as totbiaya, SUM(in_koli) as koli, SUM(in_berat_bayar) as kilo FROM deliverybill as db
			JOIN ( SELECT * from in_dtbarang WHERE in_status_bayar = 'yes' ) as indt ON indt.in_btb = db.no_smubtb
			WHERE db.isvoid = 0
			AND DATE(db.tglbayar) >= '" . $startdate . "'
			AND DATE(db.tglbayar) <= '" . $enddate . "'
			AND db.status = 0
			GROUP BY indt.in_airline
		 ");
		}
		
		 $query = $this->db->query($query);
		return $query->result();
	 }
	 
	 public function outgoing_summary_income($startdate, $enddate)
	 {
		$query = ("
		SELECT *, SUM(sewagudang) as whc, SUM(cargo_charge) as csc, SUM(ppn) as ppn, SUM(administrasi) as adm, SUM(total_biaya) as totbiaya, SUM(btb_totalkoli) as koli, ROUND(SUM(btb_totalberatbayar),1) as kilo FROM deliverybill as db
		JOIN ( SELECT * from out_dtbarang_h WHERE status_bayar = 'yes' AND isvoid = 0 ) as outdt ON outdt.btb_nobtb = db.no_smubtb
		WHERE db.isvoid = 0
		AND DATE(db.tglbayar) >= '" . $startdate . "'
		AND DATE(db.tglbayar) <= '" . $enddate . "'
		AND db.status = 1
		GROUP BY outdt.airline
		");
		
		 $query = $this->db->query($query);
		return $query->result();
	 }
	########################################
	
	 
	 public function get_cashier()
	 {
		$this->db->where('level', 'kasir'); 
		$this->db->or_where('level', 'supervisor'); 
		$this->db->or_where('level', 'kasir'); 
		$query = $this->db->get('user');
		return $query->result();
	 }
	 
	 public function renew_db($old_db_id, $no_db)
	{
		$this->db->where('id_deliverybill',$old_db_id);
		$this->db->update('deliverybill',array('nodb' => $no_db));
	}
	
	public function count_all_inbound()
	{
		 $query = $this->db->count_all_results('deliverybill');
		return $query;
	}
	
	public function all_inbound($limit, $offset)
	{
		/*$this->db->order_by("id_deliverybill", "asc"); 
		$this->db->limit($limit, $offset); 
		$query = $this->db->get('deliverybill');
		return $query->result();*/
		/*if($data_type == 'v2')
		{
			$query = ("
			SELECT * FROM deliverybill as db
			JOIN ( SELECT * from isimanifestin WHERE isvoid = 0) as isi  ON isi.no_smu = db.nosmu
			JOIN ( SELECT * from manifestin WHERE isvoid = 0) as mani ON mani.id_manifestin = isi.id_manifestin
			WHERE db.isvoid = 0
			AND db.status = 0
			ORDER BY db.tglbayar ASC
			");
		}
		else
		{*/
			$query = ("
			SELECT * FROM deliverybill as db
			JOIN ( SELECT * from in_dtbarang WHERE  in_status_bayar = 'yes' ) as indt ON indt.in_btb = db.no_smubtb
			ORDER BY tglbayar ASC
			LIMIT " . $limit . ", " . $offset . "
			
			");
		#}
		
		$query = $this->db->query($query);
		return $query->result();
	}
	
	
	/* Delivery Bill */
	public function get_all_db($num,$offset)
	{
		$query = " 	SELECT * FROM deliverybill
					WHERE isvoid = 0
					ORDER BY nodb DESC , tglbayar DESC
					LIMIT $offset , $num
					";
		$query = $this->db->query($query);
		return $query->result();
	}
	public function count_all_db()
	{
		$query = "  SELECT * FROM deliverybill
					WHERE isvoid = 0
					";
		$query = $this->db->query($query);
		return $query->num_rows();
	}
	
	public function get_db_by_nodb($db,$num,$offset)
	{
		if($db == 'ALL'){$db = '';}
		$query = " 	SELECT * FROM deliverybill
					WHERE nodb LIKE '%$db%'
					AND isvoid = 0
					ORDER BY tglbayar DESC
					LIMIT $offset , $num
					";
		$query = $this->db->query($query);
		return $query->result();
	}
	public function count_db_by_nodb($db)
	{
		if($db == 'ALL'){$db = '';}
		$query = "  SELECT * FROM deliverybill
					WHERE nodb LIKE '%$db%'
					AND isvoid = 0
					";
		$query = $this->db->query($query);
		return $query->num_rows();
	}
	/* Akhir Delivery Bill */
	
	
	/*Query incoming outgoing income summary */
	/*
	public function incoming_summary_income($date, $type)
	 {
		 /*$query = ("
		 SELECT *, SUM(sewagudang) as whc, SUM(cargo_charge) as csc, SUM(ppn) as ppn, SUM(administrasi) as adm, SUM(total_biaya) as totbiaya FROM deliverybill as db
		JOIN ( SELECT * from in_dtbarang WHERE in_status_bayar = 'yes' ) as indt ON indt.in_btb = db.no_smubtb
		WHERE db.isvoid = 0
		AND DATE(db.tglbayar) = '" . $date . "'
		AND db.status = 0
		GROUP BY indt.in_airline
	    ");*/
	/*	if($type == 'v2')
		{
		
		$query = ("
		SELECT * , SUM(sewagudang) as whc, SUM(cargo_charge) as csc, SUM(ppn) as ppn, SUM(administrasi) as adm, SUM(total_biaya) as totbiaya, SUM(totalkoli) as koli, ROUND(SUM(totalberatbayar),1) as kilo FROM deliverybill as db
			JOIN ( SELECT * from isimanifestin WHERE isvoid = 0) as isi  ON isi.no_smu = db.nosmu
			JOIN ( SELECT *, airline as in_airline from manifestin WHERE isvoid = 0) as mani ON mani.id_manifestin = isi.id_manifestin
			WHERE db.isvoid = 0
			AND DATE(db.tglbayar) = '" . $date . "'
			AND db.status = 0
			GROUP BY mani.in_airline
		");
		/*$query = ("
			SELECT *, SUM(sewagudang) as whc, SUM(cargo_charge) as csc, SUM(ppn) as ppn, SUM(administrasi) as adm, SUM(total_biaya) as totbiaya, SUM(kolidatang) as koli, ROUND(SUM(beratdatang),1) as kilo FROM deliverybill as db
			JOIN ( SELECT * from isimanifestin ) as isi  ON isi.no_smu = db.nosmu
			JOIN ( SELECT * from manifestin) as mani ON mani.id_manifestin = isi.id_manifestin
			JOIN ( SELECT * from breakdown) as bd ON bd.id_isimanifestin = isi.id_isimanifestin
			WHERE db.isvoid = 0
			AND DATE(db.tglbayar) = '" . $date . "'
			AND db.status = 0
			GROUP BY mani.airline
			");*/
	/*	}
		else
		{
		$query = ("
		SELECT *, SUM(sewagudang) as whc, SUM(cargo_charge) as csc, SUM(ppn) as ppn, SUM(administrasi) as adm, SUM(total_biaya) as totbiaya, SUM(in_koli) as koli, SUM(in_berat_bayar) as kilo FROM deliverybill as db
		JOIN ( SELECT * from in_dtbarang WHERE in_status_bayar = 'yes' ) as indt ON indt.in_btb = db.no_smubtb
		WHERE db.isvoid = 0
		AND DATE(db.tglbayar) = '" . $date . "'
		AND db.status = 0
		GROUP BY indt.in_airline
		 ");
		}
		
		 $query = $this->db->query($query);
		return $query->result();
	 }
	 
	 public function outgoing_summary_income($date)
	 {
		 /*$query = ("
		 SELECT *, SUM(sewagudang) as whc, SUM(cargo_charge) as csc, SUM(ppn) as ppn, SUM(administrasi) as adm, SUM(total_biaya) as totbiaya FROM deliverybill as db
		JOIN ( SELECT * from out_dtbarang_h WHERE status_bayar = 'yes' ) as outdt ON outdt.btb_nobtb = db.no_smubtb
		WHERE db.isvoid = 0
		AND DATE(db.tglbayar) = '" . $date . "'
		AND db.status = 1
		GROUP BY outdt.airline
	    ");*/
		
	/*	$query = ("
		SELECT *, SUM(sewagudang) as whc, SUM(cargo_charge) as csc, SUM(ppn) as ppn, SUM(administrasi) as adm, SUM(total_biaya) as totbiaya, SUM(btb_totalkoli) as koli, ROUND(SUM(btb_totalberatbayar),1) as kilo FROM deliverybill as db
		JOIN ( SELECT * from out_dtbarang_h WHERE status_bayar = 'yes' AND isvoid = 0 ) as outdt ON outdt.btb_nobtb = db.no_smubtb
		WHERE db.isvoid = 0
		AND DATE(db.tglbayar) = '" . $date . "'
		AND db.status = 1
		GROUP BY outdt.airline
		");
		
		 $query = $this->db->query($query);
		return $query->result();
	 }
	 */
}

/* End of file cashier.php */
/* Location: ./application/models/cashier.php */