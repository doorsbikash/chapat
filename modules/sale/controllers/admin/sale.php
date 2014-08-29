<?php

class Sale extends Admin_Controller
{
	
	public function __construct(){
		parent::__construct();
		$this->load->module_model('sale','sale_model');
		$this->load->module_model('purchase_detail','purchase_detail_model');
		$this->load->module_model('sale','sales_detail_model');
		$this->lang->module_load('sale','sale');
        //$this->bep_assets->load_asset('jquery.upload'); // uncomment if image ajax upload
	}

	public function index()
	{
		// Display Page
		$data['header'] = 'sale';
		$data['page'] = $this->config->item('template_admin') . "sale/index";
		$data['module'] = 'sale';
		$this->load->view($this->_container,$data);		
	}

	public function json()
	{
		$this->_get_search_param();	
		$total=$this->sale_model->count();
		paging('sales_master_id');
		$this->_get_search_param();	
		$rows=$this->sale_model->getSales()->result_array();
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
		$rows=$this->sale_model->getSales()->result_array();
		echo json_encode($rows);    	
	}    

	public function delete_json()
	{
		$id=$this->input->post('id');
		if($id && is_array($id))
		{
			foreach($id as $row):
				$this->sale_model->delete('SALES',array('sales_master_id'=>$row));
			endforeach;
		}
	}    

	public function save()
	{
		
        $salesdata=$this->_get_sales_posted_data(); //Retrive Posted Data		
        $salesDetaildata=$this->_get_salesDetail_posted_data(); //Retrive Posted Data

        if(!$this->input->post('sales_master_id'))
        {
        	$insert=$this->sale_model->insert('SALES',$salesdata);
        	if($insert){
        	$salesDetaildata['sales_master_id'] = $this->db->insert_id();
        	
        	$success=$this->sales_detail_model->insert('SALES_DETAIL',$salesDetaildata);
        	}
        }
        else
        {
        	$update=$this->sale_model->update('SALES',$salesdata,array('sales_master_id'=>$salesdata['sales_master_id']));
        	$success=$this->sale_model->update('SALES_DETAIL',$salesdata,array('sales_detail_id'=>$salesDetaildata['sales_detail_id']));
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

    private function _get_sales_posted_data()
    {
    	$salesdata=array();
    	$salesdata['sales_master_id'] = $this->input->post('sales_master_id');
    	$salesdata['sales_date'] = $this->input->post('sales_date');
    	$salesdata['bill_no'] = $this->input->post('bill_no');
    	$salesdata['amount'] = $this->input->post('amount');
    	$salesdata['sold_by'] = $this->input->post('sold_by');
    

    	return $salesdata;
    }
     private function _get_salesDetail_posted_data()
    {
    	$salesdata=array();
    	$salesdetaildata=array();
    	$salesdetaildata['item_description'] = $this->input->post('item_description');
    	$salesdetaildata['item_code'] = $this->input->post('item_code');
    	$salesdetaildata['price'] = $this->input->post('price');

    	return $salesdetaildata;
    }

    public function getItemDescription(){

    	$rows=$this->sale_model->getItemDetails()->result_array();
		echo json_encode($rows);  

    }



}