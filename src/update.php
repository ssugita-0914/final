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

 $pdo = new PDO('mysql:host=mysql220.phy.lolipop.lan;dbname=LAA1516806-final;charset=utf8','LAA1516806','Pass0914');
 echo '<h1>音楽更新</h1>
 <a href="./top.php">HOME</a><hr>';
 echo '<div>';
 foreach($pdo->query('SELECT music.*, category.category_name FROM music
 LEFT JOIN category ON music.category_id = category.category_id') as $row){
    $music_id = $row['id'];
    echo '<div class="list">
    <img id="img" src="../img/', $row['img'], '">
    <form action="update-input.php" method="get">
      <input type="hidden" name="id" value="' . $music_id . '">
      <p id="mname">', $row['music_name'], ' <button type="submit" class="btn-flat-logo">
      <i class="fa fa-chevron-right"></i> 更新
    </button></p>
            <a id="sname">楽曲.', $row['singer_name'], '</a>
            <p id="category">カテゴリ: ', $row['category_name'], '</p>
      </form>
    </div>';
}
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