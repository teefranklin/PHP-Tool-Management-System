<?php include 'gf/header.php'; ?>
<?php
include 'gf/database.php';
  $msg='Error Message will be displayed here !';
  $class='success';
if(isset($_GET['msg'])){
  $msg=$_GET['msg'];
  $class=$_GET['c'];
}
  $query="SELECT * FROM allowed_users";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result=$statement->fetchAll();


?>
<br><br><br>
<div class="row container">
  <div class="col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">Allowed Users</div>
      <div class="panel-body">
      <div class="alert alert-<?php echo $class; ?>">
                  <h4 align=center><?php echo $msg; ?></h4>
                </div>
        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#add_user"><i>Add</i></a>
        <br><br><br>
        <table id="users" class="table">
          <thead>
            <th>EC Number</th>
            <th>Username</th>
            <th>Email</th>
            <th>Department</th>
            <th>position</th>
            <?php if($_SESSION['role'] =='administrator') : ?>
            <th>Action</th>
            <?php endif ; ?>
          </thead>
          <tbody>
            <?php foreach($result as $row) : ?>
            <tr>
              <td><?php echo $row['user_id']; ?></td>
              <td><?php echo $row['firstname']. ' '.$row['lastname']; ?></td>
              <td><?php echo $row['email']; ?></td>
              <td><?php echo $row['department_code']; ?></td>
              <td><?php echo $row['role']; ?></td>

              <td>
              <?php if($_SESSION['role'] =='administrator') : ?>
              <a href="gf/delete_allowed_user.php?id=<?php echo $row['user_id']; ?>" class="btn btn-danger"><i class="fa fa-bin"></i> DELETE</a></td>
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
        <form action="gf/add_allowed.php" method="post">
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
            <input class="form-control" type="text" name="role" placeholder="position" required="">
            <span class="fa fa-envelope"></span>
          </div>
          <div class="input">
          <select name="department" id="" class="form-control">
                <?php
                    $query="SELECT * FROM department";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result=$statement->fetchAll();


                ?>
                <?php foreach($result as $row) : ?>
                    <option value="<?php echo $row['department_code'] ?>"><?php echo $row['department_name'] ?></option>
                <?php endforeach; ?>
            </select>
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

<?php include 'gf/footer.php'; ?>