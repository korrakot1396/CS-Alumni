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

    $sessionusername = $_SESSION['user_login_name'];
    
    $std_id = $_POST['std_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $career = $_POST['career'];

    $selectdata = "SELECT * FROM career WHERE std_id = $std_id AND career = $career;";
    $run1 = $db->prepare($selectdata);
    $row1 = $run1->fetch(PDO::FETCH_ASSOC);
    $timestamp = time();
    if($row1['std_id']==$std_id){
        if($row1['career']==$career){

            $query1 = "UPDATE user SET std_id='$std_id' WHERE username = '$sessionusername';";
            $query2 = "UPDATE user SET firstname='$firstname' WHERE username = '$sessionusername';";
            $query3 = "UPDATE user SET lastname='$lastname' WHERE username = '$sessionusername';";
            $query4 = "UPDATE user SET email='$email' WHERE username = '$sessionusername';";
            $query5 = "UPDATE user SET career='$career' WHERE username = '$sessionusername';";
       
            $run = $db->prepare($query1);
            $run->execute();
            $run = $db->prepare($query2);
            $run->execute();
            $run = $db->prepare($query3);
            $run->execute();
            $run = $db->prepare($query4);
            $run->execute();
            $run = $db->prepare($query5);
            $run->execute(); 
        }
    }
    else{
        if($career!=""){
            $query1 = "UPDATE user SET std_id='$std_id' WHERE username = '$sessionusername';";
            $query2 = "UPDATE user SET firstname='$firstname' WHERE username = '$sessionusername';";
            $query3 = "UPDATE user SET lastname='$lastname' WHERE username = '$sessionusername';";
            $query4 = "UPDATE user SET email='$email' WHERE username = '$sessionusername';";
            $query5 = "UPDATE user SET career='$career' WHERE username = '$sessionusername';";
       
            $run = $db->prepare($query1);
            $run->execute();
            $run = $db->prepare($query2);
            $run->execute();
            $run = $db->prepare($query3);
            $run->execute();
            $run = $db->prepare($query4);
            $run->execute();
            $run = $db->prepare($query5);
            $run->execute(); 
            
            $query6 = "INSERT INTO career (std_id,career,timestamp) VALUE ('$std_id','$career','$timestamp');";
            $run = $db->prepare($query6);
            $run->execute();
        }
    }
    

    echo"<script>alert('แก้ไขข้อมูลเรียบร้อยค่ะ')</script>";
    echo"<script>window.location='viewalumniprofile.php'</script>";
?>
