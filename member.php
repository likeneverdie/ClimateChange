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
	$data = mysql_query("SELECT * FROM member_test"); //選擇某一表格
		for($i = 1; $i<= mysql_num_rows($data); $i++){
			$row = mysql_fetch_array($data);

			if($_SESSION["account"] == $row["account"] && $_SESSION["password"] == $row["password"]){
				//echo "PPAP";
				//session_start();
				$_SESSION["steps"] = $row["steps"];
				$_SESSION["km"] = $row["km"];
				$_SESSION["ccoin"] = $row["ccoin"];
				$_SESSION["co2_saved"] = $row["co2_saved"];
				/*$steps = $row["steps"];
				$km = $row["km"];
				$ccoin = $row["ccoin"];*/
				break;
			}
		}
	$account = $_SESSION["account"];
	$co2_saved = $_SESSION["co2_saved"];
	$co2_saved = $co2_saved + $_SESSION["steps"] * 0.0000465 + $_SESSION["km"] * 0.062;
	//echo $co2_saved;
	$renew_data = mysql_query("UPDATE `Account`.`member_test` SET `co2_saved` = '$co2_saved' WHERE `member_test`.`account` = '$account';");
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
            <b id = "Hello"> Hello!!! </b>
            <p id = "account"><u><?php echo ">>  ".$_SESSION["account"]?></u></p>
            <p id = "steps"><?php echo "累積步數:  ".$_SESSION["steps"]." steps"?></p>
            <p id = "km"><?php echo "累積里程數: ".$_SESSION["km"]." km"?></p>
            <p id = "ccoin"><?php echo "擁有C幣: ".$_SESSION["ccoin"]?></p>
            <p id = "co2"><?php echo "累積減碳量: ".number_format($co2_saved, 3)." kg"?></p>
            <img id = "one" src = "1.png" height = "100px" width = "90px">
            <a href="https://likeneverdie.github.io/uidd2017_Loading/">
                <button id = "btn1" type="submit"> 步行 </button>
            </a>
            <img id = "two" src = "2.png" height = "100px" width = "90px">
            <a href="http://ckbike.ncku.edu.tw/">
                <button id = "btn2" type="submit"> 自行車 </button>
            </a>
            <img id = "three" src = "3.png" height = "100px" width = "90px">
            <a href="https://www.einvoice.nat.gov.tw/index">
                <button id = "btn3" type="submit"> 電子發票 </button>
            </a>
            <img id = "four" src = "4.png" height = "100px" width = "90px">
            <a href="https://www.metro.taipei/cp.aspx?n=91974F2B13D997F1">
                <button id = "btn4" type="submit"> 大眾運輸 </button>
            </a>
            <img id = "five" src = "5.png" height = "100px" width = "90px">
            <a href="https://www.epa.gov.tw/public/Data/771110413071.pdf">
                <button id = "btn5" type="submit"> 低碳商品 </button>
            </a>
            <form action="register.php" method="post">
                <input type="button" id = "change_button" value="商品兌換" onclick="window.location.href='http://140.116.54.153/item.php'" />
            </form>
            <form action="register.php" method="post">
                <input type="button" id = "rank_button" value="廠商紀錄" onclick="window.location.href='http://140.116.54.153/TransactionRecord.php'" />
            </form>
            <form action="coin_convert.php" method="post">
				<input type="submit" name="submit" id = "convert_button" value="兌換C幣" onclick = "btn_confirm()">
			</form>
        </div>
        <script>
			function btn_confirm(){
				alert("C幣兌換成功!!!");
			}
        </script>
    </body>
</html>
