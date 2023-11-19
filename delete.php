<?php
session_start();
if($_SESSION['id'] == "") {
   header('Location: rogout.php');
}
require("dbconnect.php");
if (isset($_GET['id']) && is_numeric($_GET['id'])) { 
   $id = $_GET['id'];
   $memos = $db->prepare('DELETE FROM memos WHERE id=?');
   $memos->bindParam(1, $id, PDO::PARAM_INT);
   $memos->execute();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="style\delete.css" rel="stylesheet">
   <title>削除画面</title>
</head>
<body>
<div class="i-phone-14-1">
        <div class="frame-5" >
            <div class="group-7" >
                <div class="ellipse-1" ></div>
                <div class="ellipse-2" ></div>
                <div class="ellipse-3" ></div>
                <div class="ellipse-4" ></div>
                <div class="ellipse-6" ></div>
            </div>
        </div>
        <div class="title"><h4>削除しました!</h4></div>
        <div class="vector"><a href="view.php"><button class="bn632-hover bn23">戻る</button></a></div>
    </div>
</body>
</html>


