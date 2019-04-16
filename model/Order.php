<?php
include_once("db.php");
include_once("Order_detail.php");
date_default_timezone_set("Asia/Tokyo");
class Order{
public $id;
public $code;
public $table_id;
public $status;
public $ordered_time;
public $made_time;
public $paid_time;
public $created_at;
public $updated_at;
public $deleted_at;
public static function checktime($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}
public static function validate($data)
{
  $error_messages = array();
  $code = $data["code"];
  $table_id = $data["table_id"];
  $status = $data["status"];
  $ordered_time = $data["ordered_time"];
  $made_time = $data["made_time"];
  $paid_time = $data["paid_time"];
  if(empty($code)){
    $error_messages[]="注文コードを記入してください！";
  }
  if(empty($table_id)){
    $error_messages[]="テーブルIDを記入してください！";
  } elseif (!is_numeric($table_id)){
    $error_messages[]="テーブルIDの数字を正しく記入してください！";
  }
  if(empty($status)){
    $error_messages[]="注文状態を選択しください!";
  } elseif (!is_numeric($status)){
    $error_messages[]="注文状態の数字を正しく記入してください！";
  }
  if(empty($ordered_time)){
    $error_messages[]="注文の時間を記入してください!";
  } elseif (!Order::checktime($ordered_time)){
    $error_messages[]="注文時間を正しく記入してください！";
  }
  if($made_time== NULL) {
  } elseif (!Order::checktime($made_time)){
    $error_messages[]="作成の時間を正しく記入してください！";
  } elseif (strtotime($ordered_time)>=strtotime($made_time)){
    $error_messages[]="注文時間より遅い時間を記入してください!";
  }
  if($paid_time== NULL) {
  } elseif (!Order::checktime($paid_time)){
    $error_messages[]="支払の時間を正しく記入してください！";
  } elseif (strtotime($made_time)>=strtotime($paid_time)||
  strtotime($ordered_time)>=strtotime($paid_time)){
    $error_messages[]="作成時間より遅い時間を記入してください!";
  }
  return $error_messages;
}
public static function get()
{
  $db = new Db();
  $conn = $db->connect_db();
  $sql ="SELECT * FROM orders WHERE DELETED_AT IS NULL";
  $sth = $conn->query($sql);
  $sth->setFetchMode(PDO::FETCH_CLASS, 'Order');
  $result = $sth->fetchAll();
  return $result;
}
public function get_price_sum()
{
  $order_id = $this->id;
  $sum = 0;
  $order_details = Order_detail::get();
  foreach ($order_details as $order_detail) {
    if($order_detail->order_id == $order_id) {
      $sum = $sum + $order_detail->price * $order_detail->number;
    }
  }
  return $sum;
}
public function get_status_name()
{
  $status_id = $this->status;
  if($status_id == 1) {
    return "注文済み";
  }
  if($status_id == 2) {
    return "作成済み";
  }
  if($status_id == 3) {
    return "支払い済み";
  }
  return "不明";
}
public function get_order_details(){
  $order_details = Order_detail::get();
  $result = array();
  foreach($order_details as $one_record){
   if($one_record->order_id == $this->id){
      $result[] = $one_record;
		}
	}
	return $result;//返回值
}
public function find($id)
{
  $result = Order::get();
  $one_record = null;
  foreach ($result as $value) {
    if($value->id == $id) {
    $one_record = $value;
    }
  }
  return $one_record;
}
private function add()
{
  $db = new Db();
  $conn = $db->connect_db();
  $sql = "INSERT INTO orders
          (code, table_id, status, ordered_time, made_time, paid_time, created_at, updated_at)
          VALUES
          (:code, :table_id, :status, :ordered_time, :made_time, :paid_time, :created_at, :updated_at)";
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':code', $this->code, PDO::PARAM_STR);
          $stmt->bindParam(':table_id', $this->table_id, PDO::PARAM_INT);
          $stmt->bindParam(':status', $this->status, PDO::PARAM_INT);
          $stmt->bindParam(':ordered_time', $this->ordered_time, PDO::PARAM_STR);
          $stmt->bindParam(':made_time', $this->made_time, PDO::PARAM_STR);
          $stmt->bindParam(':paid_time', $this->paid_time, PDO::PARAM_STR);
          $stmt->bindParam(':created_at', $this->created_at, PDO::PARAM_STR);
          $stmt->bindParam(':updated_at', $this->updated_at, PDO::PARAM_STR);
          $stmt->execute();

          $this->id = $conn->lastInsertId();
          $stmt = null;
          return true;
}
private function edit()
{
  $db = new Db();
  $conn = $db->connect_db();
  $sql="UPDATE orders SET
        code = \"$this->code\",
        table_id = \"$this->table_id\",
        status = \"$this->status\",
        ordered_time = \"$this->ordered_time\",
        made_time = \"$this->made_time\",
        paid_time = \"$this->paid_time\",
        created_at = \"$this->created_at\",
        updated_at = \"$this->updated_at\"
        WHERE id = \"$this->id\";";
  $conn->exec($sql);
  return true;
}
public function save()
{
  if($this->id){
    return $this->edit();
  } else {
    return $this->add();
  }
}
public function delete()
{
  $db = new Db();
  $conn = $db->connect_db();
  $sql="UPDATE orders SET
        deleted_at = \"$this->deleted_at\"
        WHERE id = \"$this->id\"";
  $conn->exec($sql);
  return true;
}
public function delete_order_details()
{
  $db = new Db();
  $conn = $db->connect_db();
  $sql="UPDATE order_details SET
        deleted_at = \"$this->deleted_at\"
        WHERE order_id = \"$this->id\"";
  $conn->exec($sql);
  return true;
}
public function find_unpaid_orders()
{
  $orders = Order::get();
  $unpaid_order = array();
  foreach($orders as $order){
    if($order->status!= 3){
      $unpaid_order[]= $order;
    }
  }
  return $unpaid_order;
}
public function find_not_made_orders()
{
  $orders = Order::get();
  $unpaid_order = array();
  foreach($orders as $order){
    if($order->status== 1){
      $unpaid_order[]= $order;
    }
  }
  return $unpaid_order;
}


  public static function generateRandomString($length = 10) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
  }
}
 ?>
