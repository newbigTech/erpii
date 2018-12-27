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
        border-right: 1px solid #e2e2e2;
        border-bottom: 1px solid #e2e2e2;
        border-top: 1px solid #fff;
        border-left: 1px solid #fff;
        /*width: 100px;*/
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
    .table .write,
    .table .delete{
        display: inline-block;
        width: 16px;
        height: 16px;
        background-image: url(<?php echo base_url()?>statics/css/img/ui-icons_20150410.png);
    }
    .table .write{
        background-position: -112px -16px;
    }
    .table .delete{
        background-position: -64px -16px;
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
    #add{
        position: fixed;
        width: 402px;
        height: 210px;
        background-color: #fff;
        top: 40%;
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
        height: 100%;
        box-sizing: border-box;
    }
    #add>#add_content>.content_main{
        width: 320px;
        height: 112px;
        position: relative;
        top: 6%;
        left: 50%;
        transform: translateX(-50%);
        box-sizing: border-box;
    }
    #add>#add_content>.content_main>li{
        width: 100%;
        margin-bottom: 10px;
    }
    #add>#add_content>.content_main>li>span{
        display: inline-block;
        width: 70px;
        height: 28px;
        font-size: 14px;
    }
    #add>#add_content>.content_main>li>input{
        width: 212px;
        height: 28px;
        display: inline-block;
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
        height: 30px;
        line-height: 24px;
        width: 212px;
        margin-left: -3px;
        outline: none;
    }
    #add_footer{
        position: absolute;
        width: 402px;
        height: 33px;
        bottom: 0;
        right: 0;
    }
</style>
</head>
<body>
<div class="wrapper">
    <div class="mod-search cf">
        <div class="fr">
            <a tabTxt="新增预约" parentOpen="true" rel="pageTab" href="<?php echo site_url('settings/appointment_add')?>" class="ui-btn ui-btn-sp mrb">新增</a>
            <a href="javascript:void(0);" class="ui-btn" id="refresh">刷新</a>
        </div>
    </div>
    <div class="grid-wrap">
        <div class="table">
            <table style="width: 100%;">
                <thead>
                <tr>
                    <th style="width: 5%;">操作</th>
                    <th style="width: 10%;">姓名</th>
                    <th style="width: 10%;">手机号</th>
                    <th style="width: 15%;">车牌号</th>
                    <th style="width: 15%;">预约时间</th>
                    <th style="width: 15%;">跟进人</th>
                    <th style="width: 15%;">预约项目</th>
                    <th style="width: 15%;">预约报价</th>
                    <th style="width: 15%;">支付定金</th>
                    <th style="width: 15%;">状态</th>
                    <th style="width: 15%;">创建时间</th>
                    <th style="width: 25%;">备注</th>

                </tr>
                </thead>
                <tbody >
                    <tr>
                        <td>
                            <a style="margin-bottom: -6px" class="write" tabTxt="修改预约" parentOpen="true" rel="pageTab" href="<?php echo site_url('meal/edit?id='."$val->id")?>"></a>
                            <a style="margin-bottom: -6px" class="delete" href="<?php echo site_url('meal/del?id='."$val->id")?>"></a>

                            <input type="hidden" class="id"  value="">
                        </td>
                        <td><span class="name"></span></td>
                        <td><span class="phone" ></span></td>
                        <td><span class="number"></span></td>
                        <td><span class="time"></span></td>
                        <td><span class="followUp"></span></td>
                        <td><span class="item"></span></td>
                        <td><span class="offer"></span></td>
                        <td><span class="earnestMoney"></span></td>
                        <td><span class="payment"></span></td>
                        <td><span class="status"></span></td>
                        <td><span class="createtime"></span></td>
                        <td><span class="remarks"></span></td>
                    </tr>
<!--                    <tr>-->
<!--                        <td colspan="6" style="text-align: center;">暂无记录</td>-->
<!--                    </tr>-->
                </tbody>
            </table>
        </div>
        <div id="page">
            <div class="page_left">&nbsp;</div>
            <div class="page_center">
                <div></div>
                <div></div>
                <div>
                    <input type="text" value="1">
                </div>
                <div>共 1 页</div>
                <div></div>
                <div></div>
                <div>
                    <select name="pages" id="pages">
                        <option value="100">100</option>
                        <option value="200">200</option>
                        <option value="300">300</option>
                    </select>
                </div>
            </div>
            <div class="page_right">1 -  1 &nbsp;&nbsp; 共  1  条</div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('.delete').on('click',function () {
            var id = $(this).parent().find('.id').val();
            $.ajax({
                url: "<?php echo site_url('serve/servicedel');?>",
                type: "POST",
                data:{id:id},
                dataType: "JSON",
                success:function (res) {
                    if (res.code == 0){
                        alert('删除成功！');
                    } else{
                        alert('删除失败！');
                    }

                },
                error:function () {
                    alert('出错啦！')
                }
            });
            location.reload();
        });
        $('#refresh').on('click',function () {
            location.reload();
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


 