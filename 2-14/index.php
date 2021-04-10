<?php
$members = ["tanaka", "sasaki", "kimura", "yoshida", "uchida"];

echo "要素：";
echo var_dump($members) . "<br/>";
echo "要素数：";
echo count($members) . "<br/>";
echo "ソート結果：";
sort($members);
echo var_dump($members) . "<br/>";
echo "sasakiがいる？：";
echo var_dump(in_array("sasaki", $members)) . "<br/>";
echo "satoがいる？：";
echo var_dump(in_array("sato", $members)) . "<br/>";

$atstr = implode("@", $members);
echo "要素の結合：<br/>";
var_dump($atstr);
echo "<br/>";

$re_members = explode("@", $atstr);
echo "配列に戻す：<br/>";
var_dump($re_members);