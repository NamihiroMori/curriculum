<?php
//POST送信で送られてきた名前を受け取って変数を作成
$name = $_POST["name"];

//①画像を参考に問題文の選択肢の配列を作成してください。
$choices = [[80, 22, 21, 20], ["PHP", "Python", "JAVA", "HTML"], ["join", "select", "insert", "update"]];

//② ①で作成した、配列から正解の選択肢の変数を作成してください
$correct_answers = [22, "HTML", "select"];

?>
<link rel="stylesheet" href="style.css">
<p>お疲れ様です<?php echo $name; ?>さん</p>
<!--フォームの作成 通信はPOST通信で-->
<form action="answer.php" method="POST">
  <h2>①ネットワークのポート番号は何番？</h2>
  <!--③ 問題のradioボタンを「foreach」を使って作成する-->
  <?php foreach ($choices[0] as $choice) { ?>
  <input type="radio" name="answer1"
    value="<?php echo $choice; ?>"><?php echo $choice; ?>
  <?php } ?>

  <h2>②Webページを作成するための言語は？</h2>
  <!--③ 問題のradioボタンを「foreach」を使って作成する-->
  <?php foreach ($choices[1] as $choice) { ?>
  <input type="radio" name="answer2"
    value="<?php echo $choice; ?>"><?php echo $choice; ?>
  <?php } ?>

  <h2>③MySQLで情報を取得するためのコマンドは？</h2>
  <!--③ 問題のradioボタンを「foreach」を使って作成する-->
  <?php foreach ($choices[2] as $choice) { ?>
  <input type="radio" name="answer3"
    value="<?php echo $choice; ?>"><?php echo $choice; ?>
  <?php } ?>

  <br />
  <!--問題の正解の変数と名前の変数を[answer.php]に送る-->
  <input type="hidden" name="name" value="<?php echo $name; ?>">
  <?php foreach ($correct_answers as $answer) { ?>
  <input type="hidden" name="correct_answers[]"
    value="<?php echo $answer; ?>">
  <?php } ?>

  <input type="submit" value="回答する">
</form>