<!--functionを導入する-->
<?php include_once("../../model/Product.php"); ?>


<!doctype html>
<html lang="jp">

<head>
	<title>料理削除</title>
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
	<?php

	$product = Product::find($_GET["id"]);

	?>


	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="../../kitchen/start.html"><img src="../../asset/admin/img/logo-dark.png" alt="Klorofil Logo" class="img-responsive logo"></a>
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
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="../../kitchen/start.html" class=""><i class="lnr lnr-home"></i> <span>ホームページ</span></a></li>
						<li><a href="../account/get_table.php" class=""><i class="lnr lnr-code"></i> <span>会計テーブル指定</span></a></li>
						<li><a href="../order/get_index.php" class=""><i class="lnr lnr-cog"></i> <span>注文管理</span></a></li>
						<li>
							<a href="#subPages" data-toggle="collapse" class="active"><i class="lnr lnr-file-empty"></i> <span>メニュー管理</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages" class="collapse ">
								<ul class="nav">
									<li><a href="../category/get_index.php" class="">カテゴリ管理</a></li>
									<li><a href="get_index.php" class="">料理管理</a></li>
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
					<h3 class="page-title">料理削除</h3>
					<div class="row">
						<div class="col-md-12">
							<!-- PANEL HEADLINE -->
							<div class="panel panel-headline">
								<div class="panel-heading">
								</div>

							<h1>本当にこの料理を削除しますか？</h1>
							<table class="table table-hover" align="middle" >
								<tr>
									<td>料理名</td>
									<td><?php echo $product->name; ?></td>
								</tr>
								<tr>
									<td>値段</td>
									<td><?php echo $product->price; ?></td>
								</tr>
								<tr>
									<td>カテゴリー</td>
									<td><?php echo $product->category_id; ?></td>
								</tr>
								<tr>
									<td>写真</td>
									<td><img src="<?php echo $product->picture; ?>"style="width:80%;"></td>
								</tr>
							</table>
								<div class="form-group">
									<form action="post_delete.php" method="post">
			             <input type="hidden" name="id" value="<?= $product->id ?>">
			             <input type="submit" value="削除">
			            </form>
								</div>

			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2017 <a href="https://www.themeineed.com" target="_blank">created by maggie</a>. 2019.4.1.</p>
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

<h2 align="center"><button><a href="get_index.php">料理管理に戻る</a></button></h2>

</html>
