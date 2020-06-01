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
require '../login/connection.php';

if(isset($_POST['update'])) {
  $errMsg = '';

  // Getting data from FROM
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $career = $_POST['career'];
  $username = $_POST['username'];

  if($errMsg == '') {
    try {
        $sql = "UPDATE pdo SET firstname = :firstname, lastname = :lastname, career = :career WHERE username = :username";
        $stmt = $db->prepare($sql);
        $stmt->execute(array(
          ':firstname' => $firstname,
          ':lastname' => $lastname,
          ':career' => $career,
          ':username' => $username
        ));
      echo "update";
      exit;

    }
    catch(PDOException $e) {
      $errMsg = $e->getMessage();
    }
  }
}

?>

<div class="container">
  <header>
    <img class = "size-not-change"src="..\img\test.jpg" alt="">
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
          <li class = 'right my-dropdown'><a class = 'no-hover blue' style='height:64px;' href='viewalumniprofile.php'><i class='right material-icons md-48 icon-position'>account_circle</i><p class = 'center-align my-dropdown-content text-center'><?= $_SESSION['username'] ?></p></a>
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
  <div class="content-container">
        <br>
    </div>
  <h1 align="center">Edit Profile</h1>
  <br>
  <div align="center">
    Username : $username
    <br>
  </div>

  <br>

  <form method="POST">

    <center class="form-group">
      <label for="pwd">Username</label>
      <input type="text" class="form-control"  name="username" placeholder="enter username" style="width:30%;"required>
    </center>

    <center class="form-group">
      <label for="pwd">New Firstname</label>
      <input type="text" class="form-control"  name="firstname" placeholder="enter firstname" style="width:30%;"required>
    </center>

    <center class="form-group">
      <label for="pwd">New Lastname</label>
      <input type="text" class="form-control"  name="newpass" placeholder="enter lastname" style="width:30%;"required>
    </center>

      <center class="form-group">
      <label for="pwd">New Career</label>
      <input type="text" class="form-control"  name="career" placeholder="enter career" style="width:30%;"required>
    </center>


    <div align="center">
      <button type="submit" class="btn btn-primary" name="update">Update Profile</button>
    </div>

<hr>
<footer >
 
  </footer>

</body>
</html>
