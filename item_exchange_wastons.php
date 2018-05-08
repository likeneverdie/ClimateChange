<?php

session_start();
echo $_SESSION["ccoin"]."<br>";
$ccoin = $_SESSION["ccoin"];
echo $ccoin."<br>";

$account = $_SESSION["account"];
$cart = $_SESSION["cart"];

$Conn = mysql_connect("localhost", "root", "b960203960203");

if (!$Conn) {
	die("連線失敗，錯誤訊息：".mysql_error());
}
echo "連線成功<br>";

mysql_select_db("Account"); //選擇資料庫

$data_item = mysql_query("SELECT * FROM item_test"); //選擇某一表格

// 讀取資料
for($i = 1; $i<= mysql_num_rows($data_item); $i++){

	$row = mysql_fetch_array($data_item);
	echo "ID: $row[0]<br>";
	echo "Item: $row[1]<br>";
	echo "Price: $row[2]<br>";
	echo "Stock: $row[3]<br>";
	if($row["item"] == "BOGOF"){
		$price = $row["price"];
		$stock = $row["stock"];
		break;
	}
}
if($ccoin >= $price){
	echo"購買成功<br>";
	$ccoin = $ccoin - $price;
	$stock = $stock - 1;
	$cart = $cart."Wastons BOGOF / ";
}
else{
	echo"C幣不足，無法購買<br>";
}
//echo $ccoin."<br>";
//echo $stock."<br>";


$renew_userCcoin = mysql_query("UPDATE member_test SET ccoin = '$ccoin' WHERE member_test.account = '$account'");
$renew_userCart = mysql_query("UPDATE member_test SET cart = '$cart' WHERE member_test.account = '$account'");
$renew_itemStock = mysql_query("UPDATE item_test SET stock = '$stock' WHERE item_test.item = 'BOGOF'");


$data_trans = mysql_query("SELECT * FROM trans_member_test"); //選擇某一表格

for($i = 1; $i<= mysql_num_rows($data_trans); $i++){

	$row = mysql_fetch_array($data_trans);
	
	if($i == mysql_num_rows($data_trans)){
		$prev_hash = $row['hash'];
		$id = $row['id'];
	}

}
 
$id++;
$date = date("Y/m/d");
$time = date("h:i:sa");
$timestamp = $date." ".$time;
//$user_account = "wtchen";
$item = "Wastons BOGOF Coupon";

$trans_data = $id." ".$prev_hash." ".$timestamp." ".$account." ".$price." ".$item;
echo $trans_data."<br>";
$trans_data_SHA256 = hash('sha256', $trans_data); // sha256加密
echo $trans_data_SHA256;


$trans_data_insert = mysql_query("INSERT INTO Account.trans_member_test (id, prev_hash, timestamp, account, cost, item, hash) VALUES (NULL, '$prev_hash', '$timestamp', '$account', '$price', '$item', '$trans_data_SHA256');");

$_SESSION["thisproduct"] = $item;
$_SESSION["thisprice"] = $price;
$_SESSION["thisdate"] = $timestamp;

header('Location: success_change.php');

?>
