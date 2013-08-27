<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cashier extends CI_Model {

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
	 
	public function payment_receipt_incoming($search)
	{
		$this->db->select('*');
		$this->db->where('in_btb',$search);
		$query = $this->db->get('in_dtbarang');
		return $query->result();
	}
	
	public function payment_receipt_outgoing($search)
	{
		$this->db->select('*');
		$this->db->where('btb_nobtb', $search);
		$query = $this->db->get('out_dtbarang_h');
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
		$this->db->join('out_dtbarang','out_dtbarang_h.id = out_dtbarang.id_h', 'LEFT');
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
	
	public function update_in_dtbarang($nobtb)
	{
		$this->db->update('in_dtbarang', array('in_status_bayar'=>'yes'), array('in_btb'=>$nobtb));
	}
	
	public function deposit_update($agent_id, $deposit_cash)
	{
		$this->db->update('var_agent', array('agent_deposit'=>$deposit_cash), array('agent_id'=>$agent_id));
	}
	
	public function get_last_db()
	 {
		#$this->db->select_max('wo_id');
		$this->db->order_by('nodb','DESC');
		$this->db->limit(1);
		$query = $this->db->get('deliverybill');
		
		# prepare value
		$pr_date = mdate("%Y", time());
		$pr_start = '0000000';
		
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
				$query = $item->nodb;
			endforeach;
			
			# handling same date
			if(substr($query, 0, 4) == mdate("%Y", time()))
			{
				$date_serial = substr($query, 0, 4);
				$serial_number = substr($query, 7) + 1;
				$serial_number =  sprintf("%1$07d", $serial_number);
				$query = $date_serial . $serial_number;
			}
			else # handling different date / restart new serial number
			{
				$query = $pr_date  . $pr_start;	
			}
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
	 
	 function do_void_dbo($no_btb, $user)
	 {
		$this->db->update('out_dtbarang_ha', array('status_bayar'=>'no', 'posted'=>0), array('btb_nobtb'=>$no_btb));
		$this->db->update('deliverybill', array('isvoid'=>'1', 'keterangan'=>$this->input->post('reason'),'voidby'=>$user), array('no_smubtb'=>$no_btb));
	 }
	 
	 function cek_barang_instore($no_btb)
	 {
		$this->db->select('status_ambil');
		$this->db->join('isimanifestin', 'no_smu = in_smu', 'LEFT');
		$this->db->join('breakdown', 'isimanifestin.id_isimanifestin = breakdown.id_isimanifestin', 'LEFT');
		$this->db->where('in_btb', $no_btb);
		$query = $this->db->get('in_dtbarang');
		return $query->result_array();
	 }
	 
	 function do_void_dbi($no_btb, $user)
	 {
		$this->db->update('in_dtbarang', array('in_status_bayar'=>'no'), array('in_btb'=>$no_btb));
		$this->db->update('deliverybill', array('isvoid'=>'1', 'keterangan'=>$this->input->post('reason'),'voidby'=>$user), array('no_smubtb'=>$no_btb));
	 }
}

/* End of file airline.php */
/* Location: ./application/models/airline.php */