<?php include 'gf/header.php'; ?>
<?php
include 'gf/database.php';
  $msg='Error Message will be displayed here !';
  $class='success';
if(isset($_GET['msg'])){
  $msg=$_GET['msg'];
  $class=$_GET['c'];
}
  $query="SELECT * FROM user_login";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result=$statement->fetchAll();


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
        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"> Add</i></a>
        <br><br><br>
        <table id="users" class="table">
          <thead>
            <th>EC Number</th>
            <th>Username</th>
            <th>Email</th>
            <?php if($_SESSION['role'] =='administrator') : ?>
            <th>Action</th>
            <?php endif ; ?>
          </thead>
          <tbody>
            <?php foreach($result as $row) : ?>
            <tr>
              <td><?php echo $row['user_id']; ?></td>
              <td><?php echo $row['name']. ' '.$row['surname']; ?></td>
              <td><?php echo $row['email']; ?></td>


              <td>
              <?php if($_SESSION['role'] =='administrator') : ?>
              <a href="edit_user.php?id=<?php echo $row['user_id']; ?>" class="btn btn-info"><i class="fa fa-pencil"></i> EDIT</a>
              <a href="delete_user.php?id=<?php echo $row['user_id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i> DELETE</a>
            </td>
              <?php endif ; ?>
            </tr>
            <?php endforeach ; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!--- Add
                                            tool modal--->

<!-- Modal -->
<div class="modal fade" id="add_user" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add User</h4>
      </div>
      <div class="modal-body">
        <form action="gf/add_user.php" method="post">
          <div class="input">
            <input class="form-control" type="text" name="name" placeholder="Name" required="">

            <span class="fa fa-envelope"></span>
          </div>
          <div class="input">
            <input class="form-control" type="text" name="surname" placeholder="Surname" required="">

            <span class="fa fa-unlock"></span>
          </div>
          <div class="input">
            <input class="form-control" type="text" name="user_id" placeholder="EC Number" required="">

            <span class="fa fa-envelope"></span>
          </div>
          <div class="input">
            <input class="form-control" type="email" name="email" placeholder="Email" required="">

            <span class="fa fa-envelope"></span>
          </div>
          <div class="input">
            <input class="form-control" type="text" name="role" placeholder="Role" required="">
            <span class="fa fa-envelope"></span>
          </div>

          <input type="submit" class="btn btn-primary" name="add_user" value="ADD">
        </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>



  </div>
</div>

<!--- Add
                                            tool modal--->

<!-- Modal -->
<div class="modal fade" id="edit_user" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add User</h4>
      </div>
      <div class="modal-body">
        <form action="gf/add_user.php" method="post">
          <div class="input">
            <input class="form-control" type="text" name="name" placeholder="Name" id="name" required="">

            <span class="fa fa-envelope"></span>
          </div>
          <div class="input">
            <input class="form-control" type="text" name="surname" placeholder="Surname" id="surname" required="">

            <span class="fa fa-unlock"></span>
          </div>
          <div class="input">
            <input class="form-control" type="text" name="user_id" placeholder="EC Number" id="user_id" required="" disabled>

            <span class="fa fa-envelope"></span>
          </div>
          <div class="input">
            <input class="form-control" type="email" name="email" placeholder="Email" id="email" required="">

            <span class="fa fa-envelope"></span>
          </div>
          <div class="input">
            <input class="form-control" type="text" name="role" placeholder="Role" id="role" required="">
            <span class="fa fa-envelope"></span>
          </div>

          <div class="input">
            <input class="form-control" type="text" name="password" placeholder="Change User Password" required="">
            <span class="fa fa-unlock"></span>
          </div>
          <input type="submit" class="btn btn-primary" name="edit_user" value="ADD">
        </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>



  </div>
</div>
<?php include 'gf/footer.php'; ?>