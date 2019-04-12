<?php
include_once("db.php");

class Order_detail{

public $id;
public $product_id;
public $order_id;
public $price;
public $number;
public $created_at;
public $updated_at;
public $deleted_at;

public static function get(){

  $db = new Db();
  $conn = $db->connect_db();
  $sql ="SELECT * FROM order_details WHERE deleted_at IS NULL";
  $sth = $conn->query($sql);
  $sth->setFetchMode(PDO::FETCH_CLASS, 'Order_detail');
  $result = $sth->fetchAll();
  return $result;
}

public static function validate($data){
	$error_message = array();

  $product_id = $data["product_id"];
	$order_id = $data["order_id"];
  $price = $data["price"];
  $number = $data["number"];

	if(empty($data["product_id"])){
		 $error_message[]="商品IDを入力してください";
	}

	if(empty($data["order_id"])){
		 $error_message[]="注文IDを入力してください";
	}

	if(empty($data["price"])){
		 $error_message[]="商品値段を入力してください";
	}else{
		if(!preg_match("/^[0-9]+$/",$data["price"])){
		   $error_message[]="数字のみを入力してください";
	  }
	}
	if(empty($data["number"])){
		 $error_message[]="商品個数を入力してください";
	}else{
	 if($data["number"]<1 && $data["number"]>10){
	   $error_message[]="1から10までの数字のみを入力してください";
	  }
	}

  return $error_message;//keyがない数値配列
}

public static function find($id){//select,detail
  $all = Order_detail::get();//全部的data調出來（調用static函數的調用法）
  $result = null;//然後設置一個空變量準備裝我們想要得到的值
  foreach($all as $one_record){//數組遍歷循環，$all裡面所有的資訊，$value=$one_record
   if($one_record->id == $id){//如果取到一條record的id是我們所輸入進去的id
      $result = $one_record;//那這個record就是我們要的結果、$result一開始設置為NULL，
			                      //所以最後$result要在前面，讓$one_record賦值給它，否則結果就會是NULL
		}
	}
	return $result;//返回值
}

public function save(){//判斷此id為新規（add）還是舊有編輯(edit)
	if($this->id){//如果，調用此id是已有的
		 return $this->edit();//那就是編輯
	}else{
		 return $this->add();//否則就是新規
	}
}

private function add(){//此函數為save函數內部作用判斷，因此不為public為private
	$db = new Db;
	$conn = $db->connect_db();
	// SQL文組み立て
	$sql = "INSERT INTO order_details (product_id, order_id, price, number, created_at, updated_at)
	        VALUES (:product_id, :order_id, :price, :number, :created_at, :updated_at)";
	// SQL ステートメントを準備
	$stmt = $conn->prepare($sql);

	$stmt->bindParam(':product_id', $this->product_id, PDO::PARAM_INT);
	$stmt->bindParam(':order_id', $this->order_id, PDO::PARAM_INT);
	$stmt->bindParam(':price', $this->price, PDO::PARAM_INT);
	$stmt->bindParam(':number', $this->number, PDO::PARAM_INT);
	$stmt->bindParam(':created_at', $this->created_at, PDO::PARAM_STR);
	$stmt->bindParam(':updated_at', $this->updated_at, PDO::PARAM_STR);

  $stmt->execute();
}

private function edit(){
	$db = new Db;
	$conn = $db->connect_db();
  // SQL文組み立て
  $sql = "UPDATE order_details SET product_id=:product_id, order_id=:order_id, price=:price, number=:number, updated_at=:updated_at WHERE id=:id";
  // SQL ステートメントを準備
  $stmt = $conn->prepare($sql);

  $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
  $stmt->bindParam(':product_id', $this->product_id, PDO::PARAM_INT);
	$stmt->bindParam(':order_id', $this->order_id, PDO::PARAM_INT);
	$stmt->bindParam(':price', $this->price, PDO::PARAM_INT);
	$stmt->bindParam(':number', $this->number, PDO::PARAM_INT);
	$stmt->bindParam(':updated_at', $this->updated_at, PDO::PARAM_STR);

  $stmt->execute();
}

public function delete(){
	$db = new Db;
	$conn = $db->connect_db();
	// SQL文組み立て
	$sql = "UPDATE order_details SET deleted_at=:deleted_at WHERE id=:id";
  // SQL ステートメントを準備
  $stmt = $conn->prepare($sql);

  $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
	$stmt->bindParam(':deleted_at', $this->deleted_at, PDO::PARAM_STR);

  $stmt->execute();
}


public function find_orderid(){//新しいfunctionを作る
  $db = new Db();
  $conn = $db->connect_db();
  $sql ="SELECT * FROM order_details WHERE order_id=$this->order_id";//order_idを通じて、全ての同じorder_idのorder_detailを探し出す
  $sth = $conn->query($sql);
  $sth->setFetchMode(PDO::FETCH_CLASS, 'Order_detail');
  $result = $sth->fetchAll();
  return $result;
}

public function count_all_products(){
  $order_details = Order_detail::find_orderid();
  return count($order_details);

}

public function count_already_made_products(){
  $db = new Db();
  $conn = $db->connect_db();
  $sql ="SELECT * FROM order_details WHERE order_id=$this->order_id AND finish_flg=2";
  $sth = $conn->query($sql);
  $sth->setFetchMode(PDO::FETCH_CLASS, 'Order_detail');
  $result = $sth->fetchAll();
  return count($result);
}

}
?>
