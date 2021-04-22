<?php
require_once("db_connect.php");

// POSTされた場合に処理
if (isset($_POST["signup"])) {
  if (empty($_POST["name"])) {
    echo "ユーザー名が未入力です。<br/>";
  }
  if (empty($_POST["password"])) {
    echo "パスワードが未入力です。";
  }

  // ユーザー名とパスワードが空白でない場合に処理
  if (!empty($_POST["name"]) && !empty($_POST["password"])) {
    $name = $_POST["name"];
    $password = $_POST["password"];

    /** @var PDO $pdo */
    $pdo = db_connect();

    // ユーザー名が重複していたら除外
    try {
      $sql = "SELECT * FROM users WHERE name = :name";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(":name", $name);
      $stmt->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
      die();
    }

    if ($stmt->fetch(PDO::FETCH_ASSOC)) {
      echo "そのユーザー名は既に登録済みです";
    } else {
      // DBへの登録処理
      try {
        $sql = "INSERT INTO users (name, password) VALUES (:name, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":name", $name);
        $password_hash = password_hash($password, PASSWORD_DEFAULT); // ハッシュ化パスワード
        $stmt->bindParam(":password", $password_hash);

        // 登録実行
        $stmt->execute();

        header("Location: login.php");
        exit;
      } catch (PDOException $e) {
        echo $e->getMessage();
        die();
      }
    }
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>ユーザー登録画面</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body class="mx-auto my-3" style="width: 400px;">
  <h1>ユーザー登録画面</h1>
  <form method="POST" action="" class="mb-5">
    <input type="text" class="form-control my-3" name="name" id="name" placeholder="ユーザー名">
    <input type="password" class="form-control mb-3" name="password" id="password" placeholder="パスワード">
    <input type="submit" class="btn btn-primary btn-lg" value="新規登録" id="signup" name="signup">
  </form>
  <a class="btn btn-secondary btn-sm" href="login.php">ログイン画面へ</a>
</body>

</html>