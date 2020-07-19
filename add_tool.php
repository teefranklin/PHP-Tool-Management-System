<?php
session_start();
/*
if($_SESSION['role'] != 'admin'){
	header('Location:index.php');
}
*/
include "gf/database.php";
if(isset($_POST['add_tool'])){
    $tool_id=$_POST['tool_id'];
    $surname=$_POST['tool_name'];
    //$gender=$_POST['gender'];
    $quantity=$_POST['quantity'];
    //$role=$_POST['role'];
    //$name=$_POST['name'];
    //$phone=$_POST['phone'];
	//$address=$_POST['address'];

	//setting a default password when creating a user  and hashing
    //$password="Default01";
    //$password=password_hash($password,PASSWORD_DEFAULT);

    //inserting user info
    if ($quantity > 0){
        $status = 1;
        $available_quantity = $quantity;
    }
    $query="INSERT INTO tools (tool_id, tool_name, status, quantity, available_quantity) VALUES('$tool_id','$tool_name','$status','$quantity','$available_quantity')";
    $statement = $connect->prepare($query);
    $statement->execute();

	header('Location:tool.php');

}else if(isset($_POST['edit_user'])){

}

?>
