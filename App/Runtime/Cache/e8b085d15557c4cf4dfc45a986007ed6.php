<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title><?php echo (C("Appname")); ?>——支出</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/bootstrap/css/bootstrap.min.css" />
	<style type="text/css">
		section {
			margin-top: 40px;
		}
		.modal {
			margin-top: 100px;
		}
		.pagination {
			margin-top: 0;
			margin-bottom: 0;
		}
		.table-hover tbody tr:hover td {
			background-color: #d9edf7;
		}
		.hidden {
			visibility: hidden;
		}
	</style>
</head>
<body>
<style>
	header {
		font-family: "微软雅黑";
	}
</style>
<header>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="brand" href="__APP__/Index/">个人理财系统</a>
				<ul class="nav">
					<li id="nav_index"><a href="__APP__/Index/">首 页</a></li>
					<li id="nav_expend"><a href="__APP__/Expend/">支 出</a></li>
					<li id="nav_income"><a href="__APP__/Income/income">收 入</a></li>
					<li id="nav_setting"><a href="__APP__/Setting">设 置</a></li>
				</ul>
				<ul class="nav pull-right">
					<li><a>欢迎你 <?php echo ($user); ?></a></li>
					<li class="divider-vertical"></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">账户<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#">修改密码</a></li>
							<li><a href="#">修改密码</a></li>
							<li><a href="#">修改密码</a></li>
							<li class="divider"></li>
							<li><a href="__APP__/Public/logout">退 出</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</header>

<section class="container-fluid well">
	<div class="row-fluid">
		<div class="offset2 span8 well">
			<ul id="myTab" class="nav nav-tabs">
				<li class="active"><a href="#expend_detail" data-toggle="tab">支出明细</a></li>
				<li><a href="#expend_add" data-toggle="tab">增加支出</a></li>
				<li><a href="#expend_search" data-toggle="tab">搜 索</a></li>
			</ul>
			<div id="myTabContent" class="tab-content">
				<!--支出明细-->
				<div class="tab-pane fade in active" id="expend_detail">
					<span class="btn-group" style="float: left">
						<button class="btn" id="del">删 除</button>
						<button class="btn" id="refresh">刷 新</button>
					</span>
					<div class="pagination" style="float: right">
						<ul>
							<?php echo ($page); ?>
						</ul>
					</div>
					<div style="clear: both"></div>
					<!--表格-->
					<table class="table table-bordered table-hover">
						<!--表头-->
						<thead>
							<tr>
								<th style="width: 5%"><input type="checkbox" id="selectAll"></th>
								<th style="width: 32%">类 别</th>
								<th style="width: 32%">金 额</th>
								<th style="width: 31%">时 间</th>
								<!--<th>操 作</th>-->
							</tr>
						</thead>
						<!--数据-->
						<tbody>
							<!-- 循环将数据输出 -->
							<?php if(is_array($expendList)): $i = 0; $__LIST__ = $expendList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="<?php echo ($vo["id"]); ?>">
									<td><input type="checkbox" class="toggle"></td>
									<td><?php echo ($vo["item"]); ?></td>
									<td><?php echo ($vo["money"]); ?>元</td>
									<td><?php echo ($vo["time"]); ?>
										<span class="hidden" style="float: right">
											<a style="cursor:pointer" title="修改" href="#expend_update" data-toggle="modal"
											   onclick="showUpdateDialog('<?php echo ($vo["id"]); ?>', '<?php echo ($vo["item"]); ?>', '<?php echo ($vo["money"]); ?>', '<?php echo ($vo["time"]); ?>')">
												<img src="__PUBLIC__/Images/alter.png" border="0"/></a>
										</span>
									</td>
								</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</tbody>
					</table>
				</div>

				<!--增加支出-->
				<div class="tab-pane fade" id="expend_add">
	<form class="form-horizontal" method="post" action="__URL__/expend_add">
		<div class="control-group">
			<label class="control-label">类 别</label>
			<div class="controls">
				<select id="add_category" name="add_category">
					<!-- 循环将数据输出 -->
					<?php if(is_array($categoryList)): $i = 0; $__LIST__ = $categoryList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cl): $mod = ($i % 2 );++$i;?><option value="<?php echo ($cl["item"]); ?>"><?php echo ($cl["item"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="add_money">金 额</label>
			<div class="controls">
				<input type="text" class="number" id="add_money" name="add_money" required="required"/>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="add_time">时 间</label>
			<div class="controls">
				<input type="text" id="add_time" name="add_time" required="required"/>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<input type="submit" class="btn btn-primary" value="增 加">
				<input type="button" class="btn btn-primary" value="增 加1" onclick="add_add()">
				<input type="button" class="btn btn-primary" value="取 消" onclick="add_cancle()">
			</div>
		</div>
	</form>
</div>

				<!--搜索-->
				<div class="tab-pane fade" id="expend_search">
	<form class="form-inline">
		<label>类 别</label>
		<select id="search_category" name="category" class="input-medium">
			<!-- 循环将数据输出 -->
			<?php if(is_array($categoryList)): $i = 0; $__LIST__ = $categoryList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cl): $mod = ($i % 2 );++$i;?><option value="<?php echo ($cl["item"]); ?>"><?php echo ($cl["item"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		</select>&nbsp;&nbsp;&nbsp;
		<label>起止时间</label>
		<input type="date" class="input-medium" id="search_starttime"> —
		<input type="date" class="input-medium" id="search_endtime">
		<input type="button" class="btn btn-primary" value="搜索" onclick="search()">
	</form>

	<!--表格-->
	<table class="table table-bordered table-hover">
		<!--表头-->
		<thead>
			<tr>
				<th><input type="checkbox" id="search_selectAll"></th>
				<th>类 别</th>
				<th>金 额</th>
				<th>时 间</th>
				<th>操 作</th>
			</tr>
		</thead>
		<!--数据-->
		<tbody>
			<!-- 循环将数据输出 -->
			<?php if(is_array($search_expendList)): $i = 0; $__LIST__ = $search_expendList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="<?php echo ($vo["id"]); ?>">
					<td><input type="checkbox" class="search_toggle"></td>
					<td><?php echo ($vo["item"]); ?></td>
					<td><?php echo ($vo["money"]); ?>元</td>
					<td><?php echo ($vo["time"]); ?>
						<span class="hidden" style="float: right">
							<a style="cursor:pointer" title="修改" href="#expend_update"
							   data-toggle="modal"
							   onclick="showUpdateDialog('<?php echo ($vo["id"]); ?>', '<?php echo ($vo["item"]); ?>', '<?php echo ($vo["money"]); ?>', '<?php echo ($vo["time"]); ?>')">
								<img src="__PUBLIC__/Images/alter.png" border="0"/></a>
						</span>
					</td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
</div>
			</div>

			<!--修改支出-->
<div id="expend_update" class="modal hide fade" tabindex="-1" role="dialog">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h4>修改支出</h4>
	</div>
	<div class="modal-body">
		<form id="update_from" class="form-horizontal">
			<div class="control-group">
				<label class="control-label">类 别</label>
				<div class="controls">
					<select id="update_category">
						<!-- 循环将数据输出 -->
						<?php if(is_array($categoryList)): $i = 0; $__LIST__ = $categoryList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cl): $mod = ($i % 2 );++$i;?><option value="<?php echo ($cl["item"]); ?>"><?php echo ($cl["item"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="update_money">金 额</label>
				<div class="controls">
					<input type="text" class="number" id="update_money" name="update_money" required="required"/>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="update_time">时 间</label>
				<div class="controls">
					<input type="text" id="update_time" name="update_time" required="required"/>
					<input type="hidden" id="update_id" name="update_id"/>
				</div>
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<input type="submit" class="btn btn-primary" value="修 改" onclick="update()">
		<button class="btn" data-dismiss="modal" aria-hidden="true">关 闭</button>
	</div>
</div>

		</div>
	</div>
</section>
<footer style="text-align: center;font-family:'微软雅黑';font-size:14px; margin: 5px;">
	&copy wangbin 2012-<?php echo date("Y"); ?>
</footer>

<script type="text/javascript" src="__PUBLIC__/Js/Jquery/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/expend.js"></script>

<script type="text/javascript" src="__PUBLIC__/plugin/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="__PUBLIC__/plugin/bootstrap-datepicker/bootstrap-datepicker.zh-CN.js"></script>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/plugin/bootstrap-datepicker/datepicker.css" />
</body>
</html>