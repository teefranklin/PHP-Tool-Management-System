<?php include 'gf/header.php'; ?>
<?php

  include 'gf/database.php';
  $msg='Error Message will be displayed here !';
  $class='success';
if(isset($_GET['msg'])){
  $msg=$_GET['msg'];
  $class=$_GET['c'];
}
  $query="SELECT * FROM tools";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result=$statement->fetchAll();


?>

    <br><br><br>
    <div class="row container">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Tools</div>
                <div class="panel-body">
                <div class="alert alert-<?php echo $class; ?>">
                  <h4 align=center><?php echo $msg; ?></h4>
                </div>
                <a href="#" class="btn btn-info" data-toggle="modal" data-target="#borrow_tool"><i>Borrow</i></a>
                <?php if($_SESSION['role'] =='administrator') : ?>
                <a href="#" class="btn btn-info" data-toggle="modal" data-target="#add_tool"><i>Add</i></a>
                <?php endif ; ?>
                <br><br><br>
                    <table id="tools" class="table table-striped ">
                    <thead>
                            <th>Tool ID</th>
                            <th>Tool Name</th>
                            <th>Overall Quantity</th>
                            <th>Available Quantity</th>
                            <th>Status</th>
                            <?php if($_SESSION['role'] =='administrator') : ?>
                            <th>Action</th>
                            <?php endif ; ?>
                        </thead>
                        <tbody>
                          <?php  foreach( $result as $row) : ?>
                            <tr>
                                <td><?php echo $row["tool_id"]; ?></td>
                                <td><?php echo $row["tool_name"]; ?></td>
                                <td><?php echo $row["quantity"]; ?></td>
                                <td><?php echo $row["available_quantity"]; ?></td>
                                <td><?php if ($row["status"]== 1) :?>
                                 <span class="label label-success">Available</span>
                                 <?php else :?>
                                 <span class="label label-danger">Not Available</span>
                                 <?php endif;?>
                                </td>
                                <?php if($_SESSION['role'] =='administrator') : ?>
                                <td>
                                <a href="gf/delete_tool.php?id=<?php echo $row["tool_id"]; ?>" class="btn btn-danger"><i class="fa fa-bin"></i> DELETE</a></td>
                                <?php endif ; ?>
                            </tr>
                          <?php endforeach ; ?>  
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>


    <!--- Add tool modal--->
    
<!-- Modal -->
<div class="modal fade" id="add_tool" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Tool</h4>
      </div>
      <div class="modal-body">
        <form action="add_tool.php" method="post">
        <div class="input">
                  <input class="form-control" type="text" name="tool_id" placeholder="Tool ID" required=""> 
          <span class="fa fa-envelope"></span>
        </div>
        <div class="input">
                  <input class="form-control" type="text" name="tool_name" placeholder="Tool Name" required=""> 
          <span class="fa fa-unlock"></span>
        </div>
                  <div class="input">
                  <input class="form-control" type="number" name="quantity" placeholder="Quantity" required="" min=1 > 
          <span class="fa fa-envelope"></span>
        </div>
                  
        <input type="submit" class="btn btn-primary" name="add_tool" value="ADD">
      </div>
        </form>
     
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    
     

  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="borrow_tool" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Borrow Tool</h4>
      </div>
      <div class="modal-body">
        <form action="gf/borrow_tool.php" method="post">
        <div class="input">
                  <input class="form-control" type="text" name="tool_id" placeholder="Tool ID" required=""> 
          <span class="fa fa-envelope"></span>
        </div>
        <div class="input">
          <select name="department_name" id="" class="form-control">
                <?php
                    $query="SELECT * FROM department";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result=$statement->fetchAll();


                ?>
                <?php foreach($result as $row) : ?>
                    <option value="<?php echo $row['department_code'] ?>"><?php echo $row['department_name']; ?></option>
                <?php endforeach; ?>
            </select>
          </div>
        <div class="input">
          <select name="user_id" id="" class="form-control">
                <?php
                    $query="SELECT * FROM allowed_users";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result=$statement->fetchAll();


                ?>
                <?php foreach($result as $row) : ?>
                    <option value="<?php echo $row['user_id'] ?>"><?php echo $row['firstname'] . " ".$row['lastname']; ?></option>
                <?php endforeach; ?>
            </select>
          </div>
        <div class="input">
                  <input class="form-control" type="number" name="borrowed_quantity" placeholder="Quantity" required="" min=1 style="height:3em;"> 
          <span class="fa fa-arrow-up"></span>
        </div>
        <div class="input">
                  <input class="form-control" type="date" name="return_date" placeholder="Return Date" required="" style="height:3em;"> 
          <span class="fa fa-calendar"></span>
        </div>
                  
        <input type="submit" class="btn btn-primary" name="borrow" value="Borrow">
      </div>
        </form>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    
     

  </div>
</div>
<?php include 'gf/footer.php'; ?>