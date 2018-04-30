<?php
	session_start();
	$account = $_SESSION["account_vendor"];
	/*$ccoin  = $_SESSION["ccoin_vendor"];
	$co2 = $_SESSION["co2_vendor"];*/
	
	/*echo $account."<br>";
	echo $ccoin."<br>";
	echo $co2."<br>";*/
	
	if(isset($_SESSION["account_vendor"]) == FALSE){
		header('Location: login.php');
	}
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
	
	// Transaction
	
	$data_vendor = mysql_query("SELECT * FROM vendor_test");
	
	for($i = 1; $i<= mysql_num_rows($data_vendor); $i++){

		$row = mysql_fetch_array($data_vendor);
		if($row["account"] == $account){
			//echo "PPAP";
			$ccoin = $row["ccoin"];
			$co2 = $row["co2"];
			break;
		}
	}
	
	if(empty($_POST['price']) == FALSE && empty($_POST['kg']) == FALSE){
		
		$price = $_POST['price'];
		$kg = $_POST['kg'];
		
		if($ccoin >= $price){
			$ccoin = $ccoin - $price;
			$co2 = $co2 + $kg;
			/*echo $ccoin."<br>";
			echo $co2."<br>";*/
			
			// renew vendor data
			$renew_vendorCcoin = mysql_query("UPDATE vendor_test SET ccoin = '$ccoin' WHERE vendor_test.account = '$account'");
			$renew_vendorCo2 = mysql_query("UPDATE vendor_test SET co2 = '$co2' WHERE vendor_test.account = '$account'");
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>碳交易</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="vendor_transaction.css" />
</head>
<body>
    <div id = "container">
		<h1 id = "account"> <?php echo $account?></h1>
		<h1 id = "title"> 碳交易 </h1>
		<p id = "ccoin"> <?php echo "C幣: ".$ccoin?></p>
		<p id = "co2"> <?php echo "碳存量: ".$co2."(kg)"?></p>
		
		<div id = "table">
			<table id = "trans_list">
				<tr>
					<th>廠商</th>
					<th>碳單價</th>
					<th>碳公斤數</th>
					<th></th>					
				</tr>
				<?php
				for($i = 1; $i<= mysql_num_rows($data); $i++){
					$row = mysql_fetch_array($data);
				?>
				<tr>
					<td><?php echo $row['vendor']?></td>
					<td><?php echo $row['price']?></td>
					<td><?php echo $row['kg']?></td>
					<td>
						<form action = "vendor_transaction.php" method = "post" onsubmit = "return confirm ('確定要購買嗎？');">
								<input type="hidden" name = "price" value = "<?php echo $row['price']?>">
								<input type="hidden" name = "kg" value = "<?php echo $row['kg']?>">
								<input type="image" id = "Buybtn" name="submit" src = "Buy.png" onmouseover="hover(this)"; onmouseout="unhover(this)">
						</form>
					</td>
				</tr>
				<?php
				}
				?>
			</table>
		</div>
		
    </div>
    <script>
			function hover(element){
				element.setAttribute('src', 'BuyY.png');
			}
			function unhover(element){
				element.setAttribute('src', 'Buy.png');
			}
    </script>
</body>
</html>
