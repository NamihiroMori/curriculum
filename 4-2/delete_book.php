<?php
require_once("db_connect.php");
require_once("function.php");

// ログインチェック
check_user_logged_in();

// GETのidが空の場合はmain.phpにリダイレクト
$id = $_GET["id"];
redirect_main_unless_parameter($id);

// DBから対象記事を取得
/** @var PDO $pdo */
$pdo = db_connect();

try {
  $sql = "DELETE FROM books WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(":id", $id);
  $stmt->execute();

  // main.phpにリダイレクト
  header("Location: main.php");
  exit;
} catch (PDOException $e) {
  echo $e->getMessage();
  die();
}
