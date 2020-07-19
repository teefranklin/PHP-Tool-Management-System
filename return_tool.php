<?php 
include 'gf/database.php';
session_start();

$id = $_GET['id'];
$num=0;

$query="SELECT * FROM borrowed_tools where id='$id' and status='not returned'";
$statement = $connect->prepare($query);
$statement->execute();
$count=$statement->rowCount();
$result=$statement->fetchAll();

if($count>0){
    foreach($result as $row){
        $num=$row['quantity_borrowed'];
        $tool_id=$row['tool_id'];
    }
    
    $query="UPDATE borrowed_tools SET status='returned' where id='$id'";
    $statement = $connect->prepare($query);
    $statement->execute();
    
    $query="UPDATE tools  SET available_quantity=available_quantity+$num where tool_id='$tool_id'";
    $statement = $connect->prepare($query);
    $statement->execute();

    $start_date=date('Y-m-d H:i:s');
    $query="UPDATE borrowed_tools  SET actual_date_returned='$start_date' where id='$id'";
    $statement = $connect->prepare($query);
    $statement->execute();


    header('Location:borrowed_tools.php?msg=Tool Returned Successfully&c=success');

}else{
    header('Location:borrowed_tools.php?msg=Tool already returned&c=danger');
    die();
}


 