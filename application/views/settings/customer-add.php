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
<link href="<?php echo base_url()?>statics/css/<?php echo sys_skin()?>/bills.css?ver=20150427" rel="stylesheet" type="text/css">
<style>
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
        /*margin-bottom: 5px;*/
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
    .btn{
        width: 70px;
        height: 30px;
        color: #555;
        border: 1px solid #c1c1c1;
        border-radius: 2px;
        box-shadow: 0 1px 1px rgba(0,0,0,.15);
        font: 14px/2 \5b8b\4f53;
        background: -webkit-gradient(linear,0 0,0 100%,from(#fff),to(#f4f4f4));
        vertical-align: middle;
        cursor: pointer;
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
</style>
</head>
<body>
    <div class="wrapper">
        <span id="config" class="ui-icon ui-state-default ui-icon-config"></span>
        <div class="bills">
            <div class="grid-wrap mb10" id="acGridWrap">
                <form id="manage-form" action="">
                    <ul style="font-size: 20px;font-weight: bold">个人资料</ul>
                    <ul class="mod-form-rows base-form clearfix" id="base-form">
                        <li class="row-item">
                            <div class="label-wrap"><label for="name">姓名:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="name" id="name"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="birthday">生日:</label></div>
                            <div class="ctn-wrap"><input type="date" value="" class="ui-input" name="birthday" id="birthday"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="gender">性别:</label></div>
                            <div class="ctn-wrap sel">
                                <select name="gender" id="gender">
                                    <option value="1" selected>男</option>
                                    <option value="2">女</option>
                                </select>
                            </div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="tel">联系方式:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="tel" id="tel"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="company">客户单位:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="company" id="company"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="source">客户来源:</label></div>
                            <div class="ctn-wrap sel">
                                <select name="source" id="source">
                                    <option value="1">直接到店</option>
                                    <option value="2">网络平台</option>
                                    <option value="3">客户介绍</option>
                                    <option value="4">商家联盟</option>
                                    <option value="5">其他</option>
                                </select>
                            </div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="adviser">服务顾问:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="adviser" id="adviser"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="record">建档时间:</label></div>
                            <div class="ctn-wrap"><input type="date" value="" class="ui-input" name="record" id="record"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="address">地址:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="address" id="address"></div>
                        </li>
                    </ul>
                    <ul style="font-size: 20px;font-weight: bold">车辆信息</ul>
                    <button type="button" class="btn btn_add"><input type="hidden" value="0" id="num">添加</button>
                </form>
                <div style="height: 30px;text-align: center;">
                    <button type="button" class="btn" id="submit" style="border: 1px solid #3279a0;background: -webkit-gradient(linear,0 0,0 100%,from(#4994be),to(#337fa9));color: #fff;">保存</button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url()?>statics/js/dist/customer_add.js"></script>
</body>
<script>
    $("#submit").click(function () {
        var name = $("#name").val();
        var birthday = $("#birthday").val();
        var gender = $("#gender").val();
        var tel = $("#tel").val();
        var company = $("#company").val();
        var source = $("#source").val();
        var adviser = $("#adviser").val();
        var record = $("#record").val();
        var address = $("#address").val();

        // if(!name){
        //     alert("姓名不能为空");
        // }

        var car = new Array();

        $.each($(".car"),function(i){

            id = $(this).attr("id");
            car.push({"plateNo":$("#plateNo_"+id).val(),"brand":$("#brand_"+id).val(),"system":$("#system_"+id).val(),"buytime":$("#buytime_"+id).val(),"hasCheck":$("#hasCheck_"+id).val(),"notCheck":$("#notCheck_"+id).val()});

        });

        var cars = JSON.stringify(car);//专业能力数组用JSON序列化
console.log(cars);
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('customer/add');?>",
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
                car:cars,
            },
            dataType: "json",

            success: function (data) {
                console.log(data);

            },
        });
    });
</script>
</html>


 