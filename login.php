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
	$data = mysql_query("SELECT * FROM account"); //選擇某一表格

	// 從表單中獲得使用者輸入得帳密資料
	$account = $_POST['account'];
	$password = $_POST['password'];
	// $password_SHA256 = hash('sha256', $_POST['password']); // sha256加密
	//echo "account: $account<br>";
	//echo "password: $password<br>";

	// 讀取資料
	if(empty($account == FALSE) && empty($password == FALSE)){
		for($i = 1; $i<= mysql_num_rows($data); $i++){
			$row = mysql_fetch_array($data);
			/*echo "ID: ". $row["id"]."<br>";
			echo "Account: $row[1]<br>";
			echo "Password: $row[2]<br>";*/
			if($account == $row["account"] && $password == $row["password"]){
				session_start();
				$_SESSION["account"] = $account;
				$_SESSION["password"] = $password;
				$_SESSION["id"] = $row["id"];
				//echo "帳密正確^^".$_SESSION["account"].$_SESSION["password"].$_SESSION["id"];
				//header('Location: https://www.youtube.com/?gl=TW&hl=zh-tw');
				header('Location: member.php');
				break;
			}
			else if($i == mysql_num_rows($data)){
				//echo "帳密錯誤，請重新輸入";
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link href = "app.css" rel = "stylesheet">
	<title> Login </title>
</head>
<body>
	<div id ="container">
	<form action="login.php" method="post">
		<input type="text"  name="account" id = "account_input" placeholder = "請輸入帳號" >
		<input type="password" name="password" id = "password_input" placeholder = "請輸入密碼" >
		<input type="submit" name="submit" id = "submit_button" value="登入">
	</form>
	<h1> <?php if($i == mysql_num_rows($data)+1){
		echo "帳密錯誤，請重新輸入";
	}?> </h1>
	<form action="register.php" method="post">
		<input type="submit" name="submit" id = "register_button" value="註冊會員">
	</form>
	<a href ="https://www.youtube.com/?gl=TW&hl=zh-tw" id = "forget"> 忘記密碼?</a>
	</div>
</body>
</html>
