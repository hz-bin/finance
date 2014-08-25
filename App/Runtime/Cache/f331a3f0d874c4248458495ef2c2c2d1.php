<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title><?php echo (C("Appname")); ?>——首页</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/bootstrap/css/bootstrap.min.css" />
	<style type="text/css">
		section {
			margin-top: 40px;
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
		<div class="offset1 span5 well">
			支出报表
		</div>
		<div class="span5 well">
			收入报表
		</div>
	</div>
</section>

<footer style="text-align: center;font-family:'微软雅黑';font-size:14px; margin: 5px;">
	&copy wangbin 2012-<?php echo date("Y"); ?>
</footer>

<script type="text/javascript" src="__PUBLIC__/Js/Jquery/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/bootstrap/js/bootstrap.min.js"></script>
<script>
	$(document).ready(function () {
		$('#nav_index').addClass('active');
	});
</script>
</body>
</html>