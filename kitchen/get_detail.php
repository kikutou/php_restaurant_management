<!--functionを導入する-->
<?php
include_once("../model/Order.php");
include_once("../model/Order_detail.php");
include_once("../model/Product.php");
include_once("../model/Table.php")
?>

<!DOCTYPE html>
<html lang="jp">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/css/bootstrap.min.css">
	<script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/popper.js/1.12.5/umd/popper.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<title>yami　注文一覧</title>
	<link rel="stylesheet" type="text/css" href="../asset/kitchen/css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="../asset/kitchen/css/htmleaf-demo.css">
	<link rel="stylesheet" type="text/css" href="../asset/kitchen/css/css.css" />
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<!--ssMenu CSS-->
    <link rel="stylesheet" href="../asset/kitchen/css/ss-menu.css">
    <link rel="stylesheet" href="../asset/kitchen/css/demo.css">
</head>
<body>
	<!--Start Side Sticky Menu-->
	<nav class="ss-menu">
	 <ul>
	    <li><a href="get_index.php"><i class="fa fa-bar-chart">注文一覧</i></a></li>
			<li><a href="get_detail.php"><i class="fa fa-bookmark-o"></i>注文詳細</a></li>
	 </ul>
	</nav>
	<!--End Side Sticky Menu-->
	<div class="htmleaf-container">
		<header class="htmleaf-header">
  			<span><h1>注文詳細</h1></span>
				<img src="related/WechatIMG60.jpg">
		</header>
	</div>

	<?php
	$order = Order::find($_GET["id"]);
	$order_details = $order->get_order_details();
	?>

		<div class="container">
      <div class="code">
				<span><h2>テーブル番号:<?= $order->table_id ?></h2></span>
			</div>
      <table class="table table-striped">
        <thead>
  		   <tr>
  			  <th>料理名</th>
  			  <th>料理の数</th>
          <th> </th>
  	  	 </tr>
       </thead>

			 <?php foreach($order_details as $order_detail) : ?>
				 <tr>
					 <td><?= Product::find($order_detail->product_id)->name;?></td>
					 <td><?= $order_detail->number ?></td>
					 <td>
						 	<form>
						 	<?php if($order_detail->finish_flg==1){echo '<input type="submit" value="完了";"/>';}
						 				elseif($order_detail->finish_flg==2){echo '<input type="hidden" value="料理済み");"/>';}
						 				elseif($order_detail->finish_flg==3){echo "不明な注文";}
							?>
						</form>
					 </td>
				 </tr>
			 <?php endforeach; ?>

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
