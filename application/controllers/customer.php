<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Customer extends CI_Controller {


    public function index() {

        $data = $this->db->get('ci_customer')->result();

        $this->load->view('/settings/customer',['data'=>$data]);

    }

    public function add() {

        $data = str_enhtml($this->input->post(NULL,TRUE));
        $user = $this->session->userdata('jxcsys');
        $res = [];
        $org = $this->db->where('id',$user['orgId'])->get('ci_org')->result();

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
            'org_name'=>$org[0]->name,
        );

        $customer_res = $this->db->insert('ci_customer',$customer);
        $customer_id = $this->db->insert_id();
        if(!$customer_res){
            $res['code'] = 1;
            $res['text'] = "添加失败";
            die(json_encode($res));
        }
        if($data['car']){
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
        }
        $res['code'] = 0;
        $res['text'] = "添加成功";
        die(json_encode($res));
    }

    public function detail() {

        $id = $this->input->get('id');

        $data = $this->db->where('id',$id)->get('ci_customer')->row();

        $this->load->view('/settings/customer_detail',['data'=>$data,'id'=>$id]);

    }

    //更新用户数据
    public function people(){
        $data = str_enhtml($this->input->post(NULL,TRUE));
        $res = [];
        $ress = $this->db->update('ci_customer',array('name'=>$data['name'],'sex'=>$data['gender'],'birthday'=>$data['birthday'],'mobile'=>$data['tel'],'resource'=>$data['source'],'address'=>$data['address'],'company'=>$data['company'],'service'=>$data['adviser'],'time'=>$data['record']),array('id'=>$data['id']));
        if($ress){
            $res['code'] = 0;
            $res['text'] = "添加成功";
            die(json_encode($res));
        }else{
            $res['code'] = 1;
            $res['text'] = "添加失败";
            die(json_encode($res));
        }
    }

    //更新用户发票信息
    public function invoice(){
        $data = str_enhtml($this->input->post(NULL,TRUE));
        $res = [];
        $ress = $this->db->update('ci_customer',array('rise'=>$data['rise'],'location'=>$data['location'],'bank'=>$data['bank'],'distinguish'=>$data['distinguish'],'mobilephone'=>$data['mobile'],'number'=>$data['number'],'company'=>$data['company'],'service'=>$data['adviser'],'time'=>$data['record']),array('id'=>$data['id']));
        if($ress){
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
