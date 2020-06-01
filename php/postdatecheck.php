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

if(!isset($_SESSION['user_login']))
{
  header("location: ../index.php");
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
                  echo "<a class = 'hover-bottom-solid' href='#'><i class='left material-icons md-48 icon-context'>add_circle</i>เพิ่มข้อมูลนิสิตเก่าด้วย CSV</a>";
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
  <div class="content-container">
    <div class="w3-container" style="margin-top:50px;">
      <form class="" action="postdatecheck.php" method="post">
      รุ่น : <input type="text" name="gen" value="" required><br>
      ตั้งแต่วันที่ <input type="date" name="date-s" value="" required>
      ถึงวันที่ <input type="date" name="date-e" value="" required><br>
      <input class = 'btn-small blue' type="submit" name="" value="ยืนยัน">
      </form>
      <table>
        <tr>
          <th>Firstname</th>
          <th>Lastname</th>
          <th>Post</th>
        </tr>
      <?php
      if (isset($_POST['date-s'])){
        $date_start = $_POST['date-s'];
        $date_end = $_POST['date-e'];
        $gen = $_POST['gen'];
        $q = "SELECT COUNT(DISTINCT user_id) FROM user AS a1 JOIN news AS a2 ON a1.id = a2.user_id WHERE gen = $gen AND DATE BETWEEN '$date_start' AND '$date_end';";
        $run = $db->prepare($q);
        $run->execute();
        $query =  "SELECT DISTINCT user_id FROM user AS a1 JOIN news AS a2 ON a1.id = a2.user_id WHERE gen = $gen AND DATE BETWEEN '$date_start' AND '$date_end';";
        $run1 = $db->prepare($query);
        $run1->execute();
        $post_people = $run1->fetchAll();
        $post_people_count =  $run->fetchColumn();
        $query2 = "SELECT count(*) FROM user AS a1 JOIN news AS a2 ON a1.id = a2.user_id WHERE gen = $gen AND user_id = :user_id AND DATE BETWEEN '$date_start' AND '$date_end';";
        $query3 = "SELECT * FROM user WHERE id = :user_id and gen = $gen;";
        $run2 = $db->prepare($query2);
        $run3 = $db->prepare($query3);
        $start = 0;
        while($start < $post_people_count){
              $user_id = $post_people[$start];
              $run2->execute(array('user_id'=>$user_id[0]));
              $run3->execute(array('user_id'=>$user_id[0]));
              $post_count = $run2->fetchColumn();
              $result = $run3->fetch();
              $fname = $result['firstname'];
              $lname = $result['lastname'];
              echo "<tr>
                      <td>$fname</td>
                      <td>$lname</td>
                      <td>$post_count</td>
                    </tr>";
              $start++;
            }
      }
      ?>
      </table>
    </div>
  </div>
</div>
<hr>
</body>
</html>
