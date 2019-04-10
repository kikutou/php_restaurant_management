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

//delete function
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
    $sth = "INSERT INTO products
            (name,category_id,price,picture,instruction,created_at,updated_at)
            VALUES
            (:name,:category_id,:price,:picture,:instruction,:created_at,:updated_at)";
    // SQL ステートメントを準備
    $stmt = $conn->prepare($sth);

    $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
    $stmt->bindParam(':category_id', $this->category_id, PDO::PARAM_INT);
    $stmt->bindParam(':price', $this->price, PDO::PARAM_INT);
    $stmt->bindParam(':picture', $this->picture, PDO::PARAM_STR);
    $stmt->bindParam(':instruction', $this->instruction, PDO::PARAM_STR);
    $stmt->bindParam(':created_at', $this->created_at, PDO::PARAM_STR);
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
    $sth = "UPDATE products SET name =:name,
                            category_id =:category_id,
                            price =:price,
                            picture =:picture,
                            instruction =:instruction,
                            updated_at =:updated_at
                            WHERE id =:id";

    // SQL ステートメントを準備
    $stmt = $conn->prepare($sth);

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

}
?>
