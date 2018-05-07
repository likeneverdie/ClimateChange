<?php
	session_start();
	/*if(isset($_SESSION["account"]) == FALSE){
		header('Location: login.php');
	}*/
	//$a = "PPAP";
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>兌換成功</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="success_change.css" />
</head>
<body>
    <div id = "container">
		<p id = "amount"><?php echo"商品內容&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$_SESSION["thisproduct"]?></p>
		<p id = "price"><?php echo"兌換金額&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$_SESSION["thisprice"]?></p>
		<p id = "date"><?php echo"兌換日期"?></p>
		<p id = "thisdate"><?php echo $_SESSION["thisdate"]?></p>
		<a href = "http://140.116.54.153/item.php"><img id = "back" src = 'back.png'></a>
    </div>
    <script>

    </script>
</body>
</html>
