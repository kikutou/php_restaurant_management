<?php
include_once("../../model/Order_detail.php");
include_once("../../model/Order.php");
include_once("../../model/Product.php");
include_once("../../model/Table.php");


?>
<!doctype html>
<html lang="en">

<head>
	<title>注文内容</title>
	<style>
	.button {
	    background-color: #4CAF50; /* Green */
	    border: none;
	    color: white;
	    padding: 5px 16px;
	    text-align: center;
	    text-decoration: none;
	    display: inline-block;
	    font-size: 16px;
	    margin: 4px 2px;
	    cursor: pointer;

	}

	.button1 {
	    background-color: white;
	    color: black;
	    border: 2px solid #4CAF50;
	}

</style>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="../../asset/admin/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../asset/admin/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="../../asset/admin/vendor/linearicons/style.css">
	<link rel="stylesheet" href="../../asset/admin/vendor/chartist/css/chartist-custom.css">
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
						<li><a href="../category/get_index.php" class=""><i class="lnr lnr-home"></i> <span>ホームページ</span></a></li>
						<li><a href="get_table.php" class="active"><i class="lnr lnr-code"></i> <span>会計テーブル検索</span></a></li>
						<li><a href="../order/get_index.php" class=""><i class="lnr lnr-cog"></i> <span>注文管理</span></a></li>
						<li>
							<a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>メニュー管理</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
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
					<h3 class="page-title">注文内容</h3>

					<?php

					$table = Table::find($_POST["id"]);
           if($table == null) {
 					        echo "正しいテーブル番号を入力してください";
 									echo "<br>";
 									echo "<a href=\"get_table.php\""."<button>"."戻る"."</button>"."</a>";
 			         	} else {
					 $orders = $table->get_all_not_paid_orders();

					 foreach($orders as $order):

					?>
					<div class="row">
						<div class="col-md-12">
							<!-- TABLE NO PADDING -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">注文コード：<?php echo $order->code; ?></h3>
									<h4 class="panel-title">注文状態：<?php echo $order->get_status_name() ; ?></h4>
								</div>
								<div class="panel-body">
									<table class="table">
										<thead>
											<tr>
												<th>料理の名</th>
												<th>料理の数</th>
												<th>金額</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$order_details = $order->get_order_details();
											foreach($order_details as $order_detail):

											 ?>
											<tr>
												<td><?php echo Product::find($order_detail->product_id)->name; ?></td>
												<td><?php echo $order_detail->number; ?></td>
												<td><?php echo $order_detail->price; ?></td>
											</tr>
										<?php endforeach; ?>

										</tbody>
									</table>
								</div>
							</div>
							<!-- END CONDENSED TABLE -->
						</div>
					</div>
					<?php endforeach; ?>

					<p style="float:right"> 総金額：<?php echo $table->get_pay_sum(); ?>円</a><br/>
				</div>
					<a  style="float:center" href="thanks.html" class="button"　>会計</a>
				 <?php } ?>
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
</body>

</html>
