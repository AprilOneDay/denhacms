<!doctype html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=8">
	<meta name="keywords" content=""/>
	<title>后台管理</title>
	<link rel="stylesheet" href="<?php echo getConfig('config','vendor'); ?>/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo getConfig('config','ststic'); ?>/console/css/common.css" />
	<link rel="stylesheet" href="<?php echo getConfig('config','vendor'); ?>/pace/themes/blue/pace-theme-minimal.css" />
	<link rel="stylesheet" href="<?php echo getConfig('config','ststic'); ?>/console/css/css.css" />
</head>
<body>
	<div class="border-top">
		<div class="border-top-left fl">
			<ul>
				<li><a class="logo">Denha</a></li>
			</ul>
		</div>
		<div class="border-top-right fr">
			<ul>
				<li><a href="javascript:;">cheng6251@163.com</a></li>
				<li><a href="javascript:;">退出</a></li>
			</ul>
		</div>
	</div>
	<div class="wrapper">
		<div class="navbar">
			<div class="sidebar-fold icon-unfold" ng-class="{'icon-unfold': !isSidebarFold,'icon-fold':isSidebarFold}" ng-click="toggleSidebarStatus()" aliyun-console-spm="100" data-spm-click="gostr=/aliyun;locaid=d100;;" data-spm-anchor-id="5176.2020520101.1002.d100"></div>
		</div>

		<div class="content-main" id="content-main">
			<!-- <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="index_v1.html?v=4.1.0" frameborder="0" data-id="index_v1.html" seamless="" style="display: inline;"></iframe> -->
		</div>
	</div>
<script type="text/javascript" src="<?php echo getConfig('config','ststic'); ?>/console/js/jquery-1.12.3.min.js"></script>
<script type="text/javascript" src="<?php echo getConfig('config','vendor'); ?>/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo getConfig('config','vendor'); ?>/pace/pace.min.js"></script>
</body>
</html>