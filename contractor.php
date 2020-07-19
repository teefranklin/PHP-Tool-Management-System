<?php include 'gf/header.php'; ?>
<?php
include 'gf/database.php';
  $msg='Error Message will be displayed here !';
  $class='success';
if(isset($_GET['msg'])){
  $msg=$_GET['msg'];
  $class=$_GET['c'];
}
  $query="SELECT * FROM contractors";
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
        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#add_contractor"><i class="fa fa-plus"> Add</i></a>
        <br><br><br>
        <table id="users" class="table">
          <thead>
            <th>ID</th>
            <th>Fullname</th>
            <th>Email</th>
            <?php if($_SESSION['role'] =='administrator') : ?>
            <th>Action</th>
            <?php endif ; ?>
          </thead>
          <tbody>
            <?php foreach($result as $row) : ?>
            <tr>
              <td><?php echo $row['contractor_id']; ?></td>
              <td><?php echo $row['name']; ?></td>
              <td><?php echo $row['email']; ?></td>


              <td>
              <?php if($_SESSION['role'] =='administrator') : ?>
              <a href="gf/delete_contractor.php?id=<?php echo $row['contractor_id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i> DELETE</a>
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

<!-- Modal -->
<div class="modal fade" id="add_contractor" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Contractor</h4>
      </div>
      <div class="modal-body">
        <form action="gf/add_contractor.php" method="post">
          <div class="input">
            <input class="form-control" type="text" name="name" placeholder="Name" id="name" required="">

            <span class="fa fa-envelope"></span>
          </div>
          <div class="input">
            <input class="form-control" type="email" name="email" placeholder="Email" id="email" required="">

            <span class="fa fa-envelope"></span>
          </div>
          <input type="submit" class="btn btn-primary" name="add_contractor" value="ADD">
        </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>



  </div>
</div>
<?php include 'gf/footer.php'; ?>