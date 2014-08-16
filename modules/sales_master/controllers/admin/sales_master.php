<?php

class Sales_master extends Admin_Controller
{
	
	public function __construct(){
    	parent::__construct();
        $this->load->module_model('sales_master','sales_master_model');
        $this->lang->module_load('sales_master','sales_master');
        //$this->bep_assets->load_asset('jquery.upload'); // uncomment if image ajax upload
    }
    
	public function index()
	{
		// Display Page
		$data['header'] = 'sales_master';
		$data['page'] = $this->config->item('template_admin') . "sales_master/index";
		$data['module'] = 'sales_master';
		$this->load->view($this->_container,$data);		
	}

	public function json()
	{
		$this->_get_search_param();	
		$total=$this->sales_master_model->count();
		paging('sales_master_id');
		$this->_get_search_param();	
		$rows=$this->sales_master_model->getSalesMasters()->result_array();
		echo json_encode(array('total'=>$total,'rows'=>$rows));
	}
	
	public function _get_search_param()
	{
		// Search Param Goes Here
		parse_str($this->input->post('data'),$params);
		if(!empty($params['search']))
		{
			($params['search']['amount']!='')?$this->db->like('amount',$params['search']['amount']):'';
($params['search']['sold_by']!='')?$this->db->like('sold_by',$params['search']['sold_by']):'';
($params['search']['created_by']!='')?$this->db->where('created_by',$params['search']['created_by']):'';
(isset($params['search']['delete_flag']))?$this->db->where('delete_flag',$params['search']['delete_flag']):'';

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
		$rows=$this->sales_master_model->getSalesMasters()->result_array();
		echo json_encode($rows);    	
    }    
    
	public function delete_json()
	{
    	$id=$this->input->post('id');
		if($id && is_array($id))
		{
        	foreach($id as $row):
				$this->sales_master_model->delete('SALES_MASTER',array('sales_master_id'=>$row));
            endforeach;
		}
	}    

	public function save()
	{
		
        $data=$this->_get_posted_data(); //Retrive Posted Data		

        if(!$this->input->post('sales_master_id'))
        {
            $success=$this->sales_master_model->insert('SALES_MASTER',$data);
        }
        else
        {
            $success=$this->sales_master_model->update('SALES_MASTER',$data,array('sales_master_id'=>$data['sales_master_id']));
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
        $data['sales_master_id'] = $this->input->post('sales_master_id');
$data['sales_date'] = $this->input->post('sales_date');
$data['amount'] = $this->input->post('amount');
$data['sold_by'] = $this->input->post('sold_by');
$data['created_date'] = $this->input->post('created_date');
$data['created_by'] = $this->input->post('created_by');
$data['delete_flag'] = $this->input->post('delete_flag');
$data['modified_datetime'] = $this->input->post('modified_datetime');

        return $data;
   }
   
   	
	    
}