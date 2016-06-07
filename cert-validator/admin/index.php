<?php
session_start();
	
	require '../helpers/registrationHelpers.php';
	
    $errors = array(
        1=>'Please enter a valid username',
        2=>'Please enter a valid password',
        3=>'Please enter a valid email address',
		4=>'Please complete the form',
		5=>'Certificate already exists',
		6=>'Certificate added successfully!'
    );
	
	$name = 'guest';
	
	if(!isset($_SESSION['username']))
		header('Location:login.php?err=2');
	else
		$name = $_SESSION['username'];
	
	
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		if(isset($_POST['name'],$_POST['cert_no'],$_POST['cert_date']))
		{
			$validCert = validateCert($_POST);
			if($validCert!=0)
				header('Location:index.php?err='.$validUser);
				
			if(!certExists($_POST['cert_no']))
			{
				registerCert($_POST); 
				header('Location:index.php?err=6');
			}
			else {
				header('Location:index.php?err=5');
			}
		}
		else
		{	
			header('Location:login.php?err=4');
		}
	}

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>

    <link href="../static/css/bootstrap.min.css" rel="stylesheet">
    <link href="../static/css/style.css" rel="stylesheet">

	<link rel="icon" href="../static/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="../static/favicon.ico" type="image/x-icon" />
	
  </head>
  <body>
    
    <div class="container">
        
	<div class="row clearfix center-block">
		<div class="col-md-2 column">
		</div>
		<div class="col-md-8 column">
			<div class="page-header">
					<h1 class="text-left text-danger">Hai <?php print $name;?>!</h1>
					<a href="logout.php" class="text-center">Logout</a>
			</div>
		</div>
		<div class="col-md-2 column">
		</div>
	</div>        

        
        <form class="form-signin" role="form" action="index.php" method="POST">
          <h2 class="form-signin-heading text-center text-muted">Enter Certificate Details</h2><br>
        <label for="inputUsername" class="sr-only">Name</label>
        <input type="text" id="inputUsername" class="form-control" placeholder="Name" name="name" required autofocus>
        <label for="inputEmail" class="sr-only">Certificate No.</label>
        <input type="text" id="inputEmail" class="form-control" placeholder="Certificate No" name="cert_no" required>    
		 <label for="inputEmail" class="sr-only">Certification Date</label>
        <input type="date" id="inputEmail" class="form-control" placeholder="Certification Date YYYY-MM-DD" name="cert_date" required>    
		<?php if(isset($_GET['err'])){?><p class="text-danger text-center"><?=$errors[$_GET['err']]?></p><?php }?>
        <button class="btn btn-lg btn-primary btn-block btn-danger" type="submit">Add Certificate</button><br>
      </form>

    </div> 
	 <a href="www.googleshout.com"></a>
    <script src="../static/js/jquery.min.js"></script>
    <script src="../static/js/bootstrap.min.js"></script>
	<script src="../static/js/typeahead.js"></script>
	<script src="../static/js/script.js"></script>
  </body>
</html>
