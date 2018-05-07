<?php
	session_start();
	if(isset($_SESSION["account_vendor"]) == FALSE){
		header('Location: login.php');
	}
	//$a = "PPAP";
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>交易成功</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="success_trans.css" />
</head>
<body>
    <div id = "container">
		<p id = "amount"><?php echo"購買數量&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$_SESSION["thisamount"]?></p>
		<p id = "price"><?php echo"交易金額&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$_SESSION["thisprice"]?></p>
		<p id = "date"><?php echo"購買日期"?></p>
		<p id = "thisdate"><?php echo $_SESSION["thisdate"]?></p>
		<a href = "http://140.116.54.153/vendor.php"><img id = "back" src = 'back.png'></a>
    </div>
    <script>

    </script>
</body>
</html>
