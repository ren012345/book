<?php
   require("dbconnect.php");
   session_start();

   //URL直接入力対策
   if($_SESSION['id'] == "") {
    header('Location: rogout.php');
    }
    
   if (isset($_SESSION['book']['id']) && is_numeric($_SESSION['book']['id'])) {
      $value2 = $_SESSION['book']['memo'];
      $value1 = $_SESSION['book']['bookNo'];
      $id = $_SESSION['book']['id'];
      $statement = $db->prepare('UPDATE memos SET memo=?,bookNo=?,created_at=NOW(), release_date=?, Category=?, img=? WHERE id=?');

      //検索条件を配列にする
         $params = array(
            'intitle' => $value2.$value1 //書籍タイトルと巻数
      );

      //1ページに何件取得するか
      $maxResults = 2;

      //APIの基本になるURL
      $base_url = 'https://www.googleapis.com/books/v1/volumes?q=';

      // 配列で設定した検索条件をURLに追加
      foreach ($params as $key => $value) {
         $base_url .= $key.':'.$value;
      }

      // 末尾につく「+」をいったん削除
      // $params_url = substr($base_url, 0, -1);

      // 件数情報を設定
      $url = $base_url.'&maxResults='.$maxResults;

      // 書籍情報を取得
      $json = file_get_contents($url);

      // デコード（objectに変換）
      $data = json_decode($json);

      // 全体の件数を取得
      $total_count = $data->totalItems;

      // 発売日の初期値
      $ReleaseDate = '情報がありません';

      // 画像の初期値
      $Img = NULL;

      if($total_count > 0) {
         // 書籍情報を取得
        $books = $data->items;
        // 実際に取得した件数
        $get_count = count($books);
        foreach($books as $book){
            if($book->volumeInfo->readingModes->text == true && $book->volumeInfo->readingModes->image == true){
                if(isset($book->volumeInfo->publishedDate)){
                    //発売日
                    $ReleaseDate = $book->volumeInfo->publishedDate;
                    $Img = $book->volumeInfo->imageLinks->thumbnail;
                }else{
                    //発売日
                    $ReleaseDate = '情報がありません';
                }
            }
        }
    }else{
        $ReleaseDate = '情報がありません';
    }

      $statement->execute(array($value2,$value1,$ReleaseDate,$_SESSION['book']['kategori'],$Img, $id));
   }
   //セッション破棄
   unset($_SESSION['book']);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style\edit_do.css" rel="stylesheet">
    <title>編集完了画面</title>
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
        <div class="title"><h4>編集完了!!</h4></div>
        <div class="vector"><a href="view.php"><button class="bn632-hover bn23">戻る</button></a></div>
    </div>
</body>
</html>




