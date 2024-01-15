<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/list.css">
    <title>音楽一覧</title>
</head>
<body>
<?php
const SERVER = 'mysql220.phy.lolipop.lan';
const DBNAME = 'LAA1516806-final';
const USER = 'LAA1516806';
const PASS = 'Pass0914';

$pdo = new PDO('mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8', USER, PASS);

echo '<h1>音楽一覧</h1>
      <a href="./top.php">HOME</a>
      <hr>';
echo '<div>';
foreach ($pdo->query('SELECT music.*, category.category_name FROM music
                    LEFT JOIN category ON music.category_id = category.category_id') as $row) {
    echo '<div class="list">
            <img id="img" src="../img/', $row['img'], '">
            <p id="mname">', $row['music_name'], '</p>
            <a id="sname">楽曲.', $row['singer_name'], '</a>
            <p id="category">カテゴリ: ', $row['category_name'], '</p>
          </div>';
}
echo '</div>';
?>
<button id="page-top" class="page-top"></button>
<script>
    const pagetopBtn = document.querySelector('#page-top');
    pagetopBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });
</script>
</body>
</html>