<?php include 'gf/header.php'; ?>
<?php
include 'gf/database.php';
  $msg='Error Message will be displayed here !';
  $class='success';
if(isset($_GET['msg'])){
  $msg=$_GET['msg'];
  $class=$_GET['c'];
}
  $query="SELECT * FROM department";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result=$statement->fetchAll();


?>
<br><br><br>
<div class="row container">
  <div class="col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">Departments</div>
      <div class="panel-body">
      <div class="alert alert-<?php echo $class; ?>">
                  <h4 align=center><?php echo $msg; ?></h4>
                </div>
                <a href="#" class="btn btn-info" data-toggle="modal" data-target="#add_department"><i>Add</i></a>
                    <br><br><br>
                    <table id="example1" class="table table-striped ">
                        <thead>
                            <th>Department Code</th>
                            <th>Department</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                        <?php foreach($result as $row) : ?>
                            <tr>
                                <td><?php echo $row['department_code']; ?></td>
                                <td><?php echo $row['department_name']; ?></td>
                                <td><a href="delete_department.php?id=<?php echo $row['id']; ?>" class="btn btn-danger"><i class="fa fa-bin"></i> DELETE</a</td> 
                            </tr>
                        <?php endforeach ; ?> 
                        </tbody>
                    </table> 
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="add_department" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Department</h4>
        </div>
        <div class="modal-body">
        <form action="add_department.php" method="post">
        <div class="input">
                    <input class="form-control" type="text" name="department_code" placeholder="Department Code" required=""> 
						<span class="fa fa-envelope"></span>
					</div>
					<div class="input">
                    <input class="form-control" type="text" name="department_name" placeholder="Department Name" required=""> 
						<span class="fa fa-unlock"></span>
					</div>
                    
                    
					<input type="submit" class="btn btn-primary" name="add_department" value="ADD">
        </div>
        </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<?php include 'gf/footer.php'; ?>