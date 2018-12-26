<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Serve extends CI_Controller {



//    服务分类列表
    public function index(){
        $data = [];
        $t = 0;
        $user = $this->session->userdata('jxcsys');

        if($user['orgLevel'] == 3){
            $array = array('level' => 1, 'lowId' =>$user['orgId']);
        }elseif ($user['orgLevel'] == 2){
            $array = array('level' => 1, 'midId' =>$user['orgId']);
        }elseif ($user['orgLevel'] == 1){
            $array = array('level' => 1, 'topId' =>$user['orgId']);
        }
        $one = $this->db->where($array)->get('ci_serve')->result();

        foreach ($one as $k=>$v){
            $data[$t]['id']= $v->id;
            $data[$t]['name']= $v->name;
            $two = $this->db->where(['parentId'=>$v->id])->get('ci_serve')->result();
            $m = 0;
            foreach ($two as $key => $value){
                $data[$t]['child'][$m]['id']= $value->id;
                $data[$t]['child'][$m]['name']= $value->name;
                $three = $this->db->where(['parentId'=>$value->id])->get('ci_serve')->result();
                $n = 0;
                foreach ($three as $a=>$b){
                    $data[$t]['child'][$m]['child'][$n]['id']= $b->id;
                    $data[$t]['child'][$m]['child'][$n]['name']= $b->name;
                    $n ++;
                }
                $m ++;
            }
            $t ++;

        }

        $this->load->view('/settings/serve',['data'=>$data]);
    }

    //    服务分类添加
    public function add(){
        $data = str_enhtml($this->input->post(NULL,TRUE));
        $user = $this->session->userdata('jxcsys');
        if($data['parentId'] == 0){
            $add = array(
                'name'=>$data['name'],
                'parentId'=>0,
                'level'=>1,
                'status'=>0,
                'topId'=>$user['topId'],
                'midId'=>$user['midId'],
                'lowId'=>$user['lowId'],
            );
        }else{
            $parent = $this->db->where(['id'=>$data['parentId']])->get('ci_serve')->row();

            $add = array(
                'name'=>$data['name'],
                'parentId'=>$data['parentId'],
                'level'=>$parent->level+1,
                'path'=>$parent->path,
                'status'=>0,
                'topId'=>$user['topId'],
                'midId'=>$user['midId'],
                'lowId'=>$user['lowId'],
            );
        }

        $serve_res = $this->db->insert('ci_serve',$add);
        $id = $this->db->insert_id();
        if($data['parentId'] == 0){
            $updata = $this->db->update('ci_serve',array('path'=>$id),array('id'=>$id));
        }else{
            $one =  $this->db->where(['id'=>$data['parentId']])->get('ci_serve')->row();
            $updata = $this->db->update('ci_serve',array('path'=>$one->path.",".$id),array('id'=>$id));
        }

        if($serve_res && $updata){
            $res['code'] = 0;
            $res['text'] = "添加成功";
            die(json_encode($res));
        }else{
            $res['code'] = 1;
            $res['text'] = "添加失败";
            die(json_encode($res));
        }
    }
    //    服务分类删除
    public function del(){
        $id = str_enhtml($this->input->post('id',TRUE));
        $one =  $this->db->where(['parentId'=>$id])->get('ci_serve')->result();
        $res = [];

        if($one){
            $res['code'] = 1;
            $res['text'] = "请先删除该类目下的子目录！";
            die(json_encode($res));
        }else{
            $ress = $this->db->where('id', $id)->delete('ci_serve');
            if($ress){
                $res['code'] = 0;
                $res['text'] = "删除成功";
                die(json_encode($res));
            }else{
                $res['code'] = 1;
                $res['text'] = "删除失败";
                die(json_encode($res));
            }
        }

    }

    //    服务分类修改
    public function edit(){

        $data = str_enhtml($this->input->post(NULL,TRUE));
        if($data['parentId'] == 0){
            $edit = $this->db->update('ci_serve',array('name'=>$data['name'],'parentId'=>0,'level'=>1,'path'=>$data['id']),array('id'=>$data['id']));
        }else{
            $parent = $this->db->where(['id'=>$data['parentId']])->get('ci_serve')->row();

            $edit = $this->db->update('ci_serve',array('name'=>$data['name'],'parentId'=>$data['parentId'],'level'=>$parent->level+1,'path'=>$parent->path.",".$data['id']),array('id'=>$data['id']));
        }

        if($edit){
            $res['code'] = 0;
            $res['text'] = "修改成功";
            die(json_encode($res));
        }else{
            $res['code'] = 1;
            $res['text'] = "修改失败";
            die(json_encode($res));
        }
    }

//    服务内容列表
    public function servicelist(){


        $data = [];
        $t = 0;
        $user = $this->session->userdata('jxcsys');

        if($user['orgLevel'] == 3){
            $array = array('level' => 1, 'lowId' =>$user['orgId']);
        }elseif ($user['orgLevel'] == 2){
            $array = array('level' => 1, 'midId' =>$user['orgId']);
        }elseif ($user['orgLevel'] == 1){
            $array = array('level' => 1, 'topId' =>$user['orgId']);
        }
        $one = $this->db->where($array)->get('ci_serve')->result();

        foreach ($one as $k=>$v){
            $data[$t]['id']= $v->id;
            $data[$t]['name']= $v->name;
            $two = $this->db->where(['parentId'=>$v->id])->get('ci_serve')->result();
            $m = 0;
            foreach ($two as $key => $value){
                $data[$t]['child'][$m]['id']= $value->id;
                $data[$t]['child'][$m]['name']= $value->name;
                $three = $this->db->where(['parentId'=>$value->id])->get('ci_serve')->result();
                $n = 0;
                foreach ($three as $a=>$b){
                    $data[$t]['child'][$m]['child'][$n]['id']= $b->id;
                    $data[$t]['child'][$m]['child'][$n]['name']= $b->name;
                    $n ++;
                }
                $m ++;
            }
            $t ++;

        }

        if($user['orgLevel'] == 3){
            $array = array('lowId' =>$user['orgId']);
        }elseif ($user['orgLevel'] == 2){
            $array = array('midId' =>$user['orgId']);
        }elseif ($user['orgLevel'] == 1){
            $array = array('topId' =>$user['orgId']);
        }
        $service = $this->db->where($array)->get('ci_service')->result();

        $this->load->view('/settings/serve_list',['data'=>$data,'service'=>$service]);

    }

//    服务内容添加
    public function serviceadd(){
        $data = str_enhtml($this->input->post(NULL,TRUE));

        $user = $this->session->userdata('jxcsys');
        $add = array(
            'name'=>$data['name'],
            'working'=>$data['working'],
            'price'=>$data['price'],
            'vip_price'=>$data['vip_price'],
            'category_id'=>$data['category_id'],
            'category_name'=>  trim(html_entity_decode($data['category_name']),chr(0xc2).chr(0xa0)),
             'topId'=>$user['topId'],
            'midId'=>$user['midId'],
            'lowId'=>$user['lowId'],
        );
        $serve_res = $this->db->insert('ci_service',$add);
        if($serve_res){
            $res['code'] = 0;
            $res['text'] = "添加成功";
            die(json_encode($res));
        }else{
            $res['code'] = 1;
            $res['text'] = "添加失败";
            die(json_encode($res));
        }
    }

//    服务内容修改
    public function serviceedit(){
        $data = str_enhtml($this->input->post(NULL,TRUE));

        $edit = $this->db->update('ci_service',array('name'=>$data['name'],'working'=>$data['working'],'price'=>$data['price'],'vip_price'=>$data['vip_price'],'category_id'=>$data['category_id'],'category_name'=>$data['category_name']),array('id'=>$data['id']));
        if($edit){
            $res['code'] = 0;
            $res['text'] = "修改成功";
            die(json_encode($res));
        }else{
            $res['code'] = 1;
            $res['text'] = "修改失败";
            die(json_encode($res));
        }
    }

//    服务内容删除
    public function servicedel(){
        $id = str_enhtml($this->input->post('id',TRUE));
        $ress = $this->db->where('id', $id)->delete('ci_service');
        if($ress){
            $res['code'] = 0;
            $res['text'] = "删除成功";
            die(json_encode($res));
        }else{
            $res['code'] = 1;
            $res['text'] = "删除失败";
            die(json_encode($res));
        }
    }
}