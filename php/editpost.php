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
      <title>CS Alumni</title>
</head>
<body>
  <?php

require_once '../login/connection.php';

session_start();

if(!isset($_SESSION['user_login']))
{
  header("location: ../index.php");
}

$id = $_SESSION['user_login'];
$select_stmt = $db->prepare("SELECT * FROM user WHERE id=:uid");
$select_stmt->execute(array(":uid"=>$id));

$row=$select_stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_SESSION['user_login']))
{
    $_SESSION['user_login_name'] = $row['username'];
    $username = $row['username'];
    $status = $row['status'];
}
$qu = "SELECT COUNT(*) FROM classify AS t1
      JOIN news AS t2 ON t1.news_id = t2.id
      JOIN category AS t3 ON t1.cate_id = t3.id
      WHERE user_id = :user_id";

$q = "SELECT * FROM classify AS t1
      JOIN news AS t2 ON t1.news_id = t2.id
      JOIN category AS t3 ON t1.cate_id = t3.id
      WHERE user_id = :user_id
      ORDER BY news_id desc";
$run = $db->prepare($q);
$run_c = $db->prepare($qu);
$run->execute(array('user_id'=>$_SESSION['user_login']));
$all = $run->fetchAll();
$run_c->execute(array('user_id'=>$_SESSION['user_login']));
$count = $run_c->fetchColumn();
?>
<div class="container">
  <header>
    <div class = "absolute-position">
    <nav class = "color-nav">
        <ul>
          <li class = "left" ><a class = "font-size hover-bottom-solid" href="..\index.php"><i class="set-padding set-margin left fas fa-desktop"></i>CS Alumni</a></li>
          <li class = "right my-dropdown"><a class = "no-hover" style="height:64px;" href="#"><i class="right material-icons md-48 icon-position">menu</i><p class = "left my-dropdown-content text-center">Menu</p></a>
              <div class="my-dropdown-content color-nav">
                <?php
                if ($_SESSION['status'] == 'admin'){
                  echo "<a class = 'hover-bottom-solid' href='addofficer.php'><i class='left material-icons md-48 icon-context'>add_circle_outline</i>เพิ่มข้อมูลเจ้าหน้าที่ภาควิชา</a>";
                }
                if ($_SESSION['status'] == 'admin' or $_SESSION['status'] == 'officer'){
                  echo "<a class = 'hover-bottom-solid' href='importCSV.php'><i class='left material-icons md-48 icon-context'>add_circle</i>เพิ่มข้อมูลนิสิตเก่าด้วย CSV</a>";
                }
                if ($_SESSION['status'] == 'officer'){
                  echo "<a class = 'hover-bottom-solid' href='#'><i class='left material-icons md-48 icon-context'>add_circle</i>เพิ่มข้อมูลนิสิตเก่า</a>
                        <a class = 'hover-bottom-solid' href='#'><i class='left material-icons md-48 icon-context'>create</i>แก้ไขข้อมูลนิสิตเก่า</a>
                        <a class = 'hover-bottom-solid' href='search.php'><i class='left material-icons md-48 icon-context'>youtube_searched_for</i>ค้นหาข้อมูลนิสิตเก่า</a>
                        <a class = 'hover-bottom-solid' href='..\php\search.php'><i class='left material-icons md-48 icon-context'>assignment</i>เรียกดูประวัติการทำงานนิสิต</a>";
                }
                if ($_SESSION['status'] == 'alumni'){
                  echo "<a class = 'hover-bottom-solid' href='#'><i class='left material-icons md-48 icon-context'>perm_identity</i>ดูข้อมูลตนเอง</a>";
                }
                 ?>
              </div>
          </li>
          <li class = 'right my-dropdown'><a class = 'no-hover blue' style='height:64px;' href='viewalumniprofile.php'><i class='right material-icons md-48 icon-position'>account_circle</i><p class = 'center-align my-dropdown-content text-center'><?= $_SESSION['username'] ?></p></a>
            <div class="my-dropdown-content color-nav blue">
              <?php
              if ($_SESSION['status'] == 'alumni'){
                echo "<a class = 'hover-bottom-solid' href='#'><i class='left material-icons md-48 icon-context'>create</i>Edit Profile</a>";
              }
              ?>
              <a class = 'hover-bottom-solid' href='editaccount.php'><i class='left material-icons md-48 icon-context'>create</i>Edit Account</a>
              <a class = "hover-bottom-solid" href="..\login\logout.php"><i class="left material-icons md-48 icon-context">clear</i>Logout</a>
            </div>
          </li>
          <li class = "right my-dropdown"><a class = "no-hover" style="height:64px;" href="#"><i class="right material-icons md-48 icon-position">ballot</i><p class = "left my-dropdown-content text-center">News</p></a>
              <div class="my-dropdown-content color-nav">
                <?php
                if ($_SESSION['status'] == 'admin'){
                  echo "<a class = 'hover-bottom-solid' href='report.php'><i class='left material-icons md-48 icon-context'>warning</i>รายงานข่าวไม่เหมาะสม</a>
                        <a class = 'hover-bottom-solid' href='postdatecheck.php'><i class='left material-icons md-48 icon-context'>date_range</i>รายงานจำนวนโพสต์ของนิสิต</a>";
                }
                if ($_SESSION['status'] == 'alumni' or $_SESSION['status'] == 'officer'){
                  echo "<a class = 'hover-bottom-solid' href='addnewspage.php'><i class='left material-icons md-48 icon-context'>add</i>ประกาศข่าวสาร/ประชาสัมพันธ์</a>
                        <a class = 'hover-bottom-solid' href='editpost.php'><i class='left material-icons md-48 icon-context'>create</i>แก้ไขโพสของตนเอง</a>";
                }
                 ?>
              </div>
          </li>
        </ul>
      </nav>
    </div>
  </header>
  <div class="content-container" style="padding: 20px; border: black solid 1px; min-height: 720px;">
    <h1 style="margin-top:70px;">โพสทั้งหมดของคุณ</h1>
    <hr>
    <?php
     $start = 0;
     while($start < $count){
       $result =  $all[$start];
       $title = $result['title'];
       $post_id = $result['news_id'];
       echo "<a style='margin-top:10px;font-size:25px;' href='editpostpage.php?post_id=$post_id'>$title</a><br>";
       $start++;
     }
     ?>
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
<hr>
</body>
</html>
