<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Serve extends CI_Controller {



//    VIP卡列表
    public function index(){
        $this->load->view('/settings/serve');
    }

    //    VIP卡添加
    public function add(){
        $data = str_enhtml($this->input->post(NULL,TRUE));
        if($data){
            $vip = array(
                'name'=>$data['name'],
                'price'=>$data['price'],
                'time'=>$data['time'],
                'number'=>$data['number'],
                'status'=>$data['status'],
                'orgid'=>$data['orgid'],
                'orgname'=>$data['orgname'],
                'maintain'=>$data['maintain'],
                'sheetMetal'=>$data['sheetMetal'],
                'sprayPaint'=>$data['sprayPaint'],
                'cosmetology'=>$data['cosmetology'],
                'carWash'=>$data['carWash'],
                'jixiu'=>$data['jixiu'],
                'machineRepair'=>$data['machineRepair'],
                'refit'=>$data['refit'],
                'tyre'=>$data['tyre'],
                'other'=>$data['other'],
                'consumable'=>$data['consumable'],
                'oil'=>$data['oil'],
                'paint'=>$data['paint'],
                'tool'=>$data['tool'],
                'other2'=>$data['other2'],
                'autoRepair'=>$data['autoRepair'],
                'science'=>$data['science'],
                'luntai'=>$data['luntai'],

            );
            $vip_res = $this->db->insert('ci_vipcard',$vip);
            if($vip_res){
                $res['code'] = 0;
                $res['res'] = "添加成功";
                die(json_encode($res));
            }else{
                $res['code'] = 1;
                $res['res'] = "添加失败";
                die(json_encode($res));
            }
        }
        $user = $this->session->userdata('jxcsys');
        $org = $this->db->where('parentId',$user['midId'])->get('ci_org')->result();
        $this->load->view('/settings/vip_card_add',['org'=>$org,'orgid'=>$user['midId'],'data'=>$data]);
    }
}