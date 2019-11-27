<?php
if( !enpty($_POST['btn_submit']) ){
  var_dump($_POST);
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>ご依頼掲示板</title>
</head>
<body>
<h1>ご依頼掲示板</h1>
<form method="post">
  <div>
    <label for="view_name">タイトル</label>
    <input id="view_name" type="text" name="view_name" value="依頼内容の概要">
  </div>
  <div>
    <label for="message">依頼内容</label>
    <textarea id="message" name="message" value="依頼内容を簡潔に記入。期限をつけると返信率が上がります。"></textarea>
  </div>
  <input type="submit" name="btn_submit" value="SEND">
</form>

<hr>
<section>
<!-- ここに投稿されたメッセージを表示 -->
</section>
</body>
</html>