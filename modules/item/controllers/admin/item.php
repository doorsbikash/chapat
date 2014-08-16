<?php

class Item extends Admin_Controller
{
	
	public function __construct(){
		parent::__construct();
		$this->load->module_model('item','item_model');
		$this->lang->module_load('item','item');
        //$this->bep_assets->load_asset('jquery.upload'); // uncomment if image ajax upload
	}

	public function index()
	{
		// Display Page
		$data['header'] = 'item';
		$data['page'] = $this->config->item('template_admin') . "item/index";
		$data['module'] = 'item';
		$this->load->view($this->_container,$data);		
	}

	public function json()
	{
		$this->_get_search_param();	
		$total=$this->item_model->count();
		paging('item_id');
		$this->_get_search_param();	
		$rows=$this->item_model->getItems()->result_array();
		echo json_encode(array('total'=>$total,'rows'=>$rows));
	}
	
	public function _get_search_param()
	{
		// Search Param Goes Here
		parse_str($this->input->post('data'),$params);
		if(!empty($params['search']))
		{
			($params['search']['item_code']!='')?$this->db->like('item_code',$params['search']['item_code']):'';
			($params['search']['item_description']!='')?$this->db->like('item_description',$params['search']['item_description']):'';
			($params['search']['manufacture_id']!='')?$this->db->where('manufacture_id',$params['search']['manufacture_id']):'';
			($params['search']['supplier_id']!='')?$this->db->where('supplier_id',$params['search']['supplier_id']):'';
			($params['search']['pack_id']!='')?$this->db->where('pack_id',$params['search']['pack_id']):'';
			($params['search']['quantity']!='')?$this->db->where('quantity',$params['search']['quantity']):'';
			($params['search']['cost_price']!='')?$this->db->like('cost_price',$params['search']['cost_price']):'';
			($params['search']['sell_price']!='')?$this->db->like('sell_price',$params['search']['sell_price']):'';
			($params['search']['currency']!='')?$this->db->like('currency',$params['search']['currency']):'';
			($params['search']['remarks']!='')?$this->db->like('remarks',$params['search']['remarks']):'';

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
		$rows=$this->item_model->getItems()->result_array();
		echo json_encode($rows);    	
	}    

	public function delete_json()
	{
		$id=$this->input->post('id');
		if($id && is_array($id))
		{
			foreach($id as $row):
				$this->item_model->update('ITEM',array('delete_flag'=>'1'),array('item_id'=>$row));
			endforeach;
		}
	}    

	public function save()
	{
		
        $data=$this->_get_posted_data(); //Retrive Posted Data		

        if(!$this->input->post('item_id'))
        {
        	$data['created_by'] = $data['modified_by'] = $this->session->userdata('id');
        	$data['created_datetime'] = $data['modified_datetime'] =  date('Y-m-d H:i:s');
        	$data['delete_flag'] = '0';
        	$success=$this->item_model->insert('ITEM',$data);
        }
        else
        {	
        	$data['modified_by']=$this->session->userdata('id');
        	$data['modified_datetime']=date('Y-m-d H:i:s');
        	$success=$this->item_model->update('ITEM',$data,array('item_id'=>$data['item_id']));
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
    	$data['item_id'] = $this->input->post('item_id');
    	$data['item_code'] = $this->input->post('item_code');
    	$data['item_description'] = $this->input->post('item_description');
    	//$data['manufacture_id'] = $this->input->post('manufacture_id');
    	//$data['supplier_id'] = $this->input->post('supplier_id');
    	$data['pack_id'] = $this->input->post('pack_id');
    	/*$data['manufactured_date'] = $this->input->post('manufactured_date');
    	$data['expiry_date'] = $this->input->post('expiry_date');
    	$data['quantity'] = $this->input->post('quantity');
    	$data['cost_price'] = $this->input->post('cost_price');
    	$data['sell_price'] = $this->input->post('sell_price');*/
    	//$data['currency'] = $this->input->post('currency');
    	$data['remarks'] = $this->input->post('remarks');

    	return $data;
    }



}