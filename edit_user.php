<?php include 'gf/header.php'; ?>
<?php
include 'gf/database.php';
    $id=$_GET['id'];
  $msg='Error Message will be displayed here !';
  $class='success';
if(isset($_GET['msg'])){
  $msg=$_GET['msg'];
  $class=$_GET['c'];
}
  $query="SELECT * FROM user_login where user_id='$id'";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result=$statement->fetchAll();

  foreach($result as $row){
      $name=$row['name'];
      $surname=$row['surname'];
      $email=$row['email'];
      $role=$row['role'];

  }


?>
<br><br><br>
<div class="row container">
  <div class="col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">Users</div>
      <div class="panel-body">
      <div class="alert alert-<?php echo $class; ?>">
                  <h4 align=center><?php echo $msg; ?></h4>
                </div>
        <br><br><br>
       <div class="row">
           <div class="col-md-3"></div>
           <div class="col-md-6">
           <form action="gf/add_user.php?id=<?php echo $id; ?>" method="post">
          <div class="input">
            <input class="form-control" type="text" name="name" placeholder="Name" id="name" required="" value="<?php echo $name; ?>">

            <span class="fa fa-user"></span>
          </div>
          <div class="input">
            <input class="form-control" type="text" name="surname" placeholder="Surname" id="surname" required="" value="<?php echo $surname; ?>">

            <span class="fa fa-user"></span>
          </div>
          <div class="input">
            <input class="form-control" type="text" name="user_id" placeholder="EC Number" id="user_id" required="" disabled value="<?php echo $id; ?>">

            <span class="fa fa-user"></span>
          </div>
          <div class="input">
            <input class="form-control" type="email" name="email" placeholder="Email" id="email" required="" value="<?php echo $email; ?>">

            <span class="fa fa-envelope"></span>
          </div>
          <div class="input">
            <input class="form-control" type="text" name="role" placeholder="Role" id="role" required="" value="<?php echo $role; ?>">
            <span class="fa fa-user"></span>
          </div>

          <div class="input">
            <input class="form-control" type="password" name="password" placeholder="Change User Password" >
            <span class="fa fa-unlock"></span>
          </div>
          <input type="submit" class="btn btn-primary" name="edit_user" value="Edit User">
        </form>
           </div>
       </div>
      </div>
    </div>
  </div>
</div>
<?php include 'gf/footer.php'; ?>