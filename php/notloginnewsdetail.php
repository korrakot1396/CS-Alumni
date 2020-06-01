<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link href="../css/cssfile.css" rel="stylesheet">
      <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
      <script src="https://kit.fontawesome.com/f818570924.js"></script>
      <script src="../js/javas.js"></script>
      <link href="https://fonts.googleapis.com/css?family=Mitr|Nunito&display=swap"
          rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
            rel="stylesheet">
      <title>Document</title>
</head>
<body>
<?php

require_once '../login/connection.php';

session_start();

if(isset($_SESSION['user_login']))
{
  header("location: newsdetail.php");
}

if(!isset($_GET['news_id'])){
  header("location: ../index.php");
}
$news_id = $_GET['news_id'];
$qu = "SELECT * FROM classify AS t1
      JOIN news AS t2 ON t1.news_id = t2.id
      JOIN category AS t3 ON t1.cate_id = t3.id
      WHERE news_id = :id;";
$use = $db->prepare($qu);
$use->execute(array('id' => $news_id));
$result = $use->fetch();
$title = $result['title'];
$picture = '..\img\\'.$result['picture'];
$content = $result['content'];
$date = $result['date'];
?>
<div class="container">
  <header>
    <div class = "absolute-position">
    <nav class = "color-nav">
        <ul>
          <li class = "left" ><a class = "font-size hover-bottom-solid" href="..\index.php"><i class="set-padding set-margin left fas fa-desktop"></i>CS Alumni</a></li>
          <li class = "right"><a class = "btn-small blue  no-hover" href= "..\login\index.php">SIGN IN</a></li>
          <li class = "right"><a class = "right hover-bottom-solid" href="..\login\register.php">Register</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <div class="content-container" style="margin-top:25px;">
    <h3 class = "title"><?= $title ?></h3><br>
    <div class="news-detail-picture">
      <?php
      echo "<img class = 'img-ab' src='$picture'>";
       ?>
    </div>
    <div class="news-content">
          <?= $content ?>
    </div>
    <div class="" style="float:right;">
          <?= $date  ?>
    </div>
  </div>
</div>
<hr>
</body>
</html>
