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
      <p><a href=""><img src="<?php echo "image/".$category->picture; //写真の前にimage/でファイルが格納されているフォルダを明示?>" width="200" height="200"></a>
                    <br><?php echo $category->name; ?></p>
    </div>

    <?php endforeach ?>
    </div>
   </div>

<div align="center" class="footer">
 <p>&copy;Copyright Japan YaMii group. All rights reserved.</p>
</div>
</body>
</html>
