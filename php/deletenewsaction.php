<?php
require_once '../login/connection.php';

session_start();

if(!isset($_SESSION['user_login']))
{
header("location: ../index.php");
}

if(!isset($_GET['news_id'])){
  header("location: indexafterlogin.php");
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
$query = "DELETE FROM report WHERE news_id = :id";
$query2 = "DELETE FROM classify WHERE news_id = :id";
$query3 = "DELETE FROM news WHERE id = :id";
$run = $db->prepare($query);
$run2 = $db->prepare($query2);
$run3 = $db->prepare($query3);
$run->execute(array('id'=>$_GET['news_id']));
$run2->execute(array('id'=>$_GET['news_id']));
$run3->execute(array('id'=>$_GET['news_id']));
try {
  $message = 'ลบข่าวสำเร็จ';
} catch (PDOException $e) {
  $message = 'ลบข่าวไม่สำเร็จ';
}
echo "<script type='text/javascript'>alert('$message');</script>";
header("refresh:1; indexafterlogin.php");
?>
