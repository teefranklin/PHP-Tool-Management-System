
<?php
  include "gf/database.php";
	//include "navbar.php";
	//$conn = OpenCon();
//echo "Connected Successfully";
//CloseCon($conn);
?>
 <?php
session_start();

if(isset($_POST['signin']))
{

$username=$_POST['user_id'];
$password=trim($_POST['password']);
$query="SELECT * FROM user_login where user_id='$username'";
  $statement = $connect->prepare($query);
	$statement->execute();
	$count=$statement->rowCount();
	$result=$statement->fetchAll();
	if($count>0){
		foreach($result as $row){
			if(password_verify($password,$row['password'])){
				$_SESSION['user_id']=$row['user_id'];
				$_SESSION['username']=$row['name'].' '.$row['surname'];
				$_SESSION['role']=$row['role'];
				header('Location:tool.php');
			}else{
				echo "<script type='text/javascript'> alert('wrong password');</script>";
			}
			
		}
	}else{
		echo "<script type='text/javascript'> alert('wrong username');</script>";
	}
	

//echo "<script>alert('Zvaita');</script>";

}

?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
	<title>ZPC Login</title>
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<meta name="keywords" content="Latest Login Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- Meta tag Keywords -->

	<!-- css files -->
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<!-- Style-CSS -->
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<!-- Font-Awesome-Icons-CSS -->
	<!-- //css files -->

	<!-- web-fonts -->
	<link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
	 rel="stylesheet">
	<!-- //web-fonts -->
</head>

<body>
	<div class="main-bg">
		<!-- title -->
		<h1></h1>
		<!-- //title -->
		<!-- content -->
		<div class="sub-main-w3">
			<div class="bg-content-w3pvt">
				<div class="top-content-style">
					<img src="images/logo.png" alt="" />
				</div>
				<form action="" method="post" name="signin">
					<p class="legend">Login Here<span class="fa fa-hand-o-down"></span></p>
					<div class="input">
                    <input class="form-control" type="text" name="user_id" placeholder="Username" required=""> 
						<span class="fa fa-envelope"></span>
					</div>
					<div class="input">
                    <input class="form-control" type="password" name="password" placeholder="Password" required=""> 
						<span class="fa fa-unlock"></span>
					</div>
					<button type="submit" class="btn submit" name="signin">
						<span class="fa fa-sign-in"></span>
					</button>
				</form>
				
			</div>
		</div>
		
    </div>
  
</body>

</html>