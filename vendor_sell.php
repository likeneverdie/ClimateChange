<?php
	session_start();
	$account = $_SESSION["account_vendor"];
	
	$server = "localhost";
	$user = "root";
	$password_db = "b960203960203";
	
	//連線資料庫
	$Connect = mysql_connect($server, $user, $password_db);
	if(!$Connect){
		die("連線失敗，錯誤訊息：".mysql_error());
	}
	else{
		//echo "資料庫連線成功<br>";
	}

	mysql_query("SET NAMES UTF8");
	mysql_select_db("Account"); //選擇資料庫
	$data = mysql_query("SELECT * FROM trans_vendor_test"); //選擇某一表格
	
	if(empty($_POST['price']) == FALSE && empty($_POST['amount']) == FALSE){
		$price = $_POST['price'];
		$amount = $_POST['amount'];
		/*echo $price."<br>";
		echo $amount."<br>";*/
		$insert_data = mysql_query("INSERT INTO Account.trans_vendor_test (id, vendor, price, kg, buy) VALUES (NULL, '$account', '$price', '$amount', '1');");
	}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>販售碳權</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="vendor_sell.css" />
</head>
<body>
    <div id = "container">
		<h1 id = "account"> <?php echo $_SESSION["account_vendor"]?></h1>
		<h1 id = "title"> 販售碳權 </h1>
		<p id = "ccoin"> <?php echo "C幣: ".$_SESSION["ccoin_vendor"]?></p>
		<p id = "co2"> <?php echo "碳存量: ".$_SESSION["co2_vendor"]."kg"?></p>
		<div id = "sell"></div>
		<p id = "price_text">販賣金額</p>
		<p id = "amount_text">販賣數量</p>
			<form action="vendor_sell.php" method="post" onsubmit = "return confirm ('確定要販售嗎？');">
			<input type="text"  name="price" id = "price_input" placeholder = "" >
			<input type="text" name="amount" id = "amount_input" placeholder = "" >
			<input type="submit" name="submit" id = "submit_button" value="確認發佈">
		</form>
    </div>
</body>
</html>
