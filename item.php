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
		
				$_SESSION["steps"] = $row["steps"];
				$_SESSION["km"] = $row["km"];
				$_SESSION["ccoin"] = $row["ccoin"];
				$_SESSION["cart"] = $row["cart"];
				/*$steps = $row["steps"];
				$km = $row["km"];
				$ccoin = $row["ccoin"];*/
				break;
			}
		}
		
?>

<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>兌換商品</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="item.css" >
</head>
<body>
    <div id = "container">
		<b id = "account"><u><?php echo $_SESSION["account"]?></u></b>
        <b id = "ccoin"><?php echo "擁有C幣: ".$_SESSION["ccoin"]?></b>
        <form action="coin_convert.php" method="post">
			<input type="submit" name="submit" id = "convert_button" value="會員優惠券" onclick = "btn_confirm()">
		</form>
        <img id = "city_cafe" src = "city_cafe.png" height = "126.5px" width = "200px">
        <img id = "carrefour" src = "carrefour.png" height = "126.5px" width = "200px">
        <img id = "wastons" src = "wastons.png" height = "126.5px" width = "209px">
		<b id = "city_cafe_text"> City café <br>大杯第二杯七折</b>
		<b id = "city_cafe_price">1000</b>
		<b id = "carrefour_text"> 家樂福<br> 滿2000送200 </b>
		<b id = "carrefour_price">2000</b>
		<b id = "wastons_text"> 屈臣氏<br>買一送一</b>
		<b id = "wastons_price">3000</b>
		<form action="item_exchange_cafe.php" method="post" onsubmit = "return confirm ('確定要兌換咖啡折價券嗎？');">
			<input type="image" name="submit" id = "exchange_button_cafe" src = "check.png" onmouseover="hover(this)"; onmouseout="unhover(this)">
		</form>
		<form action="item_exchange_carrefour.php" method="post" onsubmit = "return confirm ('確定要兌換家樂福折價券嗎？');">
			<input type="image" name="submit" id = "exchange_button_carrefour" src = "check.png" onmouseover="hover(this)"; onmouseout="unhover(this)">
		</form>
		<form action="item_exchange_wastons.php" method="post" onsubmit = "return confirm ('確定要兌換屈臣氏優惠券嗎？');">
			<input type="image" name="submit" id = "exchange_button_wastons" src = "check.png" onmouseover="hover(this)"; onmouseout="unhover(this)">
		</form>
    </div>
    <script>
			function btn_confirm(){
				alert("C幣兌換成功!!!");
			}
			function hover(element){
				element.setAttribute('src', 'checkY.png');
			}
			function unhover(element){
				element.setAttribute('src', 'check.png');
			}
			
    </script>
</body>
</html>
