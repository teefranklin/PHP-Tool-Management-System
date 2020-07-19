<?php
session_start();
include "database.php";
if(isset($_POST['add_user'])){
    $user_id=$_POST['user_id'];
    $surname=$_POST['surname'];
    //$gender=$_POST['gender'];
    $email=$_POST['email'];
    $role=$_POST['role'];
    $name=$_POST['name'];
    $department=$_POST['department'];
    //$phone=$_POST['phone'];
	//$address=$_POST['address'];

    //inserting user info
    $query="INSERT INTO allowed_users (user_id,firstname,lastname,email,role,department_code,status) 
    VALUES('$user_id','$name','$surname','$email','$role','$department','active')";
    $statement = $connect->prepare($query);
    $statement->execute();

	header('Location:../allowed_users.php');

}else if(isset($_POST['edit_user'])){

}

?>
