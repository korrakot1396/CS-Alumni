<?php
require '../login/connection.php';
$result = '';
if(isset($_POST['import'])){
$csv_file = $_FILES['csvfile']['tmp_name'];
$extension_name = pathinfo(basename($_FILES['csvfile']['name']),PATHINFO_EXTENSION);

  if ( ! is_file( $csv_file ) ){
    $result='ไม่พบไฟล์';
  }
else{
  $fp = file($csv_file, FILE_SKIP_EMPTY_LINES);
  $count = 1;
  $count_csv = count($fp);
  if($extension_name!='csv'){
      $result="กรุณาใช้ไฟล์CSV";
  }
  elseif(($handle = fopen( $csv_file, "r")) !== FALSE){
    while($count <= $count_csv){
            $data = fgetcsv($handle, 1000, ",");
            $std_id = $data[0];
            $fname = $data[1];
            $lname = $data[2];
            $email = $data[3];
            $gen = $data[4];
            $career = $data[5];
                $q = "INSERT INTO user(std_id,firstname,lastname,email,gen,status,career)
                      VALUES ('$std_id','$fname','$lname','$email','$gen','alumni','$career');";
                $q1 ="INSERT INTO career(std_id,career,add_date)
                      VALUES ('$std_id','$career',now());";
                try {
                    $run = $db->prepare($q);
                    $run->execute();
                    $run1 = $db->prepare($q1);
                    $run1->execute();
                    $result = 'อัพโหลดเสร็จสิ้น';
                } catch (PDOException $e){
                  $result = 'อัพโหลดมีข้อผิดพลาด';
                }
            $count++;
        }
    }
  }
echo "<script type='text/javascript'>alert('$result');</script>";
}

$tableContent = '';
$selectStmt = $db->prepare("SELECT std_id,firstname,lastname,email,career,gen FROM user WHERE status='alumni'ORDER BY std_id ASC");
$selectStmt->execute();
$users = $selectStmt->fetchAll();

foreach ($users as $user)
{
  $tableContent = $tableContent.'<tr>'.
  '<td>'.$user['std_id'].'</td>'
  .'<td>'.$user['firstname'].'</td>'
  .'<td>'.$user['lastname'].'</td>'
  .'<td>'.$user['email'].'</td>'
  .'<td>'.$user['career'].'</td>'
  .'<td>'.$user['gen'].'</td>';
}

?>
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
      <title>เพิ่มข้อมูลศิษย์เก่าด้วยCSV</title>
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
                  echo "<a class = 'hover-bottom-solid' href='add_data_alumni.php'><i class='left material-icons md-48 icon-context'>add_circle</i>เพิ่มข้อมูลนิสิตเก่า</a>
                  <a class = 'hover-bottom-solid' href='searchdatabystudentid.php'><i class='left material-icons md-48 icon-context'>create</i>แก้ไขข้อมูลนิสิตเก่า</a>
                  <a class = 'hover-bottom-solid' href='search.php'><i class='left material-icons md-48 icon-context'>youtube_searched_for</i>ค้นหาข้อมูลนิสิตเก่า</a>
                  <a class = 'hover-bottom-solid' href='searchcareerdatabystudentidforofficer.php'><i class='left material-icons md-48 icon-context'>assignment</i>เรียกดูประวัติการทำงานนิสิต</a>";
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
  <div class="content-container card-panel green accent-1"style = "margin-top: 80px; min-height:720px;">
  <u><h3><b>เพิ่มข้อมูลศิษย์เก่า(CSV file)</b></h3></u>

    <form action="importCSV.php" method="POST"  enctype="multipart/form-data">
            <input class = "btn-small blue "type="file" name="csvfile" require>
            <input class = "btn-small blue " type="submit" name="import" value = "import">
            <div class="container"id ="table">
    <table  class="striped" id = "printTable">
    <u><h3 class="center-align"><b>นิสิตเก่าของภาควิชาวิทยาการคอมพิวเตอร์</b></h3><br></u>
                <tr>
                    <td><b>ID</b></td>
                    <td><b>First Name</b></td>
                    <td><b>Last Name</b></td>
                    <td><b>email</b></td>
                    <td><b>career</b></td>
                    <td><b>gen</b></td>

                </tr>

                <?php

          echo $tableContent;
?>
   </table>
            </div>
        </form>


<hr>
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
</body>
</html>
