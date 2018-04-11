<?php

$Conn = mysql_connect("140.116.100.80", "root", "ron");

if (!$Conn) {
	die("連線失敗，錯誤訊息：".mysql_error());
}
echo "連線成功<br>";
//mysql_close($Link);

mysql_select_db("myDB"); //選擇資料庫

$data = mysql_query("SELECT * FROM member"); //選擇某一表格

// 讀取資料
for($i = 1; $i<= mysql_num_rows($data); $i++){

	$row = mysql_fetch_array($data);
	echo "ID: $row[0]<br>";
	echo "Account: $row[1]<br>";
	echo "Password: $row[2]<br>";
	echo "Steps: $row[3]<br>";
	echo "Km: $row[4]<br>";
	echo "Ccoin: $row[5]<br>";
}

/*while($row = mysql_fetch_array($data)){
	
	echo "ID: $row[0]<br>";
	echo "Account: $row[1]<br>";
	echo "Password: $row[2]<br>";
}*/

?>
