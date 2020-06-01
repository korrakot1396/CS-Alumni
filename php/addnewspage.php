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
  session_start();
  require_once '../login/connection.php';
  if(!isset($_SESSION['user_login']))
  {
    header("location: ../index.php");
  }
  if (isset($_FILES['image'])){
    $extension_name = pathinfo(basename($_FILES['image']['name']),PATHINFO_EXTENSION);
    if ($extension_name != 'jpg' && $extension_name != 'bng' && $extension_name != 'webp'){
          echo "<script type='text/javascript'>alert('กรุณาอัพโหลดไฟล์รูปภาพ (jpg or png or WebP)');</script>";
    }
  if ($extension_name == 'jpg' || $extension_name == 'bng' || $extension_name == 'webp'){
    if(isset($_POST['title'])){
      $date = date("Y-m-d",time());
      $user_id = $_SESSION['user_login'];
      $uni_name = "img_".uniqid().".".$extension_name;
      $title = $_POST['title'];
      $content = $_POST['content'];
      $img_path = "../img/";
      $img_upload_directory = $img_path.$uni_name;
      move_uploaded_file($_FILES['image']['tmp_name'],$img_upload_directory);
      $query = "INSERT INTO news(user_id,title,content,date,picture) VALUES ('$user_id','$title','$content','$date','$uni_name');";
      $query3 = "SELECT id FROM news ORDER BY id DESC;";
      $run = $db->prepare($query);
      $run->execute();
      $run3 = $db->prepare($query3);
      $run3->execute();
      $result = $run3->fetch();
      $nid = $result['id'];
      $query2 = "INSERT INTO classify(cate_id,news_id) VALUES (1,'$nid');";
      $run2 = $db->prepare($query2);
      $run2->execute();
      $message = 'เพิ่มข่าวสำเร็จ';
      try {
      } catch (PDOException $e) {
        $message = 'เพิ่มข่าวไม่สำเร็จ';

      }
      echo "<script type='text/javascript'>alert('$message');</script>";
    }
    if(isset($_POST['title-s'])){
      $date = date("Y-m-d",time());
      $user_id = $_SESSION['user_login'];
      $extension_name = pathinfo(basename($_FILES['image']['name']),PATHINFO_EXTENSION);
      $uni_name = "img_".uniqid().".".$extension_name;
      $title = $_POST['title-s'];
      $content = $_POST['content-s'];
      $img_path = "../img/";
      $img_upload_directory = $img_path.$uni_name;
      move_uploaded_file($_FILES['image']['tmp_name'],$img_upload_directory);
      $query = "INSERT INTO news(user_id,title,content,date,picture) VALUES ('$user_id','$title','$content','$date','$uni_name');";
      $query3 = "SELECT id FROM news ORDER BY id DESC;";
      $run = $db->prepare($query);
      $run->execute();
      $run3 = $db->prepare($query3);
      $run3->execute();
      $result = $run3->fetch();
      $nid = $result['id'];
      $query2 = "INSERT INTO classify(cate_id,news_id) VALUES (2,'$nid');";
      $run2 = $db->prepare($query2);
      $run2->execute();
      $message = 'เพิ่มข่าวสำเร็จ';
      try {
      } catch (PDOException $e) {
        $message = 'เพิ่มข่าวไม่สำเร็จ';

      }
      echo "<script type='text/javascript'>alert('$message');</script>";
    }
    if(isset($_POST['title-p'])){
      $date = date("Y-m-d",time());
      $user_id = $_SESSION['user_login'];
      $extension_name = pathinfo(basename($_FILES['image']['name']),PATHINFO_EXTENSION);
      $uni_name = "img_".uniqid().".".$extension_name;
      $title = $_POST['title-p'];
      $content = $_POST['content-p'];
      $img_path = "../img/";
      $img_upload_directory = $img_path.$uni_name;
      move_uploaded_file($_FILES['image']['tmp_name'],$img_upload_directory);
      $query = "INSERT INTO news(user_id,title,content,date,picture) VALUES ('$user_id','$title','$content','$date','$uni_name');";
      $query3 = "SELECT id FROM news ORDER BY id DESC;";
      $run = $db->prepare($query);
      $run->execute();
      $run3 = $db->prepare($query3);
      $run3->execute();
      $result = $run3->fetch();
      $nid = $result['id'];
      $query2 = "INSERT INTO classify(cate_id,news_id) VALUES (3,'$nid');";
      $run2 = $db->prepare($query2);
      try {
        $run2->execute();
        $message = 'เพิ่มข่าวสำเร็จ';
      } catch (PDOException $e) {
        $message = 'เพิ่มข่าวไม่สำเร็จ';

      }
      echo "<script type='text/javascript'>alert('$message');</script>";
    }
  }
}
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
                        <a class = 'hover-bottom-solid' href='..\php\search.php'><i class='left material-icons md-48 icon-context'>youtube_searched_for</i>ค้นหาข้อมูลนิสิตเก่า</a>
                        <a class = 'hover-bottom-solid' href='..\php\search.php'><i class='left material-icons md-48 icon-context'>assignment</i>เรียกดูประวัติการทำงานนิสิต</a>";
                }
                if ($_SESSION['status'] == 'alumni'){
                  echo "<a class = 'hover-bottom-solid' href='..\php\search.php'><i class='left material-icons md-48 icon-context'>perm_identity</i>ดูข้อมูลตนเอง</a>";
                }
                 ?>
              </div>
          </li>
          <li class ='right my-dropdown'><a class = 'no-hover blue' style='height:64px;' href='viewalumniprofile.php'><i class='right material-icons md-48 icon-position'>account_circle</i><p class = 'center-align my-dropdown-content text-center'><?= $_SESSION['username'] ?></p></a>
            <div class="my-dropdown-content color-nav blue">
              <?php
              if ($_SESSION['status'] == 'alumni'){
                echo "              <a class = 'hover-bottom-solid' href='#'><i class='left material-icons md-48 icon-context'>create</i>Edit Profile</a>";
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
                  echo "<a class = 'hover-bottom-solid' href='..\php\addnewspage.php'><i class='left material-icons md-48 icon-context'>add</i>ประกาศข่าวสาร/ประชาสัมพันธ์</a>
                  <a class = 'hover-bottom-solid' href='editpost.php'><i class='left material-icons md-48 icon-context'>create</i>แก้ไขโพสของตนเอง</a>";
                }
                 ?>
              </div>
          </li>
        </ul>
      </nav>
    </div>
  </header>
  <div class="content-container" style="margin-top:50px;">
    <div class="">
      <div class="w3-row">
        <a href="javascript:void(0)" onclick="openCity(event, 'add1');">
          <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding  w3-border-blue"><h3>ประกาศข่าวสาร</h3></div>
        </a>
        <a href="javascript:void(0)" onclick="openCity(event, 'add2');">
          <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding"><h3>ประกาศข่าวสารกีฬา</h3></div>
        </a>
        <a href="javascript:void(0)" onclick="openCity(event, 'add3');">
          <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding"><h3>ประชาสัมพันธ์</h3></div>
        </a>
      </div>
      <div id="add1" class="w3-container city" style="display:block">
          <form style="margin-top: 25px;" action="addnewspage.php" method="post" enctype="multipart/form-data">
            <h3>หัวเรื่องข่าว</h3><input class = "input"type="text" name="title" value="" required><br>
            <h3>เนื้อหาข่าว</h3>  <textarea class = "text-content" name="content" method="post" required></textarea>
            <h3>รูปภาพข่าว</h3><input type="file" name="image" value="" required><br>
            <hr>
            <input class = "btn-small blue" type="submit" name="" value="ยืนยัน" style="margin-bottom:20px;">
          </form>
      </div>

      <div id="add2" class="w3-container city" style="display:none">
        <form style="margin-top: 25px;" action="addnewspage.php" method="post" enctype="multipart/form-data">
          <h3>หัวเรื่องข่าวกีฬา</h3><input class = "input"type="text" name="title-s" value="" required><br>
          <h3>เนื้อหาข่าวกีฬา</h3> <textarea class = "text-content" name="content-s" method="post" required></textarea>
          <h3>รูปภาพข่าวกีฬา</h3><input type="file" name="image" value="" required><br>
          <hr>
          <input class = "btn-small blue" type="submit" name="" value="ยืนยัน">
        </form>
      </div>

      <div id="add3" class="w3-container city" style="display:none">
        <form style="margin-top: 25px;" action="addnewspage.php" method="post" enctype="multipart/form-data">
          <h3>หัวเรื่องประชาสัมพันธ์</h3><input class = "input" type="text" name="title-p" value="" required><br>
          <h3>เนื้อหาประชาสัมพันธ์</h3> <textarea class = "text-content" name="content-p" method="post" required></textarea>
          <h3>รูปภาพประชาสัมพันธ์</h3><input type="file" name="image" value="" required><br>
          <hr>
          <input class = "btn-small blue" type="submit" name="" value="ยืนยัน">
        </form>
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
