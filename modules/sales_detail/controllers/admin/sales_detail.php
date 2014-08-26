<?php

class Sales_detail extends Admin_Controller
{
	
	public function __construct(){
    	parent::__construct();
        $this->load->module_model('sales_detail','sales_detail_model');
        $this->lang->module_load('sales_detail','sales_detail');
        //$this->bep_assets->load_asset('jquery.upload'); // uncomment if image ajax upload
    }
    
	public function index()
	{
		// Display Page
		$data['header'] = 'sales_detail';
		$data['page'] = $this->config->item('template_admin') . "sales_detail/index";
		$data['module'] = 'sales_detail';
		$this->load->view($this->_container,$data);		
	}

	public function json()
	{
		$this->_get_search_param();	
		$total=$this->sales_detail_model->count();
		paging('sales_detail_id');
		$this->_get_search_param();	
		$rows=$this->sales_detail_model->getSalesDetails()->result_array();
		echo json_encode(array('total'=>$total,'rows'=>$rows));
	}
	
	public function _get_search_param()
	{
		// Search Param Goes Here
		parse_str($this->input->post('data'),$params);
		if(!empty($params['search']))
		{
			($params['search']['sales_master_id']!='')?$this->db->where('sales_master_id',$params['search']['sales_master_id']):'';
($params['search']['item_id']!='')?$this->db->where('item_id',$params['search']['item_id']):'';
($params['search']['price']!='')?$this->db->like('price',$params['search']['price']):'';
($params['search']['quantity']!='')?$this->db->where('quantity',$params['search']['quantity']):'';

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
		$rows=$this->sales_detail_model->getSalesDetails()->result_array();
		echo json_encode($rows);    	
    }    
    
	public function delete_json()
	{
    	$id=$this->input->post('id');
		if($id && is_array($id))
		{
        	foreach($id as $row):
				$this->sales_detail_model->delete('SALES_DETAIL',array('sales_detail_id'=>$row));
            endforeach;
		}
	}    

	public function save()
	{
		
        $data=$this->_get_posted_data(); //Retrive Posted Data		

        if(!$this->input->post('sales_detail_id'))
        {
            $success=$this->sales_detail_model->insert('SALES_DETAIL',$data);
        }
        else
        {
            $success=$this->sales_detail_model->update('SALES_DETAIL',$data,array('sales_detail_id'=>$data['sales_detail_id']));
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
        $data['sales_detail_id'] = $this->input->post('sales_detail_id');
$data['sales_master_id'] = $this->input->post('sales_master_id');
$data['item_id'] = $this->input->post('item_id');
$data['price'] = $this->input->post('price');
$data['quantity'] = $this->input->post('quantity');
$data['modified_datetime'] = $this->input->post('modified_datetime');

        return $data;
   }
   
   	
	    
}