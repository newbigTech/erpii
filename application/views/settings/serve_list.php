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
        /*width: 100px;*/
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
    .table .write,
    .table .delete{
        display: inline-block;
        width: 16px;
        height: 16px;
        background-image: url(<?php echo base_url()?>statics/css/img/ui-icons_20150410.png);
    }
    .table .write{
        background-position: -112px -16px;
    }
    .table .delete{
        background-position: -64px -16px;
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
    #add{
        position: fixed;
        width: 402px;
        height: 300px;
        background-color: #fff;
        top: 40%;
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
        height: 100%;
        box-sizing: border-box;
    }
    #add>#add_content>.content_main{
        width: 320px;
        height: 112px;
        position: relative;
        top: 6%;
        left: 50%;
        transform: translateX(-50%);
        box-sizing: border-box;
    }
    #add>#add_content>.content_main>li{
        width: 100%;
        margin-bottom: 10px;
    }
    #add>#add_content>.content_main>li>span{
        display: inline-block;
        width: 70px;
        height: 28px;
        font-size: 14px;
    }
    #add>#add_content>.content_main>li>input{
        width: 212px;
        height: 28px;
        display: inline-block;
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
        height: 30px;
        line-height: 24px;
        width: 212px;
        margin-left: -3px;
        outline: none;
    }
    #add_footer{
        position: absolute;
        width: 402px;
        height: 33px;
        bottom: 0;
        right: 0;
    }
</style>
</head>
<body>
<div class="wrapper">
    <div class="mod-search cf">
        <div class="fr">
            <a href="javascript:void(0);" id="new" class="ui-btn ui-btn-sp mrb">新增</a>
            <a href="javascript:void(0);" class="ui-btn" id="refresh">刷新</a>
        </div>
    </div>
    <div class="grid-wrap">
        <div class="table">
            <table>
                <thead>
                <tr>
                    <th style="width: 65px;">操作</th>
                    <th style="width: 205px;">类别</th>
                    <th style="width: 205px;">名称</th>
                    <th style="width: 205px;">工时(小时数)</th>
                    <th style="width: 205px;">售价(元)</th>
                    <th style="width: 205px;">VIP价(元)</th>
                </tr>
                </thead>
                <tbody >
                <?php if($service) :?>
                    <?php foreach ($service as $key=>$val) :?>
                        <tr>
                            <td>
                                <span class="write"></span>
                                <span class="delete"></span>
                                <input type="hidden" class="id"  value="<?php echo $val->id ?>">
                                <input type="hidden" class="category_id" value="<?php echo $val->category_id ?>">
                            </td>
                            <td><span class="category"><?php echo $val->category_name ?></span></td>
                            <td><span class="name"><?php echo $val->name ?></span></td>
                            <td><span class="working"><?php echo $val->working ?></span></td>
                            <td><span class="price"><?php echo $val->price ?></span></td>
                            <td style="text-align: center;"><span class="vip_price" ><?php echo $val->vip_price ?></span></td>
                        </tr>
                    <?php endforeach;?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">暂无记录</td>
                    </tr>
                <?php endif;?>
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


<div id="ldg_lockmask" style="position: fixed; left: 0px; top: 0px; width: 100%; height: 100%; overflow: hidden; z-index: 1977;display: none;"></div>
<div id="add" style="display: none;">
    <div id="add_header" class="clearfix">
        <div id="add_title">新增服务</div>
        <div id="add_close" class="close_add">&times;</div>
    </div>
    <div id="add_content">
        <ul class="content_main clearfix">
            <li>
                <span>类别:</span>
                <span class="sel" style="margin-left: 0">
                    <select name="category" id="category">
                             <option value="0" selected>请选择</option>
                        <?php foreach ($data as $key=>$val) :?>
                            <option value="<?php echo $val['id'] ?>"><?php echo $val['name'] ?></option>
                            <?php if($val['child']) :?>
                                <?php foreach ($val['child'] as $key1=>$val1) :?>
                                    <option value="<?php echo $val1['id'] ?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $val1['name'] ?></option>
                                    <?php if($val1['child']) :?>
                                        <?php foreach ($val1['child'] as $key2=>$val2) :?>
                                            <option value="<?php echo $val2['id'] ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $val2['name'] ?></option>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                <?php endforeach;?>
                            <?php endif;?>
                        <?php endforeach;?>
                    </select>
                </span>
            </li>
            <li>
                <span>名称:</span>
                <input type="text" id="name">
            </li>
            <li>
                <span>工时:</span>
                <input type="number" min="1" step="0.1" id="working">
            </li>
            <li>
                <span>售价:</span>
                <input type="number" min="0.01" step="0.01"  id="price">
            </li>
            <li>
                <span>VIP价:</span>
                <input type="number" min="0.01" step="0.01" id="vip_price">
            </li>
        </ul>
    </div>
    <div id="add_footer">
        <td colspan="2">
            <div class="ui_buttons">
                <input type="hidden" id="type" value="">
                <input type="button" id="save" value="保存" class="ui_state_highlight" />
                <input type="button" class="close_add" value="关闭" />
            </div>
        </td>
    </div>
</div>

<script>
    $(function () {
        $('#new').on('click',function () {
            $('#ldg_lockmask').css('display','');
            $('#add').css('display','');
            $('#type').val('add');
            $('#add_title').html('新增服务');
        });
        $('.close_add').on('click',function () {
            $('#ldg_lockmask').css('display','none');
            $('#add').css('display','none');
            $("#category").find("option[value = 0]").attr("selected",true);
            $('#price').val('');
            $('#working').val('');
            $('#name').val('');
            $('#vip_price').val('');
        });
        $('.delete').on('click',function () {
            var id = $(this).parent().find('.id').val();
            $.ajax({
                url: "<?php echo site_url('serve/servicedel');?>",
                type: "POST",
                data:{id:id},
                dataType: "JSON",
                success:function (res) {
                    if (res.code == 0){
                        alert('删除成功！');
                    } else{
                        alert('删除失败！');
                    }

                },
                error:function () {
                    alert('出错啦！')
                }
            });
            location.reload();
        });
        $('.write').on('click',function () {

            $("#category").find("option[value = 0]").attr("selected",true);
            $('#price').val('');
            $('#working').val('');
            $('#name').val('');
            $('#vip_price').val('');
            var vip_price = $(this).parent().parent().find('.vip_price').html().trim();
            var price = $(this).parent().parent().find('.price').html().trim();
            var working = $(this).parent().parent().find('.working').html().trim();
            var name = $(this).parent().parent().find('.name').html().trim();
            var category_id = $(this).parent().find('.category_id').val();

            $('#ldg_lockmask').css('display','');
            $('#add').css('display','');
            $('#type').val('edit');
            $('#add_title').html('修改服务');
            $('#vip_price').val(vip_price);
            $('#price').val(price);
            $('#working').val(working);
            $('#name').val(name);
            $("#category option[value='" + category_id + "']").attr("selected","selected");
        });
        $('#refresh').on('click',function () {
            location.reload();
        });
        $('#save').on('click',function () {
            var type = $('#type').val();
            var vip_price = $("#vip_price").val();
            var price = $("#price").val();
            var working = $("#working").val();
            var name = $("#name").val();
            var category_name= $("#category").find("option:selected").text();
            var category_id= $("#category").find("option:selected").val();


            if(category_id == 0){
                alert("请选择服务分类！");
            }else{
                if(type == "add"){
                    var url = "<?php echo site_url('serve/serviceadd');?>";
                    var id = null;
                }else{
                    var url = "<?php echo site_url('serve/serviceedit');?>";
                    var id= $(".id").val();
                }

                $.ajax({
                    url: url,
                    type: "POST",
                    data:{
                        vip_price:vip_price,
                        price:price,
                        working:working,
                        name:name,
                        category_id:category_id,
                        category_name:category_name,
                        id:id,
                    },
                    dataType: "JSON",
                    success:function (res) {

                        if (res.code == 0){
                            alert(res.text);
                            location.href = "<?php echo site_url('serve/servicelist')?>";
                        } else{
                            alert(res.text);
                        }

                    },
                    error:function (res) {
                        console.log(res);
                        alert('出错啦！');
                    }
                });
            }

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


 