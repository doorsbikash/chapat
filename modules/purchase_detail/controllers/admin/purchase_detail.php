<?php

class Purchase_detail extends Admin_Controller
{
	
	public function __construct(){
    	parent::__construct();
        $this->load->module_model('purchase_detail','purchase_detail_model');
        $this->lang->module_load('purchase_detail','purchase_detail');
        //$this->bep_assets->load_asset('jquery.upload'); // uncomment if image ajax upload
    }
    
	public function index()
	{
		// Display Page
		$data['header'] = 'purchase_detail';
		$data['page'] = $this->config->item('template_admin') . "purchase_detail/index";
		$data['module'] = 'purchase_detail';
		$this->load->view($this->_container,$data);		
	}

	public function json()
	{
		$this->_get_search_param();	
		$total=$this->purchase_detail_model->count();
		paging('purchase_detail_id');
		$this->_get_search_param();	
		$rows=$this->purchase_detail_model->getPurchaseDetails()->result_array();
		echo json_encode(array('total'=>$total,'rows'=>$rows));
	}
	
	public function _get_search_param()
	{
		// Search Param Goes Here
		parse_str($this->input->post('data'),$params);
		if(!empty($params['search']))
		{
			($params['search']['purchase_master_id']!='')?$this->db->where('purchase_master_id',$params['search']['purchase_master_id']):'';
($params['search']['item_code']!='')?$this->db->like('item_code',$params['search']['item_code']):'';
($params['search']['item_description']!='')?$this->db->like('item_description',$params['search']['item_description']):'';
($params['search']['pack']!='')?$this->db->where('pack',$params['search']['pack']):'';
($params['search']['batch']!='')?$this->db->like('batch',$params['search']['batch']):'';
($params['search']['quantity']!='')?$this->db->where('quantity',$params['search']['quantity']):'';
($params['search']['cc_rate']!='')?$this->db->like('cc_rate',$params['search']['cc_rate']):'';
($params['search']['amount']!='')?$this->db->like('amount',$params['search']['amount']):'';
($params['search']['mrp']!='')?$this->db->like('mrp',$params['search']['mrp']):'';

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
		$rows=$this->purchase_detail_model->getPurchaseDetails()->result_array();
		echo json_encode($rows);    	
    }    
    
	public function delete_json()
	{
    	$id=$this->input->post('id');
		if($id && is_array($id))
		{
        	foreach($id as $row):
				$this->purchase_detail_model->delete('PURCHASE_DETAIL',array('purchase_detail_id'=>$row));
            endforeach;
		}
	}    

	public function save()
	{
		
        $data=$this->_get_posted_data(); //Retrive Posted Data		

        if(!$this->input->post('purchase_detail_id'))
        {
            $success=$this->purchase_detail_model->insert('PURCHASE_DETAIL',$data);
        }
        else
        {
            $success=$this->purchase_detail_model->update('PURCHASE_DETAIL',$data,array('purchase_detail_id'=>$data['purchase_detail_id']));
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
        $data['purchase_detail_id'] = $this->input->post('purchase_detail_id');
$data['purchase_master_id'] = $this->input->post('purchase_master_id');
$data['item_code'] = $this->input->post('item_code');
$data['item_description'] = $this->input->post('item_description');
$data['pack'] = $this->input->post('pack');
$data['batch'] = $this->input->post('batch');
$data['expiry_date'] = $this->input->post('expiry_date');
$data['quantity'] = $this->input->post('quantity');
$data['cc_rate'] = $this->input->post('cc_rate');
$data['amount'] = $this->input->post('amount');
$data['mrp'] = $this->input->post('mrp');
$data['modified_date'] = $this->input->post('modified_date');

        return $data;
   }
   
   	
	    
}