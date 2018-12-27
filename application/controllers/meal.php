<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Meal extends CI_Controller
{


//    套餐列表
    public function index()
    {
        $user = $this->session->userdata('jxcsys');

        if ($user['orgLevel'] == 3) {
            $array = array('lowId' => $user['orgId']);
        } elseif ($user['orgLevel'] == 2) {
            $array = array('midId' => $user['orgId']);
        } elseif ($user['orgLevel'] == 1) {
            $array = array('topId' => $user['orgId']);
        }
        $data = $this->db->where($array)->get('ci_meal')->result();
        $arr = '';

        foreach ($data as $k=>$v){

            foreach (json_decode($v->content) as $key=>$value){
                $arr .= $value->name.':'.$value->number.'次'.';    ';
            }
            $data[$k]->content = $arr;
            $arr = '';
        }

        $this->load->view('/settings/meal_list', ['data' => $data]);
    }

    //    套餐添加
    public function add()
    {
        $user = $this->session->userdata('jxcsys');

        if ($user['orgLevel'] == 3) {
            $array = array('lowId' => $user['orgId']);
        } elseif ($user['orgLevel'] == 2) {
            $array = array('midId' => $user['orgId']);
        } elseif ($user['orgLevel'] == 1) {
            $array = array('topId' => $user['orgId']);
        }
        $data = $this->db->where($array)->get('ci_service')->result();

        $this->load->view('/settings/meal_add', ['data' => $data]);
    }

    //    执行套餐添加
    public function doadd(){
        $res = [];
        $user = $this->session->userdata('jxcsys');
        $data = str_enhtml($this->input->post(NULL, TRUE));

        $add = array(
            'name'=>$data['name'],
            'price'=>$data['price'],
            'content'=>json_encode($data['data']),
              'topId'=>$user['topId'],
            'midId'=>$user['midId'],
            'lowId'=>$user['lowId'],
        );
        $meal_res = $this->db->insert('ci_meal',$add);
        if($meal_res){
            $res['code'] = 0;
            $res['text'] = "添加成功";
            die(json_encode($res));
        }else{
            $res['code'] = 1;
            $res['text'] = "添加失败";
            die(json_encode($res));
        }

    }
    //    套餐删除
    public function del()
    {
        $id = str_enhtml($this->input->post('id', TRUE));
        $ress = $this->db->where('id', $id)->delete('ci_meal');

        $res = [];

        if ($ress) {
            $res['code'] = 0;
            $res['text'] = "删除成功";
            die(json_encode($res));
        } else {
            $res['code'] = 1;
            $res['text'] = "删除失败";
            die(json_encode($res));
        }


    }

    //    套餐修改
    public function edit()
    {
        $user = $this->session->userdata('jxcsys');

        if ($user['orgLevel'] == 3) {
            $array = array('lowId' => $user['orgId']);
        } elseif ($user['orgLevel'] == 2) {
            $array = array('midId' => $user['orgId']);
        } elseif ($user['orgLevel'] == 1) {
            $array = array('topId' => $user['orgId']);
        }
        $data = $this->db->where($array)->get('ci_service')->result();

        $id = str_enhtml($this->input->get('id', TRUE));

        $edit = $this->db->where(['id'=>$id])->get('ci_meal')->row();

        $edit->content = json_decode($edit->content);

        $this->load->view('/settings/meal_add', ['edit' => $edit,'data'=>$data]);

    }

    //    執行套餐修改
    public function doedit()
    {

        $data = str_enhtml($this->input->post(NULL, TRUE));

        $edit = $this->db->update('ci_meal', array('name' => $data['name'], 'content' => json_encode($data['data']), 'price' => $data['price']), array('id' => $data['id']));

        if ($edit) {
            $res['code'] = 0;
            $res['text'] = "修改成功";
            die(json_encode($res));
        } else {
            $res['code'] = 1;
            $res['text'] = "修改失败";
            die(json_encode($res));
        }
    }
}