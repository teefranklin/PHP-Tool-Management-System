<?php 
include 'gf/database.php';
session_start();

$id = $_GET['id'];
$num=0;

$query="SELECT * FROM department where id='$id'";
$statement = $connect->prepare($query);
$statement->execute();
$count=$statement->rowCount();
$result=$statement->fetchAll();

if($count>0){
    
    $query="DELETE FROM department where id='$id'";
    $statement = $connect->prepare($query);
    $statement->execute();

    header('Location:departments.php?msg=Department Deleted Successfully&c=success');

}else{
    header('Location:departments.php?msg=Department Not Found&c=danger');
    die();
}


 