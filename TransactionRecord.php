<?php
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
	$data = mysql_query("SELECT * FROM trans_vendor_record"); //選擇某一表格
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Transaction Record</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="TransactionRecord.css" />
</head>
<body>
    <div id = "container">	
		<div id = "table">
			<table id = "trans_list">
				<tr>
					<th>ID</th>
					<th>Previous Hash</th>
					<th>Timestamp</th>
					<th>Buyer</th>
					<th>Seller</th>		
					<th>Kg</th>
					<th>Price</th>
					<th>Hash Value</th>			
				</tr>
				<?php
				for($i = 1; $i<= mysql_num_rows($data); $i++){
					$row = mysql_fetch_array($data);
				?>
				<tr>
					<td><?php echo $row['id']?></td>
					<td><?php echo $row['prev_hash']?></td>
					<td><?php echo $row['timestamp']?></td>
					<td><?php echo $row['vendor_buy']?></td>
					<td><?php echo $row['vendor_sell']?></td>
					<td><?php echo $row['kg']?></td>
					<td><?php echo $row['price']?></td>
					<td><?php echo $row['hash']?></td>
				</tr>
				<?php
				}
				?>
			</table>
		</div>
    </div>
</body>
</html>
