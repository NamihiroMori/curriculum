<?php
require_once("db_connect.php");

// POSTされた場合に処理
if (isset($_POST["signUp"])) {
  $name = $_POST["name"];
  $password = $_POST["password"];

  // ユーザー名とパスワードが空白でない場合に処理
  if (!empty($name) && !empty($password)) {

    // DBへの登録処理
    try {
      /** @var PDO $pdo */
      $pdo = db_connect();
      $sql = "INSERT INTO users (name, password) VALUES (:name, :password)";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(":name", $name);
      $password_hash = password_hash($password, PASSWORD_DEFAULT); // ハッシュ化パスワード
      $stmt->bindParam(":password", $password_hash);

      // 登録実行
      $stmt->execute();
      echo "登録処理が完了しました。";
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title></title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
  <h1>新規登録</h1>
  <form method="POST" action="">
    user:<br>
    <input type="text" name="name" id="name">
    <br>
    password:<br>
    <input type="password" name="password" id="password"><br>
    <input type="submit" value="submit" id="signUp" name="signUp">
  </form>
</body>

</html>