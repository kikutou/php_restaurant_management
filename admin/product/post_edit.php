<?php include_once("../../model/Product.php"); ?>
<html>
<head>
  <title></title>
</head>
<body>

<?php
$error_messages = Product::validate($_POST);

if(count($error_messages) > 0) {
  // エラーメッセージを表示する。
  foreach ($error_messages as $message) {
    echo $message . "<br />";
  }
  exit();
}


$product = new Product();
//edit_function
$product->id = $_POST["id"];
$product->name = $_POST["name"];
$product->price = $_POST["price"];
$product->category_id = $_POST["category_id"];
$product->$picture = $_POST["picture"];
$product->instruction = $_POST["instruction"];
$product->updated_at = date("Y-m-d H:i:s");

$result = $product->save();

if($result != true) {
  echo "変更失敗";
} else {
  echo "変更成功";
}


 ?>
<a href="get_index.php">戻る</a></br>
</body>
</html>
