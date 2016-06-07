
<?php
    function dbConnect(){
        try{
			// DB Config (Localhost)
            /*$username = 'root';
            $password = '';
            $conn = new pdo("mysql:host=localhost;dbname=accountsdb;", $username, $password);*/
			
		
            $username = 'root';
            $password = '';
            $conn = new pdo("mysql:host=localhost;dbname=accountsdb;", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;

        }   catch(PDOException $e){
            echo 'ERROR', $e->getMessage();
        }
    }
?>

