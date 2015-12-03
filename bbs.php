<!-- //POST送信が行われたら、下記の処理を実行 -->
<?php

// if(null!==($_POST['nickname'||'comment']))
// if(isset($_POST['nickname'&&'commnet'])){
if(isset($_POST['nickname']) && isset($_POST['comment']))
{


//データベースに接続
    $dsn = 'mysql:dbname=oneline_bbs;host=localhost';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->query('SET NAMES utf8');

//SQL文作成
    $nickname=$_POST['nickname'];
    $comment=$_POST['comment'];

    $sql = 'INSERT INTO `oneline_bbs`.`posts`(`nickname`, `comment`, `created`) VALUES("'.$nickname.'","'.$comment.'",now())';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

//Insert文実行


     $sql = 'SELECT * FROM `posts` WHERE 1';
     $stmt = $dbh->prepare($sql);
     $stmt->execute();

     while(1)
    {
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);
      if($rec==false)
      {
        break;
      }
      //'' ""　どちらでも可能&nbspは空白を表示
      echo $rec['nickname'];
      echo '<br/>';
      echo $rec['comment'];
      echo '<br/>';
      echo $rec['created'];
      echo '<br/>';

    }


//データベースから切断
    $dbh = null;


}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>セブ掲示版</title>

</head>
<body>
    <form action="bbs.php" method="post">
      <input type="text" name="nickname" placeholder="nickname" required>
      <textarea type="text" name="comment" placeholder="comment" required></textarea>
      <button type="submit" >つぶやく</button>
    </form>

<!--     <h2><a href="#">nickname KOU</a> <span>2015-12-02 10:10:20</span></h2>
    <p>つぶやきコメント</p>

    <h2><a href="#">nickname Kou</a> <span>2015-12-02 10:10:10</span></h2>
    <p>つぶやきコメント2</p> -->
</body>
</html>


