<?php include 'gf/header.php'; ?>
<?php
include 'gf/database.php';
$msg = 'Error Message will be displayed here !';
$class = 'success';
if (isset($_GET['msg'])) {
  $msg = $_GET['msg'];
  $class = $_GET['c'];
}


?>
<br><br><br>
<div class="row container">
  <div class="col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">Reports</div>
      <div class="panel-body">
        <form action="gf/table_generator.php" method="post">
          <div class="row">
            <div class="col-md-4">
            <label for=""><b>Report Type</b></label>
              <select name="report_type" id="report_type" class="form-control">
                <option value="#" selected>Choose Report Type</option>
                <option value="borrow">Borrow Report</option>
                <option value="user">User Report</option>
              </select>
            </div>
          </div>
          <br>
          <div class="filters">
              <div class="row">
                <div class="col-md-1">
                  <label for=""><b>Tool Id:</b></label>
                </div>
                <div class="col-md-3">
                  <input type="text" name="tool_id" id="" class="form-control" placeholder="Tool Id">
                </div>
                <div class="col-md-1">
                  <label for=""><b>From:</b></label>
                </div>
                <div class="col-md-3">
                  <input type="date" name="from" id="" class="form-control" placeholder="Tool Id">
                </div>
                <div class="col-md-1">
                  <label for=""><b>to:</b></label>
                </div>
                <div class="col-md-3">
                  <input type="date" name="to" id="" class="form-control" placeholder="Tool Id">
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-2">
                  <label for=""><b>Department:</b></label>
                </div>
                <div class="col-md-2">
                  <select name="department_name" id="" class="form-control">
                  <option value="#">Choose Department</option>
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
                <div class="col-md-1">
                  <label for=""><b>Status:</b></label>
                </div>
                <div class="col-md-3">
                  <select name="status" id="" class="form-control">
                        <option value="#">Choose Status</option>
                        <option value="returned">Returned</option>
                        <option value="not returned">Not Returned</option>
                        <option value="overdue">Overdue</option>
                    </select>
                </div>
                <div class="col-md-1">
                  <label for=""><b>Borrower:</b></label>
                </div>
                <div class="col-md-3">
                  <select name="user_id" id="" class="form-control">
                        <option value="#">Choose Borrower</option>
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
              </div>
              <br>
              <input type="submit" name="view_details" id="search" class="btn btn-primary" value="View Items">
            </div>
            
        </form>

        <br>
        <hr>
        <a href="pdf/practice.php" class="btn btn-primary pull-right">Generate Report</a>
        <br>
        <div id="my_table">
        <?php if(!isset($_SESSION['results'])) : ?>
          <br>
          <table class="table table-striped" id="">
            <thead>
              <th>Tool ID</th>
              <th>Borrowed From</th>
              <th>By</th>
              <th>Quantity</th>
              <th>Borrow Date</th>
              <th>Return Date</th>
              <th>Status</th>
            </thead>
            <tbody>

            </tbody>
          </table>
          
            <?php else:   ?>
            <br>
                <?php echo $_SESSION['results'];  ?>
          <?php endif ; ?>
        </div>
      </div>
    </div>
  </div>
  <?php include 'gf/footer.php'; ?>