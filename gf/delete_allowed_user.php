<?php 
include 'database.php';
session_start();

$id = $_GET['id'];
$num=0;

$query="SELECT * FROM allowed_users where user_id='$id'";
$statement = $connect->prepare($query);
$statement->execute();
$count=$statement->rowCount();
$result=$statement->fetchAll();

if($count>0){
    
    $query="DELETE FROM allowed_users where user_id='$id'";
    $statement = $connect->prepare($query);
    $statement->execute();

    header('Location:../allowed_users.php?msg=User Deleted Successfully&c=success');

}else{
    header('Location:../allowed_users.php?msg=User Not Found&c=danger');
    die();
}
