<?php
include 'mainfile.php';
//checking if the data from the login form is submitted using isset function
if (!isset($_POST['email'], $_POST['password'])){
	//couldnot get the data submitted
	echo "<b>Error:</b>Please fill both Email and Password fields!";
}



if (isset($_POST["email"]) && isset($_POST["password"])) {
	$email = $_POST["email"];
	$password = $_POST["password"];

	if ($sql = "SELECT id, email, password, status FROM other_admin WHERE email = '$email'") {
		$result = $conn->query($sql);

		if ($result -> num_rows > 0) {
			//email exists
			$row = $result->fetch_assoc();

			//check if admin is verified
			if ($row["status"] == "Unverified") {
				//admin not verified
				echo "You are not verified, Please wait for Verification";

			} else if ($row["status"] == "Verified") {
				//admin is verified

				//verifying the password
			    if ($password == $row["password"]) {
				    //password verified
				    session_regenerate_id();
			        $_SESSION['loggedinADMIN'] = TRUE;
					$_SESSION['verified'] = $row["status"];
			        $_SESSION['idADMIN'] = $row["id"];
				    echo "Logged";

			    } else {
				    //wrong password
				    echo "Wrong password";
			    }
			}

		} else {
			//email does not exist
			echo "Email does not exists";
		}
	}
}

?>