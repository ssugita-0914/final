<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/list.css">
    <title>音楽登録画面</title>
</head>
<body>
<?php
const SERVER = 'mysql220.phy.lolipop.lan';
const DBNAME = 'LAA1516806-final';
const USER = 'LAA1516806';
const PASS = 'Pass0914';

$pdo = new PDO('mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8', USER, PASS);

echo '<h1>音楽登録画面</h1>
      <a href="./top.php">HOME</a><hr>';
echo '<form action="insert-output.php" method="post">
        音楽名<input type="text" name="music_name">
        楽曲名<input type="text" name="singer_name">
        画像パス<input type="text" name="img_path">
        カテゴリ<select name="category_id">';
        

// カテゴリテーブルからカテゴリ名を取得
foreach ($pdo->query('SELECT * FROM category') as $row) {
    echo '<option value="' . $row['category_id'] . '">' . $row['category_name'] . '</option>';
}

echo '</select>
音楽パス<input type="text" name="mp3">
        <input type="submit" value="登録">
      </form>';
?>
</body>
</html>