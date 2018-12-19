<?php if(!defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>进销存</title>
    <meta charset="utf-8">
    <meta name="globalsign-domain-verification" content="wnLJy1jTEsQbKd3ZepUI9lK4R1lnQif9O4mKSlu1rX" />
    <meta name="viewport" content='width=device-width,initial-scale=0.4; maximum-scale=3.0;minimum-scale:0.5;user-scalable=yes;'  />
    <link href="<?php echo base_url()?>statics/login/<?php echo sys_skin()?>/Css/common.css?2" rel="stylesheet" />
    <link href="<?php echo base_url()?>statics/login/<?php echo sys_skin()?>/Css/global.css?2" rel="stylesheet" />
    <link rel="shortcut icon" href="<?php echo base_url()?>statics/login/<?php echo sys_skin()?>/Images/bitbug_favicon.ico" type="image/x-icon"/>
    <link rel="apple-touch-icon" href="<?php echo base_url()?>statics/login/<?php echo sys_skin()?>/Images/WebIcon/apple-touch-icon-57.png" />
    <link rel="apple-touch-icon" sizes="72x72"  href="<?php echo base_url()?>statics/login/<?php echo sys_skin()?>/Images/WebIcon/apple-touch-icon-72.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url()?>statics/login/<?php echo sys_skin()?>/Images/WebIcon/apple-touch-icon-114.png"  />
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url()?>statics/login/<?php echo sys_skin()?>/Images/WebIcon/apple-touch-icon-144.png"  />
    <script src="<?php echo base_url()?>statics/login/<?php echo sys_skin()?>/Scripts/minijs/jquery-1.7.1.js"></script>
    <script src="<?php echo base_url()?>statics/login/<?php echo sys_skin()?>/Scripts/minijs/common.js"></script>
    <script src="<?php echo base_url()?>statics/login/<?php echo sys_skin()?>/Scripts/minijs/minicheck.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<style>
    @font-face {
        font-family: 'iconfont';
        src: url('<?php echo base_url()?>statics/css/font/iconfont.eot');
        src: url('<?php echo base_url()?>statics/css/font/iconfont.eot?#iefix') format('embedded-opentype'),
        url('<?php echo base_url()?>statics/css/font/iconfont.woff') format('woff'),
        url('<?php echo base_url()?>statics/css/font/iconfont.ttf') format('truetype'),
        url('<?php echo base_url()?>statics/css/font/iconfont.svg#iconfont') format('svg');
    }
    .iconfont{
        font-family:"iconfont" !important;
        font-size:16px;font-style:normal;
        -webkit-font-smoothing: antialiased;
        -webkit-text-stroke-width: 0.2px;
        -moz-osx-font-smoothing: grayscale;
    }
    body{
        background-color: rgb(4,135,251);
    }
    .clearfix::before,
    .clearfix::after{
        content:'';
        display: block;
        line-height: 0;
        height: 0;
        visibility: hidden;
        clear: both;
    }
    .LoginName{
        height: 224px;
        line-height: 370px;
        text-align: center;
        font-size: 50px;
        color: white;
        margin-bottom: 10%;
    }
    .LoginForm{
        background-color: rgba(255,255,255,0.1);
        border-radius: 3%;
        height: 170px;
        padding: 40px;
    }
    .LoginInput div{
        width: 80%;
        margin: 0 auto;
        height: 35px;
        border-radius: 5px;
        background-color: #fff;
        margin-bottom: 20px;
    }
    .LoginInput div i{
        display: inline-block;
        width: 50px;
        text-align: center;
        color: rgb(14,121,251);
    }
    .LoginInput div input{
        line-height: 35px;
    }
    .LoginForm .LoginBotton{
        width: 100%;
        margin-top: -8%;
        position: relative;
    }
    .LoginForm button{
        width: 80%;
        height: 35px;
        text-align: center;
        background-color: rgb(9,105,212);
        color: white;
        font-size: 17px;
        position: absolute;
        left: 9%;
        border-radius: 5px;
    }
    .LoginForm .LoginWorn{
        width: 80%;
        height: 20px;
        margin: 0 auto;
        margin-top: -6%;
    }
    .LoginForm .LoginUrl{
        color: #fff;
        width: 80%;
        margin: 0 auto;
        padding-bottom: 12px;
    }
    .LoginForm .LoginUrl a{
        color: #fff;
        float: left;
    }
    .LoginForm .LoginUrl a:last-child{
        float: right;
    }
    .LoginForm .RegisterUrl{
        color: #fff;
        width: 80%;
        margin: 0 auto;
        padding-bottom: 12px;
    }
    .LoginForm .RegisterUrl a{
        color: #fff;
        float: left;
    }
    .LoginForm .RegisterUrl a:last-child{
        float: right;
    }
    .LoginForm .ForgotUrl{
        color: #fff;
        width: 80%;
        margin: 0 auto;
        padding-bottom: 12px;
    }
    .LoginForm .ForgotUrl a{
        color: #fff;
        float: left;
    }
    .LoginForm .ForgotUrl a:last-child{
        float: right;
    }
    .get{

    }
    /*.phone2, .phone1{*/
        /*width: 60%;*/
        /*float: left;*/
    /*}*/
</style>
<body id="body">

<div class="connext">
<!--登录-->

        <div class="LoginBox" id="login">
            <div class="LoginName">ERP管理系统</div>
            <div class="LoginForm">
                <div class="LoginInput">
                    <div class="username">
                        <i class="iconfont">&#xe6b6;</i>
                        <input type="text" id="username" value="<?php //echo get_cookie('username')?>" placeholder="用户名">
                    </div>
                    <div class="password">
                        <i class="iconfont">&#xe65b;</i>
                        <input type="password" id="password" value="<?php //echo get_cookie('userpwd')?>" placeholder="密码">
                    </div>
                </div>
                <div class="LoginWorn">
                    <div style="color:red; font-size:15px;line-height:20px; display:none;" id="loginerror"></div>
                </div>
                <div class="LoginUrl clearfix">
                    <a href="javascript:void(0);" onclick="switchs('pwd')">忘记密码</a>
                    <a href="javascript:void(0);" onclick="switchs('re')">注册</a>
                </div>
                <div class="LoginBotton">
                    <button class="LoginBtn" onClick="Login()" />登录</button>
                </div>
            </div>
        </div>

<!--注册-->

        <div class="LoginBox" id="register" style="display: none">
            <div class="LoginName">ERP管理系统</div>
            <div class="LoginForm" style="height: 450px;position: relative">
                <div class="LoginInput">
                    <div class="username">
                        <i class="iconfont">&#xe6b6;</i>
                        <input type="text" id="username1" value="" placeholder="用户名">
                    </div>
                    <div class="username">
                        <i class="iconfont">&#xe6b6;</i>
                        <input type="text" id="truename" value="" placeholder="真实姓名">
                    </div>
                    <div class="username">
                        <i class="iconfont">&#xe6b6;</i>
                        <input type="text" id="organization" value="" placeholder="机构名称">
                    </div>
                    <div class="password">
                        <i class="iconfont">&#xe65b;</i>
                        <input type="password" id="password1" value="" placeholder="密码">
                    </div>
                    <div class="repassword">
                        <i class="iconfont">&#xe603;</i>
                        <input type="password" id="repassword1" value="" placeholder="确认密码">
                    </div>
                    <div class="phone1">
                        <i class="iconfont">&#xe65d;</i>
                        <input type="text" id="phone1" value="" placeholder="手机号">
                    </div>
                    <div class="code1">
                        <i class="iconfont">&#xe60d;</i>
                        <input type="password" id="code1" value="" placeholder="验证码">
                        <a href="javasript:void(0);" class="get" id="get1"  onclick="sendtel('register')">获取</a>
                    </div>
                </div>
                <div class="LoginWorn">
                    <div style="color:red; font-size:15px;line-height:20px; display:none;" id="registererror"></div>
                </div>
                <div class="RegisterUrl clearfix">
                    <a href="javascript:void(0);" onclick="switchs('pwd')">忘记密码</a>
                    <a href="javascript:void(0);" onclick="switchs('lo')">登录</a>
                </div>
                <div class="LoginBotton">
                    <button class="LoginBtn" onClick="registed()" />注册</button>
                </div>
            </div>
        </div>
        <input type="text" hidden id="recode" value="7685">
<!--忘记密码-->

        <div class="LoginBox" id="forgotpwd" style="display: none">
            <div class="LoginName">ERP管理系统</div>
            <div class="LoginForm" style="height: 280px;">
                <div class="LoginInput">
<!--                    <div class="username">-->
<!--                        <i class="iconfont">&#xe6b6;</i>-->
<!--                        <input type="text" id="username2" value="" placeholder="用户名">-->
<!--                    </div>-->

                    <div class="phone2">
                        <i class="iconfont">&#xe65d;</i>
                        <input type="text" id="phone2" value="" placeholder="手机号">
<!--                        <div type="button" class="get" id="get2" style="width: 18%;float: right" onclick="sendtel('forgot')">获取验证码</div>-->
                    </div>
                    <div class="code2">
                        <i class="iconfont">&#xe60d;</i>
                        <input type="text" id="code2" value="" placeholder="验证码">
                        <a href="javasript:void(0);" class="get" id="get2"  onclick="sendtel('forgot')" disabled="disabled">获取</a>
                    </div>
                    <div class="password">
                        <i class="iconfont">&#xe65b;</i>
                        <input type="password" id="password2" value="" placeholder="密码">
                    </div>
                    <div class="repassword">
                        <i class="iconfont">&#xe603;</i>
                        <input type="password" id="repassword2" value="" placeholder="确认密码">
                    </div>
                </div>

                <div class="LoginWorn">
                    <div style="color:red; font-size:15px;line-height:20px; display:none;" id="forgoterror"></div>
                </div>
                <div class="ForgotUrl clearfix">
                    <a href="javascript:void(0);" onclick="switchs('lo')">登录</a>
                    <a href="javascript:void(0);" onclick="switchs('re')">注册</a>
                </div>
                <div class="LoginBotton">
                    <button class="LoginBtn" onClick="forgotpwd()" />提交</button>
                </div>
            </div>
        </div>

</div>

<script type="text/javascript">
    //加载公用的js最后面
    $(window).load(function(){
        $('.loading').hide();
    });
    // 切换界面
    function switchs(t) {
        if (t == 'pwd'){
            $('#forgotpwd').css('display','');
            $('#register').css('display','none');
            $('#login').css('display','none');
        } else if (t == 're'){
            $('#forgotpwd').css('display','none');
            $('#register').css('display','');
            $('#login').css('display','none');
        } else{
            $('#forgotpwd').css('display','none');
            $('#register').css('display','none');
            $('#login').css('display','');
        }
    }
    // 登录
    function Login() {
        var cookieEnabled = (navigator.cookieEnabled) ? true : false;
        if (!cookieEnabled) {
            alert("该浏览器Cookie设置不正确，无法正常登录");
            return false;
        }
        var username = $.trim($("#username").val());
        var password = $.trim($("#password").val());
        var isRemmenbPassWord = $("#Checked").attr("val"); // 1为记住密码  0 未记住密码
        if (checkNullOrEmpty(username)) {
            $("#loginerror").text("请输入账号").show();
            $("#username").focus();
            return false;
        }
        if (checkNullOrEmpty(password)) {
            $("#loginerror").text("请输入密码").show();
            $("#password").focus();
            return false;
        }
        $('.loading').show();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('login');?>",
            data: {
                username: username,
                userpwd: password,
                token: "<?php echo token()?>",
                ispwd:isRemmenbPassWord
            },
            //dataType: "json",
            success: function (data) {
                console.log(data);
                //if (!data) {
//                    $("#loginerror").text("有未知错误发生").show();
//                    $('.loading').hide();
//                    return false;
//                }
//                if (!data.Success) {
//                    $("#loginerror").text(data.ResultMessage).show();
//                    $("#username").val('');
//                    $("#password").val('');
//                    $("#username").focus();
//                    $('.loading').hide();
//                    return false;
//                }
                if (data==1) {
                    $('.loading').hide();
                    location.href = "<?php echo site_url('home/index')?>";
                } else {
                    $("#loginerror").text(data).show();
                    $('.loading').hide();

                }

                //$('.loading').hide();
                //location.href = "<?php //echo site_url('home/index')?>//";
                return false;
            },
            timeout: 60000,
            error: function (xhr, status) {
                if (status == "timeout") {
                    $("#loginerror").text("您的网络好像很糟糕，请刷新页面重试").show();
                    $('.loading').hide();
                    return false;
                }
                else {
                    $("#loginerror").text("服务器内部错误，请重试").show();
                    $('.loading').hide();
                    return false;
                }
            }
        });
        return false;
    }
    // 注册
    function registed(){
        var username    = $.trim($("#username1").val());
        var truename    = $.trim($("#truename").val());
        var password    = $.trim($("#password1").val());
        var repassword  = $.trim($("#repassword1").val());
        var phone       = $.trim($("#phone1").val());
        var code        = $.trim($("#code1").val());
        var recode        = $.trim($("#recode").val());
        var organization = $.trim($("#organization").val());
        if (checkNullOrEmpty(username)) {
            $("#registererror").text("请输入账号").show();
            return false;
        }
        if (checkNullOrEmpty(truename)) {
            $("#registererror").text("请输入真实姓名").show();
            return false;
        }
        if (checkNullOrEmpty(organization)) {
            $("#registererror").text("请输入机构名称").show();
            return false;
        }
        if (checkNullOrEmpty(password)) {
            $("#registererror").text("请输入密码").show();
            return false;
        }
        if (checkNullOrEmpty(repassword)) {
            $("#registererror").text("请输入确认密码").show();
            return false;
        }
        if (checkNullOrEmpty(phone)) {
            $("#registererror").text("请输入手机号").show();
            return false;
        }
        if (checkNullOrEmpty(code)) {
            $("#registererror").text("请输入验证码").show();
            return false;
        }
        if (password != repassword) {
            $("#registererror").text("两次密码不同").show();
            return false;
        }

        $('.loading').show();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('register');?>",
            data: {
                username: username,
                userpwd: password,
                repassword:repassword,
                phone:phone,
                code:code,
                truename:truename,
                recode:recode,
                organization:organization,
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                if(data.code == 1){
                    $("#registererror").text(data.res).show();
                    $('.loading').hide();
                }else if (data.code == 0){
                    $('.loading').hide();
                    alert(data.res);
                    location.href = "<?php echo site_url('login')?>";
                }else{
                    $("#registererror").text("未知错误").show();
                    $('.loading').hide();
                }

                return false;
            },
            timeout: 60000,
            error: function (xhr, status) {
                if (status == "timeout") {
                    $("#registererror").text("您的网络好像很糟糕，请刷新页面重试").show();
                    $('.loading').hide();
                    return false;
                }
                else {
                    $("#registererror").text("服务器内部错误，请重试").show();
                    $('.loading').hide();
                    return false;
                }
            }
        });
    }
    // 忘记密码
    function forgotpwd(){

        var password    = $.trim($("#password2").val());
        var repassword  = $.trim($("#repassword2").val());
        var phone       = $.trim($("#phone2").val());
        var code        = $.trim($("#code2").val());
        var recode        = $.trim($("#recode").val());

        if (checkNullOrEmpty(password)) {
            $("#forgoterror").text("请输入密码").show();
            return false;
        }
        if (checkNullOrEmpty(repassword)) {
            $("#forgoterror").text("请输入确认密码").show();
            return false;
        }
        if (checkNullOrEmpty(phone)) {
            $("#forgoterror").text("请输入手机号").show();
            return false;
        }
        if (checkNullOrEmpty(code)) {
            $("#forgoterror").text("请输入验证码").show();
            return false;
        }
        if (password != repassword) {
            $("#registererror").text("两次密码不同").show();
            return false;
        }
        $('.loading').show();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('register/forget');?>",
            data: {
                userpwd: password,
                repassword:repassword,
                phone:phone,
                code:code,
                recode:recode
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                if(data.code == 1){
                    $("#forgoterror").text(data.res).show();
                    $('.loading').hide();
                }else if (data.code == 0){
                    $('.loading').hide();
                    alert(data.res);
                    location.href = "<?php echo site_url('login')?>";
                }else{
                    $("#forgoterror").text("未知错误").show();
                    $('.loading').hide();
                }

                return false;
            },
            timeout: 60000,
            error: function (xhr, status) {
                if (status == "timeout") {
                    $("#forgoterror").text("您的网络好像很糟糕，请刷新页面重试").show();
                    $('.loading').hide();
                    return false;
                }
                else {
                    $("#forgoterror").text("服务器内部错误，请重试").show();
                    $('.loading').hide();
                    return false;
                }
            }
        });
    }
    $(function () {
        document.onkeydown = function(e) {
            var ev = document.all ? window.event : e;
            if (ev.keyCode == 13) {
                $("#btnLogin").trigger("click");
            }
        };
    });
    // 发送短信
    function sendtel(t) {
        if (t == 'register') {
            var number = $('#phone1').val();
            var time = $('#get1');
        }else{
            var number = $('#phone2').val();
            var time = $('#get2');
        }
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('register/send');?>",
            data: {
                number:number
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                if(data.code !== 1){
                    $("#recode").val(data.code);
                }
                time.attr("disabled",true);
                time.css("pointer-events","none");
                var start = 60;
                var go = setInterval(function(){
                    start--;
                    if (start <= 0){
                        time.attr('disabled',false);
                        time.css("pointer-events","");
                        time.html('获取');
                        clearInterval(go);
                        return false;
                    }
                    time.html(start + 's');
                }, 1000);
            },

        });
    }

</script>

</body>
</html>
