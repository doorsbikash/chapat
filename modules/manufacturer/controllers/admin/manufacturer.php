<?php

class Manufacturer extends Admin_Controller
{
	
	public function __construct(){
		parent::__construct();
		$this->load->module_model('manufacturer','manufacturer_model');
		$this->lang->module_load('manufacturer','manufacturer');
        //$this->bep_assets->load_asset('jquery.upload'); // uncomment if image ajax upload
	}

	public function index()
	{
		// Display Page
		$data['header'] = 'manufacturer';
		$data['page'] = $this->config->item('template_admin') . "manufacturer/index";
		$data['module'] = 'manufacturer';
		$this->load->view($this->_container,$data);		
	}

	public function json()
	{
		$this->_get_search_param();	
		$total=$this->manufacturer_model->count();
		paging('id');
		$this->_get_search_param();	
		$rows=$this->manufacturer_model->getManufacturers()->result_array();
		echo json_encode(array('total'=>$total,'rows'=>$rows));
	}
	
	public function _get_search_param()
	{
		// Search Param Goes Here
		parse_str($this->input->post('data'),$params);
		if(!empty($params['search']))
		{
			($params['search']['manufacturer_name']!='')?$this->db->like('manufacturer_name',$params['search']['manufacturer_name']):'';
			($params['search']['address']!='')?$this->db->like('address',$params['search']['address']):'';
			($params['search']['country']!='')?$this->db->like('country',$params['search']['country']):'';
			($params['search']['pan_no']!='')?$this->db->like('pan_no',$params['search']['pan_no']):'';
			($params['search']['telephone_no']!='')?$this->db->like('telephone_no',$params['search']['telephone_no']):'';
			($params['search']['created_datetime']!='')?$this->db->like('created_datetime',$params['search']['created_datetime']):'';
			($params['search']['modified_by']!='')?$this->db->where('modified_by',$params['search']['modified_by']):'';

		}  
		$delete_flag=0;
		if($this->input->post('delete_flag')) {
			$delete_flag=$this->input->post('delete_flag');
		}
		$this->db->where('delete_flag',0);

		
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
		$rows=$this->manufacturer_model->getManufacturers()->result_array();
		echo json_encode($rows);    	
	}    

	public function delete_json()
	{
		$id=$this->input->post('id');
		if($id && is_array($id))
		{
			foreach($id as $row):
				$this->manufacturer_model->update('MANUFACTURER',array('delete_flag'=>'1'),array('id'=>$row));
			endforeach;
		}
	}
	

	public function save()
	{

        $data=$this->_get_posted_data(); //Retrive Posted Data		

        if(!$this->input->post('id'))
        {
        	$data['created_by'] = $data['modified_by'] = $this->session->userdata('id');
        	$data['created_datetime'] = $data['modified_datetime'] =  date('Y-m-d H:i:s');
        	$data['delete_flag'] = '0';
        	$success=$this->manufacturer_model->insert('MANUFACTURER',$data);
        }
        else
        {	
        	$data['modified_by']=$this->session->userdata('id');
        	$data['modified_datetime']=date('Y-m-d H:i:s');
        	$success=$this->manufacturer_model->update('MANUFACTURER',$data,array('id'=>$data['id']));
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
		$data['manufacturer_name'] = $this->input->post('manufacturer_name');
		$data['address'] = $this->input->post('address');
		$data['country'] = $this->input->post('country');
		$data['pan_no'] = $this->input->post('pan_no');
		$data['telephone_no'] = $this->input->post('telephone_no');


		return $data;
	}



}