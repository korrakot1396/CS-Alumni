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
    header("location: newspage.php");
  }
  if(isset($_SESSION['user_login']))
  {
      $_SESSION['user_login_name'] = $row['username'];
      $username = $row['username'];
      $status = $row['status'];
  }
  if (!isset($_GET['page'])){ //ถ้าไม่มีการส่ง parameter page เข้ามากำหนดไห้ page = 1
    $page = 1;
  } else {
    $page = $_GET['page'];
  }
  $q = "SELECT count(*) FROM classify AS t1
        JOIN news AS t2 ON t1.news_id = t2.id
        JOIN category AS t3 ON t1.cate_id = t3.id
        WHERE cate_id = 1;";
  $run = $db->prepare($q);
  $run->execute();
  $count = $run->fetchColumn();
  $limit = 4;
  $start = ($limit * $page) - $limit ;
  $end = $start + $limit;
  if ($end > $count){
    $end = $count;
  }
  $qu = "SELECT * FROM classify AS t1
        JOIN news AS t2 ON t1.news_id = t2.id
        JOIN category AS t3 ON t1.cate_id = t3.id
        WHERE cate_id = 1 ORDER BY news_id desc";
  $use = $db->prepare($qu);
  $use->execute();
  $all = $use->fetchAll();
  if (($count % $limit)==0){
    $page_total = $count / $limit;
  } else {
    $page_total = (( $count / $limit )+1);
    $page_total = (int) $page_total;
  }
  ?>

<div class="container">
  <header>
    <img class = "size-not-change" src="..\img\test.jpg" alt="">
    <div class = "absolute-position">
    <nav class = "color-nav">
        <ul>
          <li class = "left" ><a class = "font-size hover-bottom-solid" href="#"><i class="set-padding set-margin left fas fa-desktop"></i>CS Alumni</a></li>
          <li class = "right"><a class = "btn-small blue  no-hover" href= "..\login\index.php">SIGN IN</a></li>
          <li class = "right"><a class = "right hover-bottom-solid" href="..\login\checkid.php">Register</a></li>
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
      </div>
      <div id="new1" class="w3-container city solid" style="display:block">
        <?php
        while ($start < $end){
          $result = $all[$start];
          $picture = '..\img\\'.$result['picture'];
          $title = $result['title'];
          $news_id = $result['news_id'];
          echo "<div class='div-img'>
            <a href='notloginnewsdetail.php?news_id=$news_id'><img class = 'news-img-size' src='$picture'><span>'$title'</span></a>
            </div>";
          $start++;
        }
         ?>
      </div>
      <div class = "solid page-bar">
      <?php
        $p = 1;
        $prev_page = $page-1;
        $next_page = $page+1;
        if ($page != 1){
          echo "<a class = 'page-button' href='notloginnewspage.php?page=$prev_page'><<</a>";
        }
      while ($p <= $page_total){
        echo "<a class = 'page-button' href='notloginnewspage.php?page=$p'>$p</a>";
        $p++;
      }
        if ($page != $page_total){
          echo "<a class = 'page-button' href='notloginnewspage.php?page=$next_page'>>></a>";
        }
       ?>
     </div>

    </div>
  
    <footer>
    <div class ="black darken-4 row container" >
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
  </footer></div>
</div>
<hr>
</body>
</html>
