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
        <div class="fl">
            <a tabTxt="会员列表" parentOpen="true" rel="pageTab" href="<?php echo site_url('settings/customer')?>" class="ui-btn ui-btn-sp mrb">会员列表</a>
            <a tabTxt="车辆列表" parentOpen="true" rel="pageTab" href="<?php echo site_url('settings/customer_car')?>" class="ui-btn ui-btn-sp mrb">车辆列表</a>
        </div>
	    <div class="fr">
            <a  tabTxt="新增会员" parentOpen="true" rel="pageTab" href="<?php echo site_url('settings/customer_add')?>" class="ui-btn ui-btn-sp mrb">新增</a>
            <a href="#" class="ui-btn" id="btn-batchDel">删除</a>
        </div>
	  </div>
    <div class="grid-wrap">
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th style="width: 20px;">
                            <input type="checkbox" id="all">
                        </th>
                        <th>编号</th>
                        <th>车辆信息</th>
                        <th>车型</th>
                        <th>客户</th>
                        <th>手机号</th>
                        <th>保险到期时间</th>
                        <th>当前里程</th>
                        <th>车架号</th>
                        <th>最近到点</th>
                        <th>消费总额</th>
                        <th>分组</th>
                        <th>服务顾问</th>
                        <th>所属门店</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="check">
                            <input type="checkbox" class="check_child" value="1"><!--放id-->
                        </td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span><a href="javascript:viod(0);" class="ui-btn mrb detail" id="1">详情</a></span></td><!--放id-->
                    </tr>
                    <tr>
                        <td class="check">
                            <input type="checkbox" class="check_child" value="2">
                        </td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span><a href="javascript:viod(0);" class="ui-btn mrb detail" id="2">详情</a></span></td>
                    </tr>
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

        $('.detail').on('click',function () {
            var id = this.id;
        })
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
                this.href = href + dateParams;
        });
    }

    var goodsCombo = Business.goodsCombo($('#goodsAuto'), {
        extraListHtml: ''
    });
</script>
</body>
</html>


 