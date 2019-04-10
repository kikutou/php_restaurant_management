<?php
include_once("Product.php");

//validate($data)メソッドのテスト
// $data = array("code" => "a11",
//         "table_id" => "1",
//         "status" => "aa",
//         "order_time" => "2009/10/24 22:30:20",
//         "made_time" => "2009/10/24 22:30:20",
//         "paid_time" => "2009/10/29 22:30:20"
// );
// //
// echo "<pre>";
// print_r($data);
//
// $result = Order::validate($data);
// print_r($result);
//
// get()メソッドのテスト
// echo "<pre>";
// $index = Order::get();
// print_r($index);

//find($id)メソッドのテスト
// echo "<pre>";
// $id=7;
// $find = Order::find($id);
// var_dump($find);

// save()メソッドのテスト
// echo "<pre>";
// $save = new Order();
// $save->code = "a2278";
// $save->table_id = "2";
// $save->status = "2";
// $save->ordered_time= "2016-12-2 11:23:30";
// $save->made_time = "";
// $save->paid_time = "";
// $save->created_at = date('Y-m-d H:i:s');
// $save->updated_at = date('Y-m-d H:i:s');
// $result = $save->save();
// print_r($result);

// echo "<pre>";
// $save = Order::find(9999);
// if($save == NULL){
//   echo "false";
//   exit();
// } else{
// $save->code = "a222";
// $save->table_id = "2";
// $save->status = "3";
// $save->ordered_time= "2016-12-2 11:23:30";
// $save->made_time = "2016-12-2 12:23:30";
// $save->paid_time = "2016-12-2 13:23:30";
// $save->updated_at = date('Y-m-d H:i:s');
// $result = $save->save();
// }
// var_dump($result);

//
// delete()メソッドのテスト
echo "<pre>";
$product = Product::find(6);
if($product == NULL){
  echo "false";
  exit();
} else{
$product->deleted_at = date('Y-m-d H:i:s');
$result = $product->delete();
}
var_dump($result);


?>
