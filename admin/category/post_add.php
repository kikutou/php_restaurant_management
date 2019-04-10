<!--functionを導入する-->
<?php include_once("../../model/Category.php"); ?>

<html>
<head>
  <title></title>
</head>
<body>

<?php

//データ収集とバリデーション
$error_messages = Category::validate($_POST);

if(count($error_messages) > 0) {
  // エラーメッセージを表示する。
  foreach ($error_messages as $message) {
    echo $message . "<br />";
  }
  exit();
}

//上传文件代码
// 允许上传的图片后缀
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
        echo "错误：: " . $_FILES["picture"]["error"] . "<br>";
        exit();
    }
    else
    {

      // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
      //设置乱码让同样图片可以无限上传
      $picture_name = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1, 10);
      $picture_name = $picture_name .".". $extension;
        // 判断当期目录下的 upload 目录是否存在该文件
        // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
        if (file_exists("../../asset/admin/img/upload/" . $picture_name))
        {
            echo $picture_name . " 文件已经存在。 ";
            exit();
        }
        else
        {

            move_uploaded_file($_FILES["picture"]["tmp_name"], "../../asset/admin/img/upload/" . $picture_name);
            $picture_path = "../../asset/admin/img/upload/" . $picture_name;
        }
    }
}
else
{
    echo "非法的文件格式";
    exit();
}

// <!--END 上传文件代码--!>




$user = new Category();
//add_function
$user->rank = $_POST["rank"];
$user->name = $_POST["name"];
$user->picture = $picture_path;
$user->created_at = date("Y-m-d H:i:s");
$user->updated_at = date("Y-m-d H:i:s");


$result = $user->save();

if($result) {
  echo "挿入成功";
}

 ?>

<a href='get_add.php' class="button">戻る</a></br>
</body>
</html>
