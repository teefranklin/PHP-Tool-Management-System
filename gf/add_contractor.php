<?php
session_start();
include "database.php";
if(isset($_POST['add_contractor'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $query="INSERT INTO contractors (name,email,status) 
    VALUES('$name','$email','active')";
    $statement = $connect->prepare($query);
    $statement->execute();

	header('Location:../contractor.php?msg=Contractor Added Successfully&c=success');

}

?>
