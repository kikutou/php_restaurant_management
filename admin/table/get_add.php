<!doctype html>
<html lang="en">

<head>
	<title>テーブル増加</title>
	<?php
	include_once("../../model/Table.php");

	$result = Table::find($_GET["id"]);

	?>
	<style>
.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #FF5997;
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
						<li><a href="table_searching.html" class=""><i class="lnr lnr-code"></i> <span>会計テーブル指定</span></a></li>
						<li><a href="order_index.html" class="active"><i class="lnr lnr-cog"></i> <span>注文管理</span></a></li>
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
					<h3 class="page-title">テーブル増加</h3>
					<div class="row">
						<div class="col-md-12">
							<!-- PANEL HEADLINE -->
							<div class="panel panel-headline">
								<table class="table table-hover" align="middle" >


									<tbody>
										<tr>

											<tr>
													<td><form action="post_add.php" method="post">

													名前　　：<input type="text" name="name">
													         <input type="submit" value="増加" class="button">
												</form></td>
                      </tr>




											<!-- <td><?php echo $record->id; ?></td>
											<td><?php echo $record->name;?></td>
											<td><?php echo $record->created_at; ?></td>
											<td><?php echo $record->updated_at; ?></td>
											<td><a href="get_detail.php?id=<?php echo $record->id;?>" class="button">詳細</a></td>
											<td><a href="get_edit.php?id=<?php echo $record->id;?>" class="button">編集</a></td>
											<td><a href="get_delete.php?id=<?php echo $record->id; ?>" class="button">削除</a></td> -->
											<!-- <td><a href="category_detail.html" class="button">詳細</a></td>
											<td><a href="category_edit.html" class="button">編集</a></td>
											<td><a href="category_delete.html" class="button">削除</a></td> -->
										</tr>

									</tbody>



								</table>


							<!-- END PANEL HEADLINE -->
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
	<div class="row">
		<div class="col-md-4 col-md-offset-5">
			<a href="get_indext.php" class="button">戻る</a>
		</div>
	</div>

	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="../../asset/admin/vendor/jquery/jquery.min.js"></script>
	<script src="../../asset/admin/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../../asset/admin/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="../../asset/admin/scripts/klorofil-common.js"></script>
</body>

</html>
