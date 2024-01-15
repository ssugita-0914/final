<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/list.css">
    <title>音楽削除画面</title>
</head>
<body>
<h1>音楽削除</h1>
<a href="./top.php">HOME</a><hr>
<div>
<?php
const SERVER = 'mysql220.phy.lolipop.lan';
const DBNAME = 'LAA1516806-final';
const USER = 'LAA1516806';
const PASS = 'Pass0914';

try {
    $pdo = new PDO('mysql:host=mysql220.phy.lolipop.lan;dbname=LAA1516806-final;charset=utf8', 'LAA1516806', 'Pass0914');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // フォームが送信された場合の削除ロジック
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $musicIdToDelete = $_POST['id'];

        $deleteStatement = $pdo->prepare('DELETE FROM music WHERE id = ?');
        $deleteStatement->execute([$musicIdToDelete]);

        echo '<p id="message">削除しました</p>';
    }

    echo '<div>';
    foreach ($pdo->query('SELECT music.*, category.category_name FROM music
    LEFT JOIN category ON music.category_id = category.category_id') as $row) {
        echo '<div class="list">
        <img id="img" src="../img/', $row['img'], '">
        <form id="deleteForm" action="delete-output.php" method="post" onsubmit="return confirmDelete();">
          <input type="hidden" name="id" value="' . $row['id'] . '">
          <p id="mname">', $row['music_name'], ' </p>
                <a id="sname">楽曲.', $row['singer_name'], '</a>
                <p id="category">カテゴリ: ', $row['category_name'], '</p>
          </form>
        </div>';
    }
    echo '</div>';
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
<script>
    function confirmDelete() {
        return confirm("本当に削除しますか？");
    }
</script>
</body>
</html>