<?php

class Supplier extends Admin_Controller
{
	
	public function __construct(){
		parent::__construct();
		$this->load->module_model('supplier','supplier_model');
		$this->lang->module_load('supplier','supplier');
        //$this->bep_assets->load_asset('jquery.upload'); // uncomment if image ajax upload
	}

	public function index()
	{
		// Display Page
		$data['header'] = 'supplier';
		$data['page'] = $this->config->item('template_admin') . "supplier/index";
		$data['module'] = 'supplier';
		$this->load->view($this->_container,$data);		
	}

	public function json()
	{
		$this->_get_search_param();	
		$total=$this->supplier_model->count();
		paging('id');
		$this->_get_search_param();	
		$rows=$this->supplier_model->getSuppliers()->result_array();
		echo json_encode(array('total'=>$total,'rows'=>$rows));
	}
	
	public function _get_search_param()
	{
		$delete_flag=0;
		if($this->input->post('delete_flag')) {
			$delete_flag=$this->input->post('delete_flag');
		}
		$this->db->where('delete_flag',0);
		// Search Param Goes Here
		parse_str($this->input->post('data'),$params);
		if(!empty($params['search']))
		{
			($params['search']['supplier_name']!='')?$this->db->like('supplier_name',$params['search']['supplier_name']):'';
			($params['search']['address']!='')?$this->db->like('address',$params['search']['address']):'';
			($params['search']['contactno']!='')?$this->db->like('contactno',$params['search']['contactno']):'';
			($params['search']['modified_date']!='')?$this->db->like('modified_date',$params['search']['modified_date']):'';

		}  

		
		if(!empty($params['date']))
		{
			foreach($params['date'] as $key=>$value){
				$this->_datewise($key,$value['from'],$value['to']);	
			}
		}


	}

	
	private function _datewise($field,$from,$to)
	{
		if(!empty($from) && !empty($to))
		{
			$this->db->where("(date_format(".$field.",'%Y-%m-%d') between '".date('Y-m-d',strtotime($from)).
				"' and '".date('Y-m-d',strtotime($to))."')");
		}
		else if(!empty($from))
		{
			$this->db->like($field,date('Y-m-d',strtotime($from)));				
		}		
	}	

	public function combo_json()
	{
		$rows=$this->supplier_model->getSuppliers()->result_array();
		echo json_encode($rows);    	
	}    

	public function delete_json()
	{
		$id=$this->input->post('id');
		if($id && is_array($id))
		{
			foreach($id as $row):
				$this->supplier_model->update('SUPPLIER',array('delete_flag'=>'1'),array('id'=>$row));
			endforeach;
		}
	}
	

	public function save()
	{
		
        $data=$this->_get_posted_data(); //Retrive Posted Data		

        if(!$this->input->post('id'))
        {
        	$data['created_by'] = $data['modified_by'] = $this->session->userdata('id');
        	$data['created_datetime'] = $data['modified_date'] =  date('Y-m-d H:i:s');
        	$data['delete_flag'] = '0';
        	$success=$this->supplier_model->insert('SUPPLIER',$data);
        }
        else
        {
        	$data['modified_by']=$this->session->userdata('id');
        	$data['modified_date']=date('Y-m-d H:i:s');
        	$success=$this->supplier_model->update('SUPPLIER',$data,array('id'=>$data['id']));
        }
        
        if($success)
        {
        	$success = TRUE;
        	$msg=lang('success_message'); 
        } 
        else
        {
        	$success = FALSE;
        	$msg=lang('failure_message');
        }

        echo json_encode(array('msg'=>$msg,'success'=>$success));		
        
    }

    private function _get_posted_data()
    {
    	$data=array();
    	$data['id'] = $this->input->post('id');
    	$data['supplier_name'] = $this->input->post('supplier_name');
    	$data['address'] = $this->input->post('address');
    	$data['contactno'] = $this->input->post('contactno');

    	return $data;
    }



}