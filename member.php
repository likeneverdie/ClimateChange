<?php
	session_start();
	if(isset($_SESSION["account"]) == FALSE){
		header('Location: login.php');
	}
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
            <p id = "Hello"> Hello!!! </p>
            <p id = "account"><u><?php echo ">>  ".$_SESSION["account"]?></u></p>
            <p id = "steps"><?php echo "目前累積行步數:  ".$_SESSION["steps"]." steps"?></p>
            <p id = "km"><?php echo "目前累積單車里程數: ".$_SESSION["km"]." km"?></p>
            <p id = "ccoin"><?php echo "擁有C幣: ".$_SESSION["ccoin"]?></p>
            <img id = "one" src = "1.png" height = "100px" width = "90px">
            <a href="https://likeneverdie.github.io/uidd2017_Loading/">
                <button id = "btn1" type="submit"> 步行 </button>
            </a>
            <img id = "two" src = "2.png" height = "100px" width = "90px">
            <a href="https://likeneverdie.github.io/uidd2017_Loading/">
                <button id = "btn2" type="submit"> 自行車 </button>
            </a>
            <img id = "three" src = "3.png" height = "100px" width = "90px">
            <a href="https://likeneverdie.github.io/uidd2017_Loading/">
                <button id = "btn3" type="submit"> 電子發票 </button>
            </a>
            <img id = "four" src = "4.png" height = "100px" width = "90px">
            <a href="https://likeneverdie.github.io/uidd2017_Loading/">
                <button id = "btn4" type="submit"> 大眾運輸 </button>
            </a>
            <img id = "five" src = "5.png" height = "100px" width = "90px">
            <a href="https://likeneverdie.github.io/uidd2017_Loading/">
                <button id = "btn5" type="submit"> 低碳商品 </button>
            </a>
            <form action="register.php" method="post">
                <input type="button" id = "change_button" value="商品兌換" onclick="window.location.href='http://140.116.54.153/login.php'" />
            </form>
            <form action="register.php" method="post">
                <input type="button" id = "rank_button" value="廠商排名" onclick="window.location.href='http://www.hyperlinkcode.com/button-links.php'" />
            </form>
        </div>
    </body>
</html>
