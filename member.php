<?php
	session_start();
	if(isset($_SESSION["account"]) == FALSE){
		header('Location: login.php');
	}
	$server = "140.116.100.80";
	$user = "root";
	$password_db = "ron";
	
	//連線資料庫
	$Connect = mysql_connect($server, $user, $password_db);
	if(!$Connect){
		die("連線失敗，錯誤訊息：".mysql_error());
	}
	else{
		//echo "資料庫連線成功<br>";
	}

	mysql_query("SET NAMES UTF8");
	mysql_select_db("myDB"); //選擇資料庫
	$data = mysql_query("SELECT * FROM member"); //選擇某一表格
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
				$_SESSION["steps"] = $row["steps"];
				$_SESSION["km"] = $row["km"];
				$_SESSION["ccoin"] = $row["ccoin"];
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
        <meta charset="UTF-8">
        <link href = "member.css" rel = "stylesheet">
        <title> CCR </title>
    </head>
    <body>
        <div id = "container">
            <p id = "Hello"> Hello!!! </p>
            <p id = "account"><u><?php echo ">>  ".$_SESSION["account"]?></u></p>
            <p id = "steps"><?php echo "目前累積行步數:  ".$_SESSION["steps"]." steps"?></p>
            <p id = "km"><?php echo "目前累積單車里程數: ".$_SESSION["km"]." km"?></p>
            <p id = "ccoin"><?php echo "擁有C幣: ".$_SESSION["ccoin"]?></p>
            <img id = "one" src = "1.png" height = "100px" width = "90px">
            <a href="https://likeneverdie.github.io/uidd2017_Loading/">
                <button id = "btn1" type="submit"> 步行 </button>
            </a>
            <img id = "two" src = "2.png" height = "100px" width = "90px">
            <a href="https://likeneverdie.github.io/uidd2017_Loading/">
                <button id = "btn2" type="submit"> 自行車 </button>
            </a>
            <img id = "three" src = "3.png" height = "100px" width = "90px">
            <a href="https://likeneverdie.github.io/uidd2017_Loading/">
                <button id = "btn3" type="submit"> 電子發票 </button>
            </a>
            <img id = "four" src = "4.png" height = "100px" width = "90px">
            <a href="https://likeneverdie.github.io/uidd2017_Loading/">
                <button id = "btn4" type="submit"> 大眾運輸 </button>
            </a>
            <img id = "five" src = "5.png" height = "100px" width = "90px">
            <a href="https://likeneverdie.github.io/uidd2017_Loading/">
                <button id = "btn5" type="submit"> 低碳商品 </button>
            </a>
            <form action="register.php" method="post">
                <input type="button" id = "change_button" value="商品兌換" onclick="window.location.href='http://140.116.54.153/login.php'" />
            </form>
            <form action="register.php" method="post">
                <input type="button" id = "rank_button" value="廠商排名" onclick="window.location.href='http://www.hyperlinkcode.com/button-links.php'" />
            </form>
        </div>
    </body>
</html>
