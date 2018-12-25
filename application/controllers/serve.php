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
        $parent = $this->db->where(['parentId'=>$data['parentId']])->get('ci_serve')->row();
        $user = $this->session->userdata('jxcsys');

        $add = array(
            'name'=>$data['name'],
            'parentId'=>$data['parentId'],
            'path'=>$parent['path'].",".$data['id'],
            'level'=>$parent['level']+1,
            'status'=>0,
            'topId'=>$user['topId'],
            'midId'=>$user['midId'],
            'lowId'=>$user['lowId'],
        );
        $serve_res = $this->db->insert('ci_serve',$add);
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
    //    服务分类删除
    public function del(){
        $id = str_enhtml($this->input->post('id',TRUE));
        $res = $this->db->where('id', $id)->delete('ci_serve');
        die(json_encode($res));
    }

    //    服务分类修改
    public function edit(){

        $data = str_enhtml($this->input->post(NULL,TRUE));
        $parent = $this->db->where(['id'=>$data['parentId']])->get('ci_serve')->row();
        die(json_encode($parent));
        $edit = $this->db->update('ci_serve',array('name'=>$data['name'],'parentId'=>$data['parentId'],'level'=>$parent->level+1,'path'=>$parent->path.",".$data['id']),array('id'=>$data['id']));

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
}