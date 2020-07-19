<?php 
include 'database.php';
session_start();

$id = $_GET['id'];
$num=0;

$query="SELECT * FROM contractors where contractor_id='$id'";
$statement = $connect->prepare($query);
$statement->execute();
$count=$statement->rowCount();
$result=$statement->fetchAll();

if($count>0){
    
    $query="DELETE FROM contractors where contractor_id='$id'";
    $statement = $connect->prepare($query);
    $statement->execute();

    header('Location:../contractor.php?msg=Contractor Deleted Successfully&c=success');

}else{
    header('Location:../contractor.php?msg=Contractor Not Found&c=danger');
    die();
}


 