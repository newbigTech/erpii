$(function () {
	$('.btn_add').on('click',function () {
		var id = parseInt($('#num').val()) + 1;
        $('#num').val(id);
		var add = '<ul class="mod-form-rows base-form clearfix car" id="ul_' + id + '" style="margin-bottom: 20px">\n' +
            '                        <li class="row-item">\n' +
            '                            <div class="label-wrap"><label for="plateNo">车牌:</label></div>\n' +
            '                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="plateNo" id="plateNo_ul_' + id + '"></div>\n' +
            '                        </li>\n' +
            '                        <li class="row-item">\n' +
            '                            <div class="label-wrap"><label for="brand">品牌:</label></div>\n' +
            '                            <div class="ctn-wrap"><input type="text" value="" class="ui-input brand" name="brand" id="brand_ul_' + id + '"></div>\n' +
            '                        </li>\n' +
            '                        <li class="row-item">\n' +
            '                            <div class="label-wrap"><label for="system">车系:</label></div>\n' +
            '                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="system" id="system_ul_' + id + '"></div>\n' +
            '                        </li>\n' +
            '                        <li class="row-item">\n' +
            '                            <div class="label-wrap"><label for="buytime">购买时间:</label></div>\n' +
            '                            <div class="ctn-wrap"><input type="date" value="" class="ui-input" name="buytime" id="buytime_ul_' + id + '"></div>\n' +
            '                        </li>\n' +
            '                        <li class="row-item">\n' +
            '                            <div class="label-wrap"><label for="hasCheck">年款:</label></div>\n' +
            '                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="hasCheck" id="hasCheck_ul_' + id + '"></div>\n' +
            '                        </li>\n' +
            '                        <li class="row-item">\n' +
            '                            <div class="label-wrap"><label for="notCheck">车型:</label></div>\n' +
            '                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="notCheck" id="notCheck_ul_' + id + '"></div>\n' +
            '                        </li>\n' +
            '                        <button type="button" class="btn btn_cel" onclick="cel(&apos;' + id +'&apos;)" id="' + id + '">取消</button>\n' +
            '                    </ul>';
		$('#manage-form').append(add);
    });

});
function cel(id) {
    $('#ul_'+id).remove();
};



