<?php
include_once("../../model/db.php");
include_once("../../model/Order_detail.php");
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
						<li><a href="index.html" class=""><i class="lnr lnr-home"></i> <span>ホームページ</span></a></li>
						<li><a href="table_searching.html" class="active"><i class="lnr lnr-code"></i> <span>会計テーブル検索</span></a></li>
						<li><a href="order_index.html" class=""><i class="lnr lnr-cog"></i> <span>注文管理</span></a></li>
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
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<h3 class="page-title">注文内容</h3>
					<div class="row">
						<div class="col-md-12">
							<!-- BASIC TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">注文番号：</h3>
									<h4 class="panel-title">注文状態：</h4>
								</div>
								<div class="panel-body">
									<table class="table" >
										<thead>
											<tr>
												<th>料理の名</th>
												<th>料理の数</th>
												<th>単価</th>
											</tr>
										</thead>
										<?php
										$order_id = new Order_detail();//Order_detailというclassを使用したい
										$order_id->order_id = 1;//$order_idがpublic変数のorder_idを賦値される(ここはtable_idと繋がる必要がある)
										$results = $order_id->find_orderid();
										foreach($results as $result){
										?>
										<tbody>
											<tr>
												<td><?php echo $result->product_id ?></td>
												<td><?php echo $result->number ?></td>
												<td><?php echo $result->price ?></td>
											</tr>
										</tbody>
									<?php } ?>
									</table>
								</div>
							</div>
							<!-- END BASIC TABLE -->
						</div>
						<div class="col-md-12">
							<!-- TABLE NO PADDING -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">注文番号：</h3>
									<h4 class="panel-title">注文状態：</h4>
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
											<tr>
												<td>ハンバーグ</td>
												<td>1</td>
												<td>800</td>
											</tr>
											<tr>
												<td>ハンバーグ</td>
												<td>1</td>
												<td>800</td>
											</tr>
											<tr>
												<td>ハンバーグ</td>
												<td>1</td>
												<td>800</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>


							<!-- END CONDENSED TABLE -->
						</div>
					</div>
					<p style="float:right"> 総金額：9999円</a><br/>

				</div>
					<a  style="float:center" href="thanks.html" class="button"　>会計</a>

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
