<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supervisor_model extends CI_Model {

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
	 
	#########################
	########  Agent	 ########
	#########################	
	public function get_all_agent($num,$offset)
	{
		$query = " SELECT * FROM btb_agent 
					LIMIT $offset , $num
				";
		$query = $this->db->query($query);
		return $query->result();
	}
	public function count_all_agent()
	{
		$query = " SELECT * FROM btb_agent ";
		$query = $this->db->query($query);
		return $query->num_rows();
	}
	public function get_agent($agent,$num,$offset)
	{
		$query = " 	SELECT * FROM btb_agent 
					WHERE btb_agent LIKE '%$agent%'
					LIMIT $offset , $num
				";
		$query = $this->db->query($query);
		return $query->result();
	}
	public function count_agent($agent)
	{
		$query = " SELECT * FROM btb_agent WHERE btb_agent LIKE '%$agent%' ";
		$query = $this->db->query($query);
		return $query->num_rows();
	}
	
	public function count_all_balance($agent)
	{
		$query = " SELECT * FROM agent_balance WHERE agent_id = '$agent' ";
		$query = $this->db->query($query);
		return $query->num_rows();
	}
	public function get_agent_by_id($id_agent)
	{
		$query = " SELECT * FROM btb_agent WHERE id_agent='$id_agent'	";
		$query = $this->db->query($query);
		return $query->result();
	}
	public function insert_data_agent($data)
	{
		$this->db->insert('btb_agent',$data);
		return $this->db->insert_id();
	}
	
	public function insert_balance_agent($id_agent)
	{
		$data = array(
				'agent_id' => $id_agent,
				'debet' => $this->input->post('balance'),
				'balance' => $this->input->post('balance'),
			);
		$this->db->insert('agent_balance', $data);
	}
	
	public function debet_balance($id_agent, $balance)
	{
		$balance = $balance + $this->input->post('balance');
		$ket = 'top up tanggal '. mdate('%d-%m-%Y');
		$data = array(
				'agent_id' => $id_agent,
				'debet' => $this->input->post('balance'),
				'balance' => $balance,
				'ket' => $ket
			);
		$this->db->insert('agent_balance', $data);
	}
	
	public function kredit_balance($id_agent, $balance, $ket)
	{
		$balance = $balance - $this->input->post('total_bayar');
		$data = array(
				'agent_id' => $id_agent,
				'kredit' => $this->input->post('total_bayar'),
				'balance' => $balance,
				'ket' => $ket
			);
		$this->db->insert('agent_balance', $data);
	}
	
	public function get_agent_balance($id_agent, $num,$offset)
	{
		$query = " SELECT * 
					FROM  `agent_balance` 
					WHERE  `agent_id` = '$id_agent'
					LIMIT $offset , $num
				";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	public function get_balance_by_name($agent)
	{
		$query = " SELECT * 
					FROM  `agent_balance` 
					LEFT JOIN  `btb_agent` ON  `agent_id` =  `id_agent` 
					WHERE  `btb_agent` = '$agent'
					ORDER BY `id_balance` DESC
					LIMIT 1
				";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	public function get_last_balance($id_agent)
	{
		$query = " SELECT * 
					FROM  `agent_balance` 
					LEFT JOIN  `btb_agent` ON  `agent_id` =  `id_agent` 
					WHERE  `agent_id` = '$id_agent'
					ORDER BY `id_balance` DESC
					LIMIT 1
				";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	public function update_data_agent($id_agent,$data)
	{
		$this->db->where('id_agent',$id_agent);
		$this->db->update('btb_agent',$data);
	}
	public function delete_agent($id_agent)
	{
		$this->db->delete('btb_agent', array('id_agent' => $id_agent)); 
	}
	#########################
	########  Agent	 ########
	#########################	
	
}

/* End of file supervisor.php */
/* Location: ./application/models/supervisor.php */