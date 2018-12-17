<?php
//add for more
defined('BASEPATH') OR exit('No direct script access allowed');

class Org extends CI_Controller {

    public function __construct(){
        parent::__construct();
		$this->common_model->checkpurview();
		$this->jxcsys = $this->session->userdata('jxcsys');
    }
	
	public function index(){ 
		$skey   = str_enhtml($this->input->get('skey',TRUE));
		$orgId = $this->jxcsys['roleid']==0 ? '' : ($this->jxcsys['orgId'] ? ' and (find_in_set('.$this->jxcsys['orgId'].',path))' : ' and (1=2)');
		$where  = '(isDelete=0)'.$orgId;
		$this->jxcsys['roleid']>0 && $where .= '';
		$where .= $skey ? ' and name like "%'.$skey.'%"' : '';
		$list = $this->mysql_model->get_results('org',$where,'path'); 
		$parentId  = array_column($list, 'parentId');  
		foreach ($list as $arr=>$row) {
			$v[$arr]['detail']      = in_array($row['id'],$parentId) ? false : true;
			$v[$arr]['id']          = intval($row['id']);
			$v[$arr]['level']       = $row['level'];
			$v[$arr]['name']        = $row['name'];
			$v[$arr]['parentId']    = intval($row['parentId']);
			$v[$arr]['status']      = intval($row['isDelete']);
		}
		$json['status'] = 200;
		$json['msg']    = 'success';
		$json['data']['items']      = isset($v) ? $v : array();
		$json['data']['totalsize']  = count($list);
		die(json_encode($json));	  
	}
    
	
	//新增
	public function add(){
		$data = $this->validform(str_enhtml($this->input->post(NULL,TRUE)));
        $this->common_model->checkpurview(301);
		if ($data['parentId']==0) {    
		    $data['level'] = 1;
			$newid = $this->mysql_model->insert('org',elements(array('name','level','parentId'),$data));
			$sql   = $this->mysql_model->update('org',array('path'=>$newid),array('id'=>$newid));
		} else {   	
			$cate = $this->mysql_model->get_rows('org',array('id'=>$data['parentId']));   
			count($cate)<1 && str_alert(-1,'参数错误'); 
			$data['level'] = $cate['level'] + 1;                           
			$newid = $this->mysql_model->insert('org',elements(array('name','level','parentId'),$data));        
			$sql   = $this->mysql_model->update('org',array('path'=>$cate['path'].','.$newid),array('id'=>$newid));    
		}
		if ($sql) {
			$this->common_model->logs('新增组织机构:'.$data['name']);
			die('{"status":200,"msg":"success","data":{"coId":0,"detail":true,"id":'.$newid.',"level":'.$data['level'].',"name":"'.$data['name'].'","parentId":'.$data['parentId'].',"remark":"","sortIndex":1,"status":0,"uuid":""}}');
		}
		str_alert(-1,'添加失败');
	}
 
 
	//修改
	public function update(){
		$data = $this->validform(str_enhtml($this->input->post(NULL,TRUE)));
		$this->common_model->checkpurview(301);
        $cate = $this->mysql_model->get_rows('org',array('id'=>$data['id']));                                              //获取原ID数据
		count($cate)<1 && str_alert(-1,'参数错误'); 
		$old_pid  = $cate['parentId'];
		$old_path = $cate['path'];
		$pid_list = $this->mysql_model->get_results('org','(id<>'.$data['id'].') and find_in_set('.$data['id'].',path)');    //是否有子栏目
		$data['parentId'] == $data['id'] && str_alert(-1,'当前组织机构和上级组织机构不能相同');
		if ($data['parentId']==0) {                  //多级转顶级 
			$pare_depth = 1; 
			if (count($pid_list)==0) {               //ID不存在子栏目
				$this->mysql_model->update('org',array('parentId'=>0,'path'=>$data['id'],'level'=>1,'name'=>$data['name']),array('id'=>$data['id']));
			} else {                                 //ID存在子栏目
				$this->mysql_model->update('org',array('parentId'=>0,'path'=>$data['id'],'level'=>1,'name'=>$data['name']),array('id'=>$data['id']));
				foreach($pid_list as $arr=>$row) {
					$path = str_replace(''.str_replace($data['id'],'',$old_path).'','',''.$row['path'].'');  
					$pare_depth = substr_count($path,',')+1;
					$info[] =  array('id'=>$row['id'],'path'=>$path,'level'=>$pare_depth);
				}
				$this->mysql_model->update('org',$info,'id');
			}
		} else {                                                                                 //pid<>0时，顶级转多级  多级转多级
			$cate = $this->mysql_model->get_rows('org',array('id'=>$data['parentId']));     //获取原PID数据
			count($cate)<1 && str_alert(-1,'参数错误'); 
			$pare_pid   = $cate['parentId'];
			$pare_path  = $cate['path'];
			$pare_depth = $cate['level'];
			if ($old_pid==0) {                //顶级转多级  
				if (count($pid_list)==0) {    //ID不存在子栏目
					$this->mysql_model->update('org',array('name'=>$data['name'],'parentId'=>$data['parentId'],'path'=>$pare_path.','.$data['id'],'level'=>$pare_depth+1),array('id'=>$data['id']));
				} else {                      //ID存在子栏目 
					$this->mysql_model->update('org',array('name'=>$data['name'],'parentId'=>$data['parentId'],'path'=>$pare_path.','.$data['id'],'level'=>$pare_depth+1),array('id'=>$data['id']));
					foreach ($pid_list as $arr=>$row) {
						$path = $pare_path.','.$row['path'];
						$pare_depth = substr_count($path,',')+1;
						$info[] = array('id'=>$row['id'],'path'=>$path,'level'=>$pare_depth);
					}
					$this->mysql_model->update('org',$info,'id');
				}    
			} else {                          //多级转多级
				if (count($pid_list)==0) {    //ID不存在子栏目
					$this->mysql_model->update('org',array('name'=>$data['name'],'parentId'=>$data['parentId'],'path'=>$pare_path.','.$data['id'],'level'=>$pare_depth+1),array('id'=>$data['id']));
				} else {                      //ID存在子栏目 
					$this->mysql_model->update('org',array('name'=>$data['name'],'parentId'=>$data['parentId'],'path'=>$pare_path.','.$data['id'],'level'=>$pare_depth+1),array('id'=>$data['id']));
					foreach ($pid_list as $arr=>$row) {
					    $path = $pare_path.','.str_replace(str_replace($data['id'],'',$old_path),'',$row['path']);   
						$pare_depth = substr_count($path,',')+1;
						$info[] = array('id'=>$row['id'],'path'=>$path,'level'=>$pare_depth+1);
					}
					$this->mysql_model->update('org',$info,'id');
				}
			}
		}
		$data['level'] = $pare_depth;
		//$this->mysql_model->update('goods',array('categoryName'=>$data['name']),array('categoryId'=>$data['id']));
		$this->common_model->logs('修改组织机构:ID='.$data['id'].' 名称:'.$data['name']);
		die('{"status":200,"msg":"success","data":{"coId":0,"detail":true,"id":'.$data['id'].',"level":'.$data['level'].',"name":"'.$data['name'].'","parentId":'.$data['parentId'].',"remark":"","sortIndex":0,"status":0,"typeNumber":"org","uuid":""}}');
		str_alert(200,'success',$data);
	}
	
	
	
    //分类删除
	public  function delete() {
		$id   = intval($this->input->post('id',TRUE));
		$this->common_model->checkpurview(301);
		$success = '删除组织机构:';
		$data = $this->mysql_model->get_rows('org',array('id'=>$id)); 
		if (count($data)>0) {
		    //$this->mysql_model->get_count('goods',array('isDelete'=>0,'categoryId'=>$id))>0 && str_alert(-1,'该组织机构已经被使用');
			$this->mysql_model->get_count('org','(isDelete=0) and find_in_set('.$id.',path)')>1 && str_alert(-1,'不能删除，请先删除子分类！'); 
			$sql = $this->mysql_model->update('org',array('isDelete'=>1),array('id'=>$id)); 
		    if ($sql) {
			    $this->common_model->logs($success.'ID='.$id.' 名称:'.$data['name']);
				str_alert(200,'success',array('msg'=>'删除成功','id'=>'['.$id.']'));
			}
		}
		str_alert(-1,'删除失败');
	}
	
	
	//公共验证
	private function validform($data) {
		$data['id']         = isset($data['id']) ? intval($data['id']) :0;
		$data['parentId']   = isset($data['parentId']) ? intval($data['parentId']):0;
		strlen($data['name']) < 1 && str_alert(-1,'组织机构名称不能为空');
		$where['isDelete']   = 0;
		$where['name']       = $data['name'];
		$where['id !=']      = $data['id']>0 ? $data['id'] :0;
		$this->mysql_model->get_count('org',$where) > 0 && str_alert(-1,'组织机构名称重复'); 
		
		if($this->jxcsys['orgLevel']!=0){
    		(empty($this->jxcsys['orgLevel'])||empty($this->jxcsys['orgId']))&&str_alert(-1,'当前用户不属于任何组织机构！请联系管理员分配！');
    		$where = '(isDelete=0) and id='.($data['id']>0 ? $data['id'] :0).' and level<='.$this->jxcsys['orgLevel'];
    		//str_alert(-1,$where);
    		$this->mysql_model->get_count('org',$where) > 0 && str_alert(-1,'您没有修改当前组织机构的权限！');
    		empty($data['parentId']) && $this->jxcsys['roleid']!=0 && str_alert(-1,'上级组织机构不能为空！'); //add
		}
		$where = '(isDelete=0) and id='.$data['parentId'].' and level=3';
    	$this->mysql_model->get_count('org',$where) > 0 && str_alert(-1,'不能超过组织机构最大层级！');
		return $data;
	}  
	

	public function orgToUser(){
	    $userId   = intval($this->input->post('userId',TRUE));
	    $orgId   = intval($this->input->post('orgId',TRUE));
	    $sql   = $this->mysql_model->update('admin',array('orgId'=>$orgId),array('uid'=>$userId));
	    if ($sql) {
	        str_alert(200,'success');
	    }else{
	        str_alert(-1,'分配失败');
	    }
	}
	
	public function changeLowOrg(){
	    $this->jxcsys = $this->session->userdata('jxcsys');
	    $orgId   = intval($this->input->post('orgId',TRUE));
	    $user['orgId'] = $this->jxcsys['orgId'];
	    $user['orgLevel'] = $this->jxcsys['orgLevel'];
	    $user['orgName'] = $this->jxcsys['orgName'];
	    $orgWhere = $this->jxcsys['orgWhere'];
	    $orgMidWhere = $this->jxcsys['orgMidWhere'];
	    $org = $this->mysql_model->get_rows('org',array(isDelete => 0, id =>$orgId));
	    $path = $org['path'];
	    $paths = explode(',', $path);
	    $count = count($paths);
	    $topId = $midId = $lowId = -1;
	    switch ($count){
	        case 1:
	            if($org['level'] != 1) break;
	            $topId = $paths[0];
	            break;
            case 2:
                if($org['level'] != 2) break;
                $topId = $paths[0];
                $midId = $paths[1];
                break;
            case 3:
                if($org['level'] != 3) break;
                $topId = $paths[0];
                $midId = $paths[1];
                $lowId = $paths[2];
                break;
            default:
	    }
	    switch ($org['level']){
	        case 1:
	            $orgWhere = 'topId='.$topId;
	            $orgMidWhere = 'topId='.$topId;
	            break;
	        case 2:
	            $orgWhere = 'midId='.$midId;
	            $orgMidWhere = 'midId='.$midId;
	            break;
	        case 3:
	            $orgWhere = 'lowId='.$lowId;
	            $orgMidWhere = 'midId='.$midId;
	            break;
	    }
	    $data['jxcsys'] = $this->jxcsys;
	    $data['jxcsys']['topId'] = intval($topId);//此处三个ID与用户表的注意区分
	    $data['jxcsys']['midId'] = intval($midId);
	    $data['jxcsys']['lowId'] = intval($lowId);//insert
	    $data['jxcsys']['orgWhere'] = $orgWhere;
	    $data['jxcsys']['orgMidWhere'] = $orgMidWhere;//query
	    $data['jxcsys']['orgName'] = $org['name'];//show
	    
	    $this->session->set_userdata($data);
	    str_alert(200,'success');
	}
	
	public function getMd(){
	    $this->jxcsys = $this->session->userdata('jxcsys');
	    $list = $this->mysql_model->get_results('org','(isDelete=0) and parentId='.$this->jxcsys['midId'].' and id<>'.$this->jxcsys['lowId'],'id asc');//add for more
	    foreach ($list as $arr=>$row) {
	        $v[$arr]['id']          = intval($row['id']);
	        $v[$arr]['name']        = $row['name'];
	    }
	    $json['status'] = 200;
	    $json['msg']    = 'success';
	    $json['data']['rows']       = isset($v) ? $v : array();
	    $json['data']['total']      = 1;
	    $json['data']['records']    = count($list);
	    $json['data']['page']       = 1;
	    die(json_encode($v));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */