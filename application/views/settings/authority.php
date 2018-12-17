<?php $this->load->view('header');?>
<style>
.manage-wrap{margin: 0 auto;width: 300px;}
.manage-wrap .ui-input{width: 200px;font-size:14px;}
.manage-wrap .hideFeild{position: absolute;top: 30px;left:80px;width:210px;border:solid 1px #ccc;background-color
:#fff;}
.ztreeDefault{overflow-y:auto;max-height:240px;}
.searchbox{float: left;font-size: 14px;}
.searchbox li{float: left;margin-right: 10px;}
#matchCon{width:140px;}
.ui-input-ph {color: #aaa;}
.cur #custom-assisting .ui-combo-wrap {background: #eaeaea;border-color: #c1c1c1;}
.cur #custom-assisting input {background: #eaeaea;font-weight: bold;}
.ui-droplist-wrap .selected {background-color: #d2d2d2;}
.input-txt{font-size:14px;}
.ui-droplist-wrap .list-item {font-size:14px;}
</style> 
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


<script>
function validMaxForShare(){
    $.ajax({
      url: '../right/isMaxShareUser?action=isMaxShareUser',
      dataType: 'json',
      type: 'POST',
      success: function(data){
        if(data.status === 200){
        	var json = data.data;
        	if(json.shareTotal >= json.totalUserNum)
        	{
        		parent.Public.tips({type:2, content : '共享用户已经达到上限值：'+json.totalUserNum});
        		return false;
        	}else
        	{
        		window.location.href='../settings/authority_new';
        	}	
        }
      }
  });
}
</script>
</head>
<body>
<div class="wrapper">
    <div class="mod-toolbar-top">
       <a href="javascript:validMaxForShare();" class="ui-btn ui-btn-sp mrb">新增同事</a>
       <span class="tit" id="shareInfo" style="display:none;">该账套主服务最多支持<strong id="totalUser"></strong>用户共同管理，已共享<strong id="usedTotal"></strong>人，剩余<strong id="leftTotal"></strong>。</span>
    </div>    
    <div class="grid-wrap">
      <table id="grid">
      </table>
      <div id="page"></div>
    </div>
</div>
<script>
var dialog;//add for more
  (function($){
    var totalUser, usedTotal, leftTotal;
    initGrid();

    $('.grid-wrap').on('click', '.delete', function(e){
      var id = $(this).parents('tr').attr('id');
      var rowData = $('#grid').getRowData(id);
      var userName = rowData.userName;
      e.preventDefault();
      $.ajax({
        url: '../right/auth2UserCancel?action=auth2UserCancel&userName=' + userName,
        type: 'POST',
        dataType: 'json',
        success: function(data){
          if (data.status == 200) {
            parent.Public.tips({content: '取消用户授权成功！'});
            usedTotal--;
            leftTotal++;
            showShareCount();
            if (rowData.isCom) {
                rowData.share = false;
                $("#grid").jqGrid('setRowData', id, rowData);
            } else {
                $("#grid").jqGrid('delRowData',id);
            }
           
          } else {
            parent.Public.tips({type: 1, content: '取消用户授权失败！' + data.msg});
          }
        },
        error: function(){
           parent.Public.tips({content:'取消用户授权失败！请重试。', type: 1});
        }
      });
    });

    $('.grid-wrap').on('click', '.authorize', function(e){
      var id = $(this).parents('tr').attr('id');
      var rowData = $('#grid').getRowData(id);
      var userName = rowData.userName;
      e.preventDefault();
       $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '../right/auth2User?action=auth2User&userName=' + userName,
        success: function(data){
          if (data.status == 200) {
            parent.Public.tips({content : '授权成功！'});
            rowData.share = true;
            $("#grid").jqGrid('setRowData', id, rowData);
            usedTotal++;
            leftTotal--;
            showShareCount();
            //window.location.href = 'authority-setting.jsp?userName=' + userName + '&right=0';
          } else {
            parent.Public.tips({type:1, content : data.msg});
          }
        },
        error: function(){
          parent.Public.tips({type:1, content : '用户授权失败！请重试。'});
        }
      });
    });

   
    function initGrid(){
      $('#grid').jqGrid({
        url: '../right/queryAllUser?action=queryAllUser',
        datatype: 'json',
        height: Public.setGrid().h,
        colNames:['用户', '真实姓名', '公司','功能授权','数据授权','所属机构','启用授权'],//add for more
        colModel:[
          {name:'userName',index:'userName', width:200},
          {name:'realName', index:'realName', width:200},
          {name:'isCom', index:'isCom', hidden: true},
          {name:'setting', index:'setting', width:100, align:"center", title:false, formatter: settingFormatter},
		  //{name:'setting_data', index:'setting_data', width:100, align:"center", title:false, formatter: settingDataFormatter},
		  {name:'setting_data', index:'setting_data', width:100, align:"center", title:false, formatter: settingDataFormatter},
		  {name:'setting_org', index:'setting_org', width:130, align:"center", title:false, formatter: settingOrgFormatter},//add for more
		  //{name:'setting_data', index:'setting_data', width:100, align:"center", title:false, formatter: settingDataFormatter, hidden:(parent.SYSTEM.siType == 1)},
		  {name:'share', index:'share', width:100, align:"center", title:false, formatter: shareFormatter}

        ],
        altRows:true,
        gridview: true,
        page: 1,
        scroll: 1,
        autowidth: true,
        cmTemplate: {sortable:false}, 
        rowNum:150,
        shrinkToFit:false,
        forceFit:false,
        pager: '#page',
        viewrecords: true,
        jsonReader: {
          root: 'data.items', 
          records: 'data.totalsize',  
          repeatitems : false,
          id: 'userId'
        },
        loadComplete: function(data){
          if (data.status == 200) {
            data = data.data;
            totalUser = data.totalUserNum;
            usedTotal = data.shareTotal;
            leftTotal = totalUser - usedTotal;
            showShareCount();
            $('#shareInfo').show();
          } else {
        	  parent.Public.tips({type: 1, content: data.msg});
          }
          //add for more
          /*($("#ParentCategory").click(function() {
        	  if(!$(".hideFeild").show().data("hasInit")) 
        	  {
            	$(".hideFeild").show().data("hasInit", !0);
            	Public.zTree.init($(".hideFeild"), {
					defaultClass: "ztreeDefault",
					url:'../basedata/org?action=list&isDelete=2',
					showRoot:false
				}, {
					callback: {
						beforeClick: function(a, b) {
							$("#ParentCategory").val(b.name);
							$("#ParentCategory").data("PID", b.id);
							 $(".hideFeild").hide()
						}
					}
				})
          	  }
			}), document.onclick = function() {
        	  	///$(".hideFeild").hide()
			})*/
          //add for more
        },
        loadonce: true
      });
    }


    function showShareCount(){
        $('#totalUser').text(totalUser);
        $('#usedTotal').text(usedTotal);
        $('#leftTotal').text(leftTotal);
    }
	
	
	function shareFormatter(val, opt, row) {
        if (val || row.admin) {
          if (row.admin) {
              return '管理员';
          } else {
               return '<div class="operating" data-id="' + row.userId + '"><span class="delete ui-label ui-label-success">已启用</span></div>';
          }
        } else {
          return '<p class="operate-wrap"><span class="authorize ui-label ui-label-default">已停用</span></p>';
        } 
    };
    function settingFormatter(val, opt, row) {
		if (row.admin || row.share === false) {
			return '&nbsp;';
		} else {
			return '<div class="operating" data-id="' + row.userId + '"><a class="ui-icon ui-icon-pencil" title="详细设置授权信息" href="../settings/authority_setting?userName=' + row.userName + '"></a></div>';
		}
    };
    function settingDataFormatter(val, opt, row) {
		if (row.admin || row.share === false) {
			return '&nbsp;';
		} else {
			return '<div class="operating" data-id="' + row.userId + '"><a class="ui-icon ui-icon-pencil" title="详细设置授权信息" href="../settings/authority_setting_data?userName=' + row.userName + '"></a></div>';
		}
    };
    //add for more
    function settingOrgFormatter(val, opt, row) {
   	 debugger;
		if (row.admin || row.share === false) {
			return '&nbsp;';
		} else {
			return  '<div class="operating"><span id="txt'+row.userId+'">'+(row.orgName||'<font color=red>未分配</font>')+'</span><a class="ui-icon ui-icon-pencil" title="设置组织机构信息" href="javascript:showOrg(' + row.userId + ')"></a></div>';
		}
    };

  })(jQuery)
  
  $(window).resize(function(){
	  Public.resizeGrid();
  });

	//add for more
  function showOrg(userId){
		var d = ['<form id="manage-form" action="">', 
			 		'<ul class="mod-form-rows manage-wrap" id="manager">', 
			 		'<li class="row-item" style="position:relative; display:none;">', 
			 		'<div class="label-wrap"><label for="ParentCategory">选择机构:</label></div>', 
			 		'<div class="ctn-wrap" style="position:relative;"><input type="text" value="" class="ui-input" name="ParentCategory" id="ParentCategory" readonly></div>', 
			 		'<div class="dn hideFeild"></div>', "</li>","</ul>", "</form>"],
		e = 90;
		dialog = $.dialog({
			title: "分配组织机构",
			content: d.join(""),
			width: 400,
			height: e,
			max: !1,
			min: !1,
			cache: !1,
			lock: !0,
			okVal: "确定",
			ok: function() {
				var orgName = $.trim($("#ParentCategory").val()),
				orgId = orgName ? $("#ParentCategory").data("PID") : "";
				var data = {};
				data.orgId = orgId;
				data.userId = userId;
				Public.ajaxPost("../basedata/org/orgToUser", data, function(a) {
					200 == a.status ? (parent.parent.Public.tips({
						content: "操作成功！"
					}), $("#txt"+userId).text(orgName)) : parent.parent.Public.tips({
						type: 1,
						content: "操作失败！" + a.msg
					})
				})
				//return postData(b), !1
			},
			cancelVal: "取消",
			cancel: function() {
				return !0
			},
			init: function() {
				var c = $(".hideFeild"),
					d = $("#ParentCategory");
				(d.closest("li").show(), $("#ParentCategory").click(function() {
					c.show().data("hasInit") || (c.show().data("hasInit", !0), Public.zTree.init(c, {
						defaultClass: "ztreeDefault",
						url:'../basedata/org?action=list&isDelete=2',
						showRoot:false
					}, {
						callback: {
							beforeClick: function(a, b) {
								d.val(b.name), d.data("PID", b.id), c.hide()
							}
						}
					}))
				}), $(".ui_dialog").click(function() {
					c.hide()
				}), $("#ParentCategory").closest(".row-item").click(function(a) {
					var b = a || window.event;
					b.stopPropagation ? b.stopPropagation() : window.event && (window.event.cancelBubble = !0)
				}), document.onclick = function() {
					c.hide()
				})
			}
		})
	}
</script>
</body>
</html>


 