<?php
// セッション開始
session_start();
// セッション変数のクリア
$_SESSION = array();
// セッションクリア
session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>ログアウト</title>
</head>

<body>
  <h1>ログアウト画面</h1>
  <p>ログアウトしました</p>
  <a href="login.php">ログイン画面に戻る</a>
</body>

</html>