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
    .item{
        border-bottom: 1px solid #000;
        margin-bottom: 20px;
        padding-bottom: 20px;
    }
    .label-wrap>label{
        font: 12px/1.5 arial, \5b8b\4f53;
        color: #555;
    }
    .ui-input{
        width: 150px;
        height: 16px;
    }
    .sel{
        width: 160px;
        height: 30px;
        line-height: 30px;
        border: 1px solid #ddd;
        color: #555;
        outline: 0;
    }
    #gender,#source{
        border: none;
        outline: none;
        width: 100%;
        height: 20px;
        line-height: 30px;
        /*appearance: none;*/
        /*-webkit-appearance: none;*/
        /*-moz-appearance: none;*/
        /*padding-left: 60px;*/
    }
    .row-item{
        float: left;
        width: 30%;
        padding: 0;
        margin: 0;
    }
    .grid-wrap{
        background-color: #fff;
        border: 1px solid #ddd;
        height: 800px;
        width: 100%;
        overflow: auto;
        position: relative;
        box-sizing: border-box;
        padding: 5px 10px;
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
        width: 20%;
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
    .name{
        border: none;
        font-size: 20px;
        color: #555;
        background-color: #f5f5f5;
        border-bottom: 1px solid #000;
    }
    .on{
        font-size: 20px;
        font-weight: bold;
    }
    .edit{}
    .normal{
        border: none;
        border-bottom: 1px solid #bbb;
    }
    .normal select{
        appearance:none;
        -moz-appearance:none;
        -webkit-appearance:none;
    }
    .normal:focus,
    .normal:hover{
        border: none;
        box-shadow: none;
        border-bottom: 1px solid #000;
    }
    .edit1{}
    .normal1{
        border: none;
        border-bottom: 1px solid #bbb;
    }
    .normal1:focus,
    .normal1:hover{
        border: none;
        box-shadow: none;
        border-bottom: 1px solid #000;
    }
</style>
</head>
<body>
<div class="wrapper">
	<div class="mod-search cf">
        <div class="fl">
            <input type="text" class="name" value="<?php echo $data->name ?>">
        </div>
<!--	    <div class="fr">-->
<!--            <a href="#" class="ui-btn ui-btn-sp mrb">成为会员</a>-->
<!--            <a href="#" class="ui-btn" id="btn-batchDel">撤销会员</a>-->
<!--        </div>-->
    </div>
    <div class="grid-wrap">
        <input type="text" hidden value="<?php echo $id ?>" id="id">
<!--        个人信息-->

            <ul style="font-size: 20px;font-weight: bold" class="clearfix">
                <li style="float:left;">个人资料</li>
                <li style="float:right;"><button type="button" class="person" style="width: 60px;height: 30px;font-size: 16px;font-weight: bold">修改</button></li>
                <li style="float:right;"><button type="button" class="person" id = "people" style="width: 60px;height: 30px;font-size: 16px;font-weight: bold;display: none;">保存</button></li>
            </ul>
            <ul class="mod-form-rows base-form clearfix" id="base-form">
                <li class="row-item">
                    <div class="label-wrap"><label for="name">姓名:</label></div>
                    <div class="ctn-wrap"><input type="text" value="<?php echo $data->name ?>" class="ui-input normal" name="name" id="name" readonly></div>
                </li>
                <li class="row-item">
                    <div class="label-wrap"><label for="birthday">生日:</label></div>
                    <div class="ctn-wrap"><input type="date" value="<?php echo $data->birthday ?>" class="ui-input normal" name="birthday" id="birthday" readonly></div>
                </li>
                <li class="row-item">
                    <div class="label-wrap"><label for="gender">性别:</label></div>
                    <div class="ctn-wrap sel normal">

                        <select name="gender" id="gender" disabled>
                            <?php if($data->sex == '1'):?>
                                <option value="1" selected>男</option>
                                <option value="2" >女</option>
                            <?php else: ?>
                                <option value="1" >男</option>
                                <option value="2" selected>女</option>
                            <?php endif; ?>

                        </select>

                    </div>
                </li>
                <li class="row-item">
                    <div class="label-wrap"><label for="tel">联系方式:</label></div>
                    <div class="ctn-wrap"><input type="text" value="<?php echo $data->mobile ?>" class="ui-input normal" name="tel" id="tel" readonly></div>
                </li>
                <li class="row-item">
                    <div class="label-wrap"><label for="company">客户单位:</label></div>
                    <div class="ctn-wrap"><input type="text" value="<?php echo $data->company ?>" class="ui-input normal" name="company" id="company" readonly></div>
                </li>
                <li class="row-item">
                    <div class="label-wrap"><label for="source">客户来源:</label></div>
                    <div class="ctn-wrap sel normal">

                        <select name="source" id="source" disabled>
                            <?php if ($data->resource == '1') {?>
                                <option value="1" selected>直接到店</option>
                                <option value="2" >网络平台</option>
                                <option value="3" >客户介绍</option>
                                <option value="4">商家联盟</option>
                                <option value="5">其他</option>
                            <?php  }?>
                            <?php if ($data->resource == '2') {?>
                                <option value="1" >直接到店</option>
                                <option value="2" selected>网络平台</option>
                                <option value="3" >客户介绍</option>
                                <option value="4">商家联盟</option>
                                <option value="5">其他</option>
                            <?php  }?>
                            <?php if ($data->resource == '3') {?>
                                <option value="1" >直接到店</option>
                                <option value="2" >网络平台</option>
                                <option value="3" selected>客户介绍</option>
                                <option value="4">商家联盟</option>
                                <option value="5">其他</option>
                            <?php  }?>
                            <?php if ($data->resource == '4') {?>
                                <option value="1" >直接到店</option>
                                <option value="2" >网络平台</option>
                                <option value="3" >客户介绍</option>
                                <option value="4" selected>商家联盟</option>
                                <option value="5">其他</option>
                            <?php  }?>
                            <?php if ($data->resource == '5') {?>
                                <option value="1" >直接到店</option>
                                <option value="2" >网络平台</option>
                                <option value="3" >客户介绍</option>
                                <option value="4">商家联盟</option>
                                <option value="5" selected>其他</option>
                            <?php  }?>
                        </select>
                    </div>
                </li>
                <li class="row-item">
                    <div class="label-wrap"><label for="adviser">服务顾问:</label></div>
                    <div class="ctn-wrap"><input type="text" value="<?php echo $data->service ?>" class="ui-input normal" name="adviser" id="adviser" readonly></div>
                </li>
                <li class="row-item">
                    <div class="label-wrap"><label for="record">建档时间:</label></div>
                    <div class="ctn-wrap"><input type="date" value="<?php echo $data->time ?>" class="ui-input normal" name="record" id="record" readonly></div>
                </li>
                <li class="row-item">
                    <div class="label-wrap"><label for="address">地址:</label></div>
                    <div class="ctn-wrap"><input type="text" value=" <?php echo $data->address ?>" class="ui-input normal" name="address" id="address" readonly></div>
                </li>
            </ul>


<!--        开票抬头-->

            <ul style="font-size: 20px;font-weight: bold" class="clearfix">
                <li style="float:left;">开票信息</li>
                <li style="float:right;"><button type="button" class="invoices" style="width: 60px;height: 30px;font-size: 16px;font-weight: bold">修改</button></li>
                <li style="float:right;"><button type="button" class="invoices" id="invoice" style="width: 60px;height: 30px;font-size: 16px;font-weight: bold;display: none;">保存</button></li>
            </ul>
            <ul class="mod-form-rows base-form clearfix" id="base-form">
                <li class="row-item">
                    <div class="label-wrap"><label for="rise">开票抬头:</label></div>
                    <div class="ctn-wrap invoice-input"><input type="text" value="<?php echo $data->rise ?>" class="ui-input normal1" name="rise" id="rise" readonly></div>
                </li>
                <li class="row-item">
                    <div class="label-wrap"><label for="address">公司地址:</label></div>
                    <div class="ctn-wrap invoice-input"><input type="text" value="<?php echo $data->location ?>" class="ui-input normal1" name="location" id="location" readonly></div>
                </li>
                <li class="row-item">
                    <div class="label-wrap"><label for="bank">开户银行:</label></div>
                    <div class="ctn-wrap invoice-input"><input type="text" value="<?php echo $data->bank ?>" class="ui-input normal1" name="bank" id="bank" readonly></div>
                </li>
                <li class="row-item">
                    <div class="label-wrap" style="width: 80px;"><label for="distinguish">纳税人识别号:</label></div>
                    <div class="ctn-wrap invoice-input"><input type="text" value="<?php echo $data->distinguish ?>" class="ui-input normal1" name="distinguish" id="distinguish" readonly></div>
                </li>
                <li class="row-item">
                    <div class="label-wrap"><label for="tel">公司电话:</label></div>
                    <div class="ctn-wrap invoice-input"><input type="text" value="<?php echo $data->mobilephone ?>" class="ui-input normal1" name="mobile" id="mobile" readonly></div>
                </li>
                <li class="row-item">
                    <div class="label-wrap"><label for="number">银行账号:</label></div>
                    <div class="ctn-wrap invoice-input"><input type="text" value="<?php echo $data->number ?>" class="ui-input normal1" name="number" id="number" readonly></div>
                </li>
            </ul>


<!--        储值卡-->
        <ul style="font-size: 20px;font-weight: bold">储值卡</ul>
        <div class="table item">
            <table>
                <thead>
                <tr>
                    <th>卡类型</th>
                    <th>充值/扣款</th>
                    <th>卡号</th>
                    <th>绑定车辆</th>
                    <th>余额</th>
                    <th>现金账户</th>
                    <th>到期时间</th>
                    <th>状态</th>
                    <th>所属门店</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span><a tabTxt="车辆信息" parentOpen="true" rel="pageTab" href="<?php echo site_url('settings/car_detail?id=1')?>" class="ui-btn mrb detail">查看</a></span></td><!--放id-->
                </tr>
                </tbody>
            </table>
        </div>

<!--        VIP卡-->
        <ul style="font-size: 20px;font-weight: bold">VIP卡</ul>
        <div class="table item">
            <table>
                <thead>
                <tr>
                    <th>卡名称</th>
                    <th>卡类型</th>
                    <th>卡号</th>
                    <th>绑定车辆</th>
                    <th>售价</th>
                    <th>到期时间</th>
                    <th>状态</th>
                    <th>开卡门店</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span><a tabTxt="车辆信息" parentOpen="true" rel="pageTab" href="<?php echo site_url('settings/car_detail?id=1')?>" class="ui-btn mrb detail">查看</a></span></td><!--放id-->
                </tr>
                </tbody>
            </table>
        </div>

<!--        套餐-->
        <ul style="font-size: 20px;font-weight: bold">套餐</ul>
        <div class="table item">
            <table>
                <thead>
                <tr>
                    <th>套餐名称</th>
                    <th>套餐价格</th>
                    <th>套餐内容</th>
                    <th>剩余</th>
                    <th>到期时间</th>
                    <th>状态</th>
                    <th>所属门店</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span><a tabTxt="车辆信息" parentOpen="true" rel="pageTab" href="<?php echo site_url('settings/car_detail?id=1')?>" class="ui-btn mrb detail">查看</a></span></td><!--放id-->
                </tr>
                </tbody>
            </table>
        </div>

<!--        车辆信息-->
        <ul style="font-size: 20px;font-weight: bold">车辆信息</ul>
        <div class="table item">
            <table>
                <thead>
                    <tr>
                        <th>车牌号</th>
                        <th>车型</th>
                        <th>车主姓名</th>
                        <th>保险到期时间</th>
                        <th>下次保养时间</th>
                        <th>当前里程</th>
                        <th>VIN码</th>
                        <th>车辆价格</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                        <td><span><a tabTxt="车辆信息" parentOpen="true" rel="pageTab" href="<?php echo site_url('settings/car_detail?id=1')?>" class="ui-btn mrb detail">查看</a></span></td><!--放id-->
                    </tr>
                </tbody>
            </table>
        </div>

<!--        服务记录&&历史维修记录-->
        <ul style="font-size: 16px;line-height: 30px" class="clearfix">
            <li style="float: left"><a href="javascript:void(0);" class="history on">服务记录</a></li>
            <li style="float: left">&nbsp;&nbsp;&nbsp;&nbsp;</li>
            <li style="float: left"><a href="javascript:void(0);" class="history">历史维修记录</a></li>
        </ul>
        <div class="table item" id="service">
            <table>
                <thead>
                <tr>
                    <th>车牌号</th>
                    <th>车辆信息</th>
                    <th>服务门店</th>
                    <th>服务时间</th>
                    <th>服务性质</th>
                    <th>服务项目</th>
                    <th>消费金额</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="table item" id="history" style="display: none;">
            <table>
                <thead>
                <tr>
                    <th>车牌号</th>
                    <th>车辆信息</th>
                    <th>里程数</th>
                    <th>服务门店</th>
                    <th>服务时间</th>
                    <th>服务性质</th>
                    <th>服务项目</th>
                    <th>所需物料</th>
                    <th>消费金额</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                    <td><span>2hgtr4weh4efe3gerrgrwhtbvrgweh56t56t4</span></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>

        //个人信息
        $('.person').on('click',function () {
            $('.person').css('display','');
            $(this).css('display','none');
            if ($(this).html() == '修改'){
                $('.normal').addClass('edit');
                $('.edit').removeClass('normal');
                $('.edit').removeAttr('readonly');
                $('.edit select').removeAttr('disabled');
            } else{
                $('.edit').addClass('normal');
                $('.normal').removeClass('edit');
            }
        });
        //开票信息
        $('.invoices').on('click',function () {
            $('.invoices').css('display','');
            $(this).css('display','none')
            if ($(this).html() == '修改'){

                $('.normal1').addClass('edit1');
                $('.edit1').removeClass('normal1');
                $('.edit1').removeAttr('readonly');
            } else{
                $('.edit1').addClass('normal1');
                $('.normal1').removeClass('edit1');

            }
        });
        // 服务记录&&历史维修记录
        $('.history').on('click',function () {
            $('.history').removeClass('on');
            $(this).addClass('on');
            if ($(this).html() == '服务记录') {
                $('#service').css('display','');
                $('#history').css('display','none');
            }else{
                $('#service').css('display','none');
                $('#history').css('display','');
            }
        })

 //用户信息修改提交
    $("#people").click(function(){
        var name = $("#name").val();
        var birthday = $("#birthday").val();
        var gender = $("#gender").val();
        var tel = $("#tel").val();
        var company = $("#company").val();
        var source = $("#source").val();
        var adviser = $("#adviser").val();
        var record = $("#record").val();
        var address = $("#address").val();
        var id = $("#id").val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('customer/people');?>",
            traditional: true,
            data: {
                name: name,
                birthday: birthday,
                gender:gender,
                tel:tel,
                company:company,
                source:source,
                adviser:adviser,
                record:record,
                address:address,
                id:id,
            },
            dataType: "json",

            success: function (data) {
                console.log(data);
                if(data.code == 0){
                    $("#name").val(name);
                    $("#birthday").val(birthday);
                    $("#gender").val(gender);
                    $("#tel").val(tel);
                    $("#company").val(company);
                    $("#source").val(source);
                    $("#adviser").val(adviser);
                    $("#record").val(record);
                    $("#address").val(address);

                    $('.edit').addClass('normal');
                    $('.normal').removeClass('edit');
                    $('.normal').attr('readonly',true);
                    $('.normal select').attr('disabled',true);
                }else if (data.code == 1){
                    alert(data.text);
                } else{
                    alert("未知错误");
                }

            },
        });
    });

    // 发票信息修改提交
    $("#invoice").click(function(){
        var rise = $("#rise").val();
        var location = $("#location").val();
        var bank = $("#bank").val();
        var distinguish = $("#distinguish").val();
        var mobile = $("#mobile").val();
        var number = $("#number").val();

        var id = $("#id").val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('customer/invoice');?>",
            traditional: true,
            data: {
                rise: rise,
                location: location,
                bank:bank,
                distinguish:distinguish,
                mobile:mobile,
                number:number,
                id:id,
            },
            dataType: "json",

            success: function (data) {

                if(data.code == 0){
                    $("#rise").val(rise);
                    $("#location").val(location);
                    $("#bank").val(bank);
                    $("#distinguish").val(distinguish);
                    $("#mobile").val(mobile);
                    $("#number").val(number);

                    $('.edit1').addClass('normal1');
                    $('.normal1').removeClass('edit1');
                    $('.normal1').attr('readonly',true);
                    $('.normal1 select').attr('disabled',true);
                }else if (data.code == 1){
                    alert(data.text);
                } else{
                    alert("未知错误");
                }

            },
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
                this.href = href + dateParams;
        });
    }

    var goodsCombo = Business.goodsCombo($('#goodsAuto'), {
        extraListHtml: ''
    });
</script>
</body>
</html>


 