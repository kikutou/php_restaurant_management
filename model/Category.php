<?php
include_once("db.php");

class Category {

  public $id;
  public $name;
  public $picture;
  public $rank;
  public $created_at;
  public $updated_at;
  public $deleted_at;

  //データ収集とバリデーション
  public static function validate($input_data)
  {

    $result = array();

    $name = $input_data["name"];
    $rank = $input_data["rank"];


    if(empty($name)) {
      $result[] = "名前を入力ください。";
    }


    if(empty($rank)) {
      $result[] = "ランクを入力してください。";
    }

    if(is_numeric($rank)){

    }else{
      $result[] = "ランクの形式を数字に変更してください。";
    }

    return $result;
  }

  //get_function(index)
  public static function get()
  {
    $db = new Db();
    $conn = $db->connect_db();
    $sth = $conn->query("SELECT * FROM Categories WHERE deleted_at IS NULL ORDER BY rank");
    $sth->setFetchMode(PDO::FETCH_CLASS, 'Category');
    $result = $sth->fetchAll();
    return $result;
  }

  //add_function
    private function add()
    {

      $db = new Db();
      $conn = $db->connect_db();
      // SQL文組み立て
    $sth = "INSERT INTO categories (name,picture,rank,created_at,updated_at)
    VALUES(:name, :picture, :rank,:created_at,:updated_at)";
      // SQL ステートメントを準備
      $stmt = $conn->prepare($sth);

      $stmt->bindParam(':name',$this->name,PDO::PARAM_STR);
      $stmt->bindParam(':picture',$this->picture,PDO::PARAM_STR);
      $stmt->bindParam(':rank',$this->rank,PDO::PARAM_INT);
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
    $sth = "UPDATE categories
    SET name= :name, picture = :picture, rank = :rank, updated_at = :updated_at
    WHERE id = :id";


    // SQL ステートメントを準備
    $stmt = $conn->prepare($sth);

    $stmt->bindParam(':name',$this->name,PDO::PARAM_STR);
    $stmt->bindParam(':picture',$this->picture,PDO::PARAM_STR);
    $stmt->bindParam(':rank',$this->rank,PDO::PARAM_INT);
    $stmt->bindParam(':updated_at', $this->updated_at, PDO::PARAM_STR);
    $stmt->bindParam(':id',$this->id,PDO::PARAM_INT);
    $stmt->execute();
    $stmt = null;

    return true;
  }

  //統合と判断(add+edit)
    public function save()
    {
      if($this->id) {
        return $this->edit();
      } else {
        return $this->add();
      }
    }

    //delete_function
    public function delete()
    {
      $db = new Db();
      $conn = $db->connect_db();
      // SQL作成
      $sql="UPDATE categories SET
      deleted_at = :deleted_at
      WHERE id = :id";

      // 構築されたデータをDBに実行させる。
      $stmt = $conn->prepare($sql);

      $stmt->bindParam(':deleted_at', $this->deleted_at, PDO::PARAM_STR);
      $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

      $stmt->execute();

      $stmt=null;

      return true;

    }

    //find_function(detail)
  public static function find($id)
  {
    $all = Category::get();
    $result = null;
    foreach($all as $one_record) {
      if($one_record->id == $id) {
        $result = $one_record;
      }
    }
    return $result;
  }
}



  ?>
