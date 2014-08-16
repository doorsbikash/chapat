<?php

class User_Controller extends Site_Controller{
	
	function __construct()
	{
		parent::__construct();
		
		// Set container variable
		$this->_container = $this->config->item('template_user') . "container.php";
        $this->_popup_container = $this->config->item('template_user') . "popup.php";
        $this->_empty_container = $this->config->item('template_user') . "empty_container.php";
		
		//print_r($this->session->userdata);exit;
		if(!is_user())
		{
			redirect(site_url('auth'));
		}

		//$this->LOGGED_IN_USER=$this->session->userdata('id'); // Get Current Logged IN User ID
		//$this->CLIENT_ID=$this->session->userdata('client_id'); // Get Current Logged IN User's Client ID
		// Set public meta tags
		//$this->bep_site->set_metatag('name','content',TRUE/FALSE);
		$this->bep_site->set_metatag('meta_keywords',$this->preference->item('meta_keywords'));
		$this->bep_site->set_metatag('meta_description',$this->preference->item('meta_description'));
		
		/*if(!$this->preference->item('site_status'))
		{
			echo $this->preference->item('offline_message');
			exit;
		}*/
		// Load the PUBLIC asset group
		
		
		$this->lang->load('menu');
		$this->load->helper('paging');
		$this->bep_assets->load_asset_group('ADMIN');
		$this->bep_assets->load_asset('customdate');
		log_message('debug','BackendPro : User_Controller class loaded');

       
	}
}