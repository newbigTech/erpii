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
        width: 100px;
        height: 33px;
        line-height: 33px;
        margin-bottom: -6px;
        overflow: hidden;
        text-overflow:ellipsis;
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
            <a href="javascript:void(0);" id="new" class="ui-btn ui-btn-sp mrb">新增</a>
            <a href="javascript:void(0);" class="ui-btn" id="btn-batchDel">删除</a>
        </div>
	  </div>
    <div class="grid-wrap">
        <div class="table">
            <form action="">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 20px;">
                                <input type="checkbox" id="all">
                            </th>
                            <th>储值卡名称</th>
                            <th>卡号</th>
                            <th>实际售价</th>
                            <th>赠送金额</th>
                            <th>有效期</th>
                            <th>工时折扣</th>
                            <th>配件折扣</th>
                            <th>状态</th>
                            <th>适用门店</th>
                            <th>添加时间</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data as $k=>$v): ?>
                        <tr>
                            <td class="check">
                                <input type="checkbox" class="check_child" value="<?php echo $v->id ?>"><!--放id-->
                            </td>
                            <td><span><?php echo $v->car_name ?></span></td>
                            <td><span><?php echo $v->car_num ?></span></td>
                            <td><span><?php echo $v->sale ?>元</span></td>
                            <td><span><?php echo $v->present ?>元</span></td>
                            <?php if($v->validity == 13):?>
                                <td><span>永久</span></td>
                            <?php else : ?>
                                <td><span><?php echo $v->validity ?>个月</span></td>
                            <?php endif; ?>
                            <td><span><?php echo $v->hour_discount ?>%</span></td>
                            <td><span><?php echo $v->parts_discount ?>%</span></td>
                            <?php if($v->status == 0):?>
                                <td><span>正常</span></td>
                            <?php else : ?>
                                <td><span>停用</span></td>
                            <?php endif; ?>
                            <td><span><?php echo $v->orgname ?></span></td>
                            <td><span><?php echo date('Y-m-d H:i:s' ,$v->addtime )?></span></td>
                            <input type="hidden" id="type" value="add">
                            <td><span><a onclick="edit(<?php echo $v->id ?>)" class="ui-btn mrb detail" >修改</a></span></td><!--放id-->
                        </tr>
                    <?php endforeach ?>

                    </tbody>
                </table>
            </form>
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
        <div id="add_title">新增储值卡</div>
        <div id="add_close" class="close_add">&times;</div>
    </div>
    <div id="add_content">
        <ul class="content_title"><h3>基本资料</h3></ul>
        <ul class="content_main clearfix">
            <li><span>储值卡名称:</span><input type="text" id="car_name"></li>
            <li><span>卡号:</span><input type="text" id="car_num"></li>
            <li><span>实际售价:</span><input type="text" id="sale"></li>
            <li><span>有效期:</span><input type="number" min="0" step="1" id="validity"> 月 (0代表永久)</li>

            <li><span>赠送金额:</span><input type="text" id="present"></li>
            <li>
                <span>状态:</span>
                <span class="sel">
                    <select name="status" id="status">
                        <option value="0" selected >正常</option>
                        <option value="1">停用</option>
                    </select>
                </span>
            </li>

            <li>
                <span>门店:</span>
                <span class="sel">
                    <select name="orgid" id="orgid">
                        <option value="<?php echo $orgid ?>" selected>通用</option>
                         <option id= "<?php echo $orgid ?>" value="通用" hidden></option>
                        <?php foreach ($org as $k=>$v): ?>
                            <option value="<?php echo $v->id ?>"><?php echo $v->name ?></option>
                            <option id= "<?php echo $v->id ?>" value="<?php echo $v->name ?>" hidden></option>
                        <?php endforeach ?>
                    </select>
                </span>
            </li>
<!--            <li>-->
<!--                <span>限制车辆:</span>-->
<!--                <span class="sel">-->
<!--                    <select name="limit" id="limit">-->
<!--                        <option value="1" selected>是</option>-->
<!--                        <option value="0">否</option>-->
<!--                    </select>-->
<!--                </span>-->
<!--            </li>-->
        </ul>
        <ul class="content_title"><h3>折扣设置</h3></ul>
        <ul class="content_main clearfix">
            <li><span>工时折扣:</span><input type="text" id="hour_discount"><span>%</span></li>
            <li><span>配件折扣:</span><input type="text" id="parts_discount"><span>%</span></li>
        </ul>
    </div>
    <div id="add_footer">
        <td colspan="2">
            <div class="ui_buttons">
                <input type="hidden" value="" id="id">
                <input type="button" id="save" value="保存" class="ui_state_highlight" />
                <input type="button" class="close_add" value="关闭" />
            </div>
        </td>
    </div>
</div>

<script>
$("#save").click(function(){
    var car_name = $("#car_name").val();
    var car_num = $("#car_num").val();
    var sale = $("#sale").val();
    var validity = $("#validity").val();
    var present = $("#present").val();
    var status = $("#status").val();
    var hour_discount = $("#hour_discount").val();
    var parts_discount = $("#parts_discount").val();
    var orgid =  $("#orgid").find("option:selected").val();
    var orgname = $("#"+orgid).val();
    var id = $("#id").val();

    // alert(orgname);
    if(!car_name || !car_num || !sale || !validity || !present || !status || !hour_discount || !parts_discount || !orgid){
        alert("请填写全卡信息！")
    }else{
        if($("#add_title").text() == "修改储值卡"){
            var url = "<?php echo site_url('card/doedit');?>"
        }else{
            var url = "<?php echo site_url('card/add');?>"
        }

        $.ajax({
            type: "POST",
            url: url,
            traditional: true,
            data: {
                car_name: car_name,
                car_num: car_num,
                sale:sale,
                validity:validity,
                present:present,
                status:status,
                hour_discount:hour_discount,
                parts_discount:parts_discount,
                orgid:orgid,
                orgname:orgname,
                id:id,
            },
            dataType: "json",

            success: function (data) {
                console.log(data);
                if(data.code == 0){
                    alert(data.text);
                    location.href = "<?php echo site_url('card')?>";
                }else if (data.code == 1){
                    alert(data.text);
                } else{
                    alert("未知错误");
                }

            },
        });
    }

});
</script>
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
                    type: "POST",
                    url: "<?php echo site_url('card/del');?>",
                    data: {
                        id: checkitems,
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        if(data){
                            alert("删除成功");
                            location.href = "<?php echo site_url('card')?>";
                        } else{
                            alert("删除失败");
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
        $('#new').on('click',function () {
            $('#ldg_lockmask').css('display','');
            $('#add').css('display','');
            $("#add_title").text("新增储值卡");
            $("#id").val('');
            $("#car_name").val('');
            $("#car_num").val('');
            $("#sale").val('');
            $("#validity").val('');
            $("#present").val('');
            $("#status").find("option[value = 0").attr("selected",true);
            $("#parts_discount").val('');
            $("#hour_discount").val('');
            $("#orgid").find("option[value = 0]").attr("selected",true);
        });
        $('.close_add').on('click',function () {
            $('#ldg_lockmask').css('display','none');
            $('#add').css('display','none');
        });
    });
    // 修改
    function edit(id) {
        $('#ldg_lockmask').css('display','');
        $('#add').css('display','');
        $("#add_title").text("修改储值卡");
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('card/edit');?>",
            data: {
                id: id,
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                if(data){
                    $("#id").val(data.id);
                    $("#car_name").val(data.car_name);
                    $("#car_num").val(data.car_num);
                    $("#sale").val(data.sale);
                    $("#validity").val(data.validity);
                    $("#present").val(data.present);
                    $("#status").find("option[value = "+data.status +"]").attr("selected",true);
                    $("#parts_discount").val(data.parts_discount);
                    $("#hour_discount").val(data.hour_discount);
                    $("#orgid").find("option[value = "+data.orgid +"]").attr("selected",true);
                } else{
                    alert("未知错误");
                }

            },
        });
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


 