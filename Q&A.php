<?php
      session_start();
      
      //URL直接入力対策
      if($_SESSION['id'] == "") {
         header('Location: rogout.php');
      }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style\Q&A.css" rel="stylesheet">
    <title>Q&A</title>
</head>
<body>
    <header>
        <div class="header-area">
            <a href="view.php" style="display: inline-block; width: 33px; height: 29px;">
                <svg class="reply-solid-1" width="33" height="29" viewBox="0 0 33 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.2129 2.10703C13.9541 2.41582 14.4375 3.11211 14.4375 3.875V7.75H21.6562C27.9211 7.75 33 12.5211 33 18.4062C33 25.2662 27.7471 28.3299 26.5418 28.9475C26.3807 29.0322 26.2002 29.0625 26.0197 29.0625C25.3172 29.0625 24.75 28.5236 24.75 27.8697C24.75 27.4156 25.0271 26.9979 25.3816 26.6891C25.9875 26.1562 26.8125 25.0906 26.8125 23.2561C26.8125 20.0471 24.041 17.4436 20.625 17.4436H14.4375V21.3186C14.4375 22.0814 13.9605 22.7777 13.2129 23.0865C12.4652 23.3953 11.6016 23.2682 10.9957 22.7596L0.683203 14.0408C0.251367 13.6654 0 13.1447 0 12.5937C0 12.0428 0.251367 11.5221 0.683203 11.1527L10.9957 2.43398C11.6016 1.91934 12.4717 1.79219 13.2129 2.10703Z" fill="white"/>
                </svg>
            </a>
        </div>
    </header>

    <details class="qa-001">
        <summary>本の登録について</summary>
        <p>本のタイトルはすべて正確に登録しないと画像などを自動で取得することができません。正確に登録しても取得できない場合があります。</p>
    </details>

    <details class="qa-001">
        <summary>検索のリセットについて</summary>
        <p>検索後、再び一覧を表示する場合検索バーに何も入力していない状態で検索ボタンを押してください。</p>
    </details>
    
</body>
</html>