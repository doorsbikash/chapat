<?php

class Tbl_sale extends Admin_Controller
{
	
	public function __construct(){
    	parent::__construct();
        $this->load->module_model('tbl_sale','tbl_sale_model');
        $this->lang->module_load('tbl_sale','tbl_sale');
        //$this->bep_assets->load_asset('jquery.upload'); // uncomment if image ajax upload
    }
    
	public function index()
	{
		// Display Page
		$data['header'] = 'tbl_sale';
		$data['page'] = $this->config->item('template_admin') . "tbl_sale/index";
		$data['module'] = 'tbl_sale';
		$this->load->view($this->_container,$data);		
	}

	public function json()
	{
		$this->_get_search_param();	
		$total=$this->tbl_sale_model->count();
		paging('sales_master_id');
		$this->_get_search_param();	
		$rows=$this->tbl_sale_model->getTblSales()->result_array();
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
		$rows=$this->tbl_sale_model->getTblSales()->result_array();
		echo json_encode($rows);    	
    }    
    
	public function delete_json()
	{
    	$id=$this->input->post('id');
		if($id && is_array($id))
		{
        	foreach($id as $row):
				$this->tbl_sale_model->delete('TBL_SALES',array('sales_master_id'=>$row));
            endforeach;
		}
	}    

	public function save()
	{
		
        $data=$this->_get_posted_data(); //Retrive Posted Data		

        if(!$this->input->post('sales_master_id'))
        {
            $success=$this->tbl_sale_model->insert('TBL_SALES',$data);
        }
        else
        {
            $success=$this->tbl_sale_model->update('TBL_SALES',$data,array('sales_master_id'=>$data['sales_master_id']));
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
$data['delete_flag'] = $this->input->post('delete_flag');

        return $data;
   }
   
   	
	    
}