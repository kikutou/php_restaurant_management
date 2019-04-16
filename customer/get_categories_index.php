<?php
include_once("../model/Category.php");
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>ヤーミー居酒屋へようこそ</title>
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
  <h1>カテゴリー</h1>
 </div>

 <div class="container">
  <div class="row">
    <?php
    $categories = Category::get();
    foreach($categories as $category):
    ?>

    <div class="col-4 text-center has-border">
      <a href="get_products_index.php?id=<?=$category->id ?>">
        <img src="<?php echo "hello/".$category->picture;?>" width="200" height="200" alt="<?= $category->picture ?>">
      </a>
      <br>
      <p>
        <a href="get_products_index.php?id=<?=$category->id ?>">
        <?php echo $category->name; ?>
      </p>
    </div>

    <?php endforeach ?>
    </div>
   </div>

   <div align="center" class="footer">
     <div align="right">
       <a href="shopping_cart.php">
       <img src="../asset/customer/img/shoppingcart.png" width="100" height="100" alt="shoppingcart">
     </div>
     <p>&copy;Copyright Japan YaMii group. All rights reserved.</p>
   </div>

</div>
</body>
</html>
