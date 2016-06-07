<?php
    session_start(); 
	
	require '../helpers/loginHelpers.php';
	
	    $errors = array(
	        1=>'Username or Password is incorrect!',
	        2=>'Please login before adding user!',
			3=>'Please enter valid username and password!',
			4=>'You have successfully logged out!'
	    );
	
	
	if($_SERVER['REQUEST_METHOD']=='POST') {
		if(isset($_POST['username'],$_POST['password'])) {
			if(checkUser($_POST['username'],$_POST['password'])) {
				$_SESSION['username'] = $_POST['username'];
				header('Location:index.php');
			} else {
				header('Location:login.php?err=1');
			}
		} else {	
			header('Location:login.php?err=3');
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
				<h1 class="text-center text-danger">
					Admin Panel
				</h1>
			</div>
		</div>
		<div class="col-md-2 column">
		</div>
	</div>        
                   

        
        <form class="form-signin" role="form" action="login.php" method="POST">
          <h2 class="form-signin-heading text-center text-muted">Sign In</h2><br>
          
        <label for="inputUsername" class="sr-only">Username</label>
        <input type="text" id="inputUsername" class="form-control" placeholder="Username" name="username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
        <?php if(isset($_GET['err'])){?><p class="text-danger text-center"><?=$errors[$_GET['err']]?></p><?php }?>
        <button class="btn btn-lg btn-primary btn-block btn-danger" type="submit">Sign in</button><br>
      </form>

    </div> 
	 <a href="www.googleshout.com"></a>
    <script src="../static/js/bootstrap.min.js"></script>
  </body>
</html>
