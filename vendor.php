<?php
	session_start();
	if(isset($_SESSION["account"]) == FALSE){
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
	$data = mysql_query("SELECT * FROM vendor_test"); //選擇某一表格
	for($i = 1; $i<= mysql_num_rows($data); $i++){
		$row = mysql_fetch_array($data);
		/*echo "ID: ". $row["id"]."<br>";
		echo "Account: $row[1]<br>";
		echo "Password: $row[2]<br>";
		echo "steps: ". $row["steps"]."<br>";
		echo "km: ". $row["km"]."<br>";
		echo "Ccoin: ". $row["ccoin"]."<br>";
		/*echo $_SESSION["account"]."<br>";
		echo $_SESSION["password"]."<br>";
		echo $row["account"]."<br>";
		echo $row["password"]."<br>";
		echo $_SESSION["account"] == $row["account"];*/
		if($_SESSION["account"] == $row["account"] && $_SESSION["password"] == $row["password"]){
			//echo "PPAP";
			//session_start();
			$_SESSION["ccoin"] = $row["ccoin"];
			$_SESSION["co2"] = $row["co2"];
			/*$steps = $row["steps"];
			$km = $row["km"];
			$ccoin = $row["ccoin"];*/
			break;
			}
		}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>廠商介面</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="vendor.css" />
</head>
<body>
    <div id = "container">
		<h1 id = "account"> <?php echo $_SESSION["account"]?></h1>
		<p id = "ccoin"> <?php echo "C幣: ".$_SESSION["ccoin"]?></p>
		<p id = "co2"> <?php echo "碳存量: ".$_SESSION["co2"]."(kg)"?></p>
        <a href = "https://www.youtube.com/?gl=TW&hl=zh-tw" id = "btn1">
            <img src = "Vendorbtn1.png" height="150px" width="300px">
        </a>
        <a href = "https://www.youtube.com/?gl=TW&hl=zh-tw" id = "btn2">
            <img src = "Vendorbtn2.png" height="155px" width="340px">
        </a>
        <a href = "https://www.youtube.com/?gl=TW&hl=zh-tw" id = "btn3">
            <img src = "Vendorbtn3.png" height="155px" width="340px">
        </a>
    </div>
</body>
</html>
