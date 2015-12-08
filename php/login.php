<?php
	// Connect to database
	require_once('mysql_connect.php');
	
	// Get variables
	$email = $_POST['Email'];
	$pass  = $_POST['Password'];
	
	// Get password from table
	$query = mysqli_query($con, "SELECT * FROM login WHERE Email='$email' LIMIT 1");
	
	if(mysqli_num_rows($query) > 0)
	{
		// Get row results
		$row = mysqli_fetch_assoc($query);
		
		// Check if passwords match
		if(verify($pass, $row["Password"]) )
		{
			// Correct password
			echo "Login info is correct.";
		}
		else
		{
			// Wrong password
			echo "Login info is incorrect.";
		}
	}
	else 
	{
		// Didn't find login info
		echo "Login info is incorrect.";
	}	
	
	// Close connection
	mysqli_close($con);
	
	// Function to check if passwords are the same
	function verify($password, $hashedPassword) {
		return crypt($password, $hashedPassword) == $hashedPassword;
	}
?>