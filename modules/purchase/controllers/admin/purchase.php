<?php

class Purchase extends Admin_Controller
{
	
	public function __construct(){
		parent::__construct();
		$this->load->module_model('purchase','purchase_model');
		$this->load->module_model('purchase','purchase_detail_model');
		$this->load->module_model('pack','pack_model');
		$this->load->module_model('supplier','supplier_model');

		$this->lang->module_load('purchase','purchase');
		$this->lang->module_load('purchase','purchase_detail');
        //$this->bep_assets->load_asset('jquery.upload'); // uncomment if image ajax upload
	}

	public function index()
	{
		// Display Page
		$data['header'] = 'purchase';
		$data['page'] = $this->config->item('template_admin') . "purchase/index";
		$data['module'] = 'purchase';
		$this->load->view($this->_container,$data);		
	}

	public function json()
	{
		$this->_get_search_param();	
		$total=$this->purchase_model->count();
		paging('purchase_master_id');
		$this->_get_search_param();	

		$rows=$this->purchase_model->getPurchaseMasters(array('p.delete_flag' =>'0'))->result_array();
		echo json_encode(array('total'=>$total,'rows'=>$rows));
	}

	public function getPurchaseDetailjson(){
		$purchase_master_id = mysql_real_escape_string($_REQUEST['purchase_master_id']);
		$total=$this->purchase_model->countPurchaseDetail(array('purchase_master_id'=>$purchase_master_id));
		$rows=$this->purchase_model->getPurchaseDetail($purchase_master_id)->result_array();
		echo json_encode(array('total'=>$total,'rows'=>$rows));
	}
	
	public function _get_search_param()
	{
		// Search Param Goes Here
		parse_str($this->input->post('data'),$params);
		if(!empty($params['search']))
		{
			($params['search']['invoice_no']!='')?$this->db->like('invoice_no',$params['search']['invoice_no']):'';
			($params['search']['total']!='')?$this->db->like('total',$params['search']['total']):'';
			($params['search']['less_discount']!='')?$this->db->like('less_discount',$params['search']['less_discount']):'';
			($params['search']['net_total']!='')?$this->db->like('net_total',$params['search']['net_total']):'';
			($params['search']['received_by']!='')?$this->db->like('received_by',$params['search']['received_by']):'';
			($params['search']['supplier_id']!='')?$this->db->where('supplier_id',$params['search']['supplier_id']):'';
			($params['search']['memo_type']!='')?$this->db->like('memo_type',$params['search']['memo_type']):'';

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
		$rows=$this->purchase_model->getPurchases()->result_array();
		echo json_encode($rows);    	
	}    

	public function delete_json()
	{
		$id=$this->input->post('id');
		if($id && is_array($id))
		{
			foreach($id as $row):
				$this->purchase_model->update('PURCHASE',array('delete_flag'=>'1'),array('purchase_master_id'=>$row));
			endforeach;
		}
	}

	public function save()
	{
		
        $data=$this->_get_posted_data(); //Retrive Posted Data		

        if(!$this->input->post('purchase_master_id'))
        {
        	$data['created_by'] = $data['modified_by'] = $this->session->userdata('id');
        	$data['created_datetime'] = $data['modified_datetime'] =  date('Y-m-d H:i:s');
        	$data['delete_flag'] = '0';
        	$success=$this->purchase_model->insert('PURCHASE',$data);
        	$purchase_master_id = $this->db->insert_id();
        }
        else
        {
        	$data['modified_by']=$this->session->userdata('id');
        	$data['modified_datetime']=date('Y-m-d H:i:s');
        	$purchase_master_id =$data['purchase_master_id'];
        	$success=$this->purchase_model->update('PURCHASE',$data,array('purchase_master_id'=>$purchase_master_id));
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

        echo json_encode(array('msg'=>$msg,'success'=>$success,'data'=>$purchase_master_id));		
        
    }

    private function _get_posted_data()
    {
    	$data=array();
    	$data['purchase_master_id'] = $this->input->post('purchase_master_id');
    	$data['invoice_no'] = $this->input->post('invoice_no');
    	$data['purchase_date'] = $this->input->post('purchase_date');
    	$data['total'] = $this->input->post('total');
    	$data['less_discount'] = $this->input->post('less_discount');
    	$data['net_total'] = $this->input->post('net_total');
    	$data['received_by'] = $this->input->post('received_by');
    	$data['supplier_id'] = $this->input->post('supplier_id');
    	$data['memo_type'] = $this->input->post('memo_type');

    	return $data;
    }

    public function pack_json() {
		$rows=array();
		$result=$this->pack_model->getPacks(array('delete_flag'=>'0'));
		foreach($result->result_array() as $row):
			$rows[]=$row;
		endforeach;
		echo json_encode($rows);
	}

	public function supplier_json() {
		$rows=array();
		$result=$this->supplier_model->getsuppliers(array('delete_flag'=>'0'));
		foreach($result->result_array() as $row):
			$rows[]=$row;
		endforeach;
		echo json_encode($rows);
	}

	public function purchase_detail_json(){
		$getPuchaseDetail = $this->purchase_model->getPurchaseDetail()->result_array;
		echo json_encode($getPuchaseDetail);
	}

	public function savePurchaseDetail(){
		$purchase_master_id = mysql_real_escape_string($_REQUEST['purchase_master_id']);
		$isNewrecord = $this->input->post('isNewRecord');

		if($isNewrecord==true){
			$data = $this->_get_detail_posted_data($purchase_master_id);
			$data['created_by'] = $data['modified_by'] = $this->session->userdata('id');
			$data['created_datetime'] = $data['modified_datetime'] =  date('Y-m-d H:i:s');
			$data['delete_flag'] = '0';
			$success=$this->purchase_detail_model->insert('PURCHASE_DETAIL',$data);
			
			if($success){

			$data['purchase_detail_id'] = $this->db->insert_id();
			echo json_encode($data);
			}
		}
	}

	private function _get_detail_posted_data($pmid){
    	
    	$data=array();
    	$data['purchase_master_id'] = $pmid;
    	$data['purchase_detail_id'] = $this->input->post('purchase_detail_id');
    	$data['item_code'] = $this->input->post('item_code');
    	$data['item_description'] = $this->input->post('item_description');
    	$data['pack'] = $this->input->post('pack');
    	$data['batch'] = $this->input->post('batch');
    	$data['amount'] = $this->input->post('amount');
    	$data['quantity'] = $this->input->post('quantity');
    	$data['expiry_date'] = $this->input->post('expiry_date');
    	$data['cc_rate'] = $this->input->post('cc_rate');
    	$data['mrp'] = $this->input->post('mrp');

    	return $data;
    }

    public function updatePurchaseDetail(){
    	$data = array();
    	$data['purchase_detail_id'] = intval($_REQUEST['purchase_detail_id']);
    	$data['item_code'] = $_REQUEST['item_code'];
    	$data['item_description'] = $_REQUEST['item_description'];
    	$data['pack ']= $_REQUEST['pack'];
    	$data['batch ']= $_REQUEST['batch'];
    	$data['expiry_date ']= $_REQUEST['expiry_date'];
    	$data['quantity ']= $_REQUEST['quantity'];
    	$data['cc_rate ']= $_REQUEST['cc_rate'];
    	$data['amount ']= $_REQUEST['amount'];
    	$data['mrp ']= $_REQUEST['mrp'];
    	$data['modified_datetime'] = date('Y-m-d H:i:s');
    	$data['delete_flag'] = '0';
    	$success=$this->purchase_detail_model->update('PURCHASE_DETAIL',$data,array('purchase_detail_id'=>$data['purchase_detail_id']));
   		if($success){
   			echo json_encode($data);
   		}
	}
	public function deletePurchaseDetail()
	{
		$id=$this->input->post('purchase_detail_id');
		if($id && is_array($id))
		{
			foreach($id as $row):
				$this->purchase_model->update('PURCHASE',array('delete_flag'=>'1'),array('purchase_master_id'=>$row));
			endforeach;
		}
	}
}