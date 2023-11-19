<?php
   require("dbconnect.php");
   session_start();

   //URL直接入力対策
   if($_SESSION['id'] == "") {
    header('Location: rogout.php');
    }
    
   $memos = $db->prepare('SELECT * FROM memos WHERE id=?');
   $memos->bindParam(1, $_GET['id'], PDO::PARAM_INT);
   $memos->execute();
   $memo = $memos->fetch();

   if(!empty($_POST)) {
    //入力の不備を確認
    if($_POST['memo'] === "") {
        $error['memo'] = "blank";
    }
    if($_POST['bookNo'] === "") {
        $error['bookNo'] = "blank";
    }
    if($_POST['kategori'] === "カテゴリー") {
        $error['kategori'] = "blank";
    }

    //エラーがなければ次のページへ
    if(!isset($error)) {
        $_SESSION['book'] = $_POST;
        header('Location: edit_do.php');
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style\edit.css" rel="stylesheet">
    <title>編集画面</title>
</head>
<body>
    <div class="i-phone-14-2" >
        <!-- アイコン -->
        <svg class="pen-to-square-solid-1" width="89" height="89" viewBox="0 0 89 89" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g clip-path="url(#clip0_21_13)">
                <path d="M81.9773 3.77212C78.1705 -0.0347168 72.017 -0.0347168 68.2101 3.77212L62.9779 8.98696L79.9957 26.0047L85.2279 20.7725C89.0348 16.9657 89.0348 10.8122 85.2279 7.00532L81.9773 3.77212ZM29.968 42.0143C28.9076 43.0747 28.0906 44.3784 27.6213 45.8211L22.476 61.2571C21.9719 62.752 22.3717 64.4034 23.4842 65.5332C24.5967 66.6631 26.248 67.0455 27.7603 66.5414L43.1963 61.3961C44.6217 60.9268 45.9254 60.1098 47.0031 59.0495L76.0846 29.9506L59.0494 12.9155L29.968 42.0143ZM16.6875 11.125C7.47461 11.125 0 18.5997 0 27.8125V72.3125C0 81.5254 7.47461 89 16.6875 89H61.1875C70.4004 89 77.875 81.5254 77.875 72.3125V55.625C77.875 52.5483 75.3893 50.0625 72.3125 50.0625C69.2357 50.0625 66.75 52.5483 66.75 55.625V72.3125C66.75 75.3893 64.2643 77.875 61.1875 77.875H16.6875C13.6107 77.875 11.125 75.3893 11.125 72.3125V27.8125C11.125 24.7358 13.6107 22.25 16.6875 22.25H33.375C36.4518 22.25 38.9375 19.7643 38.9375 16.6875C38.9375 13.6108 36.4518 11.125 33.375 11.125H16.6875Z" fill="url(#paint0_linear_21_13)"/>
          </g>
          <defs>
                <linearGradient id="paint0_linear_21_13" x1="44.0415" y1="0.916992" x2="44.0415" y2="89" gradientUnits="userSpaceOnUse">
                      <stop offset="0.338542" stop-color="#A248E9" stop-opacity="0.95"/>
                      <stop offset="0.9999" stop-color="#E94895" stop-opacity="0.22"/>
                      <stop offset="1" stop-color="#A248E9" stop-opacity="0"/>
                </linearGradient>
                <clipPath id="clip0_21_13">
                      <rect width="89" height="89" fill="white"/>
                </clipPath>
          </defs>
        </svg>

        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
            <div class="vector">タイトル:<input type="text" name="memo" class="newText" value="<?php echo $memo['memo'] ?>"/></div><br>
            <div class="vector2">巻数:<input type="text" name="bookNo" class="newText" value="<?php echo $memo['bookNo'] ?>"/></div><br>
            <div class="rectangle-5">
                <label class="selectbox-005">
                    <select name="kategori">
                        <option value="カテゴリー">カテゴリーを選択して下さい</option>
                        <option value="漫画">漫画</option>
                        <option value="ライトノベル">ライトノベル</option>
                    </select>
                </label>
            </div>
            <div class="vector4"><input type="submit" value="編集完了" class="registration_button"></div>
        </form>

        <?php if (!empty($error["newText"]) && $error['newText'] === 'blank'): ?>
                    <p class="error">タイトルを入力してください</p>
                <?php elseif (!empty($error["bookNo"]) && $error['bookNo'] === 'blank'): ?>
                    <p class="error">巻数を入力してください</p>
                <?php elseif (!empty($error["kategori"]) && $error['kategori'] === 'blank'): ?>
                    <p class="error">カテゴリーを選択してください</p>
        <?php endif ?>


        <div class="vector3">
            <a href="view.php"><button class="registration_button">ホームへ戻る</button></a>
        <div>
    </div>
</body>
</html>
