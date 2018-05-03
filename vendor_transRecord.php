<?php
	session_start();
	
	//連線資料庫 To get the certain data of transaction
	$server = "localhost";
	$user = "root";
	$password_db = "b960203960203";
	
	$Connect = mysql_connect($server, $user, $password_db);
	if(!$Connect){
		die("連線失敗，錯誤訊息：".mysql_error());
	}
	else{
		//echo "資料庫連線成功<br>";
	}

	mysql_query("SET NAMES UTF8");
	mysql_select_db("Account"); //選擇資料庫
	$data = mysql_query("SELECT * FROM trans_vendor_record"); //選擇某一表格
	
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>交易紀錄</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="vendor_transRecord.css" />
</head>
<body>
    <div id = "container">
		<h1 id = "account"> <?php echo $_SESSION["account_vendor"]?></h1>
		<h1 id = "title"> 交易紀錄 </h1>
		<p id = "ccoin"> <?php echo "C幣: ".$_SESSION["ccoin_vendor"]?></p>
		<p id = "co2"> <?php echo "碳存量: ".$_SESSION["co2_vendor"]."kg"?></p>
		
		<div id = "table">
			<table id = "trans_list">
				<tr>
					<th>販售廠商</th>
					<th>價格</th>
					<th>碳公斤數</th>
					<th>時間</th>					
				</tr>
				<?php
				for($i = 1; $i<= mysql_num_rows($data); $i++){
					$row = mysql_fetch_array($data);
					if($row['vendor_buy'] == $_SESSION["account_vendor"]){
				?>
				<tr>
					<td><?php echo $row['vendor_sell']?></td>
					<td><?php echo $row['price']?></td>
					<td><?php echo $row['kg']?></td>
					<td><?php echo $row['timestamp']?></td>
				</tr>
				<?php
					}
				}
				?>
			</table>
		</div>
    </div>
</body>
</html>
