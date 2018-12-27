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
</style>
</head>
<body>
<div class="wrapper">
    <div class="mod-search cf">
        <div class="fr">
            <a id="save_all" class="ui-btn ui-btn-sp mrb">保存</a>
        </div>
    </div>
    <div class="grid-wrap">
        <span id="config" class="ui-icon ui-state-default ui-icon-config"></span>
        <ul class="main_title">顾客信息</ul>
        <ul class="mod-form-rows base-form clearfix" id="base-form">
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
                        <option value="1" selected>待确定</option>
                        <option value="2">已确定</option>
                        <option value="3">已取消</option>
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


        <!--        服务内容-->
        <ul class="main_title">跟进信息</ul>
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

    });
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


 