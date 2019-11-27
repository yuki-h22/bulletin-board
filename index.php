<?php
var_dump($now_date);
// メッセージを保存するファイルのパス設定
define('FILENAME','./message.text');
date_default_timezone_get('Asia/Tokyo');
$now_date = null;
$data = null;
$file_handle = null;
$split_data = null;
$message = array();
$message_array = array();
$success_message = null;
$error_message = null;

if( !empty($_POST['btn_submit']) ){
  if( $file_handle = fopen( FILENAME, "a")){
    // "a"は追加書き込み、"w"にすると一旦リセットしてから書き込み、"r"は読み込み
    $now_date = date("Y-m-d H:i:s");
    $data = "'".$_POST['view_name']."','".$_POST['message']."','".$_now_date."'\n";
    fwrite($file_handle, $data);
    fclose($file_handle);
  }
}
if($file_handle = fopen(FILENAME,'r')){
  while($data = fgets($file_handle)){
    $split_data = preg_split('/\'/',$data);
    $message = array(
      'view_name' => $split_data[1],
      'message' => $split_data[3],
      'post_date' => $split_data[5]
    );
    array_unshift($message_array,$message);
  }
  fclose($file_handle);
  $success_message = 'メッセージを書き込みました。';
  $miss_message = '書き込みに失敗しました';
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>赤ちゃん掲示板</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="/sass/reset.scss">
<link rel="stylesheet" href="/sass/toppage.scss">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>
<body>
<h1>赤ちゃん掲示板</h1>
<?php if( !empty($success_message)): ?>
  <p class = "success_message"><?php echo $success_message; ?></p>
<?php else: ?>
  <p class = "error_message"><?php echo $success_message; ?></p>
<?php endif; ?>
<form method="post">
  <div>
    <label for="view_name">タイトル</label>
    <input id="view_name" type="text" name="view_name" value="">
  </div>
  <div>
    <label for="message">メッセージ</label>
    <textarea id="message" name="message"></textarea>
  </div>
  <input type="submit" name="btn_submit" value="SEND">
</form>

<hr>
<section>
<?php if(!empty($message_array)): ?>
<?php foreach($message_array as $value): ?>
<article>
  <div class="info">
    <h2><?php echo $value['view_name']; ?></h2>
    <time><?php echo date('Y年m月d日 H:i',strtotime($value['post_date'])); ?></time>
  </div>
  <p><?php echo $value['message']; ?></p>
</article>
<?php endforeach; ?>
<?php endif; ?>
</section>
</body>
</html>