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
    .item> .row-item> .label-wrap{
        width: 120px;
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
    .selectItem{
        border: none;
        outline: none;
        width: 100%;
        height: 20px;
        line-height: 30px;
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
    .item{
        border-bottom: 1px solid #bbb;
        padding-bottom: 20px;
        margin-bottom: 20px;
    }
    .item:last-child{
        border: none;
    }
</style>
</head>
<body>
    <div class="wrapper">
        <span id="config" class="ui-icon ui-state-default ui-icon-config"></span>
        <div class="bills">
            <div class="grid-wrap mb10" id="acGridWrap">
                <form id="manage-form" action="">
                    <ul style="font-size: 20px;font-weight: bold">基本信息</ul>
                    <ul class="mod-form-rows base-form clearfix item" id="base-form">
                        <li class="row-item">
                            <div class="label-wrap"><label for="number">车牌号:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="number" id="number"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="vin">VIN码:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="vin" id="vin"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="name">车主姓名:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="name" id="name"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="brand">品牌:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="brand" id="brand"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="notice">公告号:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="notice" id="notice"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="tel">车主电话:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="tel" id="tel"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="system">车系:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="system" id="system"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="engine">发动机号:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="engine" id="engine"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="id">身份证号:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="id" id="id"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="annual">车型年款:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="annual" id="annual"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="color">车辆颜色:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="color" id="color"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="address">车主地址:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="address" id="address"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="shape">车型:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="shape" id="shape"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="price">车辆价格:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="price" id="price"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="type">车辆类型:</label></div>
                            <div class="ctn-wrap sel">
                                <select name="type" class="selectItem" id="type">
                                    <option value="1" selected>小型轿车</option>
                                    <option value="2">大型汽车</option>
                                    <option value="3">专用汽车</option>
                                    <option value="4">特种车</option>
                                    <option value="5">三轮摩托车</option>
                                </select>
                            </div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="registration">注册时间:</label></div>
                            <div class="ctn-wrap"><input type="date" value="" class="ui-input" name="registration" id="registration"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="review">年审到期:</label></div>
                            <div class="ctn-wrap"><input type="date" value="" class="ui-input" name="review" id="review"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="nature">使用性质:</label></div>
                            <div class="ctn-wrap sel">
                                <select name="nature" class="selectItem" id="nature">
                                    <option value="1" selected>营运</option>
                                    <option value="2">非营运</option>
                                </select>
                            </div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="administrator">车辆管理者:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="administrator" id="administrator"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="phone">管理者电话:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="phone" id="phone"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="displacement">排量:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="displacement" id="displacement"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="front">前轮型号:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="front" id="front"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="rear">后轮型号:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="rear" id="rear"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="transmission">变速箱型号:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="transmission" id="transmission"></div>
                        </li>
                    </ul>


                    <ul style="font-size: 20px;font-weight: bold">保养</ul>
                    <ul class="mod-form-rows base-form clearfix item" id="base-form">
                        <li class="row-item">
                            <div class="label-wrap"><label for="currentMileage">当前里程(KM):</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="currentMileage" id="currentMileage"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="adviceMileage">建议保养里程(KM):</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="adviceMileage" id="adviceMileage"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="adviceTime">建议保养时间(KM):</label></div>
                            <div class="ctn-wrap"><input type="date" value="" class="ui-input" name="adviceTime" id="adviceTime"></div>
                        </li>
                    </ul>


                    <ul style="font-size: 20px;font-weight: bold">保险</ul>
                    <ul class="mod-form-rows base-form clearfix item" id="base-form">
                        <li class="row-item">
                            <div class="label-wrap"><label for="compulsoryTime">交强险到期时间:</label></div>
                            <div class="ctn-wrap"><input type="date" value="" class="ui-input" name="compulsoryTime" id="compulsoryTime"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="compulsoryNo">交强险保单号:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="compulsoryNo" id="compulsoryNo"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="compulsoryCompany">交强险保险公司:</label></div>
                            <div class="ctn-wrap sel">
                                <select name="compulsoryCompany" class="selectItem" id="compulsoryCompany">
                                    <option value="0" selected>---请选择交强险公司---</option>
                                    <option value="1">太平洋车险</option>
                                    <option value="1">平安车险</option>
                                    <option value="1">人保车险</option>
                                    <option value="1">中国人寿财险</option>
                                    <option value="1">中华联合车险</option>
                                    <option value="1">大地车险</option>
                                    <option value="1">阳光车险</option>
                                    <option value="1">太平车险</option>
                                    <option value="1">华安车险</option>
                                    <option value="1">天安车险</option>
                                    <option value="1">英大泰和车险</option>
                                    <option value="1">安盛天平车险</option>
                                    <option value="1">安心车险</option>
                                    <option value="1">紫金车险</option>
                                    <option value="1">合众车险</option>
                                    <option value="1">利保车险</option>
                                    <option value="1">其他</option>
                                </select>
                            </div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="compulsorySale">交强险销售人员:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="compulsorySale" id="compulsorySale"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="commercialTime">商业险到期时间:</label></div>
                            <div class="ctn-wrap"><input type="date" value="" class="ui-input" name="commercialTime" id="commercialTime"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="commercialCompany">商业险保险公司:</label></div>
                            <div class="ctn-wrap sel">
                                <select name="commercialCompany" class="selectItem" id="commercialCompany">
                                    <option value="0" selected>---请选择商业险公司---</option>
                                    <option value="1">太平洋车险</option>
                                    <option value="1">平安车险</option>
                                    <option value="1">人保车险</option>
                                    <option value="1">中国人寿财险</option>
                                    <option value="1">中华联合车险</option>
                                    <option value="1">大地车险</option>
                                    <option value="1">阳光车险</option>
                                    <option value="1">太平车险</option>
                                    <option value="1">华安车险</option>
                                    <option value="1">天安车险</option>
                                    <option value="1">英大泰和车险</option>
                                    <option value="1">安盛天平车险</option>
                                    <option value="1">安心车险</option>
                                    <option value="1">紫金车险</option>
                                    <option value="1">合众车险</option>
                                    <option value="1">利保车险</option>
                                    <option value="1">其他</option>
                                </select>
                            </div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="commercialNo">商业险保单号:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="commercialNo" id="commercialNo"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="commercialSale">商业险销售人员:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="commercialSale" id="commercialSale"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="policyHolder">投保人:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="policyHolder" id="policyHolder"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="insured">被保险人:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="insured" id="insured"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="remarks">保险备注:</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="remarks" id="remarks"></div>
                        </li>
                    </ul>
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
                if(data.code == 0){
                    alert(data.text);
                    location.href = "<?php echo site_url('customer')?>";
                }else if (data.code == 1){
                    alert(data.text);
                } else{
                    alert("未知错误");
                }

            },
        });
    });
</script>
</html>


 