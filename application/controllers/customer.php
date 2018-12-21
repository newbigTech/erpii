<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Customer extends CI_Controller {


    public function index() {
        $data =
        $this->load->view('/settings/customer');

    }

    public function add() {

        $data = str_enhtml($this->input->post(NULL,TRUE));
        $user = $this->session->userdata('jxcsys');
        $res = [];
        $customer = array(
            'name'=>$data['name'],
            'sex'=>$data['gender'],
            'birthday'=>$data['birthday'],
            'mobile'=>$data['tel'],
            'resource'=>$data['source'],
            'address'=>$data['address'],
            'company'=>$data['company'],
            'service'=>$data['adviser'],
            'time'=>$data['record'],
        );

        $customer_res = $this->db->insert('ci_customer',$customer);
        $customer_id = $this->db->insert_id();
        if(!$customer_res){
            $res['code'] = 1;
            $res['text'] = "添加失败";
            die(json_encode($res));
        }

        $str =  html_entity_decode($data['car']);
        $car = json_decode($str,true);//专业能力数组反序列化
        foreach ($car as $k=>$v){
            $singer = array(
                'user_id'=>$customer_id,
                'plateNo'=>$v['plateNo'],
                'brand'=>$v['brand'],
                'system'=>$v['system'],
                'hasCheck'=>$v['hasCheck'],
                'notCheck'=>$v['notCheck'],
                'buytime'=>$v['buytime'],
            );
            if(!$this->db->insert('ci_car',$singer)){
                $res['code'] = 1;
                $res['text'] = "添加失败";
            }
        }

        $res['code'] = 0;
        $res['text'] = "添加成功";
        die(json_encode($res));
    }
}