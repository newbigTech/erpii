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
        width: 100px;
        height: 33px;
        text-align: center;
    }
    .table tr:hover{
        background-color: #f8ff94;
    }
    .table td>span{
        display: inline-block;

        height: 33px;
        line-height: 33px;

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
    .detail{
        background: #78cd51;
        border-color: #78cd51;
        color: #fff;
        font-weight: bold;
    }
    .detail:hover{
        background: #78cd51;
        color: #fff;
        font-weight: bold;
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
    .tankuang {
        padding: 0;
        height: 90%;
    }
</style>
</head>
<body>
<div class="wrapper">
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
	    <div class="fr">
            <a tabTxt="新增VIP卡" parentOpen="true" rel="pageTab" href="<?php echo site_url('vip/add')?>" class="ui-btn ui-btn-sp mrb">新增</a>
            <a href="javascript:void(0);" class="ui-btn" id="btn-batchDel">删除</a>
        </div>
	  </div>
    <div class="grid-wrap">
        <div class="table">
            <table style="width: 100%;">
                <thead style="width: 100%;">
                    <tr style="width: 100%;">
                        <th style="width: 5%;">
                            <input type="checkbox" id="all">
                        </th>
                        <th style="width: 15%;">卡号</th>
                        <th style="width: 15%;">名称</th>
                        <th style="width: 10%;">售价(元)</th>
                        <th style="width: 10%;">失效日期</th>
                        <th style="width: 10%;">持卡人</th>
                        <th style="width: 10%;">电话</th>
                        <th style="width: 10%;">状态</th>
                        <th style="width: 10%;">详情</th>
                        <th style="width: 10%;">操作</th>
                    </tr>
                </thead>
                <tbody>
                <?php if($data) :?>

                    <?php foreach ($data as $k=>$v): ?>
                        <tr>
                            <td class="check">
                                <input type="checkbox" class="check_child" value="<?php echo $v->id ?>"><!--放id-->
                            </td>
                            <td><span><?php echo $v->number ?></span></td>
                            <td><span><?php echo $v->name ?></span></td>
                            <td><span><?php echo $v->price ?></span></td>
                            <?php if($v->time == 0): ?>
                                <td><span>长期</span></td>
                            <?php else :?>
                                <td><span><?php echo date('Y-m-d',$v->time) ?></span></td>
                            <?php endif;?>
                            <td><span><?php echo $v->username ?></span></td>
                            <td><span><?php echo $v->phone ?></span></td>
                            <?php if($v->status == 0): ?>
                                <td><span>正常</span></td>
                            <?php elseif($v->status == 1) :?>
                                <td><span>已停用</span></td>
                            <?php elseif($v->status == 2) :?>
                                <td><span>已过期</span></td>
                            <?php endif;?>
                            <td><span><a  href="javascript:0" class="ui-btn mrb detail taocandetail" onclick="taocandetail(<?php echo $v->id ?>)">套餐详情</a></span></td>
                            <input type="hidden" id="type" value="add">
                            <td><span><a tabTxt="修改VIP卡" parentOpen="true" rel="pageTab" href="<?php echo site_url('settings/vip_card_add')?>" class="ui-btn mrb detail">修改</a></span></td><!--放id-->
                        </tr>
                    <?php endforeach ?>
                <?php else:?>
                    <tr>
                        <td colspan="10">暂无记录</td>
                    </tr>
                <?php endif;?>
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
<div id="ldg_lockmask" style="position: fixed; left: 0px; top: 0px; width: 100%; height: 100%; overflow: hidden; z-index: 1977;display: none;"></div>
<div id="add" style="display: none;">
    <div id="add_header" class="clearfix">
        <div id="add_title">添加套餐</div>
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
                <table style="width: 100%;">
                    <thead style="width: 100%;">
                    <tr style="width: 100%;">
                        <th style="width: 15%;">套餐名称</th>
                        <th style="width: 70%;">套餐项目</th>
                        <th style="width: 10%;">金额(元)</th>
                    </tr>
                    </thead>

                        <?php foreach ($data as $k=>$v) :?>
                            <?php foreach ($v->content as $key=>$value) :?>
                                <tr class= "taocan_content <?php echo $v->id ?>">
                                    <td><span class="taocan_name"><?php echo $value->name ?></span></td>
                                    <td><span class="taocan_contents">

                                        <?php foreach (json_decode($value->content) as $k1=>$v1) :?>
                                            <?php echo $v1->name ?>:<?php echo $v1->number ?>次;
                                        <?php endforeach;?>
                                    </span></td>
                                    <td><span class="taocan_price"><?php echo $value->price ?></span></td>
                                </tr>
                            <?php endforeach;?>
                        <?php endforeach;?>

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
        // 单选框
        $('#all').on('click',function () {
            var thisChecked = $(this).prop('checked');
            $('.check_child').prop('checked',thisChecked);

        });

        $('.check_child').on('click',function(){
            var totalNum =  $('.check_child').length;
            var checkedNum =  $('.check_child:checked').length;
            $('#all').prop('checked',totalNum==checkedNum);
        });
        
        $('#btn-batchDel').on('click',function () {
            var checkitems = new Array();
            $.each($('.check_child:checked'),function(){
                checkitems.push($(this).val());
            });
            if (checkitems != ''){
                $.ajax({
                    url: "",
                    type: "POST",
                    data:{id:checkitems},
                    dataType: "JSON",
                    success:function (res) {
                        if (res == 1){
                            alert('删除成功！');
                        } else{
                            alert('删除失败！');
                        }

                    },
                    error:function () {
                        alert('出错啦！')
                    }
                })
            } else{
                alert('未选择要删除的项！');
            }
        });

        // 添加
        $('.taocandetail').on('click',function () {
            $('#ldg_lockmask').css('display','');
            $('#add').css('display','');
            $('#type').val('add');
        });
        $('.close_add').on('click',function () {
            $('#ldg_lockmask').css('display','none');
            $('#add').css('display','none');
        });
    });
    function taocandetail(id) {
        $(".taocan_content").css('display','none');

        $("."+id).css('display','');
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

 