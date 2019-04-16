<?php
include_once("../model/Category.php");
include_once("../model/Product.php");
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title><?= Category::find($_GET["category_id"])->name ?>のメニュー</title>
<link rel="stylesheet" type="text/css" href="style.css" charset="utf-8">
<link href="https://w3g.jp/sample/css/font-family" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/css/bootstrap.min.css">
<script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/popper.js/1.12.5/umd/popper.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<body align="center">
  <div class="jumbotron text-center">
    <h1><?= Category::find($_GET["category_id"])->name ?></h1>
  </div>
  <div class="container">
    <div class="row">
      <?php
      $products = Product::get();
      $product_in_this_category=array();
      foreach($products as $product) {
        if($product->category_id == $_GET["category_id"]){
          $products_in_this_category[] = $product;
        }
      };

      foreach($products_in_this_category as $product_in_this_category) : ?>
        <div class="col-4 text-center">
          <a href="get_product_detail.php?product_id=<?=$product_in_this_category->id ?>">
            <img src="<?php echo "image/".$product_in_this_category->picture;?>" width="200" height="200" alt="<?= $product_in_this_category->picture ?>">
          </a><br>
          <p><a href="get_product_detail.php?product_id=<?=$product_in_this_category->id ?>">
             <?php echo $product_in_this_category->name; ?></a>
          </p>
          <p><?php echo $product_in_this_category->price; ?></p>
          <button type="button" class="btn btn-warning">
            <a href="shopping_cart.php?product_id=<?= $product_in_this_category->id ?>&action=add">カート入れ
            </a>
          </button>
        </div>
      <?php endforeach ?>
    </div>
   </div>

   <div align="center">
     <button type="button" class="btn"><a href="get_categories_index.php">戻る</a></button>
   </div>

   <div align="center" class="footer">
     <div align="right">
       <a href="shopping_cart.php">
       <img src="../asset/customer/img/shoppingcart.png" width="100" height="100" alt="shoppingcart"></a>
     </div>
     <p>&copy;Copyright Japan YaMii group. All rights reserved.</p>
   </div>


</body>
</html>
