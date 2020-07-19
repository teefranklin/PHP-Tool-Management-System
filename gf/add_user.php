<?php
session_start();
/*
if($_SESSION['role'] != 'admin'){
	header('Location:index.php');
}
*/
include "database.php";
if(isset($_POST['add_user'])){
    $user_id=$_POST['user_id'];
    $surname=$_POST['surname'];
    //$gender=$_POST['gender'];
    $email=$_POST['email'];
    $role=$_POST['role'];
    $name=$_POST['name'];
    //$phone=$_POST['phone'];
	//$address=$_POST['address'];

	//setting a default password when creating a user  and hashing
    $password="Default01";
    $password=password_hash($password,PASSWORD_DEFAULT);
    //inserting user info
    $query="INSERT INTO user_login (name,surname,email,user_id,password,role) 
    VALUES('$name','$surname','$email','$user_id','$password','$role')";
    $statement = $connect->prepare($query);
    $statement->execute();

	header('Location:../users.php?msg=User Added Successfully&c=success');

}else if(isset($_POST['edit_user'])){
    $user_id=$_GET['id'];
    
    $surname=$_POST['surname'];
    //$gender=$_POST['gender'];
    $email=$_POST['email'];
    $role=$_POST['role'];
    $name=$_POST['name'];
    $password=$_POST['password'];
    //$phone=$_POST['phone'];
	//$address=$_POST['address'];

	//setting a default password when creating a user  and hashing
    if($password !=''){
        $password=password_hash($password,PASSWORD_DEFAULT);
        $query="UPDATE user_login SET
        name='$name',
        surname='$surname',
        email='$email',
        password='$password',
        role ='$role'
        WHERE user_id='$user_id'";
        $statement = $connect->prepare($query);
        $statement->execute();
    }else{
        $query="UPDATE user_login SET
        name='$name',
        surname='$surname',
        email='$email',
        role ='$role'
        WHERE user_id='$user_id'";
        $statement = $connect->prepare($query);
        $statement->execute();
    }
    
    //inserting user info
    
	header('Location:../users.php?msg=User Edited Successfully&c=success');
}

?>
