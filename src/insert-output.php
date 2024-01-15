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

 $connect = 'mysql:host=mysql220.phy.lolipop.lan'. SERVER . ';dbname=LAA1516806-final'. DBNAME . ';charset=utf8';
 $pdo=new PDO('mysql:host=mysql220.phy.lolipop.lan;dbname=LAA1516806-final;charset=utf8','LAA1516806','Pass0914');
 echo '<h1>音楽登録画面</h1>
 <a href="./top.php">HOME</a><hr>';
$sql=$pdo->prepare('insert into music values(null,?,?,?,?)');
if($sql->execute([$_REQUEST['music_name'],$_REQUEST['singer_name'],$_REQUEST['img_path'],$_REQUEST['category_id']])){
    echo '<p id="message>"追加に成功しました</p>';
    echo '<div>';
 foreach($pdo->query('SELECT music.*, category.category_name FROM music
 LEFT JOIN category ON music.category_id = category.category_id') as $row){
    echo '<div class="list">
    <img id="img"src="../img/', $row['img'], '">
    <p id="mname">',$row['music_name'], '</p>
    <a id="sname">楽曲.', $row['singer_name'], '</a>   
    <p id="category">カテゴリ: ', $row['category_name'], '</p>
    </div>
 </div>';
}

}else{
    '<p id="message>追加に失敗しました。</p>';
}
?>
</body>
</html>