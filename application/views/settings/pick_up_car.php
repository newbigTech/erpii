<?php $this->load->view('header');?>

<script type="text/javascript">
    var DOMAIN = document.domain;
    var WDURL = "";
    var SCHEME= "<?php echo sys_skin()?>";
    try{
        document.domain = '<?php echo base_url()?>';
    }catch(e){
    }
    //ctrl+F5 增加版本号来清空iframe的缓存的
    $(document).keydown(function(event) {
        /* Act on the event */
        if(event.keyCode === 116 && event.ctrlKey){
            var defaultPage = Public.getDefaultPage();
            var href = defaultPage.location.href.split('?')[0] + '?';
            var params = Public.urlParam();
            params['version'] = Date.parse((new Date()));
            for(i in params){
                if(i && typeof i != 'function'){
                    href += i + '=' + params[i] + '&';
                }
            }
            defaultPage.location.href = href;
            event.preventDefault();
        }
    });
</script>

<style>
    .clearfix::before,
    .clearfix::after{
        content:'';
        display: block;
        line-height: 0;
        height: 0;
        visibility: hidden;
        clear: both;
    }
    .grid-wrap{
        background-color: #fff;
        border: 1px solid #ddd;
        height: 800px;
        width: 100%;
        overflow: auto;
        position: relative;
        box-sizing: border-box;
        padding: 15px 20px;
    }
    #config{
        background: url(<?php echo base_url()?>statics/css/img/ui-icons_20150410.png) -304px 0 no-repeat;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 2;
        cursor: pointer;
        border: none;
    }
    #add{
        position: fixed;
        width: 770px;
        height: 500px;
        background-color: #fff;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        box-shadow: 1px 1px 10px 10px #a9a9a9;
        border-radius: 3px;
        z-index: 1998;
    }
    #add>#add_header{
        background-color: #f5f5f5;
        height: 32px;
        width: 100%;
        border-radius: 3px;
    }
    #add>#add_header>#add_title{
        float: left;
        height: 32px;
        line-height: 32px;
        font-size: 14px;
        font-weight: 700;
        margin-left: 10px;
    }
    #add>#add_header>#add_close{
        float: right;
        height: 32px;
        line-height: 32px;
        color: #aaa;
        font-size: 18px;
        width: 20px;
        cursor: pointer;
    }
    #add>#add_content{
        width: 100%;
        height: 435px;
        box-sizing: border-box;
        padding: 25px;
    }
    #add>#add_content>.content_title{
        height: 18px;
        width: 100%;
        border-bottom: 1px solid #ccc;
    }
    #add>#add_content>.content_main{
        width: 100%;
        box-sizing: border-box;
        padding: 20px 0;
    }
    #add>#add_content>.content_main:first-child{
        height: 50%;
    }
    #add>#add_content>.content_main:last-child{
        height: 20%;
    }
    #add>#add_content>.content_main>li{
        width: 50%;
        float: left;
        margin-bottom: 5px;
    }
    #add>#add_content>.content_main>li>span{
        display: inline-block;
        width: 70px;
        height: 30px;
    }
    #add>#add_content>.content_main>li>input{
        width: 140px;
        height: 24px;
        border: 1px solid #ddd;
    }
    #add>#add_content>.content_main>li>span>select{
        border: none;
        width: 100%;
        height: 100%;
    }
    #add>#add_content>.content_main>li>.sel{
        display: inline-block;
        border: 1px solid #ddd;
        height: 24px;
        line-height: 24px;
        width: 140px;
        margin-left: -3px;
        outline: none;
    }
    #add_footer{
        position: absolute;
        width: 770px;
        height: 33px;
        bottom: 0;
        right: 0;
    }
    .base-form{
        border-bottom: 1px solid #ddd;
        margin-bottom: 20px;
    }
    .main_title{
        font-size: 20px;
        font-weight: bold;
    }
    .row-item{
        float: left;
        width: 33.33%;
    }
    .row-item .label-wrap{
        width: 90px;
    }
    .row-item input{
        width: 162px;
        height: 16px;
    }
    .sel{
        width: 172px;
        height: 30px;
        border: 1px solid #ddd;
    }
    .sel>select{
        width: 100%;
        height: 100%;
        border: none;
    }
    .table{
        width: 100%;
    }
    table{
        border-collapse:collapse;
    }
    .table tr{
        border: 1px solid #000;
        height: 33px;
    }
    .table th{
        background-color: #f1f1f1;
        height: 30px;
    }
    .table th,td{
        border: 1px solid #e2e2e2;
        width: 30%;
        height: 33px;
        text-align: center;
    }
    .table tr:hover{
        background-color: #f8ff94;
    }
    .table td>span{
        display: inline-block;
        width: 100px;
        height: 33px;
        line-height: 33px;
        margin-bottom: -6px;
        overflow: hidden;
        text-overflow:ellipsis;
    }
    .fr>#taocan_add{
        margin-top: -5px;
    }
    .tankuang{
        padding: 0;
        height: 90%;
    }
    #page{
        position: absolute;
        bottom: 0;
        width: 100%;
        background-color: #f1f1f1;
        line-height: 30px;
    }
    #page>div{
        float: left;
        width: 33.333%;
        text-align: center;
    }
    #page>div:first-child{
        width: 25%;
    }
    #page>div:nth-child(2){
        width: 40%;
    }
    #page>div:last-child{
        text-align: right;
    }
    .page_center>div{
        float: left;
        margin-left: 10px;
    }
    .page_center>div:first-child{
        background-image: url(<?php echo base_url()?>statics/css/img/ui-icons_20150410.png);
        background-repeat: no-repeat;
        background-position: -48px 0px;
        width: 16px;
        height: 16px;
        margin-top: 8px;
    }
    .page_center>div:nth-child(2){
        background-image: url(<?php echo base_url()?>statics/css/img/ui-icons_20150410.png);
        background-repeat: no-repeat;
        background-position: -16px 0px;
        width: 16px;
        height: 16px;
        margin-top: 8px;
    }
    .page_center>div:nth-child(3){
        width: 42px;
        height: 18px;
    }
    .page_center>div:nth-child(3)>input{
        width: 100%;
        height: 100%;
    }
    .page_center>div:nth-child(5){
        background-image: url(<?php echo base_url()?>statics/css/img/ui-icons_20150410.png);
        background-repeat: no-repeat;
        background-position: 0px 0px;
        width: 16px;
        height: 16px;
        margin-top: 8px;
    }
    .page_center>div:nth-child(6){
        background-image: url(<?php echo base_url()?>statics/css/img/ui-icons_20150410.png);
        background-repeat: no-repeat;
        background-position: -32px 0px;
        width: 16px;
        height: 16px;
        margin-top: 8px;
    }
    .item{
        width: 100%;
        margin-top: 2%;
        border-bottom: 1px solid #ddd;
    }
    .item:first-child{
        margin: 0;
    }
    .item .item_title{
        width: 100%;
        height: 40px;
        line-height: 40px;
        background-color: #f5f5f5;
    }
    .item .item_title .item_title_text{
        font-size: 20px;
        font-weight: bold;
        float: left;
        padding-left: 1%;
    }
    .item .item_title .item_title_photo{
        float: right;
        text-align: right;
        width: 75px;
        height: 25px;
        margin-right: 2%;
        cursor: pointer;
        background-image: url(<?php echo base_url()?>statics/css/img/img_upload.png);
        background-repeat: no-repeat;
    }
    .item .item_title .item_title_photo:hover{
        background-position: 0 -40px;
        color: rgb(255,150,0);
    }
    .item .item_item{
        width: 50%;
        height: 40px;
        line-height: 40px;
        float: left;
        border-top: 1px solid #ddd;
        box-sizing: border-box;
        padding:0 1%;
    }
    .item .item_item .item_name{
        float: left;
        /*min-width: 380px;*/
        /*overflow: hidden;*/
        /*white-space: nowrap;*/
        /*text-overflow:ellipsis;*/
    }
    .item .item_item .item_icon{
        float: right;
        width: 40px;
        height: 25px;
        margin-top: 7.5px;
        background-image: url(<?php echo base_url()?>statics/css/img/iszc.png);
        background-repeat: no-repeat;
    }
    .item_icon_click{
        background-position: 0px -40px;
    }
    .item .item_item .item_discribe{
        float: right;
        color: #999;
        display: inline-block;
        width: 50px;
    }
    .item .item_item .item_discribe_click{
        color: red;
    }
    .item .upload_img{
        width: 100%;
        height: 0%;
        line-height: 10px;
        border-top: 1px solid #ddd;
    }
    .item .upload_img span{
        position: relative;
        display: inline-block;
        height: 120px;
        width: 120px;
        box-sizing: border-box;
        padding: 5px;
        margin: 10px;
        border: 1px solid #000;
    }
    .item .upload_img span img{
        position: relative;
        width: 100%;
    }
    .item .upload_img span .del_img{
        position: absolute;
        display: block;
        z-index: 555;
        height: 29px;
        width: 29px;
        background: url(<?php echo base_url()?>statics/css/img/img_close.png) no-repeat;
        text-decoration: none;
        right: -13px;
        top: -13px;
    }
</style>
</head>
<body>
<div class="wrapper">
    <div class="mod-search cf">
        <div class="fl">
            <a class="ui-btn ui-btn-sp choose">顾客信息</a>
            <a class="ui-btn choose">车辆信息</a>
            <a class="ui-btn choose">实录照片</a>
            <a class="ui-btn choose">车检报告</a>
        </div>
        <div class="fr">
            <a id="save_all" class="ui-btn ui-btn-sp mrb">保存</a>
        </div>
    </div>
<!--    信息-->
    <div class="grid-wrap">
        <span id="config" class="ui-icon ui-state-default ui-icon-config"></span>
        <ul class="main_title customer_information">顾客信息</ul>
        <ul class="mod-form-rows base-form clearfix customer_information" id="base-form">
            <li class="row-item">
                <div class="label-wrap"><label for="name">客户姓名:</label></div>
                <div class="ctn-wrap"><input type="text" value="" class="ui-input normal" name="name" id="name"></div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="phone">手机号:</label></div>
                <div class="ctn-wrap"><input type="tel" value="" class="ui-input normal" name="phone" id="phone"></div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="number">车牌号:</label></div>
                <div class="ctn-wrap"><input type="text" value="" class="ui-input normal" name="number" id="number"></div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="company">工作单位:</label></div>
                <div class="ctn-wrap"><input type="text" value="" class="ui-input normal" name="company" id="company"></div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="reception">接待人员:</label></div>
                <div class="ctn-wrap">
                    <select name="reception" id="reception" class="sel">
                        <option value="1" selected>待确定</option>
                        <option value="2">已确定</option>
                        <option value="3">已取消</option>
                    </select>
                </div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="service">服务性质:</label></div>
                <div class="ctn-wrap">
                    <select name="service" id="service" class="sel">
                        <option value="1" selected>正常服务</option>
                        <option value="2">保险</option>
                        <option value="3">返工</option>
                        <option value="3">索赔</option>
                        <option value="3">免单</option>
                        <option value="3">公务车</option>
                    </select>
                </div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="songCarRen">送修人:</label></div>
                <div class="ctn-wrap"><input type="text" value="" class="ui-input normal" name="songCarRen" id="songCarRen"></div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="songCarRenPhone">送修人电话:</label></div>
                <div class="ctn-wrap"><input type="text" value="" class="ui-input normal" name="songCarRenPhone" id="songCarRenPhone"></div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="source">客户来源:</label></div>
                <div class="ctn-wrap"><input type="text" value="" class="ui-input normal" name="source" id="source"></div>
            </li>
            <li class="row-item" style="width: 100% ;">
                <div class="label-wrap"><label for="address">顾客地址:</label></div>
                <div class="ctn-wrap"><textarea value="" class="ui-input normal" name="address" id="address" style="width: 80.5%;height: 100%;"></textarea></div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="startTime">开工时间:</label></div>
                <div class="ctn-wrap"><input type="date" value="" class="ui-input normal" name="startTime" id="startTime"></div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="estimateTime">预计完工时间:</label></div>
                <div class="ctn-wrap"><input type="date" value="" class="ui-input normal" name="estimateTime" id="estimateTime"></div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="endTime">完工时间:</label></div>
                <div class="ctn-wrap"><input type="date" value="" class="ui-input normal" name="endTime" id="endTime"></div>
            </li>

        </ul>

        <ul class="main_title car_information" style="display: none">车辆信息</ul>
        <ul class="mod-form-rows base-form clearfix car_information" style="display: none" id="base-form">
            <li class="row-item">
                <div class="label-wrap"><label for="name">客户姓名:</label></div>
                <div class="ctn-wrap"><input type="text" value="" class="ui-input normal" name="name" id="name"></div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="phone">手机号:</label></div>
                <div class="ctn-wrap"><input type="tel" value="" class="ui-input normal" name="phone" id="phone"></div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="number">车牌号:</label></div>
                <div class="ctn-wrap"><input type="text" value="" class="ui-input normal" name="number" id="number"></div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="company">工作单位:</label></div>
                <div class="ctn-wrap"><input type="text" value="" class="ui-input normal" name="company" id="company"></div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="reception">接待人员:</label></div>
                <div class="ctn-wrap">
                    <select name="reception" id="reception" class="sel">
                        <option value="1" selected>待确定</option>
                        <option value="2">已确定</option>
                        <option value="3">已取消</option>
                    </select>
                </div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="service">服务性质:</label></div>
                <div class="ctn-wrap">
                    <select name="service" id="service" class="sel">
                        <option value="1" selected>正常服务</option>
                        <option value="2">保险</option>
                        <option value="3">返工</option>
                        <option value="3">索赔</option>
                        <option value="3">免单</option>
                        <option value="3">公务车</option>
                    </select>
                </div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="songCarRen">送修人:</label></div>
                <div class="ctn-wrap"><input type="text" value="" class="ui-input normal" name="songCarRen" id="songCarRen"></div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="songCarRenPhone">送修人电话:</label></div>
                <div class="ctn-wrap"><input type="text" value="" class="ui-input normal" name="songCarRenPhone" id="songCarRenPhone"></div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="source">客户来源:</label></div>
                <div class="ctn-wrap"><input type="text" value="" class="ui-input normal" name="source" id="source"></div>
            </li>
            <li class="row-item" style="width: 100% ;">
                <div class="label-wrap"><label for="address">顾客地址:</label></div>
                <div class="ctn-wrap"><textarea value="" class="ui-input normal" name="address" id="address" style="width: 80.5%;height: 100%;"></textarea></div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="startTime">开工时间:</label></div>
                <div class="ctn-wrap"><input type="date" value="" class="ui-input normal" name="startTime" id="startTime"></div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="estimateTime">预计完工时间:</label></div>
                <div class="ctn-wrap"><input type="date" value="" class="ui-input normal" name="estimateTime" id="estimateTime"></div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="endTime">完工时间:</label></div>
                <div class="ctn-wrap"><input type="date" value="" class="ui-input normal" name="endTime" id="endTime"></div>
            </li>

        </ul>

        <ul class="main_title car_photo" style="display: none">实录照片</ul>
        <ul class="mod-form-rows base-form clearfix car_photo" style="display: none" id="base-form">
            <li class="row-item">
                <div class="label-wrap"><label for="name">客户姓名:</label></div>
                <div class="ctn-wrap"><input type="text" value="" class="ui-input normal" name="name" id="name"></div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="phone">手机号:</label></div>
                <div class="ctn-wrap"><input type="tel" value="" class="ui-input normal" name="phone" id="phone"></div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="number">车牌号:</label></div>
                <div class="ctn-wrap"><input type="text" value="" class="ui-input normal" name="number" id="number"></div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="company">工作单位:</label></div>
                <div class="ctn-wrap"><input type="text" value="" class="ui-input normal" name="company" id="company"></div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="reception">接待人员:</label></div>
                <div class="ctn-wrap">
                    <select name="reception" id="reception" class="sel">
                        <option value="1" selected>待确定</option>
                        <option value="2">已确定</option>
                        <option value="3">已取消</option>
                    </select>
                </div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="service">服务性质:</label></div>
                <div class="ctn-wrap">
                    <select name="service" id="service" class="sel">
                        <option value="1" selected>正常服务</option>
                        <option value="2">保险</option>
                        <option value="3">返工</option>
                        <option value="3">索赔</option>
                        <option value="3">免单</option>
                        <option value="3">公务车</option>
                    </select>
                </div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="songCarRen">送修人:</label></div>
                <div class="ctn-wrap"><input type="text" value="" class="ui-input normal" name="songCarRen" id="songCarRen"></div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="songCarRenPhone">送修人电话:</label></div>
                <div class="ctn-wrap"><input type="text" value="" class="ui-input normal" name="songCarRenPhone" id="songCarRenPhone"></div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="source">客户来源:</label></div>
                <div class="ctn-wrap"><input type="text" value="" class="ui-input normal" name="source" id="source"></div>
            </li>
            <li class="row-item" style="width: 100% ;">
                <div class="label-wrap"><label for="address">顾客地址:</label></div>
                <div class="ctn-wrap"><textarea value="" class="ui-input normal" name="address" id="address" style="width: 80.5%;height: 100%;"></textarea></div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="startTime">开工时间:</label></div>
                <div class="ctn-wrap"><input type="date" value="" class="ui-input normal" name="startTime" id="startTime"></div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="estimateTime">预计完工时间:</label></div>
                <div class="ctn-wrap"><input type="date" value="" class="ui-input normal" name="estimateTime" id="estimateTime"></div>
            </li>
            <li class="row-item">
                <div class="label-wrap"><label for="endTime">完工时间:</label></div>
                <div class="ctn-wrap"><input type="date" value="" class="ui-input normal" name="endTime" id="endTime"></div>
            </li>

        </ul>

        <ul class="main_title car_report" style="display: none">车检报告</ul>
        <ul class="mod-form-rows base-form clearfix car_report" style="" id="base-form">
            <li class="row-item" style="width: 100% ;">
                <div class="label-wrap"><label for="examination_advice">体检建议:</label></div>
                <div class="ctn-wrap"><textarea value="" class="ui-input normal" name="examination_advice" id="examination_advice" style="width: 83.1%;height: 100%;"></textarea></div>
            </li>
            <li class="row-item" style="width: 100%;">
                <a class="ui-btn ui-btn-sp choose_inspect">全面检查</a>
                <a class="ui-btn choose_inspect">基础检查</a>
            </li>
            <li class="row-item" style="width: 100%;border: 1px solid #ddd;">
                <ul class="item clearfix">
                    <li class="item_title">
                        <span class="item_title_text">发动机部分</span>
                        <span class="item_title_photo">
                            <i></i>
                            上传照片
                        </span>
                    </li>
                    <li class="item_item base">
                        <span class="item_name">1.   着车检查发动机有无异响</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0"><!-- 0正常1不正常-->
                    </li>
                    <li class="item_item base">
                        <span class="item_name">2.   检查正时皮带是否老化或磨损（建议每3年或7万公里更换）</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item base">
                        <span class="item_name">3.   检查风扇、空调、助力泵皮带的有无异响、老化、裂纹</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item">
                        <span class="item_name">4.   清洁或更换空气格、空调格</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item base">
                        <span class="item_name">5.   检查气门垫片是否漏油</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item base">
                        <span class="item_name">6.   检查火花塞、点火线圈是否漏电</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item base">
                        <span class="item_name">7.   检查上、下水管有无老化、膨胀、漏水现象</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item base">
                        <span class="item_name">8.   检查碳罐是否堵塞（建议每3年或8万公里更换）</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item base">
                        <span class="item_name">9.   检查节气门是否脏、堵塞</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item upload_img">
                        <input type="file" name="li1_img" class="file" accept="image/*" hidden>
                    </li>
                </ul>
                <ul class="item clearfix base">
                    <li class="item_title">
                        <span class="item_title_text">底盘部分</span>
                        <span class="item_title_photo">
                            <i></i>
                            上传照片
                        </span>
                    </li>
                    <li class="item_item">
                        <span class="item_name">10.   紧固底盘螺丝</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0"><!-- 0正常1不正常-->
                    </li>
                    <li class="item_item">
                        <span class="item_name">11.   检查离合器是否有打滑现象</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item">
                        <span class="item_name">12.   检查变速器紧固情况，油平面及有无漏油现象</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item">
                        <span class="item_name">13.   检查悬挂各球头是否松动或胶套漏油现象</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item">
                        <span class="item_name">14.   检查前、后减震器是否漏油或变形</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item">
                        <span class="item_name">15.   检查前、后桥是否碰撞变形</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item">
                        <span class="item_name">16.   检查排气管是否变形或吊胶脱落</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item">
                        <span class="item_name">17.   检查油箱固定螺丝是否紧固</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item upload_img">
                        <input type="file" name="li2_img" class="file" accept="image/*" hidden>
                    </li>
                </ul>
                <ul class="item clearfix">
                    <li class="item_title">
                        <span class="item_title_text">电气设备</span>
                        <span class="item_title_photo">
                            <i></i>
                            上传照片
                        </span>
                    </li>
                    <li class="item_item">
                        <span class="item_name">18.   检查蓄电池电压是否正常</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0"><!-- 0正常1不正常-->
                    </li>
                    <li class="item_item">
                        <span class="item_name">19.   检查发电机是否供电正常</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item">
                        <span class="item_name">20.   检查内部灯光是否正常、仪表指示灯、室内阅读灯</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item">
                        <span class="item_name">21.   检查外部灯光是否正常、大灯、小灯、前后雾灯、牌照灯、制动灯等</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item">
                        <span class="item_name">22.   检查喇叭是否沙哑、单音等故障</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item">
                        <span class="item_name">23.   检查四门玻璃升降是否正常</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item">
                        <span class="item_name">24.   检查空调温度是否制冷正常</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item upload_img">
                        <input type="file" name="li3_img" class="file" accept="image/*" hidden>
                    </li>
                </ul>
                <ul class="item clearfix">
                    <li class="item_title">
                        <span class="item_title_text">轮胎部分</span>
                        <span class="item_title_photo">
                            <i></i>
                            上传照片
                        </span>
                    </li>
                    <li class="item_item">
                        <span class="item_name">25.   检查前、后轮胎和备用胎是否漏气、老化、磨损</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0"><!-- 0正常1不正常-->
                    </li>
                    <li class="item_item">
                        <span class="item_name">26.   检查前后轮磨损情况是否需要对调动平衡（建议半年更换1次）</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item">
                        <span class="item_name">27.   清理胎纹石子用袋子装好展示给客户</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item">
                        <span class="item_name">28.   紧固轮胎螺丝</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item upload_img">
                        <input type="file" name="li4_img" class="file" accept="image/*" hidden>
                    </li>
                </ul>
                <ul class="item clearfix base">
                    <li class="item_title">
                        <span class="item_title_text">刹车系统</span>
                        <span class="item_title_photo">
                            <i></i>
                            上传照片
                        </span>
                    </li>
                    <li class="item_item">
                        <span class="item_name">29.   检查刹车软管是否漏油、老化（建议3年更换1次）</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0"><!-- 0正常1不正常-->
                    </li>
                    <li class="item_item">
                        <span class="item_name">30.   检查刹车分泵是否卡死或漏油</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item">
                        <span class="item_name">31.   检查手刹工作情况</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item">
                        <span class="item_name">32.   检查刹车皮厚度是否正常</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item">
                        <span class="item_name">33.   检查刹车碟是否平整</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item upload_img">
                        <input type="file" name="li5_img" class="file" accept="image/*" hidden>
                    </li>
                </ul>
                <ul class="item clearfix">
                    <li class="item_title">
                        <span class="item_title_text">油水部分</span>
                        <span class="item_title_photo">
                            <i></i>
                            上传照片
                        </span>
                    </li>
                    <li class="item_item">
                        <span class="item_name">34.   检查或更换机油、机油格</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0"><!-- 0正常1不正常-->
                    </li>
                    <li class="item_item">
                        <span class="item_name">35.   检查或更换方向机油、变速箱油、刹车油（建议2年或4万公里更换）</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item">
                        <span class="item_name">36.   补充或更换雨刮水、防冻液，建议2年或4万公里更换防冻液</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item upload_img">
                        <input type="file" name="li6_img" class="file" accept="image/*" hidden>
                    </li>
                </ul>
                <ul class="item clearfix base">
                    <li class="item_title">
                        <span class="item_title_text">电脑检测</span>
                        <span class="item_title_photo">
                            <i></i>
                            上传照片
                        </span>
                    </li>
                    <li class="item_item">
                        <span class="item_name">37.   电脑检测读取故障码</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0"><!-- 0正常1不正常-->
                    </li>
                    <li class="item_item">
                        <span class="item_name">38.   保养机油灯复位归零</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item upload_img">
                        <input type="file" name="li8_img" class="file" accept="image/*" hidden>
                    </li>
                </ul>
                <ul class="item clearfix">
                    <li class="item_title">
                        <span class="item_title_text">外观检测</span>
                        <span class="item_title_photo">
                            <i></i>
                            上传照片
                        </span>
                    </li>
                    <li class="item_item">
                        <span class="item_name">39.   左侧车身</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0"><!-- 0正常1不正常-->
                    </li>
                    <li class="item_item">
                        <span class="item_name">40.   右侧车身</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item">
                        <span class="item_name">41.   车顶</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0"><!-- 0正常1不正常-->
                    </li>
                    <li class="item_item">
                        <span class="item_name">42.   车前部</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item">
                        <span class="item_name">43.   车后部</span>
                        <span class="item_discribe">正常</span>
                        <span class="item_icon"></span>
                        <input type="hidden" name="" value="0">
                    </li>
                    <li class="item_item upload_img">
                        <input type="file" name="li9_img" class="file" accept="image/*" hidden>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="main_title"></ul>
        <ul class="mod-form-rows base-form clearfix" id="base-form">
            <li class="row-item" style="width: 45% ;">
                <div class="label-wrap"><label for="describe">故障描述:</label></div>
                <div class="ctn-wrap"><textarea value="" class="ui-input normal" name="describe" id="describe" style="width: 85%;height: 100%;"></textarea></div>
            </li>
            <li class="row-item" style="width: 45% ;">
                <div class="label-wrap"><label for="advice">维修建议:</label></div>
                <div class="ctn-wrap"><textarea value="" class="ui-input normal" name="advice" id="advice" style="width: 85%;height: 100%;"></textarea></div>
            </li>
            <li class="row-item" style="width: 45% ;">
                <div class="label-wrap"><label for="report">出车报告:</label></div>
                <div class="ctn-wrap"><textarea value="" class="ui-input normal" name="report" id="report" style="width: 85%;height: 100%;"></textarea></div>
            </li>
            <li class="row-item" style="width: 45% ;">
                <div class="label-wrap"><label for="request">顾客要求:</label></div>
                <div class="ctn-wrap"><textarea value="" class="ui-input normal" name="request" id="request" style="width: 85%;height: 100%;"></textarea></div>
            </li>
            <li class="row-item" style="width: 100% ;">
                <div class="label-wrap"><label for="remarks">备注:</label></div>
                <div class="ctn-wrap"><textarea value="" class="ui-input normal" name="remarks" id="remarks" style="width: 83.1%;height: 100%;"></textarea></div>
            </li>


        </ul>
    </div>


<div id="ldg_lockmask" style="position: fixed; left: 0px; top: 0px; width: 100%; height: 100%; overflow: hidden; z-index: 1977;display: none;"></div>
<div id="add" style="display: none;">
    <div id="add_header" class="clearfix">
        <div id="add_title">编辑客户</div>
        <div id="add_close" class="close_add">&times;</div>
    </div>
    <div id="add_content">
        <div class="mod-search cf">
            <div class="fl">
                <ul class="ul-inline">
                    <li>
                        <span id="catorage"></span>
                    </li>
                    <li>
                        <input type="text" id="matchCon" class="ui-input ui-input-ph matchCon" value="输入客户编号/ 名称/ 联系人/ 电话查询" style="width: 280px;">
                    </li>
                    <li><a class="ui-btn mrb" id="search">查询</a></li>
                </ul>
            </div>
        </div>
        <div class="grid-wrap tankuang">
            <div class="table">
                <table>
                    <thead>
                    <tr>
                        <th>手机号</th>
                        <th>客户姓名</th>
                        <th>车牌号</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="phone"></span></td>
                            <td><span class="name"></span></td>
                            <td><span class="number"></span></td>
                        </tr>
<!--                        <tr>-->
<!--                            <td colspan="3">暂无记录</td>-->
<!--                        </tr>-->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="add_footer">
        <td colspan="2">
            <div class="ui_buttons">
                <input type="button" id="save" value="确定" class="ui_state_highlight" />
                <input type="button" class="close_add" value="关闭" />
            </div>
        </td>
    </div>
</div>


<script>
    $(function () {
        $('#save').on('click',function () {

        });

        $('#name,#phone,#number').on('focus',function () {
            $('#ldg_lockmask').css('display','');
            $('#add').css('display','');
        });
        $('.close_add').on('click',function () {
            $('#ldg_lockmask').css('display','none');
            $('#add').css('display','none');
        });

        // 两个切换
        $('.choose').on('click',function () {
            $('.choose').removeClass('ui-btn-sp');
            $(this).addClass('ui-btn-sp');
            if ($(this).html() == '顾客信息') {
                $('.customer_information').css('display','');
                $('.car_information').css('display','none');
                $('.car_photo').css('display','none');
                $('.car_report').css('display','none');
            }else if ($(this).html() == '车辆信息') {
                $('.customer_information').css('display','none');
                $('.car_information').css('display','');
                $('.car_photo').css('display','none');
                $('.car_report').css('display','none');
            }else if ($(this).html() == '实录照片'){
                $('.customer_information').css('display','none');
                $('.car_information').css('display','none');
                $('.car_photo').css('display','');
                $('.car_report').css('display','none');
            }else if ($(this).html() == '车检报告'){
                $('.customer_information').css('display','none');
                $('.car_information').css('display','none');
                $('.car_photo').css('display','none');
                $('.car_report').css('display','');
            }
        });
        $('.choose_inspect').on('click',function () {
            $('.choose_inspect').removeClass('ui-btn-sp');
            $(this).addClass('ui-btn-sp');
            if ($(this).html() == '基础检查'){
                $('.base').css('display','none');
            } else{
                $('.base').css('display','');
            }
        });

        // 正常和不正常
        $('.item_icon').on('click',function () {
            $(this).toggleClass('item_icon_click');
            if ($(this).hasClass('item_icon_click')) {
                $(this).parent().find('input').val(1);
                $(this).parent().find('.item_discribe').html('不正常');
                $(this).parent().find('.item_discribe').addClass('item_discribe_click');
            }else{
                $(this).parent().find('input').val(0);
                $(this).parent().find('.item_discribe').html('正常');
                $(this).parent().find('.item_discribe').removeClass('item_discribe_click');
            }
        });

        // 上传照片
        var url_arr = new Array();
        url_arr['li1_img'] = new Array();
        url_arr['li2_img'] = new Array();
        url_arr['li3_img'] = new Array();
        url_arr['li4_img'] = new Array();
        url_arr['li5_img'] = new Array();
        url_arr['li6_img'] = new Array();
        url_arr['li7_img'] = new Array();
        url_arr['li8_img'] = new Array();
        url_arr['li9_img'] = new Array();
        $('.item_title_photo').on('click',function () {
            var img1 = '<span><img src="';
            var img2 = '" class="show_img"><a href="javascript:void(0);" class="del_img" onclick="delImg(\'';
            var img3 = '\')"></span>';
            var upload_img = $(this).parent().parent().find('.upload_img');
            var upload_file = $(this).parent().parent().find('.upload_img .file');
            var upload_file_name = upload_file.attr('name');
            upload_file.click();
            upload_file.on('change',function () {
                if (this.files[0]){
                    var url = getObjectURL(this.files[0]);
                    url_arr[upload_file_name].push(url);
                    var img = img1 + url + img2 + url + img3;
                    upload_img.append(img);
                }
                upload_file.val('');
            })
        });
        // 获取图片路径
        function getObjectURL(file) {
            var url = null ;
            if (window.createObjectURL!=undefined) { // basic
                url = window.createObjectURL(file) ;
            } else if (window.URL!=undefined) { // mozilla(firefox)
                url = window.URL.createObjectURL(file) ;
            } else if (window.webkitURL!=undefined) { // webkit or chrome
                url = window.webkitURL.createObjectURL(file) ;
            }
            return url ;
        }
    });

    // 删除照片
    function delImg(url) {

    }
</script>
<script>
    Public.pageTab();
    reportParam();
    function reportParam(){
        $("[tabid^='report']").each(function(){
            var dateParams = "beginDate="+parent.SYSTEM.beginDate+"&endDate="+parent.SYSTEM.endDate;
            var href = this.href;
            href += (this.href.lastIndexOf("?")===-1) ? "?" : "&";
            if($(this).html() === '商品库存余额表'){
                this.href = href + "beginDate="+parent.SYSTEM.startDate+"&endDate="+parent.SYSTEM.endDate;
            }
            else{
                this.href = href + dateParams;
            }
        });
    }

    var goodsCombo = Business.goodsCombo($('#goodsAuto'), {
        extraListHtml: ''
    });
</script>
</body>
</html>