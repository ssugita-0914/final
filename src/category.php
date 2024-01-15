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

// カテゴリIDの取得
$stmt = $pdo->prepare('SELECT MAX(category_id) AS max_id FROM category');
$stmt->execute();
$maxCategoryId = $stmt->fetch(PDO::FETCH_ASSOC)['max_id'];
$newCategoryId = $maxCategoryId + 1;

echo '<h1>カテゴリ追加画面</h1>
      <a href="./top.php">HOME</a><hr>';
      echo '<form action="category-output.php" method="post">
      カテゴリID（自動入力）<input type="text" name="category_id" value="' . $newCategoryId . '" readonly>
      カテゴリ名<input type="text" name="category_name"> <!-- 修正点 -->
      <input type="submit" value="登録">
  </form>';

// フォームが送信されたときの処理
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // カテゴリ名が入力されているか確認
    if (isset($_POST['name']) && !empty($_POST['name'])) {
        // カテゴリをデータベースに挿入
        $categoryName = $_POST['name'];
        $stmt = $pdo->prepare('INSERT INTO category (category_id, category_name) VALUES (?, ?)');
        $stmt->execute([$newCategoryId, $categoryName]);
        echo 'カテゴリが追加されました。';
    } else {
        echo 'カテゴリ名が入力されていません。';
    }
}
?>
</body>
</html>