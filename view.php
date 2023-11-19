<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style\view.css">
    <title>一覧画面</title>
</head>
<body>
    <?php
                require("dbconnect.php");
                session_start();

                //URL直接入力対策
                if($_SESSION['id'] == "") {
                    header('Location: rogout.php');
                }
                    $stmt = "";
                if(isset($_GET['book_name'])) {
                    $stmt = $db->query('SELECT * FROM memos WHERE memo LIKE "%' . $_GET['book_name'] . '%" AND Category LIKE "%漫画%" AND user_id = ' . $_SESSION['id']);
                    $stmt1 = $db->query('SELECT * FROM memos WHERE memo LIKE "%' . $_GET['book_name'] . '%" AND Category LIKE "%ライトノベル%" AND user_id = ' . $_SESSION['id']);
                }
                $memos = $db->query('SELECT * FROM memos WHERE Category LIKE "%漫画%" AND user_id = ' . $_SESSION['id']);
                $memos1 = $db->query('SELECT * FROM memos WHERE Category LIKE "%ライトノベル%" AND user_id = ' . $_SESSION['id']);
            ?> 
<!--------------------------------------------------ヘッダー---------------------------------------------------------------------------------------->
    <header>
        <div class="header-area">
        <div class="hamburger">
                <!-- ハンバーガーメニューの線 -->
                <span></span>
                <span></span>
                <span></span>
                <!-- ハンバーガーメニューの線 -->
            </div>
            <!-- 検索ボックス -->
            <form action="view.php" class="search-form-003" method="get">
                <label>
                    <input type="text" placeholder="キーワードを入力" name="book_name">
                </label>
                <button type="submit" aria-label="検索"></button>
            </form>
            
        </div>
                <ul class="slide-menu">
                    <li><a class="header-nav-item-link" href="input.php">追加</a></li>
                    <li><a class="header-nav-item-link" href="Q&A.php">Q&A</a></li>
                    <li><a class="header-nav-item-link" href="rogout.php">ログアウト</a></li>
                </ul>
    </header>

    <main>
         <!-- カテゴリーで画面を切り替えるタブ -->
         <div class="tab_wrap">
            <input type="radio" id="tab1" name="tab_btn" checked>
            <input type="radio" id="tab2" name="tab_btn">

            <div class="tab_area">
                <label for="tab1" class="tab1_label">漫画</label>
                <label for="tab2" class="tab2_label">ライトノベル</label>
            </div>

            <div class="panel_area">
                <div id="panel1" class="tab_panel">
                <?php if ($stmt == ""): ?>
                    <!-- 一覧表示 -->
                    <?php while ($memo = $memos->fetch() ):?>
                        <pre>
                            <a href="view_more.php?id=<?php echo $memo['id'] ?>"><h2 class="heading-019"><div class=title_h><?php echo $memo['memo']; ?></div></h2></a>
                                <h4><?php echo '巻数 :'.$memo['bookNo']; ?></h4>
                        </pre>
                        <hr>
                    <?php endwhile ?>
                    
                    <?php else: ?>

                    <!-- 検索結果表示 -->
                    <?php foreach($stmt as $bookName):?>
                        <pre>
                            <a href="view_more.php?id=<?php echo $bookName['id'] ?>"><h2 class="heading-019"><div class=title_h><?php echo $bookName['memo']; ?></div></h2></a>
                                <h4><?php echo '巻数 :'.$bookName['bookNo']; ?></h4>
                        </pre>
                        <hr>
                    <?php endforeach ?>
                    
                    <?php endif ?>
                </div>
                
                <div id="panel2" class="tab_panel">
                <?php if ($stmt == ""): ?>
                    <!-- 一覧表示 -->
                    <?php while ($memo = $memos1->fetch() ):?>
                        <pre>
                            <a href="view_more.php?id=<?php echo $memo['id'] ?>"><h2 class="heading-019"><div class=title_h><?php echo $memo['memo']; ?></div></h2></a>
                                <h4><?php echo '巻数 :'.$memo['bookNo']; ?></h4>
                               
                        </pre>
                        <hr>
                    <?php endwhile ?>
                    
                    <?php else: ?>

                    <!-- 検索結果表示 -->
                    <?php foreach($stmt1 as $bookName):?>
                            <pre>
                                <a href="view_more.php?id=<?php echo $bookName['id'] ?>"><h2 class="heading-019"><div class=title_h><?php echo $bookName['memo']; ?></div></h2></a>
                                    <h4><?php echo '巻数 :'.$bookName['bookNo']; ?></h4>
                                   
                            </pre>
                            <hr>
                    <?php endforeach ?>
                    
                    <?php endif ?>
                </div>
            </div>
        </div> 
    </main>

    <footer>

    </footer>
    <script src="js\view.js"></script>
</body>
</html>
