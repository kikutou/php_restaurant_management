<?php
class Session
{
    public static function add($product_id , $number = 1) {

    	$cart = $_SESSION["cart"];

    	// GETパラメータがセッションに存在するかどうかをチェックする。
    	$include_prodcut_id = false;
    	foreach($cart as $product_info) {
    		if($product_info["product_id"] == $product_id) {
    			$include_prodcut_id = true;
    		}
    	}


    	if($include_prodcut_id) {
    		//　存在する場合、該当商品の数を+1
    		foreach($cart as $index=>$product_info) {
    			if($product_info["product_id"] == $product_id) {
    				$product_info["number"]++;
    	 		}
    			$cart[$index] = $product_info;
    		}
    	} else {
    		// 存在しない場合、該当商品を1個セッションに追加する。
    		$cart[] = array(
    			"product_id" => $product_id,
    			"number" => 1
    		);
    	}

    	$_SESSION["cart"] = $cart;

      return $_SESSION["cart"];
    }


    public static function delete($product_id) {

    	$cart = $_SESSION["cart"];

    	$include_prodcut_id = false;

    	foreach($cart as $index => $product_info) {
    		if($product_info["product_id"] == $product_id) {
    			unset($cart[$index]);
    		}
    	}

    	$_SESSION["cart"] = $cart;

      return $_SESSION["cart"];

    }


    public static function edit($data) {

      foreach ($_SESSION["cart"] as $index => $one_record) {
    		$key = $one_record["product_id"];
    		$new_number = $data[$key];
    		$one_record["number"] = $new_number;
    		$_SESSION["cart"][$index] = $one_record;
    	}
    }

    public static function fix_data()
    {

      foreach($_SESSION["cart"] as $index => $one_record) {
      	if($one_record["number"] > 10) {
      		$one_record["number"] = 10;
      		$_SESSION["cart"][$index] = $one_record;
      	}
      }

      return $_SESSION["cart"];
    }


    public static function init_session()
    {
      session_start();

      if(!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = array();
      }
    }
}
