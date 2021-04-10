<?php
// 直方体の体積を返す
// $x：縦、$y：横、$h：高さ
function getCuboidVolume($x, $y, $h)
{
    return $x * $y * $h;
}

// 縦=5cm、横=10cm、高さ=8cmの直方体の体積
echo "直方体の体積は" . getCuboidVolume(5, 10, 8) . "cm3です";
