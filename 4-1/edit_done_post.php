<?php
require_once("db_connect.php");
require_once("function.php");

// ログインチェック
check_user_logged_in();

if (isset($_POST["edit"])) {

  $id = $_POST["id"];
  $title = $_POST["title"];
  $content = $_POST["content"];

  // POSTデータが空の場合は編集画面にリダイレクト
  if (empty($title) || empty($content)) {
    header("Location: edit_post.php?id={$id}");
    exit;
  }

  if (!empty($title) && !empty($content)) {
    // DBから対象記事を取得
    /** @var PDO $pdo */
    $pdo = db_connect();

    try {
      $sql = "UPDATE posts SET title = :title, content = :content WHERE id = :id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(":id", $id);
      $stmt->bindParam(":title", $title);
      $stmt->bindParam(":content", $content);
      $stmt->execute();

    } catch (PDOException $e) {
      echo $e->getMessage();
      die();
    }
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>編集完了</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
  <h1>編集完了</h1>
  <p>ID: <?php echo $id; ?>を編集しました。</p>
  <a href="main.php">ホームへ戻る</a>
</body>

</html>