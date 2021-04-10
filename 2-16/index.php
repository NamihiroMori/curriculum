<?php
    $writeFile = "test.txt";
    $readFile = "test2.txt";
    $contents = "こんにちは！";

    // ファイルの書き込み
    if (is_writable($writeFile)) {
        $fp = fopen($writeFile, "w");
        fwrite($fp, $contents);
        fclose($fp);
        echo "finish writing!!" . "<br/>";
    } else {
        // 書き込み不可のときの処理
        echo "not writable!";
        exit;
    }

    // ファイルの読み込み
    if (is_readable($readFile)) {
        $fp = fopen($readFile, "r");

        while ($line = fgets($fp)) {
            echo $line . '<br/>';
        }

        fclose($fp);
    } else {
        echo "not readable!";
        exit;
    }
