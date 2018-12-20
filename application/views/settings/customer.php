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
.matchCon{width:280px;}
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
	          <input type="text" id="matchCon" class="ui-input ui-input-ph matchCon" value="输入客户编号/ 名称/ 联系人/ 电话查询">
	        </li>
	        <li><a class="ui-btn mrb" id="search">查询</a></li>
	      </ul>
	    </div>
	    <div class="fr">
            <a href="#" class="ui-btn ui-btn-sp mrb" id="btn-add">新增</a>
            <a href="#" class="ui-btn" id="btn-batchDel">删除</a>
        </div>
	  </div>
    <div class="grid-wrap">
        <div class="ui-jqgrid ui-widget ui-widget-content ui-corner-all" id="gbox_grid" dir="ltr" style="width: 792px;">
            <div class="ui-jqgrid-view" id="gview_grid" style="width: 792px;">
                <div class="ui-state-default ui-jqgrid-hdiv ui-corner-top" style="width: 792px;">
                    <div class="ui-jqgrid-hbox">
                        <table class="ui-jqgrid-htable" style="width:1425px" role="grid" aria-labelledby="gbox_grid" cellspacing="0" cellpadding="0" border="0">
                            <thead>
                            <tr class="ui-jqgrid-labels" role="rowheader">
                                <th id="grid_cb" role="columnheader" class="ui-state-default ui-th-column ui-th-ltr" style="width: 20px;">
                                    <div id="jqgh_grid_cb">
                                        <input role="checkbox" id="cb_grid" class="cbox" type="checkbox" />
                                        <span class="s-ico" style="display:none">
                                            <span sort="asc" class="ui-grid-ico-sort ui-icon-asc ui-state-disabled ui-icon ui-icon-triangle-1-n ui-sort-ltr"></span>
                                            <span sort="desc" class="ui-grid-ico-sort ui-icon-desc ui-state-disabled ui-icon ui-icon-triangle-1-s ui-sort-ltr"></span>
                                        </span>
                                    </div>
                                </th>
                                <th id="grid_operate" role="columnheader" class="ui-state-default ui-th-column ui-th-ltr" style="width: 90px;">
                                    <span class="ui-jqgrid-resize ui-jqgrid-resize-ltr" style="cursor: col-resize;">&nbsp;</span>
                                    <div id="jqgh_grid_operate" class="ui-jqgrid-sortable">
                                        操作
                                        <span class="s-ico" style="display:none">
                                            <span sort="asc" class="ui-grid-ico-sort ui-icon-asc ui-state-disabled ui-icon ui-icon-triangle-1-n ui-sort-ltr"></span>
                                            <span sort="desc" class="ui-grid-ico-sort ui-icon-desc ui-state-disabled ui-icon ui-icon-triangle-1-s ui-sort-ltr"></span>
                                        </span>
                                    </div>
                                </th>
                                <th id="grid_categoryName" role="columnheader" class="ui-state-default ui-th-column ui-th-ltr" style="width: 100px;">
                                    <span class="ui-jqgrid-resize ui-jqgrid-resize-ltr" style="cursor: col-resize;">&nbsp;</span>
                                    <div id="jqgh_grid_categoryName" class="ui-jqgrid-sortable">
                                        商品类别
                                        <span class="s-ico" style="display:none">
                                            <span sort="asc" class="ui-grid-ico-sort ui-icon-asc ui-state-disabled ui-icon ui-icon-triangle-1-n ui-sort-ltr"></span>
                                            <span sort="desc" class="ui-grid-ico-sort ui-icon-desc ui-state-disabled ui-icon ui-icon-triangle-1-s ui-sort-ltr"></span>
                                        </span>
                                    </div>
                                </th>
                                <th id="grid_number" role="columnheader" class="ui-state-default ui-th-column ui-th-ltr" style="width: 100px;">
                                    <span class="ui-jqgrid-resize ui-jqgrid-resize-ltr" style="cursor: col-resize;">&nbsp;</span>
                                    <div id="jqgh_grid_number" class="ui-jqgrid-sortable">
                                        商品编号
                                        <span class="s-ico" style="display:none">
                                            <span sort="asc" class="ui-grid-ico-sort ui-icon-asc ui-state-disabled ui-icon ui-icon-triangle-1-n ui-sort-ltr"></span>
                                            <span sort="desc" class="ui-grid-ico-sort ui-icon-desc ui-state-disabled ui-icon ui-icon-triangle-1-s ui-sort-ltr"></span></span>
                                    </div></th>
                                <th id="grid_name" role="columnheader" class="ui-state-default ui-th-column ui-th-ltr" style="width: 200px;"><span class="ui-jqgrid-resize ui-jqgrid-resize-ltr" style="cursor: col-resize;">&nbsp;</span>
                                    <div id="jqgh_grid_name" class="ui-jqgrid-sortable">
                                        商品名称
                                        <span class="s-ico" style="display:none"><span sort="asc" class="ui-grid-ico-sort ui-icon-asc ui-state-disabled ui-icon ui-icon-triangle-1-n ui-sort-ltr"></span><span sort="desc" class="ui-grid-ico-sort ui-icon-desc ui-state-disabled ui-icon ui-icon-triangle-1-s ui-sort-ltr"></span></span>
                                    </div></th>
                                <th id="grid_spec" role="columnheader" class="ui-state-default ui-th-column ui-th-ltr" style="width: 60px;"><span class="ui-jqgrid-resize ui-jqgrid-resize-ltr" style="cursor: col-resize;">&nbsp;</span>
                                    <div id="jqgh_grid_spec" class="ui-jqgrid-sortable">
                                        规格型号
                                        <span class="s-ico" style="display:none"><span sort="asc" class="ui-grid-ico-sort ui-icon-asc ui-state-disabled ui-icon ui-icon-triangle-1-n ui-sort-ltr"></span><span sort="desc" class="ui-grid-ico-sort ui-icon-desc ui-state-disabled ui-icon ui-icon-triangle-1-s ui-sort-ltr"></span></span>
                                    </div></th>
                                <th id="grid_unitName" role="columnheader" class="ui-state-default ui-th-column ui-th-ltr" style="width: 40px;"><span class="ui-jqgrid-resize ui-jqgrid-resize-ltr" style="cursor: col-resize;">&nbsp;</span>
                                    <div id="jqgh_grid_unitName" class="ui-jqgrid-sortable">
                                        单位
                                        <span class="s-ico" style="display:none"><span sort="asc" class="ui-grid-ico-sort ui-icon-asc ui-state-disabled ui-icon ui-icon-triangle-1-n ui-sort-ltr"></span><span sort="desc" class="ui-grid-ico-sort ui-icon-desc ui-state-disabled ui-icon ui-icon-triangle-1-s ui-sort-ltr"></span></span>
                                    </div></th>
                                <th id="grid_currentQty" role="columnheader" class="ui-state-default ui-th-column ui-th-ltr" style="width: 80px;"><span class="ui-jqgrid-resize ui-jqgrid-resize-ltr" style="cursor: col-resize;">&nbsp;</span>
                                    <div id="jqgh_grid_currentQty" class="ui-jqgrid-sortable">
                                        当前库存
                                        <span class="s-ico" style="display:none"><span sort="asc" class="ui-grid-ico-sort ui-icon-asc ui-state-disabled ui-icon ui-icon-triangle-1-n ui-sort-ltr"></span><span sort="desc" class="ui-grid-ico-sort ui-icon-desc ui-state-disabled ui-icon ui-icon-triangle-1-s ui-sort-ltr"></span></span>
                                    </div></th>
                                <th id="grid_quantity" role="columnheader" class="ui-state-default ui-th-column ui-th-ltr" style="width: 80px;"><span class="ui-jqgrid-resize ui-jqgrid-resize-ltr" style="cursor: col-resize;">&nbsp;</span>
                                    <div id="jqgh_grid_quantity" class="ui-jqgrid-sortable">
                                        期初数量
                                        <span class="s-ico" style="display:none"><span sort="asc" class="ui-grid-ico-sort ui-icon-asc ui-state-disabled ui-icon ui-icon-triangle-1-n ui-sort-ltr"></span><span sort="desc" class="ui-grid-ico-sort ui-icon-desc ui-state-disabled ui-icon ui-icon-triangle-1-s ui-sort-ltr"></span></span>
                                    </div></th>
                                <th id="grid_unitCost" role="columnheader" class="ui-state-default ui-th-column ui-th-ltr" style="width: 100px;"><span class="ui-jqgrid-resize ui-jqgrid-resize-ltr" style="cursor: col-resize;">&nbsp;</span>
                                    <div id="jqgh_grid_unitCost" class="ui-jqgrid-sortable">
                                        单位成本
                                        <span class="s-ico" style="display:none"><span sort="asc" class="ui-grid-ico-sort ui-icon-asc ui-state-disabled ui-icon ui-icon-triangle-1-n ui-sort-ltr"></span><span sort="desc" class="ui-grid-ico-sort ui-icon-desc ui-state-disabled ui-icon ui-icon-triangle-1-s ui-sort-ltr"></span></span>
                                    </div></th>
                                <th id="grid_amount" role="columnheader" class="ui-state-default ui-th-column ui-th-ltr" style="width: 100px;"><span class="ui-jqgrid-resize ui-jqgrid-resize-ltr" style="cursor: col-resize;">&nbsp;</span>
                                    <div id="jqgh_grid_amount" class="ui-jqgrid-sortable">
                                        期初总价
                                        <span class="s-ico" style="display:none"><span sort="asc" class="ui-grid-ico-sort ui-icon-asc ui-state-disabled ui-icon ui-icon-triangle-1-n ui-sort-ltr"></span><span sort="desc" class="ui-grid-ico-sort ui-icon-desc ui-state-disabled ui-icon ui-icon-triangle-1-s ui-sort-ltr"></span></span>
                                    </div></th>
                                <th id="grid_purPrice" role="columnheader" class="ui-state-default ui-th-column ui-th-ltr" style="width: 100px;"><span class="ui-jqgrid-resize ui-jqgrid-resize-ltr" style="cursor: col-resize;">&nbsp;</span>
                                    <div id="jqgh_grid_purPrice" class="ui-jqgrid-sortable">
                                        预计采购价
                                        <span class="s-ico" style="display:none"><span sort="asc" class="ui-grid-ico-sort ui-icon-asc ui-state-disabled ui-icon ui-icon-triangle-1-n ui-sort-ltr"></span><span sort="desc" class="ui-grid-ico-sort ui-icon-desc ui-state-disabled ui-icon ui-icon-triangle-1-s ui-sort-ltr"></span></span>
                                    </div></th>
                                <th id="grid_salePrice" role="columnheader" class="ui-state-default ui-th-column ui-th-ltr" style="width: 100px;"><span class="ui-jqgrid-resize ui-jqgrid-resize-ltr" style="cursor: col-resize;">&nbsp;</span>
                                    <div id="jqgh_grid_salePrice" class="ui-jqgrid-sortable">
                                        零售价
                                        <span class="s-ico" style="display:none"><span sort="asc" class="ui-grid-ico-sort ui-icon-asc ui-state-disabled ui-icon ui-icon-triangle-1-n ui-sort-ltr"></span><span sort="desc" class="ui-grid-ico-sort ui-icon-desc ui-state-disabled ui-icon ui-icon-triangle-1-s ui-sort-ltr"></span></span>
                                    </div></th>
                                <th id="grid_remark" role="columnheader" class="ui-state-default ui-th-column ui-th-ltr" style="width: 100px;"><span class="ui-jqgrid-resize ui-jqgrid-resize-ltr" style="cursor: col-resize;">&nbsp;</span>
                                    <div id="jqgh_grid_remark" class="ui-jqgrid-sortable">
                                        备注
                                        <span class="s-ico" style="display:none"><span sort="asc" class="ui-grid-ico-sort ui-icon-asc ui-state-disabled ui-icon ui-icon-triangle-1-n ui-sort-ltr"></span><span sort="desc" class="ui-grid-ico-sort ui-icon-desc ui-state-disabled ui-icon ui-icon-triangle-1-s ui-sort-ltr"></span></span>
                                    </div></th>
                                <th id="grid_delete" role="columnheader" class="ui-state-default ui-th-column ui-th-ltr" style="width: 80px;"><span class="ui-jqgrid-resize ui-jqgrid-resize-ltr" style="cursor: col-resize;">&nbsp;</span>
                                    <div id="jqgh_grid_delete" class="ui-jqgrid-sortable">
                                        状态
                                        <span class="s-ico" style="display:none"><span sort="asc" class="ui-grid-ico-sort ui-icon-asc ui-state-disabled ui-icon ui-icon-triangle-1-n ui-sort-ltr"></span><span sort="desc" class="ui-grid-ico-sort ui-icon-desc ui-state-disabled ui-icon ui-icon-triangle-1-s ui-sort-ltr"></span></span>
                                    </div></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="ui-jqgrid-bdiv" style="height: 698px; width: 792px;">
                    <div style="position:relative;">
                        <div></div>
                        <table id="grid" tabindex="0" cellspacing="0" cellpadding="0" border="0" role="grid" aria-multiselectable="true" aria-labelledby="gbox_grid" class="ui-jqgrid-btable" style="width: 1425px;">
                            <tbody>
                            <tr class="jqgfirstrow" role="row" style="height:auto">
                                <td role="gridcell" style="height:0px;width:20px;"></td>
                                <td role="gridcell" style="height:0px;width:90px;"></td>
                                <td role="gridcell" style="height:0px;width:100px;"></td>
                                <td role="gridcell" style="height:0px;width:100px;"></td>
                                <td role="gridcell" style="height:0px;width:200px;"></td>
                                <td role="gridcell" style="height:0px;width:60px;"></td>
                                <td role="gridcell" style="height:0px;width:40px;"></td>
                                <td role="gridcell" style="height:0px;width:80px;"></td>
                                <td role="gridcell" style="height:0px;width:80px;"></td>
                                <td role="gridcell" style="height:0px;width:100px;"></td>
                                <td role="gridcell" style="height:0px;width:100px;"></td>
                                <td role="gridcell" style="height:0px;width:100px;"></td>
                                <td role="gridcell" style="height:0px;width:100px;"></td>
                                <td role="gridcell" style="height:0px;width:100px;"></td>
                                <td role="gridcell" style="height:0px;width:80px;"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="ui-jqgrid-resize-mark" id="rs_mgrid">
                &nbsp;
            </div>
            <div id="page" class="ui-state-default ui-jqgrid-pager ui-corner-bottom" dir="ltr" style="width: 792px;">
                <div id="pg_page" class="ui-pager-control" role="group">
                    <table cellspacing="0" cellpadding="0" border="0" class="ui-pg-table" style="width:100%;table-layout:fixed;height:100%;" role="row">
                        <tbody>
                        <tr>
                            <td id="page_left" align="left">
                                <table cellspacing="0" cellpadding="0" border="0" class="ui-pg-table navtable" style="float:left;table-layout:auto;">
                                    <tbody>
                                    <tr>
                                        <td class="ui-pg-button ui-corner-all" title="">
                                            <div class="ui-pg-div">
                                                <span class="ui-icon ui-icon-config"></span>
                                            </div></td>
                                    </tr>
                                    </tbody>
                                </table></td>
                            <td id="page_center" align="center" style="white-space: pre; width: 282px;">
                                <table cellspacing="0" cellpadding="0" border="0" style="table-layout:auto;" class="ui-pg-table">
                                    <tbody>
                                    <tr>
                                        <td id="first_page" class="ui-pg-button ui-corner-all ui-state-disabled"><span class="ui-icon ui-icon-seek-first"></span></td>
                                        <td id="prev_page" class="ui-pg-button ui-corner-all ui-state-disabled"><span class="ui-icon ui-icon-seek-prev"></span></td>
                                        <td class="ui-pg-button ui-state-disabled" style="width:4px;"><span class="ui-separator"></span></td>
                                        <td dir="ltr"> <input class="ui-pg-input" type="text" size="2" maxlength="7" value="0" role="textbox" /> 共 <span id="sp_1_page">0</span> 页</td>
                                        <td class="ui-pg-button ui-state-disabled" style="width:4px;"><span class="ui-separator"></span></td>
                                        <td id="next_page" class="ui-pg-button ui-corner-all"><span class="ui-icon ui-icon-seek-next"></span></td>
                                        <td id="last_page" class="ui-pg-button ui-corner-all"><span class="ui-icon ui-icon-seek-end"></span></td>
                                        <td dir="ltr"><select class="ui-pg-selbox" role="listbox"><option role="option" value="100" selected="selected">100</option><option role="option" value="200">200</option><option role="option" value="500">500</option></select></td>
                                    </tr>
                                    </tbody>
                                </table></td>
                            <td id="page_right" align="right">
                                <div dir="ltr" style="text-align:right" class="ui-paging-info">
                                    无数据显示
                                </div></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
	    <div id="page"></div>
	  </div>
</div>
<script src="<?php echo base_url()?>statics/js/dist/customer.js"></script>
</body>
</html>


 