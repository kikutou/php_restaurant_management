<?php include_once("../../model/Category.php"); ?>
<!doctype html>
<html lang="en">

<head>
	<title>料理増加</title>
	<style>
.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #04BBDE;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 10px;
  padding: 5px;
  width: 40px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.bplus {
	display: inline-block;
	border-radius: 4px;
	background-color: #FFB646;
	border: none;
	color: #FFFFFF;
	text-align: center;
	font-size: 20px;
	padding: 5px;
	width: 60px;
	transition: all 0.5s;
	cursor: pointer;
	margin: 3px;
	margin-left:-4px;
}
.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '»';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}
</style>
	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="../../asset/admin/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../asset/admin/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="../../asset/admin/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="../../asset/admin/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="../../asset/admin/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="../../asset/admin/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="../../asset/admin/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="index.html"><img src="../../asset/admin/img/logo-dark.png" alt="Klorofil Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<form class="navbar-form navbar-left">
					<div class="input-group">
						<input type="text" value="" class="form-control" placeholder="Search dashboard...">
						<span class="input-group-btn"><button type="button" class="btn btn-primary">検索</button></span>
					</div>
				</form>
				<div class="navbar-btn navbar-btn-right">
					<a class="btn btn-success update-pro" href="get_index.php/downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>UPGRADE TO PRO</span></a>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="index.html" class=""><i class="lnr lnr-home"></i> <span>ホームページ</span></a></li>
						<li><a href="table_searching.html" class=""><i class="lnr lnr-code"></i> <span>会計テーブル指定</span></a></li>
						<li><a href="order_index.html" class=""><i class="lnr lnr-cog"></i> <span>注文管理</span></a></li>
						<li>
							<a href="#subPages" data-toggle="collapse" class="active"><i class="lnr lnr-file-empty"></i> <span>メニュー管理</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages" class="collapse ">
								<ul class="nav">
									<li><a href="get_index.php" class="">カテゴリ管理</a></li>
									<li><a href="product_index.html" class="">料理管理</a></li>
								</ul>
							</div>
						</li>
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<h3 class="page-title">料理追加</h3>
					<div class="row">
						<div class="col-md-12">
							<!-- PANEL HEADLINE -->
							<div class="panel panel-headline">
								<div class="panel-heading">


								</div>
								<div  class="form-group">
								<form action="post_add.php" method="POST" enctype="multipart/form-data">
									ランク:<input class="form-control form-control-lg" type = "text" name = "rank"><br>
									カテゴリ名:<input type = "text" name = "name"><br>
									写真:<input class="form-control form-control-lg"  type="file" name = "picture"><br>

                  <div class="col-md-4 col-md-offset-5">
                    <input type="submit" class="button" value="追加">
								</form>



							<!-- END PANEL HEADLINE -->
						</div>

			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2017 <a href="get_index.php" target="_blank">created by maggie</a>. 2019.4.1.</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="../../asset/admin/vendor/jquery/jquery.min.js"></script>
	<script src="../../asset/admin/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../../asset/admin/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="../../asset/admin/scripts/klorofil-common.js"></script>
</body>
<div class="col-md-4 col-md-offset-5">
  <a  href="get_index.php" class="bplus">戻る</a>


</html>
