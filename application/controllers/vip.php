<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Vip extends CI_Controller {



//    VIP卡列表
    public function index(){
        $this->load->view('/settings/vip_card');
    }

    //    VIP卡添加页面
    public function add(){

        $user = $this->session->userdata('jxcsys');
        if ($user['orgLevel'] == 3) {
            $array = array('lowId' => $user['orgId']);
        } elseif ($user['orgLevel'] == 2) {
            $array = array('midId' => $user['orgId']);
        } elseif ($user['orgLevel'] == 1) {
            $array = array('topId' => $user['orgId']);
        }
        $meal = $this->db->where($array)->get('ci_meal')->result();
        $arr = '';

        foreach ($meal as $k=>$v){

            foreach (json_decode($v->content) as $key=>$value){
                $arr .= $value->name.':'.$value->number.'次'.';    ';
            }
            $meal[$k]->content = $arr;
            $arr = '';
        }
        $this->load->view('/settings/vip_card_add',['meal'=>$meal]);
    }
}