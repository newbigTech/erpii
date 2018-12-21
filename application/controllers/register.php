<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Register extends CI_Controller {


    public function index() {

        $res =[];
        $data = str_enhtml($this->input->post(NULL,TRUE));

        $phone = $this->db->where('mobile',$data['phone'])->get('ci_admin')->result();

        if($phone){
            $res['code'] = 1;
            $res['res'] = "手机号已存在";
            die(json_encode($res));
        }
         if($data['code'] != $data['recode']){
             $res['code'] = 1;
             $res['res'] = "验证码错误";
             die(json_encode($res));
         }
        $org = array(
            'name'=>$data['organization'],
            'parentId' => 1,
            'level' => 2,

        );
        $bool_org = $this->db->insert('ci_org',$org);
        if(!$bool_org){
            $res['code'] = 1;
            $res['res'] = "注册失败";
            die(json_encode($res));
        }
        $id = $this->db->insert_id();
        $bool_org2 = $this->db->update('ci_org',array('path'=>'1,'.$id),array('id'=>$id));
        if(!$bool_org2){
            $res['code'] = 1;
            $res['res'] = "注册失败";
            die(json_encode($res));
        }
        $admin = array(
            'username'=>$data['username'],
            'userpwd'=>md5($data['userpwd']),
            'status'=>0,
            'name'=>$data['truename'],
            'mobile'=>$data['phone'],
            'lever'=>"1,2,203,204,205,3,4,5,85,86,87,106,107,108,109,110,111,11,12,13,99,112,113,114,115,116,117,124,125,126,127,128,198,199,129,130,131,132,133,200,201,134,135,136,137,138,139,140,141,142,143,14,100,101,102,15,16,17,144,145,146,147,148,179,196,197,149,151,152,153,154,155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,18,103,104,105,19,20,21,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,202,22,23,24,25,26,27,28,29,30,301,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,91,92,6,10,7,8,88,89,9,90,63,64,65,66,67,93,94,68,69,70,71,72,95,96,73,74,75,76,77,78,79,80,81,82,83,84,97,118,119,120,98,121,122,123",
            'roleid'=> 1,
            'topId'=> -1,
            'midId'=> -1,
            'lowId'=> -1,
            'orgId'=> $id,

        );

        $bool_admin = $this->db->insert('ci_admin',$admin);

        if($bool_admin){
            $res['code'] = 0;
            $res['res'] = "注册成功，已提交审核";
            die(json_encode($res));
        }else{
            $res['code'] = 1;
            $res['res'] = "注册失败";
            die(json_encode($res));
        }


    }

    public function forget(){
        $res =[];
        $data = str_enhtml($this->input->post(NULL,TRUE));
        if($data['code'] != $data['recode']){
            $res['code'] = 1;
            $res['res'] = "验证码错误";
            die(json_encode($res));
        }
        $ress = $this->db->update('ci_admin',array('userpwd'=>md5($data['userpwd'])),array('mobile'=>$data['phone']));
        if($ress){
            $res['code'] = 0;
            $res['res'] = "修改成功";
            die(json_encode($res));
        }else{
            $res['code'] = 1;
            $res['res'] = "修改失败";
            die(json_encode($res));
        }
    }

    public function send(){
        // 配置参数
        $mobile = str_enhtml($this->input->post('number',TRUE));

        $this->accessKeyId = 'LTAI0vdmiiI2LzjU';

        $this->accessKeySecret = '6namSsmxkZqyGPxkMfEksVJqJpxBEo';

        $this->signName = '海客购物商城';

        $this->templateCode = 'SMS_139415291';

        $code = rand ( 1000, 9999 );

        //发送短信

        $status = $this->send_verify($mobile, $code);

        $res = [];
        if ($status['Code'] == "OK") {
            $res['code'] = $code ;
            $res['result'] = "发送成功" ;
            die(json_encode($res));

        }else{
            $res['code'] = 1 ;
            $res['result'] = "发送失败," .$status['Message'];
            die(json_encode($res));
        }

    }


    private function percentEncode($string) {

        $string = urlencode ( $string );

        $string = preg_replace ( '/\+/', '%20', $string );

        $string = preg_replace ( '/\*/', '%2A', $string );

        $string = preg_replace ( '/%7E/', '~', $string );

        return $string;

    }

    /**

     * 签名

     *

     * @param unknown $parameters

     * @param unknown $accessKeySecret

     * @return string

     */

    private function computeSignature($parameters, $accessKeySecret) {

        ksort ( $parameters );

        $canonicalizedQueryString = '';

        foreach ( $parameters as $key => $value ) {

            $canonicalizedQueryString .= '&' . $this->percentEncode ( $key ) . '=' . $this->percentEncode ( $value );

        }

        $stringToSign = 'GET&%2F&' . $this->percentencode ( substr ( $canonicalizedQueryString, 1 ) );

        $signature = base64_encode ( hash_hmac ( 'sha1', $stringToSign, $accessKeySecret . '&', true ) );

        return $signature;

    }

    /**

     * @param unknown $mobile

     * @param unknown $verify_code

     *

     */

    public function send_verify($mobile, $verify_code) {

        $params = array (   //此处作了修改

            'SignName' => $this->signName,

            'Format' => 'JSON',

            'Version' => '2017-05-25',

            'AccessKeyId' => $this->accessKeyId,

            'SignatureVersion' => '1.0',

            'SignatureMethod' => 'HMAC-SHA1',

            'SignatureNonce' => uniqid (),

            'Timestamp' => gmdate ( 'Y-m-d\TH:i:s\Z' ),

            'Action' => 'SendSms',

            'TemplateCode' => $this->templateCode,

            'PhoneNumbers' => $mobile,

            'TemplateParam' => '{"code":"' . $verify_code . '"}'

//            'TemplateParam' => '{"time":"1234"}'   //更换为自己的实际模版

        );



        // 计算签名并把签名结果加入请求参数

        $params ['Signature'] = $this->computeSignature ( $params, $this->accessKeySecret );

        // 发送请求（此处作了修改）

        //$url = 'https://sms.aliyuncs.com/?' . http_build_query ( $params );

        $url = 'http://dysmsapi.aliyuncs.com/?' . http_build_query ( $params );



        $ch = curl_init ();

        curl_setopt ( $ch, CURLOPT_URL, $url );

        curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );

        curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );

        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );

        curl_setopt ( $ch, CURLOPT_TIMEOUT, 10 );

        $result = curl_exec ( $ch );

        curl_close ( $ch );

        $result = json_decode ( $result, true );

        return $result;


    }

    /**

     * 获取详细错误信息

     *

     * @param unknown $status

     */

    public function getErrorMessage($status) {

        // 阿里云的短信 乱八七糟的(其实是用的阿里大于)

        // https://api.alidayu.com/doc2/apiDetail?spm=a3142.7629140.1.19.SmdYoA&apiId=25450

        $message = array (

            'InvalidDayuStatus.Malformed' => '账户短信开通状态不正确',

            'InvalidSignName.Malformed' => '短信签名不正确或签名状态不正确',

            'InvalidTemplateCode.MalFormed' => '短信模板Code不正确或者模板状态不正确',

            'InvalidRecNum.Malformed' => '目标手机号不正确，单次发送数量不能超过100',

            'InvalidParamString.MalFormed' => '短信模板中变量不是json格式',

            'InvalidParamStringTemplate.Malformed' => '短信模板中变量与模板内容不匹配',

            'InvalidSendSms' => '触发业务流控',

            'InvalidDayu.Malformed' => '变量不能是url，可以将变量固化在模板中'

        );

        if (isset ( $message [$status] )) {

            return $message [$status];

        }

        return $status;

    }

}