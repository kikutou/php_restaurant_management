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

$find = Category::find( $_POST["id"]);
//edit_function
$find->name = $_POST["name"];
$find->rank = $_POST["rank"];
$find->updated_at = date("Y-m-d H:i:s");

//上传了的话
if(empty($_FILES["picture"])){


}else{



  $allowedExts = array("gif", "jpeg", "jpg", "png");
  $temp = explode(".", $_FILES["picture"]["name"]);
  $extension = end($temp);     // 获取文件后缀名
  if ((($_FILES["picture"]["type"] == "image/gif")
  || ($_FILES["picture"]["type"] == "image/jpeg")
  || ($_FILES["picture"]["type"] == "image/jpg")
  || ($_FILES["picture"]["type"] == "image/pjpeg")
  || ($_FILES["picture"]["type"] == "image/x-png")
  || ($_FILES["picture"]["type"] == "image/png"))
  && ($_FILES["picture"]["size"] < 2048000000)   // 小于 200 kb
  && in_array($extension, $allowedExts))
  {
      if ($_FILES["picture"]["error"] > 0)
      {
          echo "エラー：: " . $_FILES["picture"]["error"] . "<br>";
          exit();
      }
      else
      {

        // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
        $picture_name = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1, 10);
        $picture_name = $picture_name .".". $extension;
          // 判断当期目录下的 upload 目录是否存在该文件
          // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
          if (file_exists("../../asset/admin/img/upload/" . $picture_name))
          {
              echo $picture_name . "当ファイルはもう既に存在しています";
              exit();
          }
          else
          {
              move_uploaded_file($_FILES["picture"]["tmp_name"], "../../asset/admin/img/upload/" . $picture_name);
              $picture_path = "../../asset/admin/img/upload/" . $picture_name;


              $find->picture = $picture_path;


          }

      }

  }
  else
  {
      echo "正しいファイルタイプをアップロードしてください";
      exit();
  }
}


$result = $find->save();
if($result != true) {
  echo "変更失敗";
} else {
  echo "変更成功";
  echo "<br>";
}


 ?>
<a href='http://localhost/php_restaurant_management/admin/category/get_index.php'>戻る</a></br>
</body>
</html>
