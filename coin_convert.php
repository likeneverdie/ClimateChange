<?php

session_start();
echo $_SESSION["steps"]."<br>";
echo $_SESSION["km"]."<br>";
echo $_SESSION["ccoin"]."<br>";

$account = $_SESSION["account"];
$ccoin = $_SESSION["ccoin"] + ($_SESSION["steps"] * 2) + ($_SESSION["km"] * 1000);
$steps  = 0;
$km = 0;
echo $steps."<br>";
echo $km."<br>";
echo $ccoin."<br>";

$Conn = mysql_connect("localhost", "root", "b960203960203");

if (!$Conn) {
	die("連線失敗，錯誤訊息：".mysql_error());
}
echo "連線成功<br>";

mysql_select_db("Account"); //選擇資料庫

$data = mysql_query("SELECT * FROM member_test"); //選擇某一表格

//$renew_data = mysql_query("UPDATE `Account`.`member_test` SET `steps` = '$steps', `km` = '$km', `ccoin` = '$ccoin' WHERE `member_test`.`account` = 'wtchen'");
$renew_data = mysql_query("UPDATE member_test SET steps = '$steps', km = '$km', ccoin = '$ccoin' WHERE member_test.account = '$account'");

header('Location: item.php');

?>
