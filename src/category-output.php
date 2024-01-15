<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/list.css">
    <title>カテゴリ追加画面</title>
</head>
<body>
<?php
const SERVER = 'mysql220.phy.lolipop.lan';
const DBNAME = 'LAA1516806-final';
const USER = 'LAA1516806';
const PASS = 'Pass0914';

$pdo = new PDO('mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8', USER, PASS);

echo '<h1>カテゴリ追加画面</h1>
      <a href="./top.php">HOME</a><hr>';

      if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['category_name'])) { // 修正点
        // カテゴリ名が既に存在するか確認
        $existingCategory = $pdo->prepare('SELECT * FROM category WHERE category_name = ?');
        $existingCategory->execute([$_POST['category_name']]);
        $categoryExists = $existingCategory->fetch();
    
        if ($categoryExists) {
            echo '<p id="message">同じカテゴリ名が既に存在します。追加に失敗しました。</p>';
        } else {
            // カテゴリをデータベースに挿入
            $sql1 = $pdo->prepare('INSERT INTO category (category_id, category_name) VALUES (?, ?)');
            if ($sql1->execute([$_POST['category_id'], $_POST['category_name']])) {
                echo '<p id="message">追加に成功しました</p>';
                echo '<div>';
foreach ($pdo->query('SELECT * FROM category') as $row) {
    echo '<div class="list">
            <p id="c_id">', $row['category_id'], '</p>
            <a id="c_name">楽曲.', $row['category_name'], '</a>   
          </div>';
}
echo '</div>';
            } else {
                echo '<p id="message">追加に失敗しました。</p>';
            }
        }
    }


?>
</body>
</html>