<?php
    require("dbconnect.php");
    session_start();

    // 直接URLを入力された場合の対処
    if(!isset($_SESSION['join'])) {
        header('Location: top.php');
        exit();
    }

    // パスワードを暗号化
    $hash = password_hash($_SESSION['join']['pass'], PASSWORD_BCRYPT);

    // 入力情報をデータベースに登録
    $startment = $db->prepare("INSERT INTO user SET name=?, pass=?");
    $startment->execute(array(
        $_SESSION['join']['name'],
        $hash
    ));

    //セッション破棄
    unset($_SESSION['join']);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style\singup_end.css">
    <title>新規登録完了画面</title>
</head>
<body>
    <!-- For more settings use the AutoHTML plugin tab ... --> 
 <div class="i-phone-14-11" >
  	<div class="frame-4" >
    		<h2 class="singupEnd" >
                登録完了！
            </h2>
      			<div class="rectangle-14" >
                    <a href="top.php"><button class="top bn26">トップへ</button></a>
                </div>
  	</div>
</div>
</body>
</html>