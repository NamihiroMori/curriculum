<?php
require_once("db_connect.php");
require_once("function.php");

// ログインチェック
check_user_logged_in();

// POSTされた場合に処理する
if (isset($_POST["post"])) {

  // titleとcontentのいずれかが空の場合はエラー
  if (empty($_POST["title"])) {
    echo "タイトルが未入力です。<br/>";
  }
  if (empty($_POST["date"])) {
    echo "発売日が未入力です。<br/>";
  }
  if ($_POST["stock"] < 0) {
    echo "在庫数が未入力です。<br/>";
  }

  if (!empty($_POST["title"]) && !empty($_POST["date"]) && $_POST["stock"] >= 0) {

    $title = $_POST["title"];
    $date = $_POST["date"];
    $stock = $_POST["stock"];

    // DBにPOSTされた記事を登録
    /** @var PDO $pdo */
    $pdo = db_connect();

    try {
      $sql = "INSERT INTO books (title, date, stock) VALUES (:title, :date, :stock)";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(":title", $title);
      $stmt->bindParam(":date", $date);
      $stmt->bindParam(":stock", $stock);
      $stmt->execute();

      // main.phpへリダイレクト
      header("Location: main.php");
      exit;
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
  <title>本登録</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body class="mx-auto my-3" style="width: 400px;">
  <h1>本 登録画面</h1>
  <form method="post" action="" class="mb-5">
    <input type="text" class="form-control mb-3" name="title" placeholder="タイトル">
    <input type="date" class="form-control mb-3" name="date" placeholder="発売日">

    <label>在庫数</label>
    <input type="number" class="form-control mb-3" name="stock" min="0" placeholder="選択してください">

    <input type="submit" class="btn btn-primary btn-lg" value="登録" name="post">
  </form>
  <a class="btn btn-secondary btn-sm" href="main.php">メイン画面に戻る</a>
</body>

</html>