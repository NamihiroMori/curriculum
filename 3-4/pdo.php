<?php

function connect()
{
    // DBサーバのURL
    $db['host'] = "localhost";
    // データベース名
    $db['dbname'] = "checktest4";
    // ユーザー名
    $db['user'] = "root";
    // ユーザー名のパスワード
    $db['pass'] = "root";
  
    // DBに接続
    try {
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);
        return new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
