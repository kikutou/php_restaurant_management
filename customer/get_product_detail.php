<?php
include_once("../model/Category.php");
include_once("../model/Product.php");
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title><?php $product = find($_GET["id"]);
             echo $product->name ?>について</title>
<link rel="stylesheet" type="text/css" href="style.css" charset="utf-8">
<link href="https://w3g.jp/sample/css/font-family" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/css/bootstrap.min.css">
<script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/popper.js/1.12.5/umd/popper.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<body align="center">
  <div class="jumbotron text-center has-border">
    <h1><?= $product->name ?></h1>
  </div>
  <div class="container　 has-border">
        <div  align="center">
          <a href="get_product_detail.php?id=<?=$product->id ?>">
            <img src="<?php echo "hello/".$product->picture;?>" width="300" height="300" alt="<?= $product->picture ?>">
          </a>
        </div>
          <h3>カテゴリ名:<?php echo Category::find($product->category_id)->name ?></h3>
          <h3>単価:<?php echo $product->price; ?>円</h3>
          <h3>商品説明:<?php echo $product->instruction; ?></h3>
   </div>

   <div align="center">
     <button type="button" class="btn btn-warning">
       <a href="shopping_cart.php?product_id=<?= $product->id ?>&action=add">カート入れ
       </a>
     </button>
     <button type="button" class="btn"><a href="get_categories_index.php">戻る</a></button>
   </div>

   <div align="center" class="footer">
     <div align="right">
       <a href="shopping_cart.php">
       <img src="../asset/customer/img/shoppingcart.png" width="100" height="100" alt="shoppingcart">
     </div>
     <p>&copy;Copyright Japan YaMii group. All rights reserved.</p>
   </div>


</body>
</html>
