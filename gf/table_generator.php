<?php
include 'database.php';
session_start();

  if(isset($_POST['view_details'])){
    $tool_id=$_POST['tool_id'];
    $from=$_POST['from'];
    $to=$_POST['to'];
    $dep=$_POST['department_name'];
    $status=$_POST['status'];
    $borrower=$_POST['user_id'];
    
    //$query = "SELECT * FROM borrowed_tools where borrow_date between $from and $to and department_code='$dep' and status='$status' and user_id='borrower' ";
    if($tool_id !='' && $dep !='#' && $status !='#' && $borrower !='#' && $from !='' && $to !=''){
      $query = "SELECT * FROM borrowed_tools where borrow_date between '$from' and '$to' and tool_id='$tool_id' and department_code='$dep' and status='$status' and user_id='$borrower'";
      $statement = $connect->prepare($query);
      $statement->execute();
      $result = $statement->fetchAll();
    }else if( $dep !='#' && $status !='#' && $borrower !='#' && $from !='' && $to !=''){
      //without tool id
      $query = "SELECT * FROM borrowed_tools where borrow_date between '$from' and '$to' and department_code='$dep' and status='$status' and user_id='$borrower'";
      $statement = $connect->prepare($query);
      $statement->execute();
      $result = $statement->fetchAll();
    }else if($tool_id !='' && $dep !='#' && $status !='#' && $borrower !='#' ){
      //without dates
      $query = "SELECT * FROM borrowed_tools where tool_id='$tool_id' and department_code='$dep' and status='$status' and user_id='$borrower'";
      $statement = $connect->prepare($query);
      $statement->execute();
      $result = $statement->fetchAll();
    }else if($tool_id !='' && $dep !='#' && $borrower !='#' && $from !='' && $to !=''){
      //without status
      $query = "SELECT * FROM borrowed_tools where borrow_date between '$from' and '$to' and tool_id='$tool_id' and department_code='$dep' and user_id='$borrower'";
      $statement = $connect->prepare($query);
      $statement->execute();
      $result = $statement->fetchAll();
    }else if($tool_id !='' && $dep !='#' && $status !='#' && $from !='' && $to !=''){
      //without borrower
      $query = "SELECT * FROM borrowed_tools where borrow_date between '$from' and '$to' and tool_id='$tool_id' and department_code='$dep'";
      $statement = $connect->prepare($query);
      $statement->execute();
      $result = $statement->fetchAll();
    }else if($tool_id !='' && $status !='#' && $borrower !='#' && $from !='' && $to !=''){
      //without department
      $query = "SELECT * FROM borrowed_tools where borrow_date between '$from' and '$to' and tool_id='$tool_id' and department_code='$dep' and status='$status' and user_id='$borrower'";
      $statement = $connect->prepare($query);
      $statement->execute();
      $result = $statement->fetchAll();
    }else if($tool_id !='' && $from !='' && $to !=''){
      //with tool id and dates
      $query = "SELECT * FROM borrowed_tools where borrow_date between '$from' and '$to' and tool_id='$tool_id'";
      $statement = $connect->prepare($query);
      $statement->execute();
      $result = $statement->fetchAll();
    }else if($from !='' && $to !='' ){
      //with dates only                                                
      $query = "SELECT * FROM borrowed_tools where borrow_date between '$from' and '$to' ";
      $statement = $connect->prepare($query);
      $statement->execute();
      $result = $statement->fetchAll();
    }else if($tool_id !='' ){
      //with tool id only
      $query = "SELECT * FROM borrowed_tools where  tool_id='$tool_id' ";
      $statement = $connect->prepare($query);
      $statement->execute();
      $result = $statement->fetchAll();
    }else if($borrower !='#' ){
      //with dep only
      $query = "SELECT * FROM borrowed_tools where  user_id='$borrower' ";
      $statement = $connect->prepare($query);
      $statement->execute();
      $result = $statement->fetchAll();
    }else if($dep !='#' ){
      //with dep only
      $query = "SELECT * FROM borrowed_tools where  department_code='$dep' ";
      $statement = $connect->prepare($query);
      $statement->execute();
      $result = $statement->fetchAll();
    }else if($status !='' ){
      //with status only
      $query = "SELECT * FROM borrowed_tools where  status='$status' ";
      $statement = $connect->prepare($query);
      $statement->execute();
      $result = $statement->fetchAll();
    }  
    $output='<table  class="table table-striped" id="generated">
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
    ';
    foreach($result as $row){
        $output.="<tr>
                      <td>".$row['tool_id']."</td>
                      <td>".$row['department_code']."</td>
                      <td>".$row['user_id']."</td>
                      <td>".$row['quantity_borrowed']."</td>
                      <td>".$row['borrow_date']."</td>
                      <td>".$row['return_date']."</td>
                      <td>".$row['status']."</td>
                  </tr>
        ";               
    }
  $output.='</tbody>
  </table>';
  }
  $_SESSION['results']=$output;
  $_SESSION['result']=$result;
  header('Location:../reports.php');