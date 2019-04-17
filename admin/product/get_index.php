<!--functionを導入する-->
<?php include_once("../../model/Product.php"); ?>

<!doctype html>
<html lang="en">

<head>
	<title>料理一覧</title>
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
	<link rel="stylesheet" href="../../asset/admin/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../asset/admin/css/font-awesome.min.css">
	<link rel="stylesheet" href="../../asset/admin/css/style.css">
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
	//index_function
	$products = Product::get();
	?>

	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="../category/get_index.php"><img src="../../asset/admin/img/logo-dark.png" alt="Klorofil Logo" class="img-responsive logo"></a>
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
						<li><a href="../category/get_index.php" class=""><i class="lnr lnr-home"></i> <span>ホームページ</span></a></li>
						<li><a href="../account/get_table.php" class=""><i class="lnr lnr-code"></i> <span>会計テーブル指定</span></a></li>
						<li><a href="../order/get_index.php" class=""><i class="lnr lnr-cog"></i> <span>注文管理</span></a></li>
						<li>
							<a href="#subPages" data-toggle="collapse" class="active"><i class="lnr lnr-file-empty"></i> <span>メニュー管理</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages" class="collapse ">
								<ul class="nav">
									<li><a href="../category/get_index.php" class="">カテゴリ管理</a></li>
									<li><a href="../product/get_index.php" class="">料理管理</a></li>
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
					<h3 class="page-title">料理管理</h3>
					<div class="row">
						<div class="col-md-12">
							<!-- PANEL HEADLINE -->
							<div class="panel panel-headline">
								<div class="panel-heading">


								</div>
								<div >
								<table class="table table-hover" align="middle" >
									<thead>
										<tr>
											<th>料理名</th>
											<th>金額</th>
											<th>説明</th>
											<th>詳細</th>
											<th>編集</th>
											<th>削除</th>
										</tr>
									</thead>

									<?php foreach($products as $product) {

										echo "<tr>";
										echo "<td>" . $product->name . "</td>";
										echo "<td>" . $product->price . "</td>";
										echo "<td>" . $product->instruction . "</td>";
										echo "<td>" . "<a href='get_detail.php?id=" . $product->id . "'>" . "詳細" . "</a>" . "</td>";
										echo "<td>" . "<a href='get_edit.php?id=" . $product->id . "'>" . "編集" . "</a>" . "</td>";
										echo "<td>" . "<a href='get_delete.php?id=" . $product->id . "'>" . "削除" . "</a>" . "</td>";
										echo "</tr>";

									}
									?>


								</table>


							<!-- END PANEL HEADLINE -->
						</div>

			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>

		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="../../asset/admin/vendor/jquery/jquery.min.js"></script>
	<script src="../../asset/admin/bootstrap/js/bootstrap.min.js"></script>
	<script src="../../asset/admin/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="../../asset/admin/scripts/klorofil-common.js"></script>
</body>
<h2 align="center"><button><a href="get_add.php">料理追加</a></button></h2>

</html>
