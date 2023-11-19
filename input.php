<?php
    require("dbconnect.php");
    session_start();

    //URL直接入力対策
   if($_SESSION['id'] == "") {
    header('Location: rogout.php');
    }
    
    if(!empty($_POST)) {
        //入力の不備を確認
        if($_POST['newText'] === "") {
            $error['newText'] = "blank";
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
            header('Location: input_do.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style\input.css" rel="stylesheet">
    <title>登録画面</title>
</head>
<body>
    <div class="i-phone-14-3" >
        <!-- アイコン -->
        <svg class="book-medical-solid-1" width="85" height="94" viewBox="0 0 85 94" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_23_6)">
                <g filter="url(#filter0_d_23_6)">
                    <path d="M0 17.625C0 7.89453 8.15848 0 18.2143 0H72.8571H78.9286C82.2868 0 85 2.62539 85 5.875V64.625C85 67.8746 82.2868 70.5 78.9286 70.5V82.25C82.2868 82.25 85 84.8754 85 88.125C85 91.3746 82.2868 94 78.9286 94H72.8571H18.2143C8.15848 94 0 86.1055 0 76.375V17.625ZM12.1429 76.375C12.1429 79.6246 14.856 82.25 18.2143 82.25H66.7857V70.5H18.2143C14.856 70.5 12.1429 73.1254 12.1429 76.375ZM39.4643 20.5625V29.375H30.3571C28.6875 29.375 27.3214 30.6969 27.3214 32.3125V38.1875C27.3214 39.8031 28.6875 41.125 30.3571 41.125H39.4643V49.9375C39.4643 51.5531 40.8304 52.875 42.5 52.875H48.5714C50.2411 52.875 51.6071 51.5531 51.6071 49.9375V41.125H60.7143C62.3839 41.125 63.75 39.8031 63.75 38.1875V32.3125C63.75 30.6969 62.3839 29.375 60.7143 29.375H51.6071V20.5625C51.6071 18.9469 50.2411 17.625 48.5714 17.625H42.5C40.8304 17.625 39.4643 18.9469 39.4643 20.5625Z" fill="url(#paint0_linear_23_6)" shape-rendering="crispEdges"/>
                </g>
            </g>
            <defs>
                <filter id="filter0_d_23_6" x="-4" y="0" width="93" height="102" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                    <feOffset dy="4"/>
                    <feGaussianBlur stdDeviation="2"/>
                    <feComposite in2="hardAlpha" operator="out"/>
                    <feColorMatrix type="matrix" values="0 0 0 0 0.313726 0 0 0 0 0.298039 0 0 0 0 0.956863 0 0 0 0.28 0"/>
                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_23_6"/>
                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_23_6" result="shape"/>
                </filter>
                <linearGradient id="paint0_linear_23_6" x1="42.5" y1="0" x2="42.5" y2="94" gradientUnits="userSpaceOnUse">
                <stop offset="0.338542" stop-color="#504CF4" stop-opacity="0.91"/>
                <stop offset="0.947917" stop-color="#504CF4" stop-opacity="0.44"/>
                </linearGradient>
                <clipPath id="clip0_23_6">
                <rect width="85" height="94" fill="white"/>
                </clipPath>
            </defs>
        </svg>
        
        <form action="" method="post">
            <div class="vector"><input type="text" name="newText" class="newText" placeholder="タイトルを入力してください"/></div>
            <br>
            <div class="vector2"><input type="text" name="bookNo" class="bookNo" placeholder="巻数を入力してください"></div>
            <br>
            <div class="rectangle-5">
                <label class="selectbox-005">
                    <select name="kategori">
                        <option value="カテゴリー">カテゴリーを選択して下さい</option>
                        <option value="漫画">漫画</option>
                        <option value="ライトノベル">ライトノベル</option>
                    </select>
                </label>
            </div>

                <?php if (!empty($error["newText"]) && $error['newText'] === 'blank'): ?>
                    <p class="error">タイトルを入力してください</p>
                <?php elseif (!empty($error["bookNo"]) && $error['bookNo'] === 'blank'): ?>
                    <p class="error">巻数を入力してください</p>
                <?php elseif (!empty($error["kategori"]) && $error['kategori'] === 'blank'): ?>
                    <p class="error">カテゴリーを選択してください</p>
                <?php endif ?>

            <div class="vector4"><input type="submit" value="登録する" class="bn632-hover bn20"></div>
        </form>
        <div class="vector3"><a href="view.php"><button class="bn632-hover bn20">戻る</button></a></div>
    </div>
</body>
</html>