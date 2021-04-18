<?php
require_once("db_connect.php");
require_once("function.php");

// ログインチェック
check_user_logged_in();

// POSTされた場合に処理する
if (isset($_POST["post"])) {

  // titleとcontentのいずれかが空の場合はエラー
  if (empty($_POST["title"])){
    echo "タイトルが未入力です。<br/>";
  }
  if (empty($_POST["content"])) {
    echo "コンテンツが未入力です。<br/>";
  }

  if (!empty($_POST["title"]) && !empty($_POST["content"])) {

    $title = $_POST["title"];
    $content = $_POST["content"];

    // DBにPOSTされた記事を登録
    /** @var PDO $pdo */
    $pdo = db_connect();

    try {
      $sql = "INSERT INTO posts (title, content) VALUES (:title, :content)";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(":title", $title);
      $stmt->bindParam(":content", $content);
      $stmt->execute();

      // main.phpへリダイレクト
      header("Location: main.php");
    } catch (PDOException $e) {
      echo $e->getMessage();
      die();
    }
  }
}


?>


<!doctype html>
<html lang="ja">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>記事登録</title>
</head>

<body>
  <h2>記事登録</h2>
  <form method="post" action="">
    title:<br /><textarea name="title" rows="2"></textarea>
    <br />
    content:<br /><textarea name="content" rows="10"></textarea>
    <br />
    <input type="submit" value="submit" name="post">
  </form>
  <a href="main.php">メイン画面に戻る</a>
</body>

</html>