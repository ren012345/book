<?php 
      require("dbconnect.php");
      session_start();
      
      //URL直接入力対策
      if($_SESSION['id'] == "") {
         header('Location: rogout.php');
      }

      $id = $_GET['id'];
      $memos = $db->prepare('SELECT * FROM memos WHERE id=?');
      $memos->bindParam(1, $id, PDO::PARAM_INT);
      $memos->execute();
      $memo = $memos->fetch();
      if($memo['img'] != NULL) {
         $Img=file_get_contents($memo['img']);
         $base64Img = base64_encode($Img);
         $imgSrc = 'data:image/jpeg;base64,' . $base64Img;

      }
   ?>

<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style\view_more.css">
   <title>メモ詳細画面</title>
</head>
<body>
   <header>
      <div class="header-area">
         <a href="view.php" style="display: inline-block; width: 33px; height: 29px;">
            <svg class="reply-solid-1" width="33" height="29" viewBox="0 0 33 29" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path d="M13.2129 2.10703C13.9541 2.41582 14.4375 3.11211 14.4375 3.875V7.75H21.6562C27.9211 7.75 33 12.5211 33 18.4062C33 25.2662 27.7471 28.3299 26.5418 28.9475C26.3807 29.0322 26.2002 29.0625 26.0197 29.0625C25.3172 29.0625 24.75 28.5236 24.75 27.8697C24.75 27.4156 25.0271 26.9979 25.3816 26.6891C25.9875 26.1562 26.8125 25.0906 26.8125 23.2561C26.8125 20.0471 24.041 17.4436 20.625 17.4436H14.4375V21.3186C14.4375 22.0814 13.9605 22.7777 13.2129 23.0865C12.4652 23.3953 11.6016 23.2682 10.9957 22.7596L0.683203 14.0408C0.251367 13.6654 0 13.1447 0 12.5937C0 12.0428 0.251367 11.5221 0.683203 11.1527L10.9957 2.43398C11.6016 1.91934 12.4717 1.79219 13.2129 2.10703Z" fill="white"/>
            </svg>
         </a>
         <div class="hamburger">
            <!-- ハンバーガーメニューの線 -->
            <span></span>
            <span></span>
            <span></span>
         </div>
      </div>

         <ul class="slide-menu">
            <li><a href="https://www.melonbooks.co.jp/">メロンブックス</a></li>
            <li><a href="https://www.animate-onlineshop.jp/">アニメイト</a></li>
            <li><a href="https://www.gamers.co.jp/">ゲーマーズ</a></li>
            <li><a href="https://www.toranoana.jp/">とらのあな</a></li>
         </ul>
   </header>

   <div class="i-phone-14-4">
      <div class="title1">
         <h2 class="title2" id="title2"><?php echo $memo['memo']; ?></h2>

         <!-- <label class="checkbox-label" for="checkbox" id="checkbox-label">
            <input type="checkbox" class="checkbox-input" id="checkbox">
            <svg class="circle-chevron-down-solid-1" width="24" height="23" viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_43_8)">
            <path d="M12 0C8.8174 0 5.76516 1.2116 3.51472 3.36827C1.26428 5.52494 0 8.45001 0 11.5C0 14.55 1.26428 17.4751 3.51472 19.6317C5.76516 21.7884 8.8174 23 12 23C15.1826 23 18.2348 21.7884 20.4853 19.6317C22.7357 17.4751 24 14.55 24 11.5C24 8.45001 22.7357 5.52494 20.4853 3.36827C18.2348 1.2116 15.1826 0 12 0ZM6.32812 10.8262C5.8875 10.4039 5.8875 9.72109 6.32812 9.30332C6.76875 8.88555 7.48125 8.88105 7.91719 9.30332L11.9953 13.2115L16.0734 9.30332C16.5141 8.88105 17.2266 8.88105 17.6625 9.30332C18.0984 9.72559 18.1031 10.4084 17.6625 10.8262L12.7969 15.498C12.3563 15.9203 11.6438 15.9203 11.2078 15.498L6.32812 10.8262Z" fill="#1F78FF"/>
            </g>
            <defs>
            <clipPath id="clip0_43_8">
            <rect width="24" height="23" fill="white"/>
            </clipPath>
            </defs>
            </svg>
         </label> -->
      </div>

      <div class="img-area" >
         <div class="imgg">
            <?php 
               if(isset($imgSrc)){
                  echo '<img src="'.$imgSrc.'" alt="画像がありません" width=150px height="200px">'; 
               }else{
                  echo '画像がありません';
               } 
            ?>
         </div>
      </div>

      
      <div class="line-3" ></div>
      <div class="kansu">巻数</div>
      <div class="kansu2"><?php echo $memo['bookNo']; ?></div>

      <div class="line-4" ></div>
      <div class="hatubai">発売日</div>
      <div class="hatubai2"><?php echo $memo['release_date']; ?></div>

      <div class="line-5" ></div>
      <div class="touroku">登録日</div>
      <div class="touroku2"><?php echo $memo['created_at']; ?></div>


      
</div>

   <div class="hensyu">
      <a href="edit.php?id=<?php echo $id ?>"><button class="css-button-retro">編集する</button></a>
   </div>

   <div class="delete">
      <a href="delete.php?id=<?php echo $id ?>"><button class="css-button-retro">削除する</button></a>
   </div>

   <!-- <a href="view.php"><button class="css-button-retro">戻る</button></a> -->
   <script src="js\view.js"></script>
</body>
</html>




