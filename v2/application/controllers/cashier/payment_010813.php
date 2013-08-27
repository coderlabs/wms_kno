<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller {

	/**
	 *
	 */
	function __construct()
	{
        parent::__construct();
		/*
		if ( ! $this->session->userdata('logged_in'))
    	{ 
        	# function allowed for access without login
			$allowed = array('');
        
			# other function need login
			if (! in_array($this->router->method, $allowed)) 
			{
    			redirect('user/login');
			}
   		 }
		 */
	} 
	
	public function index()
	{
		redirect('cashier/payment/new_receipt');
	}
	
	public function new_receipt()
	{		
		#view call
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('cashier/add_payment_receipt_form');
		$this->load->view('template/footer');
	}
	
	public function do_search_receipt()
	{
		#load model
		$this->load->model('cashier');
		
		#form validation
		//$this->form_validation->set_rules('btb_no', 'btb_no', 'required');
		
		#preparing search
		//if ($this->form_validation->run() == FALSE)
		{ 
			#redirect if form btb empty
			//redirect('cashier/payment/new_receipt'); 
		} //else
		{
			$search = $this->input->post('btb_no');
			$data['outgoing'] = $this->cashier->payment_receipt_outgoing($search);
			$data['incoming'] = $this->cashier->payment_receipt_incoming($search);
			
			$outgoing = 0;
			$incoming = 0;
			foreach($data['outgoing'] as $row)
			{
				$outgoing = $outgoing + 1;
			}
			foreach($data['incoming'] as $row)
			{
				$incoming = $incoming + 1;
			}
			
			if (($outgoing == 1) && ($incoming == 0))
			{
				$this->payment_receipt_outgoing($data['outgoing']);
			} else 
			if (($incoming == 1) && ($outgoing == 0))
			{
				$this->payment_receipt_incoming($data['incoming']);
			} else if (($outgoing > 1) || ($incoming > 1))
			{
				redirect('cashier/payment/new_receipt/duplicate_data');
			} else if (($outgoing == 0) && ($incoming == 0))
			{
				redirect('cashier/payment/new_receipt/not_found');
			}
			
		}
	}
	
	public function payment_receipt_outgoing($search)
	{		
		#prepare var
		$data['payment_type']= $this->cashier->get_all_payment_type();
		$today = date('Y-m-d');
		
		foreach ($search as $row)
		{
			$hargasewa = $this->cashier->get_harga_sewa($row->btb_agent,'outgoing');
			$data['totalberat'] = $row->btb_totalberat;
			$hari = mdate('%Y-%m-%d',strtotime($row->btb_date));
		}
			
		#perhitungan biaya
		if ($hargasewa != NULL)
		{
			$data['outgoing'] = $search;
			foreach ($hargasewa as $hs)
			{
				$data['admin'] = $hs->dokumen;
				$csc = $hs->cgocharge;
				$data['sph'] = $hs->sewaperhari;
				$data['ppn'] = $hs->ppn;
				$kade = $hs->kade;
				$mincharge = $hs->mincharge;
				$minweight = $hs->minweight;
				$minhari = $hs->minhari;
			}
			
			$data['jumhari'] = strtotime($today) - strtotime($hari);
			$data['jumhari'] = $data['jumhari'] / (3600*24);
			
			if ($data['jumhari'] <= $minhari)
			{
				$data['minhari'] = 1;
			} else {$data['minhari'] = $data['jumhari'] - 2;}
			
			$data['minweight'] = 'n';
			if ($data['totalberat'] <= $minweight)
			{
				$data['totalberat'] = $minweight;
				$data['minweight'] = 'y';
			}
			$data['cargocharge'] = $csc * $data['totalberat'];
			$data['kade'] = $kade * $data['totalberat'];
			$data['total'] = $data['totalberat'] * $data['sph'] * $data['minhari'];
			$data['overtime'] = $data['total'] - ($data['totalberat']*$data['sph']);
			if ($data['overtime'] <= 0)
			{
				$data['overtime'] = 0;
			}
			
			$data['mincharge'] = 'n';
			if ($data['total'] <= $mincharge)
			{
				$data['total'] = $mincharge;
				$data['mincharge'] = 'y';
			}
		}
		#View Call
		$this->load->view('template/spk_header');
		$this->load->view('template/breadcumb');
		if ($hargasewa == NULL)
		{
			$this->load->view('cashier/payment_error');
		} else {
		$this->load->view('cashier/payment_receipt_outgoing_form',$data);
		}
		$this->load->view('template/footer');
	}
	
	public function payment_receipt_incoming($search)
	{
		#sidebar data
		#prepare var
		$data['payment_type']= $this->cashier->get_all_payment_type();
		$today = date('Y-m-d');
		
		foreach ($search as $row)
		{
			$hargasewa = $this->cashier->get_harga_sewa($row->in_agent,'incoming');
			$data['totalberat'] = $row->in_berat_bayar;
			$hari = mdate('%Y-%m-%d',strtotime($row->in_tgl_manifest));
		}
			
		#perhitungan biaya
		if ($hargasewa != NULL)
		{
			$data['incoming'] = $search;
			foreach ($hargasewa as $hs)
			{
				$data['admin'] = $hs->dokumen;
				$csc = $hs->cgocharge;
				$data['sph'] = $hs->sewaperhari;
				$data['ppn'] = $hs->ppn;
				$kade = $hs->kade;
				$mincharge = $hs->mincharge;
				$minweight = $hs->minweight;
				$minhari = $hs->minhari;
			}
			
			$data['jumhari'] = strtotime($today) - strtotime($hari);
			$data['jumhari'] = $data['jumhari'] / (3600*24);
			
			if ($data['jumhari'] <= $minhari)
			{
				$data['minhari'] = 1;
			} else {$data['minhari'] = $data['jumhari'] - 2;}
			
			$data['minweight'] = 'n';
			if ($data['totalberat'] <= $minweight)
			{
				$data['totalberat'] = $minweight;
				$data['minweight'] = 'y';
			}
			$data['cargocharge'] = $csc * $data['totalberat'];
			$data['kade'] = $kade * $data['totalberat'];
			$data['total'] = $data['totalberat'] * $data['sph'] * $data['minhari'];
			$data['overtime'] = $data['total'] - ($data['totalberat']*$data['sph']);
			if ($data['overtime'] <= 0)
			{
				$data['overtime'] = 0;
			}
			
			$data['mincharge'] = 'n';
			if ($data['total'] <= $mincharge)
			{
				$data['total'] = $mincharge;
				$data['mincharge'] = 'y';
			}
		}
		
		#view call
		$this->load->view('template/spk_header');;
		$this->load->view('template/breadcumb');
		if ($hargasewa == NULL)
		{
			$this->load->view('cashier/payment_error');
		} else {
		$this->load->view('cashier/payment_receipt_incoming_form',$data);
		}
		$this->load->view('template/footer');
	}
	
	public function save_payment()
	{
		$this->load->model('cashier');
		
		# get user data
		$user = $this->session->userdata('logged_in');
		$user = $user['id_user'];
		$no_db = $this->cashier->get_last_db();
		if($this->input->post('agent') <> 'POS INDONESIA')
		{
			$no_faktur = $this->cashier->get_last_faktur();
		} else {$no_faktur = '';}
		
		# data preparing
		$print['print'] = $this->input->post('btb_no');
		$print['nodb'] = $no_db;
		$data = array(
				'no_smubtb' => $this->input->post('btb_no'),
				'document' => $this->input->post('administrasi'),
				'storage' => $this->input->post('total'),
				'id_carabayar' => $this->input->post('payment_type'),
				'lain' => $this->input->post('ppn_rp'),
				'ppn' => $this->input->post('ppn_rp'),
				'tglbayar' => mdate('%Y-%m-%d %h:%i:%s', strtotime($this->input->post('date_out'))),
				'user' => $user,
				'hari' => $this->input->post('min_hari'),
				'status' => $this->input->post('type'),
				'posted' => 0,
				'keterangan' => $this->input->post('ket'),
				'nosmu' => $this->input->post('awb_no'),
				'overtime' => $this->input->post('overtime'),
				'nodb' => $no_db,
				'nofaktur' => $no_faktur,
				'actual_days' => $this->input->post('jum_hari'),
				'sewagudang' => $this->input->post('total'),
				'sewagudang_after_discount' => $this->input->post('total'),
				'administrasi' => $this->input->post('administrasi'),
				'total_biaya' => $this->input->post('total_bayar'),
				'minimum_charge' => $this->input->post('minc'),
				'minimum_weight' => $this->input->post('minw'),
			);
		
		$this->cashier->save_db($data);
		
		#View Call
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		if($this->input->post('type') == 0)
		{
			$this->load->view('cashier/print_bti', $print);
			$this->cashier->update_in_dtbarang($this->input->post('btb_no'));
		} else if ($this->input->post('type') == 1){
			$this->load->view('cashier/print_bto',$print);
			$this->cashier->update_out_dtbarang_h($this->input->post('btb_no'));
		}
		$this->load->view('template/footer');
		//redirect('cashier/payment/new_receipt'); 
	}
	
	public function print_db()
	{
		#model call
		$this->load->model('cashier');
		$this->load->helper('terbilang');
		
		$devbil = $this->uri->segment(4);
	
		$devbill_out = $this->cashier->get_dev_bill_out_detail($devbil);
		$devbill_in = $this->cashier->get_dev_bill_in_detail($devbil);
		if ( $devbill_out != NULL) {
			$data['dev_bill'] = $this->cashier->get_dev_bill_out_detail($devbil);
			$set = $data['dev_bill'];
		} else if ($devbill_in != NULL) {
			$data['dev_bill'] = $this->cashier->get_dev_bill_in_detail($devbil);
			$set = $data['dev_bill'];
		}
		
		foreach ($set as $row)
		{
			$data['terbilang'] = number_to_words($row->total_biaya);
			$type = $row->status;
			$devbill = $row->nodb;
			$no_btb = $row->no_smubtb;
		}
		
		$this->cashier->update_status_print($devbill);
		$this->cashier->update_status_dbo($no_btb);
		
		# Helper Load
		$this->load->helper('sigap_pdf');
		$this->load->view('cashier/pdf/print_dbi',$data);
		
		//PDF Maker
		$stream = TRUE; 
		$papersize = 'legal'; 
		$orientation = 'potrait';
		$filename = 'delivery-bill-'.$devbil;
		$stn = $this->input->post('hs_service_site');
		if ($type == 0)
		{ $html = $this->load->view('cashier/pdf/print_dbi', $data, true); }
		else if ($type == 1)
		{ $html = $this->load->view('cashier/pdf/print_dbo',$data, true); }
     	pdf_create($html, $filename, $stream, $papersize, $orientation, $stn);
		$full_filename = $filename . '.pdf';
		
		
		redirect('cashier/payment/');
	}
	public function reprint_db()
	{
		$data['no_btb'] = $this->uri->segment(4);
		
		#View Call
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('cashier/reprint_db', $data);
		$this->load->view('template/footer');
	
	}
	public function do_reprint_db()
	{
		#model call
		$this->load->model('cashier');
		$this->load->helper('terbilang');
		
		$no_btb = $this->uri->segment(4);
		
		$no_db = $this->cashier->get_nodb($no_btb);
		foreach ($no_db as $row)
		{
			$no_db = $row->nodb;
		}
		$devbill_out = $this->cashier->get_dev_bill_out_detail($no_db);
		$devbill_in = $this->cashier->get_dev_bill_in_detail($no_db);
		if ( $devbill_out != NULL) {
			$data['dev_bill'] = $this->cashier->get_dev_bill_out_detail($no_db);
			$set = $data['dev_bill'];
		} else if ($devbill_in != NULL) {
			$data['dev_bill'] = $this->cashier->get_dev_bill_in_detail($no_db);
			$set = $data['dev_bill'];
		}
		
		foreach ($set as $row)
		{
			$data['terbilang'] = number_to_words($row->total_biaya);
			$type = $row->status;
			$devbill = $row->nodb;
			$no_btb = $row->no_smubtb;
		}
		
		$this->cashier->update_status_print($devbill);
		$this->cashier->update_status_dbo($no_btb);
		# Helper Load
		$this->load->helper('sigap_pdf');
		$this->load->view('cashier/pdf/print_dbi',$data);
		
		//PDF Maker
		$stream = TRUE; 
		$papersize = 'legal'; 
		$orientation = 'potrait';
		$filename = 'delivery-bill-'.$no_db;
		$stn = $this->input->post('hs_service_site');
		$html = '';
		if ($type == 0)
		{ $html = $this->load->view('cashier/pdf/print_dbi', $data, true); }
		else if ($type == 1)
		{ $html = $this->load->view('cashier/pdf/print_dbo',$data, true); }
     	pdf_create($html, $filename, $stream, $papersize, $orientation, $stn);
		$full_filename = $filename . '.pdf';
		
		
		
		//redirect('cashier/payment/');
	}
	
	public function void_dbi()
	{
		#model call
		$this->load->model('cashier');
		
		$data['no_btb'] = $this->uri->segment(4);
		$data['cek_barang'] = $this->cashier->cek_barang_instore($data['no_btb']);
		
		#View Call
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('cashier/void_reason_dbi', $data);
		$this->load->view('template/footer');
	}
	
	function do_void_dbi()
	{
		#model call
		$this->load->model('cashier');
		
		$user = $this->session->userdata('logged_in');
		$user = $user['id_user'];
		$no_btb = $this->uri->segment(4);
		
		$this->cashier->do_void_dbi($no_btb, $user);
		
		redirect('cashier/payment');
	}
	
	public function void_dbo()
	{
		$data['no_btb'] = $this->uri->segment(4);
		
		#View Call
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('cashier/void_reason_dbo', $data);
		$this->load->view('template/footer');
	}
	
	function do_void_dbo()
	{
		#model call
		$this->load->model('cashier');
		
		$user = $this->session->userdata('logged_in');
		$user = $user['id_user'];
		$no_btb = $this->uri->segment(4);
		
		$this->cashier->do_void_dbo($no_btb, $user);
		
		redirect('cashier/payment');
	}
}

/* End of file payment.php */
/* Location: ./application/controllers/cashier/payment.php */