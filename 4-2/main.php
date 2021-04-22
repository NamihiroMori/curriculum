<?php
require_once("db_connect.php");
require_once("function.php");

// ログインチェック
check_user_logged_in();

// DBからpostsテーブルを新しい順に取得
/** @var PDO $pdo */
$pdo = db_connect();

try {
  $sql = "SELECT * from books ORDER BY date";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
} catch (PDOException $e) {
  echo $e->getMessage();
  die();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>メイン</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body class="mx-auto my-3" style="width: 800px;">
  <h1>在庫一覧画面</h1>
  <div class="d-flex my-3">
    <a class="btn btn-primary me-3" href="create_book.php">新規登録</a>
    <a class="btn btn-secondary" href="logout.php">ログアウト</a>
  </div>

  <table class="table table-bordered align-middle text-center">
    <thead>
      <tr class="table-secondary">
        <th>タイトル</th>
        <th>発売日</th>
        <th>在庫数</th>
        <th></th>
      </tr>
    </thead>

    <tbody>
      <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr>
          <td><?php echo $row["title"]; ?></td>
          <td><?php echo $row["date"]; ?></td>
          <td><?php echo $row["stock"]; ?></td>
          <td><a class="btn btn-danger" href="delete_book.php?id=<?php echo $row["id"]; ?>">削除</a></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</body>

</html>