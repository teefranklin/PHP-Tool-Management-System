<?php 
include 'database.php';
session_start();

$id = $_GET['id'];
$num=0;

$query="SELECT * FROM borrowed_tools where tool_id='$id'";
$statement = $connect->prepare($query);
$statement->execute();
$count=$statement->rowCount();
$result=$statement->fetchAll();

if($count>0){
    
    $query="DELETE FROM borrowed_tools where tool_id='$id'";
    $statement = $connect->prepare($query);
    $statement->execute();

    header('Location:../borrowed_tools.php?msg=Record Deleted Successfully&c=success');

}else{
    header('Location:../borrowed_tools.php?msg=Record Not Found&c=danger');
    die();
}