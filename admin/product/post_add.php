<!--functionを導入する-->
<?php include_once("../../model/Product.php"); ?>
<html>
<head>
  <title></title>
</head>
<body>

<?php

//データ収集とバリデーション
$error_messages = Product::validate($_POST);
if(count($error_messages) > 0) {
  // エラーメッセージを表示する。
  foreach ($error_messages as $message) {
    echo $message . "<br />";
  }
  exit();
}

$products = new Product();
//add_function
$products->name = $_POST["name"];
$products->price = $_POST["price"];
$products->instruction= $_POST["instruction"];
$products->picture= $_POST["picture"];
$products->created_at = date("Y-m-d H:i:s");
$products->updated_at = date("Y-m-d H:i:s");
$result = $products->save();


if($result) {
  echo "挿入成功";
}

 ?>

<a href='get_index.php'>戻る</a></br>
</body>
</html>
