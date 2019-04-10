<?php
include_once("Db.php");

class Product {

  public $id;
  public $name;
  public $category_id;
  public $price;
  public $picture;
  public $instruction;
  public $created_at;
  public $updated_at;
  public $deleted_at;

  //データ収集とバリデーション
  public static function validate($input_data)
  {

    $result = array();

    $name = $input_data["name"];
    $price = $input_data["price"];
    $instruction = $input_data["instruction"];
    $category_id = $input_data["category_id"];

    if(empty($name)) {
      $result[] = "商品名を入力ください。";
    }

    if(empty($price)){
      $result[]="値段を入力してください!";
    } elseif (!is_numeric($price)){
      $result[]="値段を正しく記入してください！";
    }

    if(empty($instruction)) {
      $result[] = "紹介文を入力してください。";
    }

    if(empty($category_id)) {
      $result[] = "カテゴリーIDを入力してください。";
    }

    return $result;

  }

  //get_function(index)
  public static function get()
  {
    $db = new Db();
    $conn = $db->connect_db();
    $sth = $conn->query("SELECT * FROM products WHERE deleted_at IS NULL");
    $sth->setFetchMode(PDO::FETCH_CLASS, 'Product');
    $result = $sth->fetchAll();
    return $result;
  }

  //find_function(detail)
  public static function find($id)
  {
    $all = Product::get();
    $result = null;
    foreach($all as $one_record) {
      if($one_record->id == $id) {
        $result = $one_record;
      }
    }
    return $result;
  }


  public function delete()
  {
  	$db = new Db();
  	$conn = $db->connect_db();
  	// SQL文組み立て
  	$sql = "UPDATE products SET deleted_at=:deleted_at WHERE id=:id";
    // SQL ステートメントを準備
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
  	$stmt->bindParam(':deleted_at', $this->deleted_at, PDO::PARAM_STR);

    $stmt->execute();

    $stmt = null;
  }

  //統合と判断(add+eddit)
  public function save()
  {
    if($this->id) {
      return $this->edit();
    } else {
      return $this->add();
    }
  }

  //add_function
  private function add()
  {

    $db = new Db();
    $conn = $db->connect_db();
    // SQL文組み立て
    $sql = "INSERT INTO users
            (name, category_id, price, picture, instruction, created_at)
            VALUES
            (:name, :category_id, :price, :picture, :instruction, :created_at, :created_at)";
    // SQL ステートメントを準備
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
    $stmt->bindParam(':category_id', $this->category_id, PDO::PARAM_INT);
    $stmt->bindParam(':price', $this->price, PDO::PARAM_INT);
    $stmt->bindParam(':picture', $this->picture, PDO::PARAM_STR);
    $stmt->bindParam(':instruction', $this->instruction, PDO::PARAM_STR);
    $stmt->bindParam(':updated_at', $this->updated_at, PDO::PARAM_STR);

    $stmt->execute();
    $stmt = null;

    return true;

  }

  //edit_function
  private function edit()
  {
    $db = new Db();
    $conn = $db->connect_db();
    // SQL文組み立て
    $sql = "UPDATE users SET name =:name,
                            category_id =:category_id,
                            price =:price,
                            picture =:picture,
                            instruction =:instruction,
                            updated_at =:updated_at
                            WHERE id =:id";

    // SQL ステートメントを準備
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
    $stmt->bindParam(':category_id', $this->category_id, PDO::PARAM_INT);
    $stmt->bindParam(':price', $this->price, PDO::PARAM_INT);
    $stmt->bindParam(':picture', $this->picture, PDO::PARAM_STR);
    $stmt->bindParam(':instruction', $this->instruction, PDO::PARAM_STR);
    $stmt->bindParam(':updated_at', $this->updated_at, PDO::PARAM_STR);
    $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

    $stmt->execute();
    $stmt = null;

    return true;
  }


  public function pitcure ()
  {
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
    && ($_FILES["picture"]["size"] < 2048000000000)   // 小于 200 kb
    && in_array($extension, $allowedExts))
    {
      if ($_FILES["picture"]["error"] > 0)
      {
          echo "错误：: " . $_FILES["picture"]["error"] . "<br>";
          exit();
      }
      else
      {

          // 判断当期目录下的 upload 目录是否存在该文件
          // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
          if (file_exists("../../asset/admin/img/upload/" . $_FILES["picture"]["name"]))
          {
              echo $_FILES["picture"]["name"] . " 文件已经存在。 ";
              exit();
          }
          else
          {
              // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
              move_uploaded_file($_FILES["picture"]["tmp_name"], "../../asset/admin/img/upload/" . $_FILES["picture"]["name"]);
              $picture_path = "../../asset/admin/img/upload/" . $_FILES["picture"]["name"];
          }
      }
    }
    else
    {
      echo "非法的文件格式";
      exit();
    }
  }


}
?>
