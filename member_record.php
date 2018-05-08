<?php
	session_start();
	
	if(isset($_SESSION["account"]) == FALSE){
		header('Location: login.php');
	}

	//連線資料庫 To get the certain data from a certain member
	$server = "localhost";
	$user = "root";
	$password_db = "b960203960203";
	
	$Connect = mysql_connect($server, $user, $password_db);
	if(!$Connect){
		die("連線失敗，錯誤訊息：".mysql_error());
	}
	else{
		//echo "資料庫連線成功<br>";
	}

	mysql_query("SET NAMES UTF8");
	mysql_select_db("Account"); //選擇資料庫

	if(empty($_POST['timestamp']) == FALSE && empty($_POST['id']) == FALSE){
		$timestamp = $_POST['timestamp'];
		$id = $_POST['id'];
		//echo "Success<br>";
		//echo $id;
		$renew_check = mysql_query("UPDATE `Account`.`trans_member_test` SET `check` = '1' WHERE `trans_member_test`.`id` = '$id';");

	}
	$data = mysql_query("SELECT * FROM trans_member_test"); //選擇某一表格
	for($i = 1; $i<= mysql_num_rows($data1); $i++){
		$row = mysql_fetch_array($data1);
		if($row['account'] == $_SESSION["account"]){
			$check = $row['check'];
			echo $check."<br>";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>兌換紀錄</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="member_record.css" />
</head>
<body>
    <div id = "container">
		<a href = "http://140.116.54.153/item.php"><img id = "back" src = 'back.png'></a>
		<h1 id = "account"> <?php echo $_SESSION["account"]?></h1>
		<p id = "ccoin"> <?php echo "C幣: ".$_SESSION["ccoin"]?></p>
		<div id = "table">
			<table id = "trans_list">
				<tr>
					<th>品項</th>
					<th>金額</th>
					<th>日期</th>
					<th> </th>					
				</tr>
				<?php
				for($i = 1; $i<= mysql_num_rows($data); $i++){
					$row = mysql_fetch_array($data);
					if($row['account'] == $_SESSION["account"]){
						$check = $row['check'];
						//echo $check."<br>";
						if($check == 0){
				?>
				<tr>
					<td><?php echo $row['item']?></td>
					<td><?php echo $row['cost']?></td>
					<td><?php echo $row['timestamp']?></td>
					<td>
						<form action = "member_record.php" method = "post" onsubmit = "return confirm ('確定要兌換嗎？');">
								<input type="hidden" name = "id" value = "<?php echo $row['id']?>">
								<input type="hidden" name = "timestamp" value = "<?php echo $row['timestamp']?>">
								<input type="image" id = "Buybtn" name="submit" src = "change.png" onmouseover="hover(this)"; onmouseout="unhover(this)">
						</form>
					</td>
				</tr>
				<?php
						}
				?>
				<?php
						if($check == 1){
				?>
				<tr>
					<td><?php echo $row['item']?></td>
					<td><?php echo $row['cost']?></td>
					<td><?php echo $row['timestamp']?></td>
					<td><img id = "changed" src = 'changed.png'></td>
				</tr>
				<?php
						}
					}
				}
				?>
			</table>
		</div>
    </div>
    <script>
		function hover(element){
			element.setAttribute('src', 'changeY.png');
		}
		function unhover(element){
			element.setAttribute('src', 'change.png');
		}
    </script>
</body>
</html>
