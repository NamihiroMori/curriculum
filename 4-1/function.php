<?php
require_once("db_connect.php");

// function.php
/**
 * $_SESSION["user_name"]が空だった場合、ログインページにリダイレクトする
 * @return void
 */
function check_user_logged_in()
{
  // セッション開始
  session_start();
  // セッションにuser_nameの値がなければlogin.phpにリダイレクト
  if (empty($_SESSION["user_name"])) {
    header("Location: login.php");
    exit;
  }
}

/**
 * 指定パラメータが空の場合にmain画面にリダイレクトする
 * 
 * @param int $param 任意のパラメータ
 * @return void
 */
function redirect_main_unless_parameter($param)
{
  if (empty($param)) {
    header("Location: main.php");
    exit;
  }
}


/**
 * 指定パラメータが空の場合にmain画面にリダイレクトする
 * 
 * @param int $id postsテーブルのID
 * @return void
 */
function find_post_by_id($id)
{
  // DBから対象記事を取得
  /** @var PDO $pdo */
  $pdo = db_connect();

  try {
    $sql = "SELECT * FROM posts WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
    die();
  }

  if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    return $row;
  } else {
    redirect_main_unless_parameter($id);
  }
}
