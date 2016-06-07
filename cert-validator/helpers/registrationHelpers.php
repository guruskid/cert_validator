

<?php

require 'dbHelpers.php';


	function registerCert($details) 
	{
		$sql = "INSERT INTO certificate_details (cert_id, name,cert_no,cert_date) VALUES ('',:name,:cert_no,:cert_date)";
		$query = dbConnect()->prepare($sql);
                $query->bindParam(':name', $details['name']);
                $query->bindParam(':cert_no', $details['cert_no']);	
                $query->bindParam(':cert_date', $details['cert_date']);	

		return $query->execute();

	}
	
	function certExists($cert_no)
	{
		$sql = "SELECT * FROM certificate_details WHERE cert_no=:cert_no";
		$query = dbConnect()->prepare($sql);
                $query->bindParam(':cert_no', $cert_no);	
		$query->execute();
        	$row = $query->fetch();
		
		return count($row)>1;
		
	}
	
	function validateCert($details)
	{
		$cert_no_regex = '/^(?=.{6,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/';
	//	$email_regex = '/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/';
		
		if(!preg_match($cert_no_regex,$details['cert_no']))
			return 1;
	/*	if(!preg_match($email_regex,$details['email']))
			return 3;				
		if(strlen($details['password'])<8)
			return 2;	*/	

		return 0;
	}
function certDetails($cert_no)
	{
		$sql = "SELECT * FROM certificate_details WHERE cert_no=:cert_no";
		$query = dbConnect()->prepare($sql);
				$query->bindParam(':cert_no', $cert_no);
		$query->execute();
	if($row = $query->fetch())
		{
			
			return $row;
		}
		else
		{
			return null;
		}
		
	}

?>
