<?php
session_start();

include "gf/database.php";
if(isset($_POST['add_department'])){
    $department_code=$_POST['department_code'];
    $department_name=$_POST['department_name'];
    //$gender=$_POST['gender'];
    $email=$_POST['email'];
    $role=$_POST['role'];
    $name=$_POST['name'];

    //inserting user info
    $query="INSERT INTO department (department_code,department_name) 
    VALUES('$department_code','$department_name')";
    $statement = $connect->prepare($query);
    $statement->execute();

	header('Location:departments.php');

}

?>
