<?php
session_start();
/*
if($_SESSION['role'] != 'admin'){
	header('Location:index.php');
}
*/
include "database.php";
if(isset($_POST['change_password'])){
    $old_pass=$_POST['old_password'];
    $password=trim($_POST['password']);
    //$gender=$_POST['gender'];
    $new_pass=$_POST['new_password'];

    // Validate password strength
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);

    

    if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
        die( 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.');
    }else{
        $query="SELECT * FROM user_login where user_id='".$_SESSION['user_id']."'";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result=$statement->fetchAll();

        foreach($result as $row){
            if(password_verify($old_pass,$row['password'])){
                if($password == $new_pass){
                    $password=password_hash($password,PASSWORD_DEFAULT);
                    //inserting user info
                    $query="UPDATE user_login SET password='$password' where user_id='".$_SESSION['user_id']."'";
                    $statement = $connect->prepare($query);
                    $statement->execute();
        
                    header('Location:../tool.php');
                }else{
                    die('Passwords Do Not Match !');
                }
            }else{
                die('Old Password is Incorect !');
            }
        }

        
    }


    

}

?>