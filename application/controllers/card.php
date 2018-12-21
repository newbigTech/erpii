<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Card extends CI_Controller {


    //储值卡列表
    public function index() {
        $user = $this->session->userdata('jxcsys');

        $org = $this->db->where('parentId',$user['midId'])->get('ci_org')->result();
        $data = $this->db->get('ci_storedcard')->result();

        $this->load->view('/settings/stored_value_card',['org'=>$org,'orgid'=>$user['midId'],'data'=>$data]);
    }

    //添加储值卡
    public function add() {
        $data = str_enhtml($this->input->post(NULL,TRUE));

        $res = [];
//        if($data['sale'] == '13'){
////            $sale = 0;
////        }else{
////            $sale = strtotime("+".$data['sale']." months",time());
////        }

        $card = array(
            'car_num'=>$data['car_num'],
            'car_name'=>$data['car_name'],
            'sale'=>$data['sale'],
            'validity'=>$data['validity'],
            'present'=>$data['present'],
            'status'=>$data['status'],
            'hour_discount'=>$data['hour_discount'],
            'parts_discount'=>$data['parts_discount'],
            'addtime'=>time(),
            'orgid'=> $data['orgid'],
            'orgname'=>$data['orgname'],
        );
        $card_res = $this->db->insert('ci_storedcard',$card);
        if($card_res){
            $res['code'] = 0;
            $res['text'] = "添加成功";
            die(json_encode($res));
        }else{
            $res['code'] = 1;
            $res['text'] = "添加失败";
            die(json_encode($res));
        }
    }

    //修改储值卡
    public function edit() {


    }

    //删除储值卡
    public function del() {


    }
}