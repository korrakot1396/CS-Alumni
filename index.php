<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link href="css/cssfile.css" rel="stylesheet">
      <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
      <script src="https://kit.fontawesome.com/f818570924.js"></script>
      <script src="js/javas.js"></script>
      <link href="https://fonts.googleapis.com/css?family=Mitr|Nunito&display=swap"
          rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
      <title>CS Alumni</title>
</head>
<body>
  <?php
  require_once 'login/connection.php';

  session_start();
  if(isset($_SESSION["user_login"])) //ถ้า user login ค้างไว้จะเด้งไปที่หน้า afterlogin.php
  {
  	header("location: php/indexafterlogin.php");
  }
  $q = "SELECT COUNT(*) FROM classify WHERE cate_id = 1;";
  $run = $db->prepare($q);
  $run->execute();
  $count = $run->fetchColumn();
  $limit = 4;
  $qu = "SELECT * FROM classify AS t1
         JOIN news AS t2 ON t1.news_id = t2.id
         JOIN category AS t3 ON t1.cate_id = t3.id
         WHERE cate_id = 1 ORDER BY news_id desc";
  $use = $db->prepare($qu);
  $q1 = "SELECT COUNT(*) FROM classify WHERE cate_id = 2;";
  $run1 = $db->prepare($q1);
  $run1->execute();
  $count1 = $run1->fetchColumn();
  $qu1 = "SELECT * FROM classify AS t1
         JOIN news AS t2 ON t1.news_id = t2.id
         JOIN category AS t3 ON t1.cate_id = t3.id
         WHERE cate_id = 2 ORDER BY news_id desc";
  $use1 = $db->prepare($qu1);
  $q2 = "SELECT COUNT(*) FROM classify WHERE cate_id = 3;";
  $run2 = $db->prepare($q2);
  $run2->execute();
  $count2 = $run2->fetchColumn();
  $qu2 = "SELECT * FROM classify AS t1
         JOIN news AS t2 ON t1.news_id = t2.id
         JOIN category AS t3 ON t1.cate_id = t3.id
         WHERE cate_id = 3 ORDER BY news_id desc";
  $use2 = $db->prepare($qu2);
   ?>
<div class="container">
  <header>
    <img class = "size-not-change"src="img\test.jpg" alt="">
    <div class = "absolute-position">
    <nav class = "color-nav">
        <ul>
          <li class = "left" ><a class = "font-size hover-bottom-solid" href="index.php"><i class="set-padding set-margin left fas fa-desktop"></i>CS Alumni</a></li>
          <li class = "right"><a class = "btn-small blue  no-hover" href= "login\index.php">SIGN IN</a></li>
          <li class = "right"><a class = "right hover-bottom-solid" href="login\checkid.php">Register</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <div class="content-container">
    <div class="">
      <div class="w3-row">
        <a href="javascript:void(0)" onclick="openCity(event, 'new1');">
          <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding  w3-border-blue"><h3>ข่าวสารทั่วไป</h3></div>
        </a>
        <a href="javascript:void(0)" onclick="openCity(event, 'new2');">
          <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding"><h3>ข่าวสารกีฬา</h3></div>
        </a>
        <a href="javascript:void(0)" onclick="openCity(event, 'new3');">
          <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding"><h3>ประชาสัมพันธ์</h3></div>
        </a>
      </div>
      <div id="new1" class="w3-container city solid" style="display:block">
        <?php
        $start = 1;
        $end = 4;
        if ($count < 4){
          $end = $count;
        }
        while ($start <= $end){
          $use->execute();
          $all = $use->fetchAll();
          $result = $all[$start-1];
          $new_id = $result['news_id'];
          $picture = 'img\\'.$result['picture'];
          $title = $result['title'];
          echo "<div class='div-img'>
            <a href='php\\notloginnewsdetail.php?news_id=$new_id'><img class = 'news-img-size' src='$picture'><span>'$title'</span></a>
            </div>";
          $start++;
        }
         ?>
      </div>

      <div id="new2" class="w3-container city" style="display:none">
        <?php
        $start = 1;
        $end = 4;
        if ($count1 < 4){
          $end = $count1;
        }
        while ($start <= $end){
          $use1->execute();
          $all = $use1->fetchAll();
          $result = $all[$start-1];
          $new_id = $result['news_id'];
          $picture = 'img\\'.$result['picture'];
          $title = $result['title'];
          echo "<div class='div-img'>
            <a href='php\\notloginnewsdetail.php?news_id=$new_id'><img class = 'news-img-size' src='$picture'><span>'$title'</span></a>
            </div>";
          $start++;
        }
         ?>
      </div>

      <div id="new3" class="w3-container city" style="display:none">
        <?php
        $start = 1;
        $end = 4;
        if ($count2 < 4){
          $end = $count2;
        }
        while ($start <= $end){
          $use2->execute();
          $all = $use2->fetchAll();
          $result = $all[$start-1];
          $new_id = $result['news_id'];
          $picture = 'img\\'.$result['picture'];
          $title = $result['title'];
          echo "<div class='div-img'>
            <a href='php\\notloginnewsdetail.php?news_id=$new_id'><img class = 'news-img-size' src='$picture'><span>'$title'</span></a>
            </div>";
          $start++;
        }
         ?>
      </div>
    </div>
    <div class="">
      <a class = "btn-small blue right" href="php/notloginnewspage.php" style="margin-top: 20px;">ดูทั้งหมด</a>
    </div>
 
  <footer>
    <div class ="black darken-4 row container" style="float:left;">
    <div class="col s4 center-align"><a href ="https://www.facebook.com/comsci.ku/"><i class='fab fa-facebook-square  top-footer' style='font-size:60px;color:white'></i></a><br>
                <p class =" white-text text-darken-2 " >ภาควิชาวิทยาการคอมพิวเตอร์ เกษตรศาสตร์ </p>
  </div>
    <div class="col s4 center-align"><i class='far fa-envelope  top-footer' style='font-size:60px;color:white '></i><br>
                <p class =" center-align white-text text-darken-2 " >admin@cs.sci.ku.ac.th</p>
  </div>
    <div class="col s4 center-align"><i class='fas fa-phone top-footer'  style='font-size:60px;color:white'></i><br>
                <p class ="center-align white-text text-darken-2 " >02-562-5444, 02-562-5555 ต่อ 3721-3737</p>
  
  </div>
  <div class="col s12 center-align top-footer white-text text-darken-2">ที่อยู่: ภาควิชาวิทยาการคอมพิวเตอร์ มหาวิทยาลัยเกษตรศาสตร์
           เลขที่ 50 ถนนพหลโยธิน แขวงลาดยาว เขตจตุจักร
           กรุงเทพมหานคร 10900</div>  
    </div>
  </footer>
</div> </div>
<hr>
</body>
</html>
