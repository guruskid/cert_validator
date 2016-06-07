<?php
	session_start(); 
	require 'helpers/registrationHelpers.php';
	
    $errors = array(
        1=>'Please enter a valid username',
        2=>'Please enter a valid password',
        3=>'Please enter a valid email address',
		4=>'Please Enter a Certificate No.',
		5=>'This is a Valid Certificate!',
		6=>'Certificate does not Exists!'
    );
	
	$name = 'guest';
	$cert_no='';
	
	
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		if(isset($_POST['cert_no']))
		{
			$validCert = validateCert($_POST);

			if($validCert!=0)
				header('Location:index.php?err='.$validCert);
				
			if(!certExists($_POST['cert_no']))
			{
				header('Location:index.php?err=6');
			}
			else {
				
				certDetails($_POST['cert_no']);
				
				
			/*	$_SESSION['cert_no'] = $_POST['cert_no'];
			$cert_no = $_SESSION['cert_no']; */
				header('Location:index.php?err=5');
			}
		}
		else
		{	
			header('Location:index.php?err=4');
		}
		
	}

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Certificate Validator</title>
    <link href="static/css/bootstrap.min.css" rel="stylesheet">
    <link href="static/css/style.css" rel="stylesheet">

	<link rel="icon" href="static/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="static/favicon.ico" type="image/x-icon" />
	
  </head>
  <body>
    
    <div class="container">
        
	<div class="row clearfix center-block">
		<div class="col-md-2 column">
		</div>
		 <a href="www.googleshout.com"></a>
		<div class="col-md-8 column">
			<div class="page-header">
					<h1 class="text-left text-danger">Hai <?php print $name;?>!</h1>
			</div>
		</div>
		<div class="col-md-2 column">
		</div>
	</div>        
        <form class="form-signin" role="form" action="cert.php" method="POST">
          <h2 class="form-signin-heading text-center text-muted">Enter Certificate Details</h2><br>
       <label for="inputEmail" class="sr-only">Certificate No</label>
        <input type="text" id="inputEmail" class="form-control" placeholder="Certificate No" name="cert_no" required>    
		<?php if(isset($_GET['err'])){?><p class="text-danger text-center"><?=$errors[$_GET['err']]?></p><?php }?>
		 <button class="btn btn-lg btn-primary btn-block btn-danger" type="submit">Validate Certificate</button><br>
      </form>
    </div> 
    <script src="static/js/jquery.min.js"></script>
    <script src="static/js/bootstrap.min.js"></script>
	<script src="static/js/typeahead.js"></script>	
	<script src="static/js/script.js"></script>
  </body>
</html>
