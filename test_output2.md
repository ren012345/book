
<?php
/*データの受け取り*/
$a = $s;
/*文字列を区切って配列に入れる*/ 
$arry1 = str_split($a);
/*要素数カウント*/
$youso = count($arry1);
/*組み合わせの連想配列*/
$kumi = [
    '(' => ')',
    '[' => ']',
    '{' => '}'
];
    $stack = []; // スタックを初期化
    for($i = 0; $i < $youso; $i++) {
        $count = 0;
        /*左かっこだった時の処理*/
        if($arry1[$i] == "(" || $arry1[$i] == "[" || $arry1[$i] == "{") {
            array_push($stack, $arry1[$i]); // スタックに追加
        } else {
            /*右かっこだった時の処理*/
            $migi = $arry1[$i];
            /*向かい合って閉じているかどうかの処理*/
            if ($kumi[array_pop($stack)] != $migi) {
                echo "false";
                exit;
            }
        }
    }
    if (count($stack) > 0) {
        echo "false"; // スタックにまだ要素が残っている場合もfalseとする
    } else {
        echo "true";
    }
?>