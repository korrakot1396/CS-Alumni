<?php
require_once '../login/connection.php';

session_start();

if(!isset($_SESSION['user_login']))
{
header("location: ../index.php");
}

if(!isset($_GET['report_id'])){
  header("location: indexafterlogin.php");
}

if($_SESSION['status'] != 'admin'){
  header("location: indexafterlogin.php");
}

$query = "DELETE FROM report WHERE news_id = :id;";
$run = $db->prepare($query);
$run->execute(array("id" => $_GET['report_id']));
  header("refresh:1; report.php");
?>
