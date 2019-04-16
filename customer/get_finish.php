<?php
include_once("../model/Order.php");
include_once("../model/Product.php");
include_once("../model/Order_detail.php");
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>注文完了</title>
<link rel="stylesheet" type="text/css" href="style.css" charset="utf-8">
<link href="https://w3g.jp/sample/css/font-family" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<?php

$input_data = array(
  "code" => Order::generateRandomString(),
  "table_id" => $_POST["table_id"],
  "status" => 1,
  "ordered_time" => date("Y-m-d H:i:s"),
  "made_time" => null,
  "paid_time" => null
);
$error_messages = Order::validate($input_data);
if(count($error_messages) > 0) {
  foreach ($error_messages as $message) {
    echo $message . "<br />";
  }
  exit();
}

$order = new Order();
$order->code = $input_data["code"];
$order->status = $input_data["status"];
$order->table_id = $input_data["table_id"];
$order->ordered_time = $input_data["ordered_time"];
$order->created_at = date('Y-m-d H:i:s');
$order->updated_at = date('Y-m-d H:i:s');
$order->save();

$order_id = $order->id;

session_start();
$cart = $_SESSION["cart"];

foreach ($cart as $one_record) {
  $order_detail_data = array(
    "product_id" => $one_record["product_id"],
    "order_id" => $order_id,
    "price" => Product::find($one_record["product_id"])->price,
    "number" => $one_record["number"]
  );
  $error_messages = Order_detail::validate($order_detail_data);

  if(count($error_messages) > 0) {
    foreach ($error_messages as $message) {
      echo $message . "<br />";
    }
    exit();
  }

  $order_detail = new Order_detail();
  $order_detail->product_id = $order_detail_data["product_id"];
  $order_detail->order_id = $order_detail_data["order_id"];
  $order_detail->price = $order_detail_data["price"];
  $order_detail->number = $order_detail_data["number"];
  $order_detail->created_at = date("Y-m-d H:i:s");
  $order_detail->updated_at = date("Y-m-d H:i:s");
  $order_detail->save();
}


session_destroy();


?>
<body align="center">
<div>
 <p><img src="../asset\customer\img\arigato-gozaimashita.png" width="400" height="300" alt=""></p>
 <p><img src="../asset\customer\img\tenin-woman-man-thankyou-01-01.png" width="400" height="400" alt=""></p>
<p><a href="get_categories_index.php"><button>カテゴリーに戻る</button></a></p>
</div>
<div class="footer">
  <p>&copy;Copyright Japan YaMii group. All rights reserved.</p>
</div>
</body>
</html>
