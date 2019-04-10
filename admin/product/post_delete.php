<?php include_once("../../model/Product.php"); ?>

<html>
<head>
  <title>test form</title>
</head>
<body>

  <?php
  $product = new Product();
  $product->id = $_POST["id"];
  $product->deleted_at = date("Y-m-d H:i:s");
  $product->delete();
  echo "該当商品削除しました";
  ?>


<a href="get_index.php">戻る</a></br>
</body>
</html>
