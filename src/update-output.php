<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/list.css">
    <title>音楽更新画面</title>
</head>
<body>
<?php
const SERVER = 'mysql220.phy.lolipop.lan';
const DBNAME = 'LAA1516806-final';
const USER = 'LAA1516806';
const PASS = 'Pass0914';

$pdo = new PDO('mysql:host=mysql220.phy.lolipop.lan;dbname=LAA1516806-final;charset=utf8', 'LAA1516806', 'Pass0914');
echo '<h1>音楽登録画面</h1>
<a href="./top.php">HOME</a><hr>';

// フォームからのリクエストによって処理を分岐
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // POST リクエストの場合は追加または更新を行う

    // フォームから受け取ったデータ
    $musicName = $_POST['music_name'];
    $singerName = $_POST['singer_name'];
    $imgPath = $_POST['img_path'];
    $categoryId = $_POST['category_id'];

    // music_id が渡された場合は更新、そうでない場合は新規追加
    if (isset($_POST['music_id'])) {
        // 更新の場合
        $musicId = $_POST['music_id'];
        $sql = $pdo->prepare('UPDATE music SET music_name=?, singer_name=?, img=?, category_id=? WHERE id=?');
        $sql->execute([$musicName, $singerName, $imgPath, $categoryId, $musicId]);
        echo '<p id="message">更新に成功しました</p>';
    }
}

// 画面表示
echo '<div>';
foreach ($pdo->query('SELECT music.*, category.category_name FROM music
LEFT JOIN category ON music.category_id = category.category_id') as $row) {
    echo '<div class="list">
            <img id="img" src="../img/', $row['img'], '">
            <p id="mname">', $row['music_name'], '</p>
            <a id="sname">楽曲.', $row['singer_name'], '</a>   
            <p id="category">カテゴリ: ', $row['category_name'], '</p>
          </div>
          </div>';
}
?>
</body>
</html>