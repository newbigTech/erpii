<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Vip extends CI_Controller {



//    VIP卡列表
    public function index(){
        $user = $this->session->userdata('jxcsys');

        if ($user['orgLevel'] == 3){
            $where = "orgid =".$user['orgId']." OR orgid =".$user['midId'];
        }else if($user['orgLevel'] == 2){
            $where = "midId =".$user['midId'];
        }else if($user['orgLevel'] == 1){
            $where = "topId =".$user['topId'];
        }else if($user['orgLevel'] == 0){
            $where = "";
        }

        $data = $this->db->where($where)->get('ci_vipcard')->result();

        foreach ($data as $k=>$v){

            if ($v->time != 0 && $v->time<time() && $v->status == 0){
                $this->db->update('ci_vipcard',array('status'=>2),array('id'=>$v->id));
                $data[$k]->status = 2 ;
            }
        }
        $this->load->view('/settings/vip_card',['data'=>$data]);
    }

    //    VIP卡添加页面
    public function add(){

        $user = $this->session->userdata('jxcsys');

        $org = $this->db->where('parentId',$user['midId'])->get('ci_org')->result();

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

        $this->load->view('/settings/vip_card_add',['meal'=>$meal,'org'=>$org,'orgid'=>$user['midId']]);
    }

    //    执行VIP卡添加页面
    public function doadd(){
        $data = str_enhtml($this->input->post(NULL,TRUE));
        $user = $this->session->userdata('jxcsys');
        $total = [];
        $t = 0 ;
        foreach ($data['data'] as $k=>$v){
           $meal = $this->db->where('id',$v['id'])->get('ci_meal')->row();
            $total[$t] = $meal->content;
            $t++;
        }
        if($data['time'] == 0){
            $time = 0;
        }else{
            $time = strtotime("+".$data['time']." months",time());
        }
        $add =array(
            'name'=>$data['name'],
            'price'=>$data['price'],
            'time'=> $time,
            'number'=>$data['number'],
            'status'=>$data['status'],
            'orgid'=>$data['orgid'],
            'orgname'=>$data['orgname'],
            'username' =>$data['username'],
            'phone' =>$data['phone'],
            'content'=>json_encode($total),
            'topId'=>$user['topId'],
            'midId'=>$user['midId'],
            'lowId'=>$user['lowId'],
        );
        $vipcard_res = $this->db->insert('ci_vipcard',$add);
        if($vipcard_res){
            $res['code'] = 0;
            $res['text'] = "添加成功";
            die(json_encode($res));
        }else{
            $res['code'] = 1;
            $res['text'] = "添加失败";
            die(json_encode($res));
        }

    }
}