<?php
include_once("../model/Table.php");
include_once("../model/Product.php");
include_once("../model/Session.php");

$action = $_GET["action"];

Session::init_session();

if($action == "add") {
	$product_id = $_GET["product_id"];
	Session::add($product_id);
} elseif($action == "delete") {
	$product_id = $_GET["product_id"];
	Session::delete($product_id);
} elseif($action == "edit") {
	Session::edit($_GET);
}

$session_data = Session::fix_data();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>注文カート</title>
  <link rel="stylesheet" type="text/css" href="../asset/customer/css/style.css" charset="utf-8">
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="wrapper">
<?php
if($_SESSION == NULL){
?>
	<h1 class="logo">注文カート</h1>
  <img src="../asset/customer/img/shoppingcart.png" width="50" height="50">
	<h3>注文カートに何も入っていません！</h3>
	<button><a href="get_categories_index.php">早速注文しましょう！</a></button>
<?php
} else {
?>

 <h1 class="logo">注文カート</h1>
  <img src="../asset/customer/img/shoppingcart.png" width="50" height="50" alt="">
  <table class="table table-striped">
    <thead>
 		<tr>
 			<th>商品名</th>
 			<th>単価</th>
			<th></th>
 			<th>個数</th>
			<th></th>
			<th>値段</th>
      <th>削除</th>
 		</tr>
    </thead>
		<form action="shopping_cart.php" method="get">
			<input type="hidden" name="action" value="edit">
		<?php
		$cart = $session_data;
		$sum = 0;
		foreach($cart as $cart_record):
		?>
 	  <tbody>
 		<tr>
 			<td><?= Product::find($cart_record["product_id"])->name ?></td>
 			<td>&yen;<?= Product::find($cart_record["product_id"])->price ?></td>
			<td>*</td>
			<td>

			<select name="<?= $cart_record["product_id"]; ?>">
					<?php for($i = 1; $i <= 10; $i++): ?>
					<option value="<?= $i ?>"
						<?php
							if($i == $cart_record["number"]) {
								echo "selected";
							}
						 ?>
						><?= $i ?></option>
				<?php endfor; ?>
			</select>
		</td>
				<th>=</th>
				<td><?= Product::find($cart_record["product_id"])->price*$cart_record["number"] ?></td>
				<?php $sum = $sum + Product::find($cart_record["product_id"])->price*$cart_record["number"]; ?>
      <td>
				<button type="button"><a href="?product_id=<?= $cart_record["product_id"] ?>&action=delete">削除</a>
				</button>
			</td>
 		</tr>
 	  </tbody>
<?php endforeach ?>


  </table>

	<input type="submit" value="精算">

	</form>
  <h4>総金額：<?= $sum ?>円</h4>
	<button><a href="get_categories_index.php">カテゴリーに戻る</a></button>



	<form action="finish.php" method="post">

		テーブル名：<select name="table_id">
		<?php foreach(Table::get() as $table) :?>
			 <option value="<?= $table->id ?>"><?= $table->name ?></option>
		<?php endforeach ?>

		<input type="submit" value="注文確認">
	 </form>
<?php } ?>

<div class="footer">
  <p>&copy;Copyright Japan YaMii group. All rights reserved.</p>
</div>
</div>
</body>
</html>
