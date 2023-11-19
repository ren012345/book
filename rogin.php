<?php
    require("dbconnect.php");
    session_start();

    if(!empty($_POST)) {
        $name = $_POST['name'];
        $pass = $_POST['pass'];

        $sql = "SELECT * FROM user WHERE name= :name";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->execute();
        $member = $stmt->fetch();

        if($member !== false) {
            if(password_verify($pass, $member['pass'])) {
                $_SESSION['id'] = $member['id'];
                $_SESSION['name'] = $member['name'];
                header("Location:view.php");
            }else {
                $msg = '名前もしくはパスワードが違います。';
            }
        }else{
            $msg = '名前もしくはパスワードが違います。';
        }
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style\rogin.css" rel="stylesheet">
    <title>ログイン画面</title>
</head>
<body>
 <div class="i-phone-14-8" >
  	<div class="frame-4" >
    		<div class="login" >
                Login
            </div>
 
            <form action="" method="post">
      			<div class="line-36" >
                        <div class="cp_iptxt">
                            <input class="ef" type="text" placeholder="" name="name">
                            <label>Name</label>
                            <span class="focus_line"></span>
                        </div>
    		    </div>
    		
      			<div class="line-37" >
                  <div class="cp_iptxt">
                            <input class="ef" type="text" placeholder="" name="pass">
                            <label>Pass</label>
                            <span class="focus_line"></span>
                        </div>
    		    </div>
    		
                <?php if(!empty($msg)): ?>
                    <p id="warning"><?php echo $msg ?></p>
                <?php endif ?>
                
      			<div class="rectangle-14" >
      			    <button class="rogin bn26">ログイン</button>
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