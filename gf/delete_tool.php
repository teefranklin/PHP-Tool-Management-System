<?php 
include 'database.php';
session_start();

$id = $_GET['id'];
$num=0;

$query="SELECT * FROM tools where tool_id='$id'";
$statement = $connect->prepare($query);
$statement->execute();
$count=$statement->rowCount();
$result=$statement->fetchAll();

if($count>0){
    
    $query="DELETE FROM tools where tool_id='$id'";
    $statement = $connect->prepare($query);
    $statement->execute();

    header('Location:../tool.php?msg=Tool Deleted Successfully&c=success');

}else{
    header('Location:../tool.php?msg=Tool Not Found&c=danger');
    die();
}