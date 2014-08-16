<?php

class Pack extends Admin_Controller
{
	
	public function __construct(){
		parent::__construct();
		$this->load->module_model('pack','pack_model');
		$this->lang->module_load('pack','pack');
        //$this->bep_assets->load_asset('jquery.upload'); // uncomment if image ajax upload
	}

	public function index()
	{
		// Display Page
		$data['header'] = 'pack';
		$data['page'] = $this->config->item('template_admin') . "pack/index";
		$data['module'] = 'pack';
		$this->load->view($this->_container,$data);		
	}

	public function json()
	{
		$this->_get_search_param();	
		$total=$this->pack_model->count();
		paging('id');
		$this->_get_search_param();	
		$rows=$this->pack_model->getPacks()->result_array();
		echo json_encode(array('total'=>$total,'rows'=>$rows));
	}
	
	public function _get_search_param()
	{
		// Search Param Goes Here
		parse_str($this->input->post('data'),$params);
		if(!empty($params['search']))
		{
			($params['search']['pack_description']!='')?$this->db->like('pack_description',$params['search']['pack_description']):'';
			($params['search']['created_datetime']!='')?$this->db->like('created_datetime',$params['search']['created_datetime']):'';
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
		$rows=$this->pack_model->getPacks()->result_array();
		echo json_encode($rows);    	
	}    

	public function delete_json()
	{
		$id=$this->input->post('id');
		if($id && is_array($id))
		{
			foreach($id as $row):
				$this->pack_model->update('PACK',array('delete_flag'=>'1'),array('id'=>$row));
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
        	$success=$this->pack_model->insert('PACK',$data);
        }
        else
        {
        	$data['modified_by']=$this->session->userdata('id');
        	$data['modified_datetime']=date('Y-m-d H:i:s');
        	$success=$this->pack_model->update('PACK',$data,array('id'=>$data['id']));
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
    	$data['pack_description'] = $this->input->post('pack_description');
    	$data['created_datetime'] = $this->input->post('created_datetime');
    	$data['delete_flag'] = $this->input->post('delete_flag');
    	$data['modified_by'] = $this->input->post('modified_by');
    	$data['modified_datetime'] = $this->input->post('modified_datetime');

    	return $data;
    }



}