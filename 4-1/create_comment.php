<?php
require_once("db_connect.php");
require_once("function.php");

// ログインチェック
check_user_logged_in();

// POSTの場合、コメントをDBに登録
if (isset($_POST["post"])) {
  $post_id = $_POST["post_id"];

  if (empty($_POST["name"])) {
    echo "名前が未入力です。";
  }

  if (empty($_POST["content"])) {
    echo "コメントが未入力です。";
  }

  if (!empty($_POST["name"]) && !empty($_POST["content"])) {
    $name = $_POST["name"];
    $content = $_POST["content"];

    // DBにPOSTされた記事を登録
    /** @var PDO $pdo */
    $pdo = db_connect();

    try {
      $sql = "INSERT INTO comments (post_id, name, content) VALUES (:post_id, :name, :content)";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(":post_id", $post_id);
      $stmt->bindParam(":name", $name);
      $stmt->bindParam(":content", $content);
      $stmt->execute();

      // detail_post.phpへリダイレクト
      header("Location: detail_post.php?id=$post_id");
    } catch (PDOException $e) {
      echo $e->getMessage();
      die();
    }
  }
} else {
  // GETの場合の処理：post_idが空の場合はmain.phpにリダイレクト
  $post_id = $_GET["post_id"];
  redirect_main_unless_parameter($post_id);
}
?>


<!doctype html>
<html lang="ja">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>コメント登録</title>
</head>

<body>
  <h2>コメント登録</h2>
  <form method="post" action="">
    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
    投稿者名:<br/><input type="text" name="name">
    <br/>
    コメント:<br/><input type="text" name="content" style="width: 200px; height: 50px;">
    <br />
    <input type="submit" value="submit" name="post">
  </form>
  <a href="detail_post.php?id=<?php echo $post_id; ?>">詳細画面に戻る</a>
</body>

</html>