<?php
	
require 'helpers/dbHelpers.php';
	function certDetails($cert_no)
	{
		$sql = "SELECT * FROM certificate_details WHERE cert_no=:cert_no";
		$query = dbConnect()->prepare($sql);
				$query->bindParam(':cert_no', $cert_no);
		$query->execute();
	if($row = $query->fetch())
		{
			return array(
				'name' => $row['name'],
				'cert_no' => $row['cert_no'],
				'cert_date' => $row['cert_date']
			);
		}
		else
		{
			return null;
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
		<div class="col-md-8 column">
			<div class="page-header">
					<h1 class="text-left text-danger">Hai <?php certDetails($cert_no); print $cert_date;?>!</h1>
			</div>
		</div>
		<div class="col-md-2 column">
		</div>
	</div>        

         <a href="www.googleshout.com"></a>
        <form class="form-signin" role="form" action="index.php" method="POST">
          <h2 class="form-signin-heading text-center text-muted">Enter Certificate Details</h2><br>
       <label for="inputEmail" class="sr-only">Certificate No</label>
	   
        <input type="text" id="inputEmail" class="form-control" placeholder="Certificate No" name="cert_no" required>    
		<button class="btn btn-lg btn-primary btn-block btn-danger" type="submit">Validate Certificate</button><br>
      </form>

    </div> 
    <script src="static/js/jquery.min.js"></script>
    <script src="static/js/bootstrap.min.js"></script>
	<script src="static/js/typeahead.js"></script>
	<script src="static/js/script.js"></script>
  </body>
</html>
