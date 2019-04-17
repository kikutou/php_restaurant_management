<!--functionを導入する-->
<?php
include_once("../model/Order.php");
include_once("../model/Order_detail.php");
include_once("../model/Table.php");
?>

<!DOCTYPE html>
<html lang="zh">
<head>
	<title>yami　注文一覧</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/css/bootstrap.min.css">
	<script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/popper.js/1.12.5/umd/popper.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../asset/kitchen/css/css.css" />
	<link rel="stylesheet" type="text/css" href="../asset/kitchen/css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="../asset/kitchen/css/htmleaf-demo.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<!--ssMenu CSS-->
    <link rel="stylesheet" href="../asset/kitchen/css/ss-menu.css">
    <link rel="stylesheet" href="../asset/kitchen/css/demo.css">
</head>
<body>
	<!--Start Side Sticky Menu-->
	<nav class="ss-menu ">
	 <ul>
	    <li><a href="get_index.php"><i class="fa fa-bar-chart">注文一覧</i></a></li>
	    <li><a href="get_index.php"><i class="fa fa-bookmark-o"></i>注文詳細</a></li>
	 </ul>
	</nav>

	<?php
	//index_function
	$orders = Order::find_not_made_orders();
	?>


	<div class="htmleaf-container">
		<header class="htmleaf-header">
  			<span><h1>注文一覧</h1></span>
				<img src="related/WechatIMG60.jpg">
		</header>
	</div>

	<div class="container">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>注文コード</th>
					<th>テーブル番号</th>
					<th>料理の数</th>
				</tr>
			</thead>

			<?php foreach($orders as $order) {

				echo "<tr>";
				echo "<td>" . $order->code . "</td>";
				echo "<td>" . Table::find($order->table_id)->name . "</td>";
				echo "<td>" . $order->get_all_finished_product_number() . "/" . $order->get_all_product_number() . "</td>";
				echo "<td>" . "<a href='get_detail.php?id=" . $order->id . "'>" . "作業" . "</a>" . "</td>";
				echo "</tr>";

			}
			?>

		</table>
	</div>

		<script src="../asset/kitchen/js/jquery-1.11.0.min.js" type="text/javascript"></script>
		<script src="../asset/kitchen/js/jquery.ss.menu.js"></script>
		<script>
		 $(document).ready(function(){

			 $(".ss-menu").ssMenu();

		 });

		</script>
</body>
</html>
