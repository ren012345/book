<?php
    require("dbconnect.php");
    session_start();

    //URL直接入力対策
   if($_SESSION['id'] == "") {
    header('Location: rogout.php');
    }
    
    $statement = $db->prepare('INSERT INTO memos SET memo=?, bookNo=?, created_at=NOW(), release_date=?, Category=?, img=?, user_id=?');
    
    //検索条件を配列にする
    $params = array(
        'intitle' => $_SESSION['book']['newText'].$_SESSION['book']['bookNo'] //書籍タイトルと巻数
    );

    //1ページに何件取得するか
    $maxResults = 2;

    //APIの基本になるURL
    $base_url = 'https://www.googleapis.com/books/v1/volumes?q=';

    // 配列で設定した検索条件をURLに追加
    foreach ($params as $key => $value) {
        $base_url .= $key.':'.$value;
    }

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
   
    if(isset($_SESSION['book']["kategori"])) {
        $kategori = $_SESSION['book']["kategori"];
    }else{
        $kategori = "";
    }
        

    $statement->execute(array($_SESSION['book']['newText'],$_SESSION['book']['bookNo'],$ReleaseDate,$kategori,$Img,$_SESSION['id']));

    //セッション破棄
    unset($_SESSION['book']);

     header('Location: view.php'); 
?>
