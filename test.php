<?php

$Conn = mysql_connect("localhost", "root", "b960203960203");

if (!$Conn) {
	die("連線失敗，錯誤訊息：".mysql_error());
}
//echo "連線成功<br>";
//mysql_close($Link);

mysql_select_db("Account"); //選擇資料庫

$data = mysql_query("SELECT * FROM account"); //選擇某一表格

// 讀取資料
for($i = 1; $i<= mysql_num_rows($data); $i++){

	$row = mysql_fetch_array($data);
	echo "ID: $row[0]<br>";
	echo "Account: $row[1]<br>";
	echo "Password: $row[2]<br>";
}

/*while($row = mysql_fetch_array($data)){
	
	echo "ID: $row[0]<br>";
	echo "Account: $row[1]<br>";
	echo "Password: $row[2]<br>";
}*/

?>
