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

?>


<!doctype html>
<html lang="ja">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>記事編集</title>
</head>

<body>
  <h2>記事編集</h2>
  <form method="POST" action="edit_done_post.php">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    title:<br>
    <input type="text" name="title" id="title" style="width:200px;height:50px;" value=<?php echo $title; ?>>
    <br>
    content:<br>
    <input type="text" name="content" id="content" style="width:200px;height:100px;" value=<?php echo $content; ?>><br>
    <input type="submit" value="submit" id="edit" name="edit">
  </form>
  <a href="main.php">メイン画面に戻る</a>
</body>

</html>