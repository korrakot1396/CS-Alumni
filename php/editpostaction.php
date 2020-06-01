<?php
require_once '../login/connection.php';
if (empty($_POST['title'])){
  header("location: indexafterlogin.php");
}

$query = "UPDATE news SET title=:title , content=:content WHERE id = :id";
$run = $db->prepare($query);
$query2 = "UPDATE news SET picture = :picture WHERE id = :id";
$run2 = $db->prepare($query2);
if ($_FILES["image"]["error"] != 4){
  $extension_name = pathinfo(basename($_FILES['image']['name']),PATHINFO_EXTENSION);
  if ($extension_name != 'jpg' && $extension_name != 'png' && $extension_name != 'webp'){
        $message = "กรุณาอัพโหลดไฟล์รูปภาพ (jpg or png or WebP)";
  } else {
    $uni_name = "img_".uniqid().".".$extension_name;
    $img_path = "../img/";
    $img_upload_directory = $img_path.$uni_name;
    move_uploaded_file($_FILES['image']['tmp_name'],$img_upload_directory);
    try {
      $run2->execute(array('id'=> $_GET['post_id'], 'picture'=> $uni_name));
      $run->execute(array('title'=> $_POST['title'] , 'content' => $_POST['content'] , 'id'=> $_GET['post_id']));
      $message = 'แก้ไขสำเร็จ';
    } catch (PDOException $e) {
      $message = 'แก้ไขไม่สำเร็จ';
    }
  }
} else if ($_FILES["image"]["error"] == 4){
  try {
    $run->execute(array('title'=> $_POST['title'] , 'content' => $_POST['content'] , 'id'=> $_GET['post_id']));
    $message = 'แก้ไขสำเร็จ';
  } catch (PDOException $e) {
    $message = 'แก้ไขไม่สำเร็จ';
  }
}
echo "<script type='text/javascript'>alert('$message');</script>";
header("refresh:1; indexafterlogin.php");
?>
