<?php include 'gf/header.php'; ?>
<?php

  include 'gf/database.php';
  $msg='Error Message will be displayed here !';
  $class='success';
if(isset($_GET['msg'])){
  $msg=$_GET['msg'];
  $class=$_GET['c'];
}
  $query="SELECT * FROM borrowed_tools";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result=$statement->fetchAll();


?>

    <br><br><br>
    <div class="row container-fluid">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Borrowed Tools</div>
                <div class="panel-body">
                <div class="alert alert-<?php echo $class; ?>">
                  <h4 align=center><?php echo $msg; ?></h4>
                </div>
               
                    <table id="borrowed_tools" class="table">
                    <thead>
                            <th>Tool ID</th>
                            <th>Borrowed From</th>
                            <th>By</th>
                            <th>Quantity Borrowed</th>
                            <th>Return Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                          <?php  foreach( $result as $row) : ?>
                            <tr>
                                <td><?php echo $row["tool_id"]; ?></td>
                                <td><?php echo $row["department_code"]; ?></td>
                                <?php
                                    $query="SELECT * FROM allowed_users where user_id='".$row['user_id']."'";
                                    $statement = $connect->prepare($query);
                                    $statement->execute();
                                    $user=$statement->fetchAll();

                                    foreach($user as $u){
                                      $name=$u['firstname'] ." ".$u['lastname'];
                                    }
                                ?>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $row["quantity_borrowed"]; ?></td>
                                <td><?php echo $row["return_date"]; ?></td>
                                <?php
                                  $output='';
                                  if ($row["status"]== 'returned'){
                                      $output='<span class="label label-success">Returned</span>';
                                  }else if($row["status"]== 'overdue'){
                                      $output='<span class="label label-danger">overdue</span>';
                                  }else{
                                    $output='<span class="label label-danger">Not Returned</span>';
                                  }
                                ?>
                                <td><?php echo $output; ?>
                                </td>
                                <td><a href="return_tool.php?id=<?php echo $row['id']; ?> " class="btn btn-primary"><i class="fa fa-pencil"></i> Return Tool</a> &nbsp;&nbsp;
                                <?php if($_SESSION['role'] =='administrator') : ?>
                                <a href="gf/delete_borrowed.php?id=<?php echo $row['tool_id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i> DELETE</a>
                                <?php endif ; ?>
                              </td>
                            </tr>
                          <?php endforeach ; ?>  
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

<?php include 'gf/footer.php'; ?>