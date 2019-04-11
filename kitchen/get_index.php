<?php
include_once("../model/Order.php");
include_once("../model/Table.php");
include_once("../model/Order_detail.php");


?>
<!DOCTYPE html>
<html lang="zh">
<head>
	<title>注文一覧</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/css/bootstrap.min.css">
	<script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/popper.js/1.12.5/umd/popper.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../asset/kitchen/css/css.css" />
	<link rel="stylesheet" href="../asset/kitchen/css/css.css" />
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
	    <li><a href="get_order_index.html"><i class="fa fa-bookmark-o"></i>注文詳細</a></li>
	 </ul>
	</nav>

	<div class="htmleaf-container">
		<header class="htmleaf-header">
  			<span><h1>キッチン</h1></span>
		</header>
	</div>

	<div class="container">
		<h1>注文一覧</h1>
		<table class="table table-striped">
			<thead>
			 <tr>
				<th>注文コード</th>
				<th>テーブル名</th>
				<th>料理の数</th>
				<th></th>
			 </tr>
			</thead>
			<?php $orders = new Order();
						$not_made_orders = $orders->find_not_made_orders();
						$order_details = new Order_detail();
						foreach($not_made_orders as $not_made_order) :
							$order_details->order_id = $not_made_order->id;
							if($order_details->count_all_products()!=$order_details->count_already_made_products()) {
			?>
			<tr>
				<td><?= $not_made_order->code ?></td>
				<td><?= Table::find($not_made_order->table_id)->name ?></td>
				<td><?php
					echo $order_details->count_already_made_products()."/".
					$order_details->count_all_products() ?>
				</td>
				<td><a href='get_order_index.html'><button type="button" class="btn btn-primary">作業</button></a></td>
			</tr>
		<?php } endforeach ?>

		</table>
	</div>


	<script src="../asset/kitchen/js/jquery-1.11.0.min.js" type="text/javascript"></script>
	<script src="../asset/kitchen/js/jquery.ss.menu.js"></script>
	<script>
	 $(document).ready(function(){

	   $(".ss-menu").ssMenu();

	 });

	</script>
	<script>
         $(function(){
           var ssMenu = $(".ss-menu");
           var theme = $(".theme-picker").find("span");

            $(theme).click(function(y){

              y = $(this).attr("class");

              $(ssMenu).removeClass().addClass("ss-menu " +y); //Aaah what a nice


            });

            $(".set-default").click(function(){
                   $(ssMenu).removeClass().addClass("ss-menu default");

            });

         });

      </script>
</body>
</html>
