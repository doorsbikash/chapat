<?php
class Purchase_model extends MY_Model
{
	var $joins=array();
    public function __construct()
    {
    	parent::__construct();
        $this->prefix='tbl_';
        $this->prefixmaster='master_';
        $this->_TABLES=array('PURCHASE'=>$this->prefix.'purchase',
                            'SUPPPLIER'=>$this->prefixmaster.'supplier',
                            'PURCHASE_DETAIL'=>$this->prefix.'purchase_detail');
		    
    }
    
    public function getPurchases($where=NULL,$order_by=NULL,$limit=array('limit'=>NULL,'offset'=>''))
    {
         //this query works
         //$this->db->"select * from tbl_purchase where purchase_master_id in (select purchase_master_id from tbl_purchase)";
        $fields='p.invoice_no,p.memo_type,pd.*';
        $this->db->select($fields);
        $this->db->from($this->_TABLES['PURCHASE'].' p');
        $this->db->join($this->_TABLES['PURCHASE_DETAIL'].' pd','p.purchase_master_id=pd.purchase_master_id','left');
        
        //$this->db->from($this->_TABLES['PURCHASE']. ' purchases');
		$order_by="invoice_no";
		(! is_null($where))?$this->db->where($where):NULL;
		(! is_null($order_by))?$this->db->order_by($order_by):NULL;

		if( ! is_null($limit['limit']))
		{
			$this->db->limit($limit['limit'],( isset($limit['offset'])?$limit['offset']:''));
		}
       // echo $this->db->last_query();
		return $this->db->get();	    
    }

    public function getPurchaseMasters($where=NULL,$order_by=NULL,$limit=array('limit'=>NULL,'offset'=>''))
    {
    
        $fields='p.*,sup.supplier_name';
         
        $this->db->select($fields);
      //  $this->db->from($this->_TABLES['PURCHASE'].' p');
        $this->db->from($this->_TABLES['PURCHASE']. ' p');
        $this->db->join($this->_TABLES['SUPPPLIER'].' sup','sup.id=p.supplier_id','left');
        $order_by="invoice_no";
        (! is_null($where))?$this->db->where($where):NULL;
        (! is_null($order_by))?$this->db->order_by($order_by):NULL;

        if( ! is_null($limit['limit']))
        {
            $this->db->limit($limit['limit'],( isset($limit['offset'])?$limit['offset']:''));
        }
        return $this->db->get();      
    }
    

    public function getPurchaseDetail($purchase_master_id )
    {   
        $this->db->select('*');
        $this->db->from($this->_TABLES['PURCHASE_DETAIL'].' pd');
        $this->db->where('pd.purchase_master_id',$purchase_master_id);
        $result = $this->db->get();
        return $result;
    }
    
    
    public function count($where=NULL)
    {
		
        $this->db->from($this->_TABLES['PURCHASE'].' purchases');
        
        foreach($this->joins as $key):
        $this->db->join($this->_TABLES[$key]. ' ' .$this->_JOINS[$key]['alias'],$this->_JOINS[$key]['join_field'],$this->_JOINS[$key]['join_type']);
        endforeach;        
       
       (! is_null($where))?$this->db->where($where):NULL;
		
        return $this->db->count_all_results();
    }
    public function countPurchaseDetail($where=NULL)
    {
        
        $this->db->from($this->_TABLES['PURCHASE_DETAIL'].' purchase_details');
        
       (! is_null($where))?$this->db->where($where):NULL;
        
        return  $this->db->count_all_results();
    }
}