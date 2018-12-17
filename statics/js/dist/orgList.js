//add for more
function initDom() {
	
}
function initEvent() {
	$("#btn-add").click(function(a) {
		a.preventDefault(), handle.operate("add")
	}), $("#grid").on("click", ".operating .ui-icon-pencil", function(a) {
			a.preventDefault();
			var b = $(this).parent().data("id");
			handle.operate("edit", b)
	}), $("#grid").on("click", ".operating .ui-icon-trash", function(a) {
			a.preventDefault();
			var b = $(this).parent().data("id");
			handle.del(b)
	}), $("#btn-refresh").click(function(a) {
		a.preventDefault(), $("#grid").trigger("reloadGrid")
	}), $("#search").click(function(a) {
		a.preventDefault();
		var b = $.trim($("#matchCon").val());
		conditions.skey = "输入名称查询" == b ? "" : b, $("#grid").setGridParam({
			postData: conditions
		}).trigger("reloadGrid")
	}), $("#matchCon").placeholder(), $(window).resize(function() {
		Public.resizeGrid()
	})
}
function initGrid() {
	var a = [{
		name: "operate",
		label: "操作",
		width: 60,
		fixed: !0,
		align: "center",
		formatter: Public.operFmatter
	}, {
		name: "name",
		label: "组织机构",
		width: 200,
		formatter: function(a, b, c) {
			for (var d = parseInt(c.level) - 1, e = "", f = 0; d > f; f++) e += "   ";
			return e + a
		}
	}, {
		name: "id",
		label: "id",
		hidden: !0
	}, {
		name: "level",
		label: "level",
		hidden: !0
	}, {
		name: "parentId",
		label: "parentId",
		hidden: !0
	}, {
		name: "parentName",
		label: "parentName",
		hidden: !0
	}, {
		name: "detail",
		label: "是否叶",
		hidden: !0
	}];
	$("#grid").jqGrid({
		url: url,
		postData: conditions,
		datatype: "json",
		height: Public.setGrid().h,
		altRows: !0,
		gridview: !0,
		colModel: a,
		autowidth: !0,
		viewrecords: !0,
		cmTemplate: {
			sortable: !1,
			title: !1
		},
		page: 1,
		pager: "#page",
		rowNum: 2e3,
		shrinkToFit: !1,
		scroll: 1,
		jsonReader: {
			root: "data.items",
			records: "data.totalsize",
			repeatitems: !1,
			id: "id"
		},
		loadComplete: function(a) {
			if (a && 200 == a.status) {
				var b = {};
				a = a.data;
				for (var c = 0; c < a.items.length; c++) {
					var d = a.items[c];
					b[d.id] = d
				}
				showParentCategory = true;
				for (var c = 0; c < a.items.length; c++) {
					var d = a.items[c],
						e = b[d.parentId] || {};
					e.name && (showParentCategory = !0, b[d.id].parentName = e.name)
				}
				$("#grid").data("gridData", b)
			} else {
				var f = 250 == a.status ? "没有" + conditions.name + "组织机构数据！" : "获取" + conditions.name + "组织机构数据失败！" + a.msg;
				parent.Public.tips({
					type: 2,
					content: f
				})
			}
		},
		loadError: function() {
			parent.Public.tips({
				type: 1,
				content: "操作失败了哦，请检查您的网络链接！"
			})
		}
	})
}
function initValidator() {
	$("#manage-form").validate({
		rules: {
			category: {
				required: !0
			}
		},
		messages: {
			category: {
				required: "组织机构不能为空"
			}
		},
		errorClass: "valid-error"
	})
}
function postData(a) {
	if (!$("#manage-form").validate().form()) return void $("#manage-form").find("input.valid-error").eq(0).focus();
	var b = $.trim($("#category").val()),
		c = $.trim($("#ParentCategory").val()),
		d = a ? "update" : "add",
		e = c ? $("#ParentCategory").data("PID") : "";
	if (e === a) return void parent.parent.Public.tips({
		type: 2,
		content: "当前组织机构和上级组织机构不能相同！"
	});
	var f = {
		parentId: e,
		id: a,
		name: b
	},
		g = "add" == d ? "新增" + conditions.name + "组织机构" : "修改" + conditions.name + "组织机构";
	Public.ajaxPost("../basedata/org/" + d, f, function(a) {
		200 == a.status ? (parent.parent.Public.tips({
			content: g + "成功！"
		}), handle.callback(a.data, d)) : parent.parent.Public.tips({
			type: 1,
			content: g + "失败！" + a.msg
		})
	})
}
function resetForm() {
	$("#manage-form").validate().resetForm(), $("#ParentCategory").val(""), $("#category").val("").focus().select()
}

var showParentCategory, url = "../basedata/org?action=list&isDelete=2",
	urlParam = Public.urlParam();
var conditions = {
	skey: "",
	name: ""
},
	rightsAction = {
		query: "_QUERY",
		add: "_ADD",
		del: "_DELETE",
		update: "_UPDATE"
	},
	handle = {
		operate: function(a, b) {
			if ("add" == a) {
				var c = "新增" + conditions.name + "组织机构";
				({
					oper: a,
					callback: this.callback
				})
			} else {
				var c = "修改" + conditions.name + "组织机构";
				({
					oper: a,
					rowData: $("#grid").data("gridData")[b],
					callback: this.callback
				})
			}
			var d = ['<form id="manage-form" action="">', '<ul class="mod-form-rows manage-wrap" id="manager">', '<li class="row-item" style="position:relative; display:none;">', '<div class="label-wrap"><label for="ParentCategory">上级机构:</label></div>', '<div class="ctn-wrap" style="position:relative;"><input type="text" value="" class="ui-input" name="ParentCategory" id="ParentCategory" readonly></div>', '<div class="dn hideFeild"></div>', "</li>", '<li class="row-item">', '<div class="label-wrap"><label for="category">组织机构:</label></div>', '<div class="ctn-wrap"><input type="text" value="" class="ui-input" name="category" id="category"></div>', "</li>", "</ul>", "</form>"],
				e = 90;
			showParentCategory && (e = 150), this.dialog = $.dialog({
				title: c,
				content: d.join(""),
				width: 400,
				height: e,
				max: !1,
				min: !1,
				cache: !1,
				lock: !0,
				okVal: "确定",
				ok: function() {
					return postData(b), !1
				},
				cancelVal: "取消",
				cancel: function() {
					return !0
				},
				init: function() {
					var c = $(".hideFeild"),
						d = $("#ParentCategory"),
						e = $("#category");
					if (showParentCategory && (d.closest("li").show(), $("#ParentCategory").click(function() {
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
					}), "add" != a) {
						var f = $("#grid").data("gridData")[b];
						e.val(f.name), d.val(f.parentName), d.data("PID", f.parentId)
					}
					initValidator()
				}
			})
		},
		del: function(a) {
			$.dialog.confirm("删除的" + conditions.name + "组织机构将不能恢复，请确认是否删除？", function() {
				Public.ajaxPost("../basedata/org/delete?action=delete", {
					id: a
				}, function(b) {
					if (b && 200 == b.status) {
						parent.Public.tips({
							content: "删除" + conditions.name + "组织机构成功！"
						}), $("#grid").jqGrid("delRowData", a);
					} else parent.Public.tips({
						type: 1,
						content: "删除" + conditions.name + "组织机构失败！" + b.msg
					})
				})
			})
		},
		callback: function(a, b) {
			var c = $("#grid").data("gridData");
			c || (c = {}, $("#grid").data("gridData", c));
			c[a.id] = a, a.parentId && (c[a.id].parentName = c[a.parentId].name), "add" != b ? 
					($("#grid").jqGrid("setRowData", a.id, a), this.dialog.close()) : 
					($("#grid").jqGrid("addRowData", a.id, a, "last"), this.dialog.close()), 
						$("#grid").setGridParam({
							postData: conditions
						}).trigger("reloadGrid")
		}
	};
initDom(), initEvent(), initGrid();



 