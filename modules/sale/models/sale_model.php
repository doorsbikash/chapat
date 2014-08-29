    <?php
    class Sale_model extends MY_Model
    {
    	var $joins=array();
        public function __construct()
        {
        	parent::__construct();
            $this->prefix='tbl_';
            $this->_TABLES=array('SALES'=>$this->prefix.'sales',
             'SALES_DETAIL'=>$this->prefix.'sales_detail',
             'PURCHASE_DETAIL'=>$this->prefix.'purchase_detail' );

        }
        
        public function getSales($where=NULL,$order_by=NULL,$limit=array('limit'=>NULL,'offset'=>''))
        {
         $fields='sales.*';

         $this->db->select($fields);
         $this->db->from($this->_TABLES['SALES']. ' sales');

         foreach($this->joins as $key):
            $this->db->join($this->_TABLES[$key]. ' ' .$this->_JOINS[$key]['alias'],$this->_JOINS[$key]['join_field'],$this->_JOINS[$key]['join_type']);
        endforeach;	        

        (! is_null($where))?$this->db->where($where):NULL;
        (! is_null($order_by))?$this->db->order_by($order_by):NULL;

        if( ! is_null($limit['limit']))
        {
         $this->db->limit($limit['limit'],( isset($limit['offset'])?$limit['offset']:''));
     }
     return $this->db->get();	    
    }

    public function count($where=NULL)
    {

        $this->db->from($this->_TABLES['SALES'].' sales');

        foreach($this->joins as $key):
            $this->db->join($this->_TABLES[$key]. ' ' .$this->_JOINS[$key]['alias'],$this->_JOINS[$key]['join_field'],$this->_JOINS[$key]['join_type']);
        endforeach;        

        (! is_null($where))?$this->db->where($where):NULL;

        return $this->db->count_all_results();
    }
    public function getItemDetails(){
        $fields='p.item_description,p.item_code,p.batch,p.mrp';
        $this->db->select($fields);   
        $this->db->from($this->_TABLES['PURCHASE_DETAIL'].' p');
        $this->db->group_by('p.batch');
        return $this->db->get();     

    }
    }