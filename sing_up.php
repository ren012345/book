<?php
    require("dbconnect.php");
    session_start();

    if(!empty($_POST)) {
        //入力の不備を確認
        if($_POST['name'] === "") {
            $error['name'] = "blank";
        }
        if($_POST['pass'] === "") {
            $error['pass'] = "blank";
        }

        //名前の重複を確認
        if(!isset($error)) {
            $member = $db->prepare('SELECT COUNT(*) as cnt FROM user WHERE name=?');
            $member->execute(array($_POST['name']));
            $record = $member->fetch();
            if($record['cnt']>0) {
                $error['name'] = 'duplicate';
            }
        }

        //エラーがなければ次のページへ
        if(!isset($error)) {
            $_SESSION['join'] = $_POST;
            header('Location: singup_end.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style\sing_up.css" rel="stylesheet">
    <title>新規登録画面</title>
</head>
<body>
 <div class="i-phone-14-8" >
  	<div class="frame-4" >
    		<div class="login" >
                Sing up
            </div>

            <form action="" method="POST">
      			<div class="line-36" >
                        <div class="cp_iptxt">
                            <input class="ef" type="text" placeholder="" name="name">
                            <label>Name</label>
                            <span class="focus_line"></span>
                        </div>
    		    </div>

                <?php if (!empty($error["name"]) && $error['name'] === 'blank'): ?>
                    <p class="error">名前を入力してください</p>
                <?php elseif (!empty($error["name"]) && $error['name'] === 'duplicate'): ?>
                    <p class="error">この名前はすでに登録済みです。</p>
                <?php endif ?>
    		
      			<div class="line-37" >
                  <div class="cp_iptxt">
                            <input class="ef" type="text" placeholder="" name="pass">
                            <label>Pass</label>
                            <span class="focus_line"></span>
                        </div>
    		    </div>

                <?php if (!empty($error["pass"]) && $error['pass'] === 'blank'): ?>
                    <p class="error">パスワードを入力してください。</p>
                <?php endif ?>
    		
      			<div class="rectangle-14" >
      			    <button class="rogin bn26">登録</button>
                </div>
            </form>
  	</div>
    <a href="top.php">
        <svg class="reply-solid-1" width="33" height="31" viewBox="0 0 33 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.2129 2.10727C13.9541 2.41606 14.4375 3.11235 14.4375 3.87524V7.75024H21.6562C27.9211 7.75024 33 12.5213 33 18.4065C33 25.2665 27.7471 28.3301 26.5418 28.9477C26.3807 29.0325 26.2002 29.0627 26.0197 29.0627C25.3172 29.0627 24.75 28.5239 24.75 27.87C24.75 27.4159 25.0271 26.9981 25.3816 26.6893C25.9875 26.1565 26.8125 25.0909 26.8125 23.2563C26.8125 20.0473 24.041 17.4438 20.625 17.4438H14.4375V21.3188C14.4375 22.0817 13.9605 22.778 13.2129 23.0868C12.4652 23.3956 11.6016 23.2684 10.9957 22.7598L0.683203 14.0411C0.251367 13.6657 0 13.145 0 12.594C0 12.043 0.251367 11.5223 0.683203 11.153L10.9957 2.43423C11.6016 1.91958 12.4717 1.79243 13.2129 2.10727Z" fill="white"/>
        </svg>
    </a>
</div>
</body>
</html>