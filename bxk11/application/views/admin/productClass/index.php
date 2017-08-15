<!-- BEGIN PAGE -->
<link rel="stylesheet" type="text/css" href="/static/admin/css/productClass/base.css"
media="all">
<link rel="stylesheet" type="text/css" href="/static/admin/css/productClass/common.css"
media="all">
<link rel="stylesheet" type="text/css" href="/static/admin/css/productClass/module.css">
<link rel="stylesheet" type="text/css" href="/static/admin/css/productClass/style.css"
media="all">
<link rel="stylesheet" type="text/css" href="/static/admin/css/productClass/blue_color.css"
media="all">
<div class="page-content">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div id="portlet-config" class="modal hide">
        <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button">
            </button>
            <h3>
                portlet Settings
            </h3>
        </div>
        <div class="modal-body">
            <p>
                Here will be a configuration form
            </p>
        </div>
    </div>
    <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN STYLE CUSTOMIZER -->
               
                <!-- END BEGIN STYLE CUSTOMIZER -->
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    系统设置
                    <small>
                        增值服务设置
                    </small>
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home">
                        </i>
                        <a href="index.html">
                            家178
                        </a>
                        <i class="icon-angle-right">
                        </i>
                    </li>
                    <li>
                        <a href="#">
                            管理中心
                        </a>
                        <i class="icon-angle-right">
                        </i>
                    </li>
                    <li>
                        <a href="#">
                            系统设置
                        </a>
                    </li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-edit">
                            </i>
                            增值服务列表
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse">
                            </a>
                            <a href="#portlet-config" data-toggle="modal" class="config">
                            </a>
                            <a href="javascript:;" class="reload">
                            </a>
                            <a href="javascript:;" class="remove">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="clearfix">
                            <div class="btn-group">
                                <button id="sample_editable_1_new" class="btn green" onclick="javascript:window.location.href='<?php echo U('admin/productClass/add',array('pc_pid'=>0));?>'">
                                    Add New
                                    <i class="icon-plus">
                                    </i>
                                </button>
                            </div>
                            <!-- <div class="btn-group">
                                <button id="sample_editable_1_new" class="btn red" onclick="jsv.delAll('','<?php echo U('admin/productClass/doDel');?>');">
                                    DELETE
                                    </i>
                                </button>
                            </div> -->
                        </div>
                        <!-- 表格列表 -->
                        <div class="tb-unit posr">
                            <div class="category">
                                <div class="hd cf">
                                    <div class="fold">
                                        折叠
                                    </div>
                                    <div class="order">
                                        层级
                                    </div>
                                    <div class="order">
                                        房间功能
                                    </div>
                                    <div class="name">
                                        名称
                                    </div>
                                </div>
                                <?php if($list){foreach($list as $value){?>
                                <!--第一部分 statr--> 
                                <dl class="cate-item" id="<?php echo "t_s".$value['pc_id']?>">
                                    <dt class="cf">
                                        <form action="<?php echo U('admin/productClass/doedit');?>" method="post">
                                            <div class="" style="float:right">
                                                <a title="编辑" href="<?php echo U('admin/productClass/edit',array('pc_id'=>$value['pc_id']));?>">
                                                    编辑
                                                </a>
                                                <a title="删除" href="javascript:jsv.delAll('<?php echo $value['pc_id'];?>','<?php echo U('admin/productClass/doDel');?>');"
                                                class="confirm ajax-get">
                                                    删除
                                                </a>
                     
                                            </div>
                                            <div class="fold">
                                                <i>
                                                </i>
                                            </div>
                                            <div class="order">
                                               <!--  <input type="text" name="sort" class="text input-mini" value="0"> -->
                                               <?php echo $value['pc_depth']?>
                                            </div>
                                            <div class="order">

                                               
                                            </div>
                                            <div class="name">
                                                <span class="tab-sign">
                                                </span>
                                                <input type="hidden" name="pc_id" value="<?php echo $value['pc_id']?>">
                                                <input type="text" name="pc_name" class="text" value="<?php echo $value['pc_name']?>">
                                                <a class="add-sub-cate" title="添加子分类" href="<?php echo U('admin/productClass/add',array('pc_pid'=>$value['pc_id']));?>">
                                                    <i class="icon-add">
                                                    </i>
                                                </a>
                                                <span class="help-inline msg">
                                                </span>
                                            </div>
                                        </form>
                                    </dt>
                                    <!--第二部分 statr--> 
                                    <dd sr='emptyRemove'>
                                    	<?php if($value['son']){foreach($value['son'] as $val){?>
                                        <dl class="cate-item" id="<?php echo "t_s".$val['pc_id']?>">
                                            <dt class="cf">
                                                <form action="<?php echo U('admin/productClass/doedit');?>" method="post">
                                                    <div class="" style="float:right">
                                                        <a title="编辑" href="<?php echo U('admin/productClass/edit',array('pc_id'=>$val['pc_id']));?>">
                                                            编辑
                                                        </a>
                                                        <a title="删除" href="javascript:jsv.delAll('<?php echo $val['pc_id'];?>','<?php echo U('admin/productClass/doDel');?>');"
                                                        class="confirm ajax-get">
                                                            删除
                                                        </a>
                                                      
                                                    </div>
                                                    <div class="fold">
                                                        <i>
                                                        </i>
                                                    </div>
                                                    <div class="order">
                                                        <!-- <input type="text" name="sort" class="text input-mini" value="2"> -->
                                                        <?php echo $val['pc_depth']?>
                                                    </div>
                                                    <div class="order">
                                                        <?php echo $val['pc_function']?>
                                                    </div>
                                                    <div class="name">
                                                        <span class="tab-sign">
                                                        </span>
                                                        <input type="hidden" name="pc_id" value="<?php echo $val['pc_id']?>">
                                                        <input type="text" name="pc_name" class="text" value="<?php echo $val['pc_name']?>">
                                                        <a class="add-sub-cate" title="添加子分类" href="<?php echo U('admin/productClass/add',array('pc_pid'=>$val['pc_id']));?>">
                                                            <i class="icon-add">
                                                            </i>
                                                        </a>
                                                        <span class="help-inline msg">
                                                        </span>
                                                    </div>
                                                </form>
                                            </dt>
                                           <!--第三部分 statr--> 	
                                           <?php if($val['son']){foreach($val['son'] as $va){?>
                                            <dd>
                                            	
                                                <dl class="cate-item" id="<?php echo "t_s".$va['pc_id']?>">
                                                    <dt class="cf">
                                                        <form action="<?php echo U('admin/productClass/doedit');?>" method="post">
                                                            <div class="" style="float:right">
                                                                <a title="编辑" href="<?php echo U('admin/productClass/edit',array('pc_id'=>$va['pc_id']));?>">
                                                                    编辑
                                                                </a>
                                                                <a title="删除" href="javascript:jsv.delAll('<?php echo $va['pc_id'];?>','<?php echo U('admin/productClass/doDel');?>');"
                                                                class="confirm ajax-get">
                                                                    删除
                                                                </a>
                      
                                                            </div>
                                                            <div class="fold">
                                                                <i>
                                                                </i>
                                                            </div>
                                                            <div class="order">
                                                               <!--  <input type="text" name="sort" class="text input-mini" value="0"> -->
                                                               <?php echo $val['pc_depth']?>
                                                            </div>
                                                            <div class="order">
                                                                <?php echo $val['pc_function']?>
                                                            </div>
                                                            <div class="name">
                                                                <span class="tab-sign">
                                                                </span>
                                                                <input type="hidden" name="pc_id" value="<?php echo $va['pc_id']?>">
                                                                <input type="text" name="pc_name" class="text" value="<?php echo $va['pc_name']?>">
                                                                <a class="add-sub-cate" title="添加子分类" href="/onetink/index.php?s=/admin/category/add/pid/39.html">
                                                                    <i class="icon-add">
                                                                    </i>
                                                                </a>
                                                                <span class="help-inline msg">
                                                                </span>
                                                            </div>
                                                        </form>
                                                    </dt>
                                                </dl>

                                            </dd>
                                               <?php }} ?>
										<!--第三部分 end--> 
                                        </dl>
                                        <?php }} ?>
                                    </dd>
                                    <!--第二部分 end--> 
                                </dl>
                                 <?php }} ?>
                                 <!--第一部分 end--> 
                            </div>
                        </div>
                        <!-- /表格列表 -->
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
    <!-- END PAGE CONTAINER-->
</div>
<!-- END PAGE -->
<script type="text/javascript">

	
    (function($) {

    	/* 分类按钮收起 */
    	$("dd").hide();

    	var num = $("[sr = 'emptyRemove']").length;

    	for (var i=num;i>0;i--) {

    		if($("[sr = 'emptyRemove']").eq(i).children().length == 0) {

    			$("[sr = 'emptyRemove']").eq(i).remove();

    		}

    	}
        /* 分类展开收起 */
        $(".category dd").prev().find(".fold i").addClass("icon-fold").click(function() {
            var self = $(this);
            if (self.hasClass("icon-unfold")) {
                self.closest("dt").next().slideUp("fast",
                function() {
                    self.removeClass("icon-unfold").addClass("icon-fold");
                });
            } else {
                self.closest("dt").next().slideDown("fast",
                function() {
                    self.removeClass("icon-fold").addClass("icon-unfold");
                });
            }
        });

        /* 可支持三级分类删除新增按钮 */
        //$(".category dd dd .add-sub-cate").remove();
        /* 二级分类删除新增按钮 */
        $(".category dd .add-sub-cate").remove();
        /* 实时更新分类信息 */
        $(".category").on("submit", "form",
        function() {
            var self = $(this);
            $.post(self.attr("action"), self.serialize(),
            function(data) {
                /* 提示信息 */
                var name = data.err ? "error": "success",
                msg;
                msg = self.find(".msg").addClass(name).text(data.msg).css("display", "inline-block");
                setTimeout(function() {
                    msg.fadeOut(function() {
                        msg.text("").removeClass(name);
                    });
                },
                2000);
            },
            "json");
            return false;
        }).on("focus", "input",
        function() {
            $(this).data('param', $(this).closest("form").serialize());

        }).on("blur", "input",
        function() {
            if ($(this).data('param') != $(this).closest("form").serialize()) {
                $(this).closest("form").submit();
            }
        });
    })(jQuery);
</script>