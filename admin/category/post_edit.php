<?php include_once("../../model/Category.php"); ?>
<html>
<head>
  <title></title>
</head>
<body>

<?php
$error_messages = Category::validate($_POST);

if(count($error_messages) > 0) {
  // エラーメッセージを表示する。
  foreach ($error_messages as $message) {
    echo $message . "<br />";
  }
  exit();
}


$user = new Category();
//edit_function
$user->id = $_POST["id"];
$user->name = $_POST["name"];
$user->rank = $_POST["rank"];
$user->picture = $_POST["picture"];
$user->updated_at = date("Y-m-d H:i:s");


$result = $user->save();

if($result != true) {
  echo "変更失敗";
} else {
  echo "変更成功";
}


 ?>
<a href='http://127.0.0.1/restaurant/admin/category/get_index.php'>戻る</a></br>
</body>
</html>
