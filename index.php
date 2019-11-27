<?php
var_dump($now_date);
// メッセージを保存するファイルのパス設定
define('FILENAME','./message.text');
date_default_timezone_set('Asia/Tokyo');
if( !empty($_POST['btn_submit']) ){
  if( $file_handle = fopen( FILENAME, "a")){
    // "a"は追加書き込み、"w"にすると一旦リセットしてから書き込み、"r"は読み込み
    $now_date = date("Y-m-d H:i:s");
    $data = "'".$_POST['view_name']."','".$_POST['message']."','".$_now_date."'\n";
    fwrite($file_handle, $data);
    fclose($file_handle);
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>ご依頼掲示板</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="/sass/reset.scss">
<link rel="stylesheet" href="/sass/toppage.scss">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>
<body>
<h1>ご依頼掲示板</h1>
<form method="post">
  <div>
    <label for="view_name">タイトル</label>
    <input id="view_name" type="text" name="view_name" value="">
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