<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mysql_model extends CI_Model { 

    public function __construct(){
  		parent::__construct();
  		$this->regetSession();
	}
	
	private function regetSession(){//目前有3处//session1
	    $this->jxcsys = $this->session->userdata('jxcsys');
	    $this->canOperate = ($this->jxcsys['roleid'] != 0 && $this->jxcsys['orgId'] && $this->jxcsys['lowId']>0);//&& $this->jxcsys['orgLevel']==3
	    $orgWhere = explode('=',$this->jxcsys['orgWhere']);
	    $this->orgWhere = array($orgWhere[0]=>$orgWhere[1]);
	    $orgMidWhere = explode('=',$this->jxcsys['orgMidWhere']);
	    $this->orgMidWhere =  array($orgMidWhere[0]=>$orgMidWhere[1]);
	    $this->orgMidWhereStr = $this->jxcsys['orgMidWhere'];
	    $this->orgWhereStr = $this->jxcsys['orgWhere'];
	}
	
	private function getOrgWhere($where,$table){
	    $this->regetSession();
	    if($this->jxcsys['roleid'] == 0) return $where;
	    if(!$this->jxcsys['orgId']) {
	        if(is_array($where))
	            return array_merge($where,array(1=>2));
	        else 
	            return $where.' and (1=2) ';
	    }
	    $pubArr = array('invoice_type','menu','options','admin','org');
	    if(in_array($table, $pubArr))return $where;
	    $baseArr = array('contact','goods','goods_img','storage','staff','account','category');
	    if(is_array($where)){
    	    if(in_array($table, $baseArr))
    	        return array_merge($where,$this->orgMidWhere);
    	    else 
    	        return array_merge($where,$this->orgWhere);
	    }else{
	        if(in_array($table, $baseArr))
	            return $where.' and ('.$this->orgMidWhereStr.') ';
	        else
	            return $where.' and ('.$this->orgWhereStr.') ';
	    }
	}
	
	public function query($sql,$type=1) {
		$query = $this->db->query($sql);
		switch ($type) {
			case 1:
				$result = $query->row_array();break;  
			case 2:
				$result = $query->result_array();break;  	
			case 3:
				$result = $query->num_rows();break; 	
		}
		return $result;
	}

	public function get_results($table,$where='',$order='',$limit1=0,$limit2=0,$select='*') {
	    $where = $this->getOrgWhere($where,$table);
		$this->db->select($select);
		$this->db->from($this->db->dbprefix($table));
		if ($where) {
			$this->db->where($where);
		}
		if ($order) {
			$this->db->order_by($order);
		}
		if ($limit2>0) {
			$this->db->limit($limit2, $limit1);
		}
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_rows($table,$where=array(1=>1),$select='*') {
	    $where = $this->getOrgWhere($where,$table);
	    $query = $this->db->select($select)
		                            ->from($this->db->dbprefix($table))
									->where($where)
									->get();
		return $query->row_array();					
	}
	
	public function get_row($table,$where=array(1=>1),$select) {
	    $where = $this->getOrgWhere($where,$table);
	    $query = $this->db->select($select)
		                            ->from($this->db->dbprefix($table))
									->where($where)
									->get();
		$result = $query->row_array();							
		return $result[$select];					
	}
	
	public function get_count($table,$where=array(1=>1),$select='*') {
	    $where = $this->getOrgWhere($where,$table);
	    return $this->db->select($select)
		                            ->from($this->db->dbprefix($table))
									->where($where)
									->count_all_results();					
	}
	
	
	public function insert($table,$data){
	    //str_alert(-1,var_export($this->jxcsys,true));
	    $this->regetSession();
	    if($table=='org'){
	        $table  = $this->db->dbprefix($table);
	        if (isset($data[0]) && is_array($data[0])) {
	            $this->db->insert_batch($table, $data);
	        } else {
	            $this->db->insert($table, $data);
	        }
	        $this->db->cache_delete_all();
	        return $this->db->insert_id();
	    }
	    !in_array($table,array('log','admin','options'))&&!$this->canOperate && str_alert(-1,'对不起，您不在组织机构中，无法新增！');
		$table  = $this->db->dbprefix($table);
		if (isset($data[0]) && is_array($data[0])) {
		    foreach ($data as $arr=>$row) {
		        $v[$arr]=$row;
		        $v[$arr]['topId']||$v[$arr]['topId'] = $this->jxcsys['topId'];
		        $v[$arr]['midId']||$v[$arr]['midId'] = $this->jxcsys['midId'];
		        $v[$arr]['lowId']||$v[$arr]['lowId'] = $this->jxcsys['lowId'];
		    }
			$this->db->insert_batch($table, $v);
		} else {
		    $data['topId']||$data['topId'] = $this->jxcsys['topId'];
		    $data['midId']||$data['midId'] = $this->jxcsys['midId'];
		    $data['lowId']||$data['lowId'] = $this->jxcsys['lowId'];
			$this->db->insert($table, $data);    	
		}
		$this->db->cache_delete_all();
		return $this->db->insert_id();  
	}
	
	public function update($table,$data,$where='') {
		$table  = $this->db->dbprefix($table);
		if (isset($data[0]) && is_array($data[0])) {
			$this->db->update_batch($table,$data,$where);
			if ($this->db->affected_rows()) {
				$result = true;  
			}     
		} else {
			if (is_array($data)&&count($data)>0) {
				if ($where) {
					$this->db->where($where);
				}
				$result = $this->db->update($table, $data);  
			} else {
				if (!is_array($data)) {
				    $result = $this->db->query('UPDATE '.$table.' SET '.$data .($where ? ' WHERE '.$where : ''));
				}
			}	
		}
		if (isset($result)) {
		    $this->db->cache_delete_all();
			return  $result;  
		} 
        return false;
    }

	public function delete($table,$where='') { 
		$table  = $this->db->dbprefix($table);
		if ($where) {
			$this->db->where($where);
		}
		$this->db->delete($table);
		if ($this->db->affected_rows()) {
		    $this->db->cache_delete_all();
			return  true; 
		} 
		return  false; 
	}

	
}