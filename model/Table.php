<?php
include_once("Db.php");

class Table{
//クラスのプロパティ。
  public $id;
  public $name;
  public $created_at;
  public $updated_at;
  public $deleted_at;

//テーブル番号の入力をチェックする。
  public static function validate($data){
    $result = array();
    $name = $data["name"];
    if(empty($name)) {
      $result[] = "名前を入力ください。";
    }
    return $result;
  }

//index方法。統一のため、抽出されたデーターをobject式で返す。
  public static function get(){
    $db = new Db();
    $conn = $db->connect_db();
    $sth = $conn->query("SELECT * FROM tables WHERE deleted_at IS NULL");
    $sth->setFetchMode(PDO::FETCH_CLASS, 'Table');
    $result = $sth->fetchAll();
    return $result;
  }

//detail方法。get方法を利用したので、すでにobject式に変わった。staticなので、thisは使えない。
  public static function find($id){
    $all = Table::get();
    $result = null;
    foreach($all as $one_record) {
      if($one_record->id == $id) {
        $result = $one_record;
      }
    }
    return $result;
  }

//edit()とadd()どちらを利用するか判断する。
  public function save(){
    if($this->id) {
      return $this->edit();
    } else {
      return $this->add();
    }
  }
//prepare()メゾットは必要。
  private function add(){
    $db = new Db();
    $conn = $db->connect_db();
    $sql = "INSERT INTO tables
    (name,created_at,updated_at)
    VALUES (:name,:created_at,:updated_at)";
    // -- (\"$this->name\",
    // --  \"$this->created_at\",
    // --  \"$this->updated_at\")";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
    $stmt->bindParam(':created_at', $this->created_at, PDO::PARAM_STR);
    $stmt->bindParam(':updated_at', $this->updated_at, PDO::PARAM_STR);
    $stmt->execute();
    $stmt = null;
    return true;
  }

  private function edit(){

    $db = new Db();
    $conn = $db->connect_db();

    $sql= "UPDATE tables SET name =:name, updated_at =:updated_at WHERE id =:id";
          // name = \"$this->name\",
          // updated_at = \"$this->updated_at\"
          // WHERE id = \"$this->id\";";
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
          $stmt->bindParam(':updated_at', $this->updated_at, PDO::PARAM_STR);
          $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
          $stmt->execute();
          $stmt = null;
          return true;
  }


  public function delete(){
    $db = new Db();
    $conn = $db->connect_db();
    $sql="UPDATE tables SET
          deleted_at = \"$this->deleted_at\"
          WHERE id = \"$this->id\";";
    $conn->exec($sql);
  }

}
?>
