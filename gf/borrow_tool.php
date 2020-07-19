<?php
session_start();
/*
if($_SESSION['role'] != 'admin'){
	header('Location:index.php');
}
*/
include ('database.php');
if(isset($_POST['borrow'])){
    $tool_id=trim($_POST['tool_id']);
    $department_name=trim($_POST['department_name']);
    $borrowed_quantity=$_POST['borrowed_quantity'];
    $borrow_date=date('Y-m-d');
    $return_date=$_POST['return_date'];
    $user_id=$_POST['user_id'];
   
    $query = "SELECT * FROM tools WHERE tool_id ='$tool_id'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result=$statement->fetchAll();
    $difference=0;

    foreach($result as $row){
        $difference=$row['available_quantity'];
    }
    
    //echo  $result;
    if($borrowed_quantity>$difference){
        header('Location:../tool.php?msg=borrowed quantity is greater than available quantity&c=danger');
        die();
        //die("<script>alert('borrowed quantity is greater than available quantity');</script>;");
    }

    if($difference<=0){
        header('Location:../tool.php?msg=Tool is not available&c=danger');
        die();
    }


    $query = "SELECT * FROM borrowed_tools WHERE tool_id ='$tool_id' and user_id='$user_id'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result=$statement->fetchAll();
    $count=$statement->rowCount();

    if($count>0){
        header('Location:../tool.php?msg=User Already Borrowed This Tool&c=danger');
        die();
    }


    $difference = $difference - $borrowed_quantity;

    if(strtotime($borrow_date)>strtotime($return_date)){
        header('Location:../tool.php?msg=Return Date Should be a future Date&c=danger');
        die();
    }else{
        $query="UPDATE tools SET available_quantity = $difference WHERE tool_id ='$tool_id'";
        $statement = $connect->prepare($query);
        $statement->execute();


        $query="INSERT INTO borrowed_tools(tool_id,quantity_borrowed,status, department_code,user_id, borrow_date, return_date)
                VALUEs('$tool_id','$borrowed_quantity','not returned','$department_name','$user_id','$borrow_date','$return_date')";
        $statement = $connect->prepare($query);
        $statement->execute();
        header('Location:../tool.php?msg=Tool Borrowed Successfully&c=success');
    }

	

}

?>
