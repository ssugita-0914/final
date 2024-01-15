<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/list.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha256-Gn5384xq9R95NZ1FIqzA7EVrAAKPhK9IvBX3ILC9RA=" crossorigin="anonymous">
    <title>音楽更新画面</title>
</head>
<body>
<?php
const SERVER = 'mysql220.phy.lolipop.lan';
const DBNAME = 'LAA1516806-final';
const USER = 'LAA1516806';
const PASS = 'Pass0914';

$pdo = new PDO('mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8', USER, PASS);

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {
    $music_id = $_GET['id'];

    // Fetch music data based on the provided ID
    $stmt = $pdo->prepare('SELECT music.*, category.category_name FROM music
                          INNER JOIN category ON music.category_id = category.category_id
                          WHERE music.id = ?');
    $stmt->execute([$music_id]);
    $musicData = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fetch all categories for the select box
    $categories = $pdo->query('SELECT * FROM category')->fetchAll(PDO::FETCH_ASSOC);

    if ($musicData) {
        // Display the form with the fetched data
        echo '<h1>音楽更新</h1>
              <a href="./top.php">HOME</a><hr>';
        echo '<form action="update-output.php" method="post">
                <input type="hidden" name="music_id" value="' . $music_id . '">
                <label for="music_name">音楽名</label>
                <input type="text" name="music_name" value="' . $musicData['music_name'] . '">
                <label for="singer_name">楽曲名</label>
                <input type="text" name="singer_name" value="' . $musicData['singer_name'] . '">
                <label for="img_path">画像パス</label>
                <input type="text" name="img_path" value="' . $musicData['img'] . '">
                <label for="category_id">カテゴリ</label>
                <select name="category_id">';
                
        // Loop through categories to populate the select box
        foreach ($categories as $category) {
            $selected = ($category['category_id'] == $musicData['category_id']) ? 'selected' : '';
            echo '<option value="' . $category['category_id'] . '" ' . $selected . '>' . $category['category_name'] . '</option>';
        }

        echo '</select>
                <input type="submit" value="更新">
              </form>';
    } else {
        echo '指定されたIDの音楽データが見つかりません。';
    }
} else {
    echo '不正なアクセスです。';
}
?>
</body>
</html>