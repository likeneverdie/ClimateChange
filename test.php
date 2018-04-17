<?php

$Conn = mysql_connect("localhost", "root", "b960203960203");

if (!$Conn) {
	die("連線失敗，錯誤訊息：".mysql_error());
}
//echo "連線成功<br>";
//mysql_close($Link);

mysql_select_db("Account"); //選擇資料庫

$data = mysql_query("SELECT * FROM member_test"); //選擇某一表格
//echo $data;

// 讀取資料
for($i = 1; $i<= mysql_num_rows($data); $i++){

	$row = mysql_fetch_array($data);
	/*echo "ID: $row[0]<br>";
	echo "Account: $row[1]<br>";
	echo "Password: $row[2]<br>";
	echo "Steps: $row[3]<br>";
	echo "Km: $row[4]<br>";
	echo "Ccoin: $row[5]<br>";*/
	if($row["account"] == "wtchen" && $row["password"] == "handsome"){
		session_start();
		$_SESSION["steps"] = $row["steps"];
		$_SESSION["km"] = $row["km"];
		$_SESSION["ccoin"] = $row["ccoin"];
		$_SESSION["cart"] = $row["cart"];
		break;
	}
}
/*$ccoin = $steps * 2 + $km * 1000;
$stpes = 0;
$km = 0;*/
/*echo $_SESSION["steps"]."<br>";
echo $_SESSION["km"]."<br>";
echo $_SESSION["ccoin"]."<br>";*/


/*while($row = mysql_fetch_array($data)){
	
	echo "ID: $row[0]<br>";
	echo "Account: $row[1]<br>";f
	echo "Password: $row[2]<br>";
}*/

$date = date("Y/m/d");
$time = date("h:i:sa");
$timestamp = $date." ".$time;
//echo $timestamp."<br>";
$user_account = "wtchen";
$user_password = "handsome";
$cost = 1000;
$items = "city_cafe";

$trans_data = $timestamp." ".$user_account." ".$user_password." ".$cost." ".$items;
echo $trans_data."<br>";

$trans_data_SHA256 = hash('sha256', $trans_data); // sha256加密
echo $trans_data_SHA256."<br>";

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title> Test </title>
	</head>
	<body>
		<h1> <?php echo "步數: ".$_SESSION["steps"]; ?> </h1>
		<h1> <?php echo "里程: ".$_SESSION["km"]; ?> </h1>
		<h1> <?php echo "C幣: ".$_SESSION["ccoin"]; ?> </h1>
		<form action="exchange.php" method="post">
			<input type="submit" name="submit" id = "test_button" value="兌換C幣">
		</form>
		<form action="item_exchange.php" method="post">
			<input type="submit" name="submit" id = "item_change" value="兌換商品">
		</form>
	</body>
</html>
