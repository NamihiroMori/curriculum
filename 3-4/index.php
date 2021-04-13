<?php
require_once("getData.php");

// getDataオブジェクト生成
$getData = new getData();

// ユーザー名をフルネームで作成
$userData = $getData->getUserData();
$userName = $userData["last_name"] . $userData["first_name"];

/**
     * カテゴリ文字列の取得
     *
     * @param カテゴリID(postsテーブルのcategory_no)
     * @return カテゴリ文字列(1だったら食事、2だったら旅行、それ以外であればその他)
     */
function getCategoryStr($categoryNo)
{
    switch ($categoryNo) {
    case 1:
      return "食事";
      break;
    case 2:
      return "旅行";
      break;
    default:
      return "その他";
      break;
  }
}

?>

<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <title>新規登録</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header>
    <img src="logo.png">
    <p class="userName">ようこそ <?php echo $userName; ?> さん</p>
    <p class="loginDate">最終ログイン日時：<?php echo $userData["last_login"]; ?>
    </p>
  </header>
  <main>
    <table>
      <thead>
        <tr>
          <th>記事ID</th>
          <th>タイトル</th>
          <th>カテゴリ</th>
          <th>本文</th>
          <th>投稿日</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($getData->getPostData() as $record) { ?>
        <tr>
          <td><?php echo $record["id"]; ?></td>
          <td><?php echo $record["title"]; ?></td>
          <td><?php echo getCategoryStr($record["category_no"]); ?></td>
          <td><?php echo $record["comment"]; ?></td>
          <td><?php echo $record["created"]; ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </main>
  <footer>
    <p>Y&I group.inc</p>
  </footer>
</body>

</html>