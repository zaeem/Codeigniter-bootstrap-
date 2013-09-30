<?php
class Subscribe extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');

		$this->load->model('SettingsModel');
		$this->mckey = "63713f59c1fb39cfb4e58665cf1c381c-us6";
		//$this->mcList = $this->SettingsModel->GetMailchimpList();
		//$this->mdkey = $this->SettingsModel->GetMD();
		if($this->mckey){
				$config1 = array(  	'apikey' => $this->mckey,      // Insert your api key
	            					'secure' => FALSE   // Optional (defaults to FALSE)
				);

			$this->load->library('MCAPI', $config1, 'mail_chimp1');
		}
	}

	function index(){
		$data['heading'] = 'Subscribe';

		$data['lists'] = $this->mail_chimp1->lists();
		$data['lists'] = $data['lists']['data'];

		$this->load->view('common/header',$data);
		$this->load->view('common/nav',$data);
		$this->load->view('subscribe_view',$data);
		$this->load->view('common/footer',$data);
	}

	function do_subscribe(){
		$this->form_validation->set_rules('fname', "First Name", "required|trim");
		$this->form_validation->set_rules('lname', "Last Name", "required|trim");
		$this->form_validation->set_rules('email', "Email", "required|trim|valid_email");

		if(!$this->form_validation->run()){
			$this->index();
		}
		else{
			$mergevars = array('fname' => ($this->input->post('fname')), 'lname'=> ($this->input->post('lname')));
			$retval = $this->mail_chimp1->listSubscribe( $this->input->post('list'), $this->input->post('email'), $mergevars);
			
			//echo var_dump();
			$data['lists'] = $this->mail_chimp1->lists();
			$data['lists'] = $data['lists']['data'];	
			$data['msg'] = "You are succesfully subscribed!";
			$data['heading'] = "Subscribe";

			$this->load->view('common/header',$data);
			$this->load->view('common/nav',$data);
			$this->load->view('subscribe_view',$data);
			$this->load->view('common/footer',$data);
		}		
	}
}
?> 