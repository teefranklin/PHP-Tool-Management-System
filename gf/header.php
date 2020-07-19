<?php
include 'gf/database.php';
session_start();
if(!isset($_SESSION['username'])){
    header('Location:login.php');
}

$query ="SELECT * FROM borrowed_tools where status !='overdue' and status !='returned'";
    $today_date=strtotime(date('Y-m-d'));  


    $statement = $connect->prepare($query);
    $statement->execute();
    $count= $statement -> rowCount();
    $result = $statement->fetchAll();

    foreach($result as $row){
      $due_date=strtotime($row['return_date']);
      if($today_date > $due_date){
         $query ="UPDATE borrowed_tools SET status='overdue' WHERE id ='".$row['id']."' and status !='done'";
         $statement = $connect->prepare($query);
         $statement->execute();

         $query ="SELECT * FROM allowed_users where user_id='".$row['user_id']."'";
          $today_date=strtotime(date('Y-m-d'));  


          $statement = $connect->prepare($query);
          $statement->execute();
          $count= $statement -> rowCount();
          $user = $statement->fetchAll();

          foreach($user as $u){
            $name = $u['firstname']. " " .$u['lastname'];
          }

         $about="Tool borrowed by $name with id <b><i>".$row['tool_id']."</i></b> is overdue !";
         $start_date=date('Y-m-d H:i:s');
         $sub_query="INSERT INTO notification 
          (text,date)
          VALUES('$about','$start_date')";

        $statement = $connect->prepare($sub_query);
        $statement->execute();
      }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>ZPC Tool Management System</title>

<!-- Custom styles for this template -->
<link href="css/simple-sidebar.css" rel="stylesheet">
  <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">ZPC Tool Management System</div>
      <div class="list-group list-group-flush">
        <a href="tool.php" class="list-group-item list-group-item-action bg-light">Tools</a>
        <a href="borrowed_tools.php" class="list-group-item list-group-item-action bg-light"> Borrowed Tools</a>
        <?php if($_SESSION['role'] =='administrator') : ?>
          <a href="users.php" class="list-group-item list-group-item-action bg-light">Users</a>
          <a href="departments.php" class="list-group-item list-group-item-action bg-light">Departments</a>
          <a href="allowed_users.php" class="list-group-item list-group-item-action bg-light">Allowed Users</a>
          <a href="contractor.php" class="list-group-item list-group-item-action bg-light">Contractors</a>
        <?php endif; ?>
        <a href="reports.php" class="list-group-item list-group-item-action bg-light">Reports</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->
<?php
$query ="SELECT * FROM notification where seen ='no'";
$statement = $connect->prepare($query);
$statement->execute();
$count= $statement -> rowCount();
$result = $statement->fetchAll();

?>
    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
      <div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Notifications ( <?php echo $count; ?> )</button>
          <ul class="dropdown-menu">
            <li class="dropdown-header">You have <?php echo $count; ?> New Notifications</li> 
            <li class="divider"></li> 
            <?php foreach($result as $row)  :  ?>
            <li><a href="borrowed_tools.php"> <i class="fa fa-tasks"></i> <?php echo $row['text']; ?></li>
            <?php endforeach ; ?>
            <li class="divider"></li> 
            <li class="dropdown-header">end of notifications</li> 
          </ul>
        </div> 
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="#"><?php echo $_SESSION['username']; ?> <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="change_password" data-toggle="modal" data-target="#change_password">Change Password<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="logout.php">Logout <span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </div>
      </nav>