<?php
// ceil, floor, round, pi
$x = 4.5;
echo $x . "を・・・<br/>";
echo "切り上げたら" . ceil($x) . "<br/>";
echo "切り捨てたら" . floor($x) . "<br/>";
echo "四捨五入したら" . round($x) . "<br/>";
echo "PIをかけると" . $x * pi() . "<br/>";
echo "<br/>";

// mt_rand
echo "サイコロは" . mt_rand(1, 6) . "が出ました。 <br/>";
echo "<br/>";

// str
$str = "namihiro";

echo "文字列：" . $str . "<br/>";
echo "文字列の長さ：" . strlen($str) . "<br/>";
echo "iの位置index：" . strpos($str, 'i') . "<br/>";
echo "最後の4文字：" . substr($str, -4, 4) . "<br/>";
echo "iをaに置き換えると：" . str_replace('i', 'a', $str) . "<br/>";
echo "<br/>";

// print
$name = "Taro";
$age = 15;
printf("%sは%d歳です。<br/>", $name, $age);
$message = sprintf("%sは%d歳です。<br/>", $name, $age);
echo $message;