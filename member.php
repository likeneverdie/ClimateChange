<?php
	session_start();
	if(isset($_SESSION["account"]) == FALSE){
		header('Location: login.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link href = "app.css" rel = "stylesheet">
	<meta charset="UTF-8">
	<title> FISH </title>
</head>
<body>
	<h2>W.T Chen is charming ^^ <br> Hello <?php echo $_SESSION["account"];?></h2>
</body>
</html>
