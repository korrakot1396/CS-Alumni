<?php

require_once '../login/connection.php';

session_start();
$tableContent = '';
$genCS = '';
$std_id ='';
$fname ='';
$lname = '';
$searched_data='';
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
if(isset($_POST['reset'])){
    $tableContent = '';
    $genCS = '';
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
}

elseif(isset($_POST['search']))
{
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $std_id = $_POST['std_id'];
  $genCS = $_POST['genCS'];

  $tableContent = '';
    if($genCS==null&& $fname==null && $lname==null && $std_id==null){
        $selectStmt = $db->prepare("SELECT std_id,firstname,lastname,email,career,gen FROM user WHERE status='alumni'ORDER BY std_id ASC"); $selectStmt->execute();
    }
    if($genCS!=null&& $fname!=null && $lname!=null && $std_id!=null){
      $selectStmt = $db->prepare("SELECT std_id,firstname,lastname,email,career,gen FROM user WHERE  status='alumni'AND gen ='$genCS' AND firstname='$fname'AND lastname='$lname' AND std_id ='$std_id' ORDER BY std_id ASC");
      $selectStmt->execute();}
    if($genCS!=null&& $fname==null && $lname==null && $std_id==null){
      $selectStmt = $db->prepare("SELECT std_id,firstname,lastname,email,career,gen FROM user WHERE status='alumni'AND gen ='$genCS' ORDER BY std_id ASC");
      $selectStmt->execute();}
  if($genCS!=null&& $fname!=null && $lname==null && $std_id==null){
    $selectStmt = $db->prepare("SELECT std_id,firstname,lastname,email,career,gen FROM user WHERE status='alumni'AND gen ='$genCS' AND firstname='$fname' ORDER BY std_id ASC");
    $selectStmt->execute();}    
if($genCS!=null&& $fname!=null && $lname!=null && $std_id==null){
  $selectStmt = $db->prepare("SELECT std_id,firstname,lastname,email,career,gen FROM user WHERE status='alumni'AND gen ='$genCS' AND firstname='$fname'AND lastname='$lname' ORDER BY std_id ASC");
  $selectStmt->execute();}  
if($genCS==null&& $fname!=null && $lname==null && $std_id==null){
  $selectStmt = $db->prepare("SELECT std_id,firstname,lastname,email,career,gen FROM user WHERE status='alumni'AND  firstname='$fname' ORDER BY std_id ASC");
  $selectStmt->execute();}
 if($genCS==null&& $fname!=null && $lname!=null && $std_id==null){
  $selectStmt = $db->prepare("SELECT std_id,firstname,lastname,email,career,gen FROM user WHERE  status='alumni' AND firstname='$fname'AND lastname='$lname' ORDER BY std_id ASC");
  $selectStmt->execute();} 
 if($genCS==null&& $fname!=null && $lname!=null && $std_id!=null){
  $selectStmt = $db->prepare("SELECT std_id,firstname,lastname,email,career,gen FROM user WHERE  status='alumni' AND firstname='$fname'AND lastname='$lname' AND std_id='$std_id'  ORDER BY std_id ASC");
  $selectStmt->execute();}
 if($genCS==null&& $fname==null && $lname!=null && $std_id==null){
  $selectStmt = $db->prepare("SELECT std_id,firstname,lastname,email,career,gen FROM user WHERE  status='alumni'AND lastname='$lname'  ORDER BY std_id ASC");
  $selectStmt->execute();}
 if($genCS==null&& $fname==null && $lname!=null && $std_id!=null){
  $selectStmt = $db->prepare("SELECT std_id,firstname,lastname,email,career,gen FROM user WHERE  status='alumni'AND lastname='$lname' AND std_id ='$std_id' ORDER BY std_id ASC");
  $selectStmt->execute();}
if($genCS==null&& $fname==null && $lname==null && $std_id!=null){
  $selectStmt = $db->prepare("SELECT std_id,firstname,lastname,email,career,gen FROM user WHERE  status='alumni' AND std_id ='$std_id' ORDER BY std_id ASC");
  $selectStmt->execute();}
    
    $users = $selectStmt->fetchAll();
    $total_row = $selectStmt->rowCount();
    $tableContent = '';
    if($genCS==null){
        $genCS='___';}
     if($fname==null ){
      $fname='___';}
     if($lname==null ){
      $lname='___';}
    if($std_id==null){
      $std_id='___';}
    $searched_data='<b class="blue-text text-darken-2"><u>ID:</u> </b>'.$std_id.'<b class="blue-text text-darken-2">     <u>Firstname:</u> </b>'.$fname.'<b class="blue-text text-darken-2">     <u>Lastname:</span></u> </b>'.$lname.'<b class ="blue-text text-darken-2">    <u> Gen:</u> </b>'.$genCS;


  if($total_row>0){
        
        foreach ($users as $user){
          $tableContent = $tableContent.'<tr>'.
          '<td>'.$user['std_id'].'</td>'
          .'<td>'.$user['firstname'].'</td>'
          .'<td>'.$user['lastname'].'</td>'
          .'<td>'.$user['email'].'</td>'
          .'<td>'.$user['career'].'</td>'
          .'<td>'.$user['gen'].'</td>';
      }
    }
    else {
        $tableContent .= '<tr><td> No data found</td></tr>';
}
    
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
      <title>ค้นหาข้อมูลนิสิตเก่า</title>
</head>
<body>
  <?php


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
  
  <div class="content-container card-panel  teal accent-1" style = "margin-top: 80px;">
    <form action="search.php" method="POST">
    <u><h3 class="center-align"><b>ค้นหาข้อมูลนิสิตเก่า</b></h3></u>
    <div class="row ">
      <div class="input-field col s6">
        <div class="teal-text text-lighten-1">First Name</div> <input  name="fname" type="text" class="validate">
        
      </div>
      <div class="input-field col s6">
        <div class="teal-text text-lighten-1">Last Name </div><input  name="lname" type="text" class="validate">
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6">
        <div class="teal-text text-lighten-1">Student ID</div> <input  name="std_id" type="text" class="validate">
      </div>
      <div class="input-field col s6">
        <div class="teal-text text-lighten-1">Gen Computer Science </div><input  name="genCS" type="text" class="validate">
      </div>
      
      <input class = "btn-small blue " type="submit" name="search" value="ค้นหา">
      <input class = "btn-small blue " type="submit" name="reset" value="รีเซ็ต"><b class = "red-text text-darken-2">*ไม่จำเป็นต้องกรอกข้อมูลครบ*</b><br><br>
  </div>
  
  </div>
  <div class="content-container card-panel green accent-1">
  <u><p class="center-align"><b>ข้อมูลที่ค้นหา</b></p></u><br>
  <p class="center-align red-text text-darken-2"><?php echo  $searched_data; ?></p><br>

  </div>
  
    <div class ="right-align"><button class = "btn-small blue "onclick="printContent('table')">พิมพ์ตาราง</button></div>

        <div class="container"id ="table">    
 
        
      <table  class="striped"  id="printTable">
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
  </div>
</div>
</header>
<hr>
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
  </footer>
</body>
</html>