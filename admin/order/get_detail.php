<?php
include_once("../../model/Order.php");
include_once("../../model/Order_details.php");
include_once("../../model/Product.php");
include_once("../../model/Table.php");

?>
<!doctype html>
<html lang="en">

<head>
	<title>カテゴリ詳細</title>
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
				<a href="index.php"><img src="../../asset/admin/img/logo-dark.png" alt="Klorofil Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<form class="navbar-form navbar-left">
					<div class="input-group">
						<input type="text" value="" class="form-control" placeholder="Search dashboard...">
						<span class="input-group-btn" ><button type="button" class="btn btn-primary"　>検索</button></span>
					</div>
				</form>
				<div class="navbar-btn navbar-btn-right">
					<a class="btn btn-success update-pro" href="https://www.themeineed.com/downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>UPGRADE TO PRO</span></a>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="index.php" class=""><i class="lnr lnr-home"></i> <span>ホームページ</span></a></li>
						<li><a href="table_searching.html" class=""><i class="lnr lnr-code"></i> <span>会計テーブル検索</span></a></li>
						<li><a href="get_index.php" class="active"><i class="lnr lnr-cog"></i> <span>注文管理</span></a></li>
						<li>
							<a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>メニュー管理</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages" class="collapse ">
								<ul class="nav">
									<li><a href="category_index.html" class="">カテゴリ管理</a></li>
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
					<!-- MAIN CONTENT -->
					<div class="main">
						<!-- MAIN CONTENT -->
						<div class="main-content">
							<div class="container-fluid">
								<h3 class="page-title">注文詳細</h3>
					<?php $order = Order::find($_GET["id"]);
								$order_details = $order->get_order_details();
					?>
								<h3 class="page-title">注文コード：<?= $order->code ?></h3>
								<div class="row">
									<div class="col-md-12">
										<!-- PANEL HEADLINE -->
										<div class="panel panel-headline">
											<table class="table table-hover"   border="3">
												<tr>
													<th>料理名</th>
													<th>点数</th>
													<th>単価</th>
												</tr>
													<?php foreach($order_details as $order_detail) : ?>
														<tr>
															<td><?= Product::find($order_detail->product_id)->name;?></td>
															<td><?= $order_detail->number ?></td>
															<td><?= $order_detail->price ?></td>
														</tr>
													<?php endforeach; ?>
											</table>
											<table class="table table-hover" align="left"  border="3">
												<tr>
													<td>ID</td>
													<td><?= $order->id ?></td>
												</tr>
												<tr>
													<td>テーブル名</td>
													<td><?= Table::find($order->table_id)->name ?></td>
												</tr>
												<tr>
													<td>状態</td>
													<td><?= $order->get_status_name() ?></td>
												</tr>
												<tr>
													<td>総金額</td>
													<td><?= $order->get_price_sum() ?></td>
												</tr>
												<tr>
													<td>注文時間</td>
													<td><?= $order->ordered_time ?></td>
												</tr>
												<tr>
													<td>作成時間</td>
													<td><?= $order->made_time ?></td>
												</tr>
												<tr>
													<td>支払時間</td>
													<td><?= $order->paid_time ?></td>
												</tr>
											</table>
											<button><a href="get_index.php">戻る</a></button>
			<!-- END WRAPPER -->
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2019 <a href="https://www.themeineed.com" target="_blank">created by maggie</a>. 2019.4.1.</p>
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

</html>
