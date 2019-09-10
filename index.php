<?php
	function validateString($query){ // method for detection SQL Injection
		/*queryString generates the raw template from the query*/
		$queryString = '';
		$count = 0;
		$queryVal = str_split($query);
		foreach ($queryVal as $char) {
			if($char == "'"){
				if($count == 0) {
					$queryString .= "'";
					$count = $count + 1;
					continue;
				}
				else{
					$queryString .= "'";
					$count = $count - 1;
					continue;
				}
			}
			if($count == 0) {
				$queryString .= $char;
			}
		}
		
		/*Expected template for the string to match*/
		$template = "SELECT * FROM users WHERE email ='' AND password = '';";
		$length = strlen($template);
		
		/*Compare queryString and template to check for the injection attack*/
		for ( $i = 0; $i < $length; $i++) {
			if($template[$i] != $queryString[$i])
				return 1;
		}	
		return 0;
	}
    
	include 'connection.php';
    
	// formation of query using the user inputs
	$query = "SELECT * FROM users WHERE email ='" .$_POST['email']. "' AND password = '".$_POST['password']."';";
	
	// checking for SQL Injection
	$check = validateString($query);
	
	/*All the activities will be logged into log.txt file*/
	$fp = fopen('log.txt', 'a');
	
	// remove comments to work as IPS 
	//if(check != 1){
		$val = mysqli_query($db, $query.PHP_EOL); // fires the formed query to database
	//}
	//else{
	//	echo "<script type='text/javascript'>alert('SQL Injection Attack! Not allowed to login');window.location = 'index.html'</script>";
	//}
	
	
	$result = mysqli_fetch_array($val);
    if(count($result) >= 1){
		if($check == 1) {
			fwrite($fp, "Successful Login!!SQL injection attack" . PHP_EOL . $query . PHP_EOL);
			fclose($fp);
			echo "<script type='text/javascript'>alert('Login successful!! SQL Injection Attack');window.location = 'index.html'</script>";
		}
		else {
			fwrite($fp, "Successful Login!!" . PHP_EOL . $query . PHP_EOL);
			fclose($fp);
			echo "<script type='text/javascript'>alert('Login successful!!');window.location = 'index.html'</script>";
		}	
	}
	else{
		if($check == 0) {
			fwrite($fp, "Login Failed" . PHP_EOL . $query . PHP_EOL);
			fclose($fp);
        	echo "<script type='text/javascript'>alert('Username or Password maybe wrong!!');window.location = 'index.html'</script>";
		}	
		else {
			fwrite($fp, "Login Failed!! Tried injecting SQL" . PHP_EOL . $query . PHP_EOL);
			fclose($fp);
        	echo "<script type='text/javascript'>alert('SQL Injection attack!!Username or Password maybe wrong!!');window.location = 'index.html'</script>";
			
		}
		
	}
?>
