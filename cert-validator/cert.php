<?php
	session_start(); 
	require 'helpers/registrationHelpers.php';
    
	
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
        $cert_no = $_POST['cert_no'];
}
		
		
	/*	else
		{
			return null;
		}*/
			
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
    <title>Certificate Details</title>

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
		<div class="col-md-8 column">
			<div class="page-header">
					<h1 class="text-left text-danger">Hai <?php print $name;?>!</h1>
			</div>
		</div>
		<div class="col-md-2 column">
		</div>
	</div>        
         <a href="www.googleshout.com"></a>
          <h2 class="form-signin-heading text-center text-muted"><b>Certificate Details</b></h2><br>
		  <h3 class="form-signin-heading text-center text-muted">
	<?php	  $query = dbConnect()->prepare("SELECT * FROM certificate_details WHERE cert_no=:cert_no");
		
        	$query->bindParam(':cert_no', $cert_no);	
		
		$query->execute();
		
        /*	if($row = $query->fetch())
		{
			return array(
				'name' => $row['name'],
				'cert_no' => $row['cert_no'],
				'cert_date' => $row['cert_date']
			);
		}*/
		while($row = $query->fetch(PDO::FETCH_LAZY)){

    echo '<div>';
    echo $row['name'];
	echo '<br/>';
    echo $row['cert_no'];
	echo '<br/>';
    echo $row['cert_date'];
	echo '<br/>';
    echo '</div>';
		} ?>
		  </h3><br>
       <label for="inputEmail" class="sr-only">Certificate No</label>
	    <label for="inputEmail" class="sr-only">
		</label>
		   <label for="inputEmail" class="sr-only">Name</label>
	    <label for="inputEmail" class="sr-only"><?php print $name;?></label>
     <form class="form-signin" role="form" action="cert.php" method="POST">
		 <button class="btn btn-lg btn-primary btn-block btn-danger" type="submit">Validate Another Certificate</button><br>
      </form>
    </div> 
    <script src="static/js/jquery.min.js"></script>
    <script src="static/js/bootstrap.min.js"></script>
	<script src="static/js/typeahead.js"></script>
	<script src="static/js/script.js"></script>
  </body>
</html>
