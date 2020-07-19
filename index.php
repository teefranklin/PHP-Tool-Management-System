<?php
session_start();
if(isset($_SESSION['username'])){
    header('Location:tool.php');
}else{
    header('Location:login.php');
}
?>