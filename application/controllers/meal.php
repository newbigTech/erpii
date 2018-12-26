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

    }
    //    套餐删除
    public function del()
    {
        $id = str_enhtml($this->input->post('id', TRUE));
        $one = $this->db->where(['parentId' => $id])->get('ci_serve')->result();
        $res = [];

        if ($one) {
            $res['code'] = 1;
            $res['text'] = "请先删除该类目下的子目录！";
            die(json_encode($res));
        } else {
            $ress = $this->db->where('id', $id)->delete('ci_serve');
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

    }

    //    套餐修改
    public function edit()
    {

        $data = str_enhtml($this->input->post(NULL, TRUE));
        if ($data['parentId'] == 0) {
            $edit = $this->db->update('ci_serve', array('name' => $data['name'], 'parentId' => 0, 'level' => 1, 'path' => $data['id']), array('id' => $data['id']));
        } else {
            $parent = $this->db->where(['id' => $data['parentId']])->get('ci_serve')->row();

            $edit = $this->db->update('ci_serve', array('name' => $data['name'], 'parentId' => $data['parentId'], 'level' => $parent->level + 1, 'path' => $parent->path . "," . $data['id']), array('id' => $data['id']));
        }

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