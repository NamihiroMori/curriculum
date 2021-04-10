<?php
// 40マスすごろく
$total = 0; // 合計何マス進んだか
$count = 0; // 何回目か
define("SQUARE_NUM", 40);

// マス目の合計が40を超えるまでサイコロを振る
while ($total < SQUARE_NUM) {
    $count++;
    // サイコロを振り合計に足す
    $num = mt_rand(1, 6);
    $total += $num;
    echo $count . "回目＝" . $num . "<br/>";
}
echo "合計{$count}回でゴールしました";

echo "<br/><br/>";

// あいさつ

// 現在の時間をint型で取得
$hour = intval(date("H", time()));
echo "今" . $hour . "時台です <br/>";

// 6-11時はおはよう、12-17時はこんにちは、18-5時はこんばんは
if ($hour >= 6 && $hour < 12) {
    echo "おはようございます";
} elseif ($hour >= 12 && $hour < 17) {
    echo "こんにちは";
} elseif (($hour >= 18 && $hour < 24) || $hour >=0 && $hour < 6) {
    echo "こんばんは";
}