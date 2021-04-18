<?php
require_once("db_connect.php");
require_once("function.php");

// ログインチェック
check_user_logged_in();

// GETのidが空の場合はmain.phpにリダイレクト
$id = $_GET["id"];
redirect_main_unless_parameter($id);

// DBから対象記事を取得
$row = find_post_by_id($id);
$id = $row["id"];
$title = $row["title"];
$content = $row["content"];


// DBからコメントを取得
/** @var PDO $pdo */
$pdo = db_connect();
try {
  $sql = "SELECT * FROM comments WHERE post_id = :post_id ORDER BY time DESC";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(":post_id", $id);
  $stmt->execute();
} catch (PDOException $e) {
  echo $e->getMessage();
  die();
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>記事詳細</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
  <table>
    <tr>
      <td>ID</td>
      <td><?php echo $id; ?></td>
    </tr>
    <tr>
      <td>タイトル</td>
      <td><?php echo $title; ?></td>
    </tr>
    <tr>
      <td>本文</td>
      <td><?php echo $content; ?></td>
    </tr>
  </table>

  <a href="create_comment.php?post_id=<?php echo $id; ?>">この記事にコメントする</a><br />
  <a href="main.php">メインページに戻る</a>

  <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
    <hr>
    <p><?php echo $row["name"]; ?></p>
    <p><?php echo $row["content"]; ?></p>
  <?php } ?>

</body>

</html>