<?php
	session_start();
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>販售碳權</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="vendor_sell.css" />
</head>
<body>
    <div id = "container">
		<h1 id = "account"> <?php echo $_SESSION["account_vendor"]?></h1>
		<h1 id = "title"> 販售碳權 </h1>
		<p id = "ccoin"> <?php echo "C幣: ".$_SESSION["ccoin_vendor"]?></p>
		<p id = "co2"> <?php echo "碳存量: ".$_SESSION["co2_vendor"]."(kg)"?></p>
		
		<div id = "table">
			
		</div>
		
    </div>
</body>
</html>
