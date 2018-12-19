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
<link href="<?php echo base_url()?>statics/css/help/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo base_url()?>statics/css/help/theme-default.css" rel="stylesheet" type="text/css" id="indexFile">
<style>
    .page-content-wrap{
        margin-top: 1%;
    }
    .panel.panel-default {
        margin-bottom: 10%;
    }
    /*内容*/
    .faq .faq-item {
        width: 100%;
        float: left;
        padding: 10px 15px;
        /*border-bottom: 1px solid #bdbbbb;*/
    }
    .faq .faq-item .faq-text{
        overflow: auto;
    }
    .faq .buy{
        display: block;
    }
    /*下拉目录*/
    .select-menu{
        margin-bottom: 1%;
    }
    .select-menu-ul{
        margin-top:50px;
        list-style:none;
        opacity:0;
        display:none;
        width:200px;
        text-align:left;
        border:1px solid #ddd;
        background:white;
        position:absolute;
        z-index:1;
        height: 100px;
        overflow: auto;
        cursor: pointer;
    }
    .select-menu-ul li{
        padding:2% 0 2% 3%;

    }
    .select-menu-ul li:hover{
        background:white;

    }
    .select-menu-div{
        position:relative;
        height:30px;
        width:200px;
        background-color: white;
        border:1px solid #ddd;
        line-height:30px;
    }
    .select-this{
        background:#6892cc;
    }
    .select-this:hover{
        background:#6892cc!important;
    }
    i{
        margin-right:5px;
        position:absolute;
        right:0;
        top:7px;

    }
    .select-menu-input{
        margin-left:3%;
        border:0;
        height:29px;
        cursor:pointer;
        user-select:none;
        background-color: white;
    }
    .select-menu-i{
        transform:rotate(180deg);

    }
    i{
        -webkit-transition: all 0.4s ease;
        -o-transition: all 0.4s ease;
        transition: all 0.4s ease;
    }
    .faq-item{
        display: none;
    }
    .faq-text img{
        height: 400px;
        margin-left: 25px
    }
</style>
</head>
<body>
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">
            <!--下拉目录-->
            <div class="select-menu">
                <div class="select-menu-div">
                    <input id="No1" readonly class="select-menu-input"/>

                    <i class="fa fa-caret-down"></i>
                </div>
                <ul class="select-menu-ul" >
                    <li class="select-this" id="buy">购货单</li>
                    <li id="sale">销货单</li>
                    <li id="storage">调拨单</li>
                    <li id="pandian">库存查询</li>
                    <li id="otherWarehouse">其他入库单</li>
                    <li id="otherOutbound">其他出库单</li>
<!--                    <li id="cost">成本调整单</li>-->
                    <li id="receipt">收款单</li>
                    <li id="payment">付款单</li>
                    <li id="reportForm">报表查询</li>
                    <li id="base">基础资料</li>
                    <li id="auxiliary">辅助资料</li>
                    <li id="set">高级设置</li>
                    <li id="skill">操作技巧</li>
                </ul>
            </div>
            <!--下拉目录end-->
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class="push-down-0">帮助</h3>
                </div>


                <!--内容-->
                <div class="panel-body faq">
                    <!--购货单-->
                    <div class="faq-item buy">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>新增购货单</div>
                        <div class="faq-text">
                            <a href="<?php echo base_url()?>statics/images/购货单.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/购货单.png"/></a>
                            <p>
                                购货页签->购货单，可新建购货单<br>
                                1、 主要步骤：录入购货单位->录入商品->录入数量->录入购货单价->仓库->本次付款->结算账户->保存或保存并新增。<br>
                                2、 提供两种业务类型，其中“购货”可处理日常的入库业务，数量自动为正；采购退货选择“退货”类型，数量录入也为正，在单据列表中会红字显示，在报表中会显示为负数。<br>
                                3、 在“购货单位”后面的框中录入供应商名称，对已存在的供应商，系统自动过滤出来供选择；对不存在的供应商，可点击下拉箭头，打开“新增供应商”可新增。<br>
                                4、 在“商品”下面的空白字段中录入输入商品编号，规格型号或名称，对已存在的货品，系统自动过滤供选择，不存在的商品，可打开“新增商品”网页框新增。  <br>
                                5、 “商品”中如果是已存在的商品，则计量单位自动带出，且不可再修改。<br>
                                6、 单据中的数量及单价字段分以下几种情况处理：<br>
                                &emsp;A． 编辑单据时如果为新增的商品，则数量默认为1、单价默认为0，都可手工修改；<br>
                                &emsp;B． 编辑单据时如果商品为选择的已存在商品，数量默认为1，单价会自动带出商品资料中的“预计采购价”，可手工修改；<br>
                                &emsp;C．数量与单价不能录入负数。<br>
                                7、 系统默认购货金额自动等于数量乘以单价，金额合计自动等于金额之和；如果修改金额自动回推单价。<br>
                                8，输入数量和金额后，输入折扣率，会自动计算出折扣额，若输入折扣额，也会反算出折扣额，购货金额为折扣后金额。<br>
                                9，标准版中，在系统参数中可“启用税金”，单据界面会出现税率，税额，价税合计等列。选择供应商和商品后，会自动携带出该供应商档案中设置的“税率”，并根据金额计算税额及加税合计。<br>
                                10、本次付款默认0，可以修改；单据保存时，如果（金额合计-本次付款）大于0，保存时将差额自动增加供应商的应付款。<br>
                                11、结算账户：将单据上“本次付款”中的金额统计到具体的账户；点击“多账户”，可录入多个结算账户进行付款。<br>
                                12、单据保存后，打印按钮才会显示出来。<br>
                            </p>
                        </div>
                    </div>
                    <div class="faq-item buy">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>查询/修改/已确认/删除/打印购货单</div>
                        <div class="faq-text">
                            <p>
                                购货页签->购货记录，可以按条件查找已保存的所有进货单。<br>
                                1、查找：按照供应商、单据编号，备注和日期范围进行单据查找；<br>
                                2、修改、删除：选中一笔单据可以修改、删除；<br>
                                3、已确认：批量当前列表中已勾选的单据；<br>
                                4、打印：批量打印当前列表中已勾选的单据。可选择已预设的模板打印，也可以申请设计自定义模板。
                            </p>
                        </div>
                    </div>
                    <!--销货单-->
                    <div class="faq-item sale">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>新增销货单</div>
                        <div class="faq-text">
                            <a href="<?php echo base_url()?>statics/images/销货单.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/销货单.png"/></a>
                            <p>
                                1、 新建销货单主要步骤：录入销货单位->录入商品->录入数量->录入销售单价->仓库->本次收款->结算账户->保存或保存并新增。<br>
                                2、 提供两种业务类型，其中“销货”可处理日常的入库业务，数量自动为正；销售退货选择“退货”类型，数量录入也为正，在单据列表中会红字显示，在报表中会显示为负数。<br>
                                3、 在“销货单位”后面的框中录入客户名称，对已存在的客户，系统自动过滤出来供选择；对不存在的客户，可点击下拉箭头，打开“新增客户”可新增。<br>
                                4、 在“商品”下面的空白字段中录入输入商品编号，规格型号或名称，对已存在的货品，系统自动过滤供选择，不存在的商品，可打开“新增商品”网页框新增。<br>
                                5、 “商品”中如果是已存在的商品，则计量单位自动带出，且不可再修改。<br>
                                6、 单据中的数量及单价字段分以下几种情况处理：<br>
                                &emsp;A． 编辑单据时如果为新增的商品，则数量默认为1、单价默认为0，都可手工修改；<br>
                                &emsp;B． 编辑单据时如果商品为选择的已存在商品，数量默认为1，单价会自动带出商品资料中的“预计销售价”，可手工修改；<br>
                                &emsp;C．数量与单价不能录入负数。<br>
                                7、 系统默认销货金额自动等于数量乘以单价，金额合计自动等于金额之和；如果修改金额自动回推单价。<br>
                                8、输入数量和金额后，输入折扣率，会自动计算出折扣额，若输入折扣额，也会反算出折扣额，销货金额为折扣后金额。<br>
                                9、标准版中，在系统参数中可“启用税金”，单据界面会出现税率，税额，价税合计等列。选择商品后，会自动携带出系统参数中设置的“税率”，并根据金额计算税额及加税合计。<br>
                                10、本次收款默认0，可以修改；单据保存时，如果（金额合计-本次收款）大于0，保存时将差额自动增加客户的应收款。  <br>
                                11、结算账户：将单据上“本次收款”中的金额统计到具体的账户；点击“多账户”，可录入多个结算账户进行收款。<br>
                                12、单据保存后，打印按钮才会显示出来。<br>
                            </p>
                        </div>
                    </div>
                    <div class="faq-item sale">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>查询/修改/已确认/删除/打印销货单</div>
                        <div class="faq-text">
                            <p>
                                销货页签->销货记录，可以按条件查找已保存的所有销货单。<br>
                                1、查找：按照客户、单据编号，备注和日期范围进行单据查找；<br>
                                2、修改、删除：选中一笔单据可以修改、删除；<br>
                                3、已确认：批量当前列表中已勾选的单据；<br>
                                4、打印：批量打印当前列表中已勾选的单据。可选择已预设的模板打印，也可以申请设计自定义模板。
                            </p>
                        </div>
                    </div>
                    <!--调拨单-->
                    <div class="faq-item storage">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>新增调拨单</div>
                        <div class="faq-text">
                            <a href="<?php echo base_url()?>statics/images/调拨单.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/调拨单.png"/></a>
                            <p>
                                1、新建调拨单主要步骤：录入商品->录入数量->录入调出仓库->录入调入仓库->保存或保存并新增。<br>
                                2、数量默认为1，可以修改。<br>
                                3、调出仓库为商品档案中设置的“首选仓库”，可以修改。<br>
                                4、可以批量录入所有分录的调入仓库，也可以修改。<br>
                                5、调拨单保存后，单据中的商品，在调出仓库中的数量减少，在调入仓库中的数量增加。商品的库存成本金额不会改变。
                            </p>
                        </div>
                    </div>
                    <div class="faq-item storage">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>查询/修改/已确认/删除/打印调拨单</div>
                        <div class="faq-text">
                            <p>
                                仓库页签->调拨记录，可以按条件查找已保存的所有调拨单。<br>
                                1、查找：按照单据编号，备注和日期范围进行单据查找；在“高级搜索”中，可按仓库查找。<br>
                                2、修改、删除：选中一笔单据可以修改、删除；<br>
                                3、已确认：批量当前列表中已勾选的单据；<br>
                                4、打印：批量打印当前列表中已勾选的单据。可选择已预设的模板打印，也可以申请设计自定义模板。
                            </p>
                        </div>
                    </div>
                    <!--库存查询-->
                    <div class="faq-item pandian">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>库存查询</div>
                        <div class="faq-text">
                            <p>
                                仓库页签->库存查询，可以定期调整库存数量。<br>
                                1、选择仓库和商品类别，也可输入指定商品编号，若均为空则默认查询所有仓库中所有商品的系统库存；<br>
                                2、 在“库存查询”中录入实际库存数量，若与系统库存数量不一致，则自动显示盘盈盘亏数量：<br>
                                系统库存<实际库存——盘盈为正。系统库存>实际库存——盘亏为负；<br>
                                3、点击“生成单据”，会自动生成盘亏单和盘盈单，这两张单据在其他入库，其他出库记录中找；<br>
                                4、也可以直接手工录入其他入库——盘盈，其他出库——盘亏，调整库存数量。<br>
                                <a href="<?php echo base_url()?>statics/images/盘点.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/盘点.png"/></a>
                            </p>
                        </div>
                    </div>
                    <!--其他入库单-->
                    <div class="faq-item otherWarehouse">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>新增其他入库单</div>
                        <div class="faq-text">
                            <a href="<?php echo base_url()?>statics/images/其他入库单.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/其他入库单.png"/></a>
                            <p>
                                1、新建其他入库单主要步骤：选择业务类别->录入商品->录入数量->录入入库单价->录入仓库->保存或保存并新增。<br>
                                2、其他入库单用于处理购货之外的增加商品库存的业务，比如盘盈，借入，接受捐赠等等。<br>
                                3、其他入库单保存后，商品的库存数量及成本增加。
                            </p>
                        </div>
                    </div>
                    <div class="faq-item otherWarehouse">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>查询/修改/已确认/删除/打印其他入库单</div>
                        <div class="faq-text">
                            <p>
                                仓库页签->其他入库记录，可以按条件查找已保存的所有其他入库单。<br>
                                1、查找：按照单据编号，供应商名称，备注和日期范围进行单据查找；在“高级搜索”中，可按仓库和业务类型查找。<br>
                                2、修改、删除：选中一笔单据可以修改、删除；<br>
                                3、已确认：批量当前列表中已勾选的单据；<br>
                                4、打印：批量打印当前列表中已勾选的单据。可选择已预设的模板打印，也可以申请设计自定义模板。
                            </p>
                        </div>
                    </div>
                    <!--其他出库单-->
                    <div class="faq-item otherOutbound">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>新增其他出库单</div>
                        <div class="faq-text">
                            <a href="<?php echo base_url()?>statics/images/其他出库单.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/其他出库单.png"/></a>
                            <p>
                                1、新建其他出库单主要步骤：选择业务类别->录入商品->录入数量->录入仓库->保存或保存并新增。<br>
                                2、其他出库单用于处理销货之外的减少商品库存的业务，比如盘亏，借出，领用材料等等。<br>
                                3、单据中的“出库单位成本”及“出库成本”不能录入，当单据保存后，会根据存货计价方法计算出此时的出库单位成本，并填入单据中。<br>
                                4、其他出库单保存后，商品的库存数量及成本减少。
                            </p>
                        </div>
                    </div>
                    <div class="faq-item otherOutbound">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>查询/修改/已确认/删除/打印其他出库单</div>
                        <div class="faq-text">
                            <p>
                                仓库页签->其他出库记录，可以按条件查找已保存的所有其他出库单。<br>
                                1、查找：按照单据编号，客户名称，备注和日期范围进行单据查找；在“高级搜索”中，可按仓库和业务类型查找。<br>
                                2、修改、删除：选中一笔单据可以修改、删除；<br>
                                3、已确认：批量当前列表中已勾选的单据；<br>
                                4、打印：批量打印当前列表中已勾选的单据。可选择已预设的模板打印，也可以申请设计自定义模板。
                            </p>
                        </div>
                    </div>
                    <!--成本调整单-->
<!--                    <div class="faq-item cost">-->
<!--                        <div class="faq-title"><span class="fa fa-angle-down"></span>新增成本调整单</div>-->
<!--                        <div class="faq-text">-->
<!--                            <a href="--><?php //echo base_url()?><!--statics/images/成本调整单.png" class="flipLightBox"><img src="--><?php //echo base_url()?><!--statics/images/成本调整单.png"/></a>-->
<!--                            <p>-->
<!--                                1、新建成本调整单主要步骤：录入商品->录入调整金额->录入仓库->保存或保存并新增。<br>-->
<!--                                2、成本调整单用于修改商品的结存成本。调整金额为正数时，该商品的结存总成本增加，调整金额为负数是，该商品的结存总成本减少。-->
<!--                            </p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="faq-item cost">-->
<!--                        <div class="faq-title"><span class="fa fa-angle-down"></span>查询/修改/删除/打印成本调整单</div>-->
<!--                        <div class="faq-text">-->
<!--                            <p>-->
<!--                                仓库页签->成本调整单记录，可以按条件查找已保存的所有成本调整单。<br>-->
<!--                                1、查找：按照单据编号，备注，仓库和日期范围进行单据查找。<br>-->
<!--                                2、修改、删除：选中一笔单据可以修改、删除；<br>-->
<!--                                3、打印：打开一张单据，在编辑界面点击打印；-->
<!--                            </p>-->
<!--                        </div>-->
<!--                    </div>-->
                    <!--收款单-->
                    <div class="faq-item receipt">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>新增收款单</div>
                        <div class="faq-text">
                            <a href="<?php echo base_url()?>statics/images/收款单.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/收款单.png"/></a>
                            <a href="<?php echo base_url()?>statics/images/收款单选择源单.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/收款单选择源单.png"/></a>
                            <p>
                                1、新建收款单主要步骤：标准版收款单可对应收记录进行核销 <br>
                                若是不需对应收款进行核销，选择销货单位->录入结算账户->录入收款金额->保存或保存并新增。<br>
                                若是需要对应收款进行核销，选择销货单位->录入结算账户->录入收款金额->选择源单->录入本次核销金额->保存或保存并新增。<br>
                                2、当没有对源单进行核销时，本次收款即为预收款。<br>
                                3、当需要对未收款的单据进行收款时，可选择源单，打开为结算完的应收单据明细，进行勾选。应收源单包括该客户的期初应收款余额及未收完款的销货单据。<br>
                                4、整单折扣是对本次核销金额的抵减项，比如本次核销1050，实际收款1000，则折扣为50。<br>
                                5、本次预收款是本次实际收款大于核销金额的差额，比如本次收款1500，核销1000，则500为预收款。<br>
                                6、当存在核销及折扣时，预收款=本次实际收款-（本次核销金额-整单折扣）。<br>
                                7、当处理退货造成的应收款退回时，源单也可以选择退货单，本次核销金额为负数，本次收款账户可录入负数
                            </p>
                        </div>
                    </div>
                    <div class="faq-item receipt">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>查询/修改/删除/收款单</div>
                        <div class="faq-text">
                            <p>
                                资金页签->收款单记录，可以按条件查找已保存的所有收款单。<br>
                                1、查找：按照单据编号，客户名称，备注和日期范围进行单据查找。<br>
                                2、修改、删除：选中一笔单据可以修改、删除；
                            </p>
                        </div>
                    </div>
                    <!--付款单-->
                    <div class="faq-item payment">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>新增付款单</div>
                        <div class="faq-text">
                            <a href="<?php echo base_url()?>statics/images/付款单.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/付款单.png"/></a>
                            <a href="<?php echo base_url()?>statics/images/付款单选择源单.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/付款单选择源单.png"/></a>
                            <p>
                                1、新建付款单主要步骤：标准版付款单可对应付记录进行核销 <br>
                                若是不需对应付款进行核销，选择购货单位->录入结算账户->录入付款金额->保存或保存并新增。 <br>
                                若是需要对应付款进行核销，选择购货单位->录入结算账户->录入付款金额->选择源单->录入本次核销金额->保存或保存并新增。 <br>
                                2、当没有对源单进行核销时，本次付款即为预付款。 <br>
                                3、当需要对未付款的单据进行付款时，可选择源单，打开为结算完的应付单据明细，进行勾选。应付源单包括该供应商的期初应付款余额及未付完款的购货单据。 <br>
                                4、整单折扣是对本次核销金额的抵减项，比如本次核销1050，实际付款1000，则折扣为50。 <br>
                                5、本次预付款是本次实际付款大于核销金额的差额，比如本次付款1500，核销1000，则500为预付款。 <br>
                                6、当存在核销及折扣时，预付款=本次实际付款-（本次核销金额-整单折扣）。 <br>
                                7、当处理退货造成的应付款退回时，源单也可以选择退货单，本次核销金额为负数，本次付款账户可录入负数
                            </p>
                        </div>
                    </div>
                    <div class="faq-item payment">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>查询/修改/删除/付款单</div>
                        <div class="faq-text">
                            <p>
                                资金页签->付款单记录，可以按条件查找已保存的所有付款单。<br>
                                1、查找：按照单据编号，供应商名称，备注和日期范围进行单据查找。<br>
                                2、修改、删除：选中一笔单据可以修改、删除；
                            </p>
                        </div>
                    </div>
                    <!--报表查询-->
                    <div class="faq-item reportForm">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>采购明细表</div>
                        <div class="faq-text">
                            <p>
                                统计一段时期内商品的采购明细情况，可选择全部供应商、商品、仓库进行统计，也可挑选部分供应商、商品、仓库进行统计。查询界面如下：
                            </p>
                            <a href="<?php echo base_url()?>statics/images/采购明细表.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/采购明细表.png"/></a>
                            <p>
                                1、设置查询条件：<br>
                                A.供应商、商品、仓库如果空表示查找所有供应商、商品、仓库，可分别打开各选择框进行勾选；<br>
                                B.日期范围可以任意调整；<br>
                                C.可选择部分供应商，商品，仓库进行组合查询<br>
                                2、查询条件设置后，点“确定”按条件把查询结果显示在下面列表中；<br>
                                3、查询结果按日期排序；单击某行，可打开该张单据查看；<br>
                                4、打印、导出是指把查询出的数据清单打印或导出；
                            </p>
                        </div>
                    </div>
                    <div class="faq-item reportForm">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>采购汇总表（按商品）</div>
                        <div class="faq-text">
                            <p>
                                统计一段时期内对某商品进行采购的汇总数，可选择全部供应商、商品、仓库进行统计，也可挑选部分供应商、商品、仓库进行统计。查询界面如下：
                            </p>
                            <a href="<?php echo base_url()?>statics/images/采购汇总表（按商品）.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/采购汇总表（按商品）.png"/></a>
                            <p>
                                1、设置查询条件：<br>
                                A.供应商、商品、仓库如果空表示查找所有供应商、商品、仓库，可分别打开各选择框进行勾选；<br>
                                B.日期范围可以任意调整；<br>
                                C.可选择部分供应商，商品，仓库进行组合查询<br>
                                2、查询条件设置后，点“确定”按条件把查询结果显示在下面列表中；<br>
                                3、查询结果按商品编号排序；单击某行，可打开该商品在对应仓库的采购明细表查看；<br>
                                4、打印、导出是指把查询出的数据清单打印或导出；
                            </p>
                        </div>
                    </div>
                    <div class="faq-item reportForm">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>采购汇总表（按供应商）</div>
                        <div class="faq-text">
                            <p>
                                统计一段时期内向某供应商对某商品进行采购的汇总数，可选择全部供应商、商品、仓库进行统计，也可挑选部分供应商、商品、仓库进行统计。查询界面如下：
                            </p>
                            <a href="<?php echo base_url()?>statics/images/采购汇总表（按供应商）.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/采购汇总表（按供应商）.png"/></a>
                            <p>
                                1、设置查询条件：<br>
                                A.供应商、商品、仓库如果空表示查找所有供应商、商品、仓库，可分别打开各选择框进行勾选；<br>
                                B.日期范围可以任意调整；<br>
                                C.可选择部分供应商，商品，仓库进行组合查询<br>
                                2、查询条件设置后，点“确定”按条件把查询结果显示在下面列表中；<br>
                                3、查询结果按供应商排序；单击某行，可打开向该供应商采购某商品到对应仓库的采购明细表查看；<br>
                                4、打印、导出是指把查询出的数据清单打印或导出；
                            </p>
                        </div>
                    </div>
<!--                    <div class="faq-item reportForm">-->
<!--                        <div class="faq-title"><span class="fa fa-angle-down"></span>销售订单跟踪表</div>-->
<!--                        <div class="faq-text">-->
<!--                            <p>-->
<!--                                实时跟踪一段时期内所有销售订单的详细信息，可选择全部客户、商品和三种订单状态进行统计，也可挑选部分客户、商品、状态进行统计。查询界面如下：-->
<!--                            </p>-->
<!--                            <a href="--><?php //echo base_url()?><!--statics/images/销售订单跟踪表.png" class="flipLightBox"><img src="--><?php //echo base_url()?><!--statics/images/销售订单跟踪表.png"/></a>-->
<!--                            <p>-->
<!--                                1、设置查询条件：<br>-->
<!--                                A. 客户、商品、状态如果空表示查找所有客户、商品、状态，可分别打开各选择框进行勾选；<br>-->
<!--                                B. 订单日期、预计交货日期范围可以任意调整；<br>-->
<!--                                C.可选择部分客户、商品、状态进行组合查询；<br>-->
<!--                                2、查询条件设置后，点“确定”按条件把查询结果显示在下面列表中；<br>-->
<!--                                3、查询结果按商品编号排序；双击某行，可打开对应的销售订单查看；<br>-->
<!--                                4、打印、导出是指把查询出的数据清单打印或导出；-->
<!--                            </p>-->
<!--                        </div>-->
<!--                    </div>-->
                    <div class="faq-item reportForm">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>销售明细表</div>
                        <div class="faq-text">
                            <p>
                                统计一段时期内商品的销售明细情况，可选择全部客户、商品、仓库进行统计，也可挑选部分客户、商品、仓库进行统计。查询界面如下：
                            </p>
                            <a href="<?php echo base_url()?>statics/images/销售明细表.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/销售明细表.png"/></a>
                            <p>
                                1、设置查询条件：<br>
                                A.客户、商品、仓库如果空表示查找所有客户、商品、仓库，可分别打开各选择框进行勾选；<br>
                                B.日期范围可以任意调整；<br>
                                C.可选择部分客户，商品，仓库进行组合查询<br>
                                D.可选择排序规格，按销售数量或销售收入的从小到大顺序排泄<br>
                                E.若不勾选“计算毛利”选项，则不显示单位成本，销售成本，销售毛利，毛利率列。<br>
                                2、查询条件设置后，点“确定”按条件把查询结果显示在下面列表中；<br>
                                3、单击某行，可打开该张单据查看；<br>
                                4、打印、导出是指把查询出的数据清单打印或导出；
                            </p>
                        </div>
                    </div>
                    <div class="faq-item reportForm">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>销售汇总表（按商品）</div>
                        <div class="faq-text">
                            <p>
                                统计一段时期内对某商品进行销售的汇总数，可选择全部客户、商品、仓库进行统计，也可挑选部分客户、商品、仓库进行统计。查询界面如下：
                            </p>
                            <a href="<?php echo base_url()?>statics/images/销售汇总表（按商品）.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/销售汇总表（按商品）.png"/></a>
                            <p>
                                1、设置查询条件：<br>
                                A.客户、商品、仓库如果空表示查找所有客户、商品、仓库，可分别打开各选择框进行勾选；<br>
                                B.日期范围可以任意调整；<br>
                                C.可选择部分客户，商品，仓库进行组合查询<br>
                                D.若不勾选“计算毛利”选项，则不显示单位成本，销售成本，销售毛利，毛利率列。<br>
                                2、查询条件设置后，点“确定”按条件把查询结果显示在下面列表中；<br>
                                3、查询结果按商品编号排序；单击某行，可打开该商品在对应仓库的采购明细表查看；<br>
                                4、打印、导出是指把查询出的数据清单打印或导出；
                            </p>
                        </div>
                    </div>
                    <div class="faq-item reportForm">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>销售汇总表（按客户）</div>
                        <div class="faq-text">
                            <p>
                                统计一段时期内向某客户对某商品进行采购的汇总数，可选择全部客户、商品、仓库进行统计，也可挑选部分客户、商品、仓库进行统计。查询界面如下：
                            </p>
                            <a href="<?php echo base_url()?>statics/images/销售汇总表（按客户）.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/销售汇总表（按客户）.png"/></a>
                            <p>
                                1、设置查询条件：<br>
                                A.客户、商品、仓库如果空表示查找所有客户、商品、仓库，可分别打开各选择框进行勾选；<br>
                                B.日期范围可以任意调整；<br>
                                C.可选择部分客户，商品，仓库进行组合查询<br>
                                D.若不勾选“计算毛利”选项，则不显示单位成本，销售成本，销售毛利，毛利率列。<br>
                                2、查询条件设置后，点“确定”按条件把查询结果显示在下面列表中；<br>
                                3、查询结果按客户排序；单击某行，可打开向该客户采购某商品到对应仓库的销售明细表查看；<br>
                                4、打印、导出是指把查询出的数据清单打印或导出；
                            </p>
                        </div>
                    </div>
                    <div class="faq-item reportForm">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>往来单位欠款表</div>
                        <div class="faq-text">
                            <p>
                                统计截止到当前客户的应收款余额，供应商额应付款余额。查询界面如下：
                            </p>
                            <a href="<?php echo base_url()?>statics/images/往来单位欠款表.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/往来单位欠款表.png"/></a>
                            <p>
                                1、设置查询条件：<br>
                                A.客户、供应商名称如果空，且不勾选客户、供应商类别选项表示查找所有客户、供应商；<br>
                                B.可输入客户、供应商编号或名称的部分字符进行查询，查询结果为包含该字符的所有客户供应商应收引入余额<br>
                                C.若勾选客户或供应商的选项，则只查询客户或供应商余额。<br>
                                2、查询条件设置后，点“查询”按条件把查询结果显示在下面列表中；<br>
                                3、应收款或应付款余额为0的客户供应商不显示<br>
                                4、打印、导出是指把查询出的数据清单打印或导出；
                            </p>
                        </div>
                    </div>
                    <div class="faq-item reportForm">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>商品库存余额表</div>
                        <div class="faq-text">
                            <p>
                                统计截止到当前的商品的库存数量及金额余额。查询界面如下：
                            </p>
                            <a href="<?php echo base_url()?>statics/images/商品库存余额表.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/商品库存余额表.png"/></a>
                            <p>
                                1、设置查询条件：<br>
                                A.商品、仓库如果空表示查找所有商品、仓库，可分别打开各选择框进行勾选；<br>
                                B.开始日期为系统启用日期，不能修改，截止日期范围可以任意调整；<br>
                                C.可选择部分商品，仓库进行组合查询<br>
                                2、查询条件设置后，点“确定”按条件把查询结果显示在下面列表中；<br>
                                3、查询结果按商品编号排序；<br>
                                4、打印、导出是指把查询出数据清单打印或导出；
                            </p>
                        </div>
                    </div>
                    <div class="faq-item reportForm">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>商品收发明细表</div>
                        <div class="faq-text">
                            <p>
                                统计一段时间中商品的入库及出库的数量及金额。查询界面如下：
                            </p>
                            <a href="<?php echo base_url()?>statics/images/商品收发明细表.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/商品收发明细表.png"/></a>
                            <p>
                                1、设置查询条件：<br>
                                A.商品、仓库如果空表示查找所有商品、仓库，可分别打开各选择框进行勾选；<br>
                                B.查询日期范围可以任意调整；<br>
                                C.可选择部分商品，仓库进行组合查询<br>
                                2、查询条件设置后，点“确定”按条件把查询结果显示在下面列表中；<br>
                                3、查询结果按商品编号排序；单击某行中的单据编号，可打开这张单据查看；<br>
                                4、清单中显示的“出库单位成本”，是根据系统参数中选择的“存货计价方法”计算得出；<br>
                                “入库单位成本”是单据中的不含税单价。<br>
                                5、打印、导出是指把查询出数据清单打印或导出；
                            </p>
                        </div>
                    </div>
                    <div class="faq-item reportForm">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>商品收发汇总表</div>
                        <div class="faq-text">
                            <p>
                                统计一段时期内商品在各种业务类型下出入库的汇总数，可选择商品、仓库进行统计，也可挑选部分商品、仓库进行统计。查询界面如下：
                            </p>
                            <a href="<?php echo base_url()?>statics/images/商品收发汇总表.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/商品收发汇总表.png"/></a>
                            <p>
                                1、设置查询条件：<br>
                                A.商品、仓库如果空表示查找所有商品、仓库，可分别打开各选择框进行勾选；<br>
                                B.查询日期范围可以任意调整；<br>
                                C.可选择部分商品，仓库进行组合查询<br>
                                2、查询条件设置后，点“确定”按条件把查询结果显示在下面列表中；<br>
                                3、查询结果按商品编号排序；单击某行，可打开该商品在当前行的仓库中的出入库明细表查看；<br>
                                4、打印、导出是指把查询出数据清单打印或导出；
                            </p>
                        </div>
                    </div>
                    <div class="faq-item reportForm">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>现金银行报表</div>
                        <div class="faq-text">
                            <p>
                                统计一段时期内各账户的资金流入和流出记录及账户余额。查询界面如下：
                            </p>
                            <a href="<?php echo base_url()?>statics/images/现金银行报表.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/现金银行报表.png"/></a>
                            <p>
                                1、设置查询条件：<br>
                                A.结算账户如果空表示查找所有结算账户；<br>
                                B.查询日期范围可以任意调整；<br>
                                C.可选择部分结算账户进行查询<br>
                                2、查询条件设置后，点“确定”按条件把查询结果显示在下面列表中；<br>
                                3、查询结果按账户编号排序；单击某行中的单据编号，可打开该张单据查看；<br>
                                4、账户记录来源有购货单，销货单，收款单，付款单，账户期初余额；<br>
                                5、打印、导出是指把查询出数据清单打印或导出；
                            </p>
                        </div>
                    </div>
                    <div class="faq-item reportForm">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>应付账款明细表</div>
                        <div class="faq-text">
                            <p>
                                统计一段时期内供应商的应付账款、预付账款的增加和减少及余额。查询界面如下：
                            </p>
                            <a href="<?php echo base_url()?>statics/images/应付账款明细表.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/应付账款明细表.png"/></a>
                            <p>
                                1、设置查询条件：<br>
                                A.供应商如果空表示查找所有供应商；<br>
                                B.查询日期范围可以任意调整；<br>
                                C.可选择部分供应商进行查询<br>
                                2、查询条件设置后，点“确定”按条件把查询结果显示在下面列表中；<br>
                                3、查询结果按供应商编号排序；单击某行中的单据编号，可打开该张单据查看；<br>
                                4、应付预付款记录来源有购货单，付款单，核销单及期初余额；<br>
                                5、打印、导出是指把查询出数据清单打印或导出；
                            </p>
                        </div>
                    </div>
                    <div class="faq-item reportForm">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>应收账款明细表</div>
                        <div class="faq-text">
                            <p>
                                统计一段时期内客户的应收账款、预收账款的增加和减少及余额。查询界面如下：
                            </p>
                            <a href="<?php echo base_url()?>statics/images/应收账款明细表.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/应收账款明细表.png"/></a>
                            <p>
                                1、设置查询条件：<br>
                                A.客户如果空表示查找所有客户；<br>
                                B.查询日期范围可以任意调整；<br>
                                C.可选择部分客户进行查询<br>
                                2、查询条件设置后，点“确定”按条件把查询结果显示在下面列表中；<br>
                                3、查询结果按客户编号排序；单击某行中的单据编号，可打开该张单据查看；<br>
                                4、应收预收款记录来源有销货单，收款单，核销单及期初余额；<br>
                                5、打印、导出是指把查询出数据清单打印或导出；
                            </p>
                        </div>
                    </div>
                    <div class="faq-item reportForm">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>客户对账单</div>
                        <div class="faq-text">
                            <p>
                                统计一段时期内某客户的应收账款、实际收款的增加和减少及余额。查询界面如下：
                            </p>
                            <a href="<?php echo base_url()?>statics/images/客户对账单.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/客户对账单.png"/></a>
                            <p>
                                1、设置查询条件：<br>
                                A.销货单位为必选项，只能选择一个客户查询；<br>
                                B.查询日期范围可以任意调整；<br>
                                C.勾选显示商品明细，可列出销货单分录；<br>
                                2、查询条件设置后，点“查询”按条件把查询结果显示在下面列表中；<br>
                                3、查询结果按单据日期排序；单击某行可打开该张单据查看；<br>
                                4、“应收金额”为销货单未结算金额及核销单中转入或转出金额；“实际收款金额”为销货单和收款单中有账户结算的收款金额；<br>
                                5、打印、导出是指把查询出数据清单打印或导出；
                            </p>
                        </div>
                    </div>
                    <div class="faq-item reportForm">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>供应商对账单</div>
                        <div class="faq-text">
                            <p>
                                统计一段时期内某供应商的应付账款、实际付款的增加和减少及余额。查询界面如下：
                            </p>
                            <a href="<?php echo base_url()?>statics/images/供应商对账单.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/供应商对账单.png"/></a>
                            <p>
                                1、设置查询条件：<br>
                                A.购货单位为必选项，只能选择一个供应商查询；<br>
                                B.查询日期范围可以任意调整；<br>
                                C.勾选显示商品明细，可列出购货单分录；<br>
                                2、查询条件设置后，点“查询”按条件把查询结果显示在下面列表中；<br>
                                3、查询结果按单据日期排序；单击某行可打开该张单据查看；<br>
                                4、“应付金额”为购货单未结算金额及核销单中转入或转出金额；“实际付款金额”为购货单和付款单中有账户结算的付款金额；<br>
                                5、打印、导出是指把查询出数据清单打印或导出；
                            </p>
                        </div>
                    </div>
                    <!--基础资料-->
                    <div class="faq-item base">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>客户</div>
                        <div class="faq-text">
                            <p>
                                1、新增客户：点击首页的“客户”，进入客户管理，点击新增打开新增界面。输入客户编号、客户名称、客户类别、期初应收款、期初预收款，联系人及联系方式并保存。除客户编号和名称必须录入外，其他资料依据现实情况可录可不录。<br>
                                2、若没有客户类别，可点击下拉框中的“新增”增加，也可打开“设置——客户类别”增加。<br>
                                3、期初应收款与期初预收款的差额，为最终的期初往来余额。若期初应收款大于期初预收款，差额作为应收款进行核销；若期初应收款小于期初预收款，差额作为预收款进行核销。<br>
                                4、若录入多个联系人，需指定一个联系人为“首要联系人”，在打印单据时，若要打印联系人字段，取首要联系人打印。<br>
                                5、点击客户列表的修改图标，可打开编辑界面进行修改；点击删除图标可删除商品，也可以一次选择多个客户批量删除；若客户已被使用过，则不能被删除。
                            </p>
                        </div>
                    </div>
                    <div class="faq-item base">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>供应商</div>
                        <div class="faq-text">
                            <p>
                                1、新增供应商：点击首页的“供应商”，进入供应商管理，点击新增打开新增界面。输入供应商编号、供应商名称、供应商类别、期初应付款、期初预付款，增值税税率，联系人及联系方式并保存。除供应商编号和名称必须录入外，其他资料依据现实情况可录可不录。<br>
                                2、若没有供应商类别，可点击下拉框中的“新增”增加，也可打开“设置——供应商类别”增加。<br>
                                3、期初应付款与期初预付款的差额，为最终的期初往来余额。若期初应付款大于期初预付款，差额作为应付款进行核销；若期初应付款小于期初预付款，差额作为预付款进行核销。<br>
                                4、若录入多个联系人，需指定一个联系人为“首要联系人”，在打印单据时，若要打印联系人字段，取首要联系人打印。<br>
                                5、点击供应商列表的修改图标，可打开编辑界面进行修改；点击删除图标可删除供应商，也可以一次选择多个供应商批量删除；若供应商已被使用过，则不能被删除。
                            </p>
                        </div>
                    </div>
                    <div class="faq-item base">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>商品</div>
                        <div class="faq-text">
                            <p>
                                1、新增商品：点击首页的“商品”，进入商品管理，点击新增打开新增界面。输入商品编号、商品名称、规格型号、商品类别、计量单位、首选仓库，预计采购价、预计销售价、期初仓库、数量、单位成本并保存。除商品编号和名称必须录入外，其他资料依据现实情况可录可不录。<br>
                                2、若没有商品类别，可点击下拉框中的“新增”增加，也可打开“设置——商品类别”增加。<br>
                                3、若没有仓库，可点击首选仓库下拉框中的“新增”增加，也可打开“设置——仓库管理”增加。<br>
                                4、录入期初库存数量时，一定要同时录入仓库和数量才能保存。若有多个仓库，可每个仓库录入一条期初库存。<br>
                                5、商品中，录入了首选仓库，预计采购价，预计销售价，在录入单据时，选择商品后，这些信息会自动携带出来，提高单据录入效率。<br>
                                6、点击商品列表的修改图标，可打开编辑界面进行修改；点击删除图标可删除商品，也可以一次选择多个商品批量删除；若商品已被使用过，则不能被删除。
                            </p>
                        </div>
                    </div>
                    <div class="faq-item base">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>仓库</div>
                        <div class="faq-text">
                            <p>
                                1、 新增仓库：点击“设置”页签的“仓库管理”，点击新增打开新增界面。输入仓库编号、仓库名称并保存。仓库编号和名称均必须录入。<br>
                                2、点击仓库列表的修改图标，可打开编辑界面进行修改；点击删除图标可删除仓库；若仓库已被使用过，则不能被删除。<br>
                                3、点击某个仓库状态栏的“已启用”，将状态变为“已禁用”。状态为“已禁用”的仓库在录入单据时不能选择。
                            </p>
                        </div>
                    </div>
                    <div class="faq-item base">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>账户</div>
                        <div class="faq-text">
                            <p>
                                1、 新增账户：点击“设置”页签的“账户管理”，点击新增打开新增界面。输入账户编号、账户名称、账户余额及账户类别并保存。账户编号和名称必须录入。建议录入准确的账户余额，现金银行报表的数据才会准确。<br>
                                2、点击账户列表的修改图标，可打开编辑界面进行修改；点击删除图标可删除账户；若账户已被使用过，则不能被删除。
                            </p>
                        </div>
                    </div>
                    <!--辅助资料-->
                    <div class="faq-item auxiliary">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>客户类别</div>
                        <div class="faq-text">
                            <p>
                                1、 新增客户类别：点击“设置”页签的“客户类别”，点击新增打开新增界面。输入客户类别名称保存。<br>
                                2、点击客户类别列表的修改图标，可打开编辑界面进行修改；点击删除图标可删除客户类别；若客户类别已在客户档案中被使用过，则不能被删除。
                            </p>
                        </div>
                    </div>
                    <div class="faq-item auxiliary">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>供应商类别</div>
                        <div class="faq-text">
                            <p>
                                1、 新增客户类别：点击“设置”页签的“供应商类别”，点击新增打开新增界面。输入供应商类别名称保存。<br>
                                2、点击供应商类别列表的修改图标，可打开编辑界面进行修改；点击删除图标可删除供应商类别；若供应商类别已在供应商档案中被使用过，则不能被删除。
                            </p>
                        </div>
                    </div>
                    <div class="faq-item auxiliary">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>商品类别</div>
                        <div class="faq-text">
                            <p>
                                1、 新增商品类别：点击“设置”页签的“商品类别”，点击新增打开新增界面。输入商品类别名称保存。<br>
                                2、点击商品类别列表的修改图标，可打开编辑界面进行修改；点击删除图标可删除商品类别；若商品类别已在商品档案中被使用过，则不能被删除。
                            </p>
                        </div>
                    </div>
                    <div class="faq-item auxiliary">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>计量单位</div>
                        <div class="faq-text">
                            <p>
                                1、新增计量单位：点击“设置”页签的“计量单位”，点击新增打开新增界面。输入计量单位名称保存。<br>
                                2、点击计量单位列表的修改图标，可打开编辑界面进行修改；点击删除图标可删除计量单位；若计量单位已在商品档案中被使用过，则不能被删除。
                            </p>
                        </div>
                    </div>
                    <div class="faq-item auxiliary">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>品牌</div>
                        <div class="faq-text">
                            <p>
                                1、新增品牌：点击“设置”页签的“品牌”，点击新增打开新增界面。输入品牌名称保存。<br>
                                2、点击品牌列表的修改图标，可打开编辑界面进行修改；点击删除图标可删除品牌；若品牌已在商品档案中被使用过，则不能被删除。
                            </p>
                        </div>
                    </div>
                    <div class="faq-item auxiliary">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>结算方式</div>
                        <div class="faq-text">
                            <p>
                                1、 新增结算方式：点击“设置”页签的“结算方式”，点击新增打开新增界面。输入结算方式名称保存。<br>
                                2、点击结算方式列表的修改图标，可打开编辑界面进行修改；点击删除图标可删除结算方式；若结算方式已在收款单、付款单中被使用过，则不能被删除。
                            </p>
                        </div>
                    </div>
                    <!--高级设置-->
                    <div class="faq-item set">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>系统参数</div>
                        <div class="faq-text">
                            <p>
                                1、点击“设置”页签的“系统参数”，进入系统参数设置页面。<br>
                                2、公司名称：可随时修改。<br>
                                3、启用时间：系统启用时设置，不能修改；若要修改启用时间，需要将账套重新初始化，恢复到启用之前状态。<br>
                                4、本位币：系统启用时设置，不能修改。<br>
                                5、小数位数：若已有单据产生，则不能将小数位数改小。<br>
                                6、存货计价方法：默认为“移动平均法”；基础版不能选择存货计价方法，标准版还可以选择为“先进先出法”。<br>
                                7、是否检查负库存：不勾选表示录入出库单据时不检查库存是否充足；勾选后，在做销售单，其他出库单，调拨单等出库类单据时，若库存不足，单据不允许保存。<br>
                            </p>
                        </div>
                    </div>
                    <div class="faq-item set">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>权限设置</div>
                        <div class="faq-text">
                            <a href="<?php echo base_url()?>statics/images/权限设置.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/权限设置.png"/></a>
                            <p>
                                点击“设置”页签的“权限设置”，进入权限设置页面。<br>
                                1、若是单用户操作，不需要进行权限设置。若是多用户操作，需要先将账套共享给其他用户。点击同事账号授权栏的“未启用”，变为“已启用”。若要取消对同事账号的共享，点击“已启用”变为“未启用”。<br>
                                2、同事账号“权限设置”分为功能授权和数据授权，点击“编辑”图标进入。
                            </p>
                        </div>
                    </div>
                    <div class="faq-item set">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>数据授权</div>
                        <div class="faq-text">
                            <p>
                                1、设置了数据授权后，在录入单据、查询报表时，只能选择有权限的客户、供应商、仓库。报表中若默认为空，也只能查询出有权限的客户，供应商，仓库的数据范围。
                            </p>
                            <a href="<?php echo base_url()?>statics/images/数据授权1.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/数据授权1.png"/></a>
                            <p>
                                2、首先选择授权的数据类别，如销售员只能查看指定客户，则选择数据类别为“客户”，点击“已启用”按钮，列表中出现所有客户，勾选该销售员能查看的客户，点“确定”授权完成。数据类别为“仓库”“供应商”的授权方法同上。
                            </p>
                            <a href="<?php echo base_url()?>statics/images/数据授权2.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/数据授权2.png"/></a>
<!--                            <p>-->
<!--                                3、在单据列表中有“制单人”（或“已确认人”）列，显示操作员姓名。在数据授权中，也有“制单人”类别，可勾选有权限查看的操作员录入的单据，从而控制单据列表显示内容。-->
<!--                            </p>-->
<!--                            <a href="--><?php //echo base_url()?><!--statics/images/数据授权3.png" class="flipLightBox"><img src="--><?php //echo base_url()?><!--statics/images/数据授权3.png"/></a>-->
                        </div>
                    </div>
                    <div class="faq-item set">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>功能授权</div>
                        <div class="faq-text">
                            <p>
                                功能授权是控制操作员在不同的功能模块可执行的查询、新增、修改、删除、打印、导入导出等权限。用户可根据自身需求自行勾选。
                            </p>
                        </div>
                    </div>
                    <div class="faq-item set">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>操作日志</div>
                        <div class="faq-text">
                            <p>
                                点击“设置”页签的“操作日志”，可查询用户操作记录。
                            </p>
                            <a href="<?php echo base_url()?>statics/images/操作日志.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/操作日志.png"/></a>
                        </div>
                    </div>
                    <div class="faq-item set">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>备份与恢复</div>
                        <div class="faq-text">
                            <a href="<?php echo base_url()?>statics/images/备份与恢复.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/备份与恢复.png"/></a>
                            <p>
                                1、点击“设置”页签的“备份与恢复”。<br>
                                2、点击“开始备份”将当前账套进行备份，备份完成后，会产生一条备份文件记录，可以将文件下载到本地电脑保存。<br>
                                3、可以将另外账套的备份文件上传到该账套中，点击“恢复”，即可将备份文件数据恢复到当前账套<br>
                                4、恢复后的操作不可逆转。
                            </p>
                        </div>
                    </div>
                    <!--操作技巧-->
<!--                    <div class="faq-item skill">-->
<!--                        <div class="faq-title"><span class="fa fa-angle-down"></span>批量导入基础资料</div>-->
<!--                        <div class="faq-text">-->
<!--                            <p>-->
<!--                                当开始使用系统时，需要录入大量的客户，供应商，商品，仓库，及初始余额等资料，通过“批量导入”功能，在excel表格中填好后，可一次性的导入以上数据。具体表格填写方式，请下载“演示模板”，查看“说明”页签。<br>-->
<!--                                导入完成后，点击“查看导入信息”，可看到导入成功记录数，若未成功的记录，可打开生成的导入结果文件查看。-->
<!--                            </p>-->
<!--                            <a href="--><?php //echo base_url()?><!--statics/images/批量导入基础资料.png" class="flipLightBox"><img src="--><?php //echo base_url()?><!--statics/images/批量导入基础资料.png"/></a>-->
<!--                        </div>-->
<!--                    </div>-->
                    <div class="faq-item skill">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>批量设置仓库</div>
                        <div class="faq-text">
                            <p>
                                当单据分录数较多，仓库字段不需要一个个手工选择，点击“批量”，选择一个仓库，则所有分录中会填入该仓库。
                            </p>
                            <a href="<?php echo base_url()?>statics/images/批量设置仓库.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/批量设置仓库.png"/></a>
                        </div>
                    </div>
                    <div class="faq-item skill">
                        <div class="faq-title"><span class="fa fa-angle-down"></span>查询即时库存</div>
                        <div class="faq-text">
                            <p>
                                除了仓存类报表外，另外有两种方便的库存查询方法：<br>
                                1、在首页的“商品即时库存”中，录入商品信息即可立即显示
                            </p>
                            <a href="<?php echo base_url()?>statics/images/查询即时库存1.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/查询即时库存1.png"/></a>
                            <p>
                                2、在单据的“选择商品”对话框中，点击某商品操作列的查询图标，也可查询该商品的当前库存数量。
                            </p>
                            <a href="<?php echo base_url()?>statics/images/查询即时库存2.png" class="flipLightBox"><img src="<?php echo base_url()?>statics/images/查询即时库存2.png"/></a>
                        </div>
                    </div>
                </div>
                <!--内容end-->

            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url()?>statics/js/help/faq.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>statics/js/help/fliplightbox.min.js"></script>
<script type="text/javascript">$('body').flipLightBox()</script>
<script>
    $(function(){
        selectMenu(0);
        selectMenu(1);
        function selectMenu(index){
            $(".select-menu-input").eq(index).val($(".select-this").eq(index).html());//在输入框中自动填充第一个选项的值
            $(".select-menu-div").eq(index).on("click",function(e){
                e.stopPropagation();
                if($(".select-menu-ul").eq(index).css("display")==="block"){
                    $(".select-menu-ul").eq(index).hide();
                    $(".select-menu-div").eq(index).find("i").removeClass("select-menu-i");
                    $(".select-menu-ul").eq(index).animate({marginTop:"50px",opacity:"0"},"fast");
                }else{
                    $(".select-menu-ul").eq(index).show();
                    $(".select-menu-div").eq(index).find("i").addClass("select-menu-i");
                    $(".select-menu-ul").eq(index).animate({marginTop:"5px",opacity:"1"},"fast");
                }
                for(var i=0;i<$(".select-menu-ul").length;i++){
                    if(i!==index&& $(".select-menu-ul").eq(i).css("display")==="block"){
                        $(".select-menu-ul").eq(i).hide();
                        $(".select-menu-div").eq(i).find("i").removeClass("select-menu-i");
                        $(".select-menu-ul").eq(i).animate({marginTop:"50px",opacity:"0"},"fast");
                    }
                }

            });
            $(".select-menu-ul").eq(index).on("click","li",function(){//给下拉选项绑定点击事件
                $(".select-menu-input").eq(index).val($(this).html());//把被点击的选项的值填入输入框中
                $(".select-menu-div").eq(index).click();
                $(this).siblings(".select-this").removeClass("select-this");
                $(this).addClass("select-this");
                //获取点击id，显示相应内容
                var id = $(this).attr('id');
                $('.faq-item').css('display','none');
                $('.'+id).css('display','block');
            });
            $("body").on("click",function(event){
                event.stopPropagation();
                if($(".select-menu-ul").eq(index).css("display")==="block"){
                    $(".select-menu-ul").eq(index).hide();
                    $(".select-menu-div").eq(index).find("i").removeClass("select-menu-i");
                    $(".select-menu-ul").eq(index).animate({marginTop:"50px",opacity:"0"},"fast");

                }
            });
        }
    })
</script>
</body>
</html>

