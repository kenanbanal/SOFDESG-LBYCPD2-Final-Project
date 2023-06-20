<html>
<body style="background-color:#E4DFDA;"></body>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	</head>
<body>

<h1>Login</h1>
<fieldset>

<form name="LoginForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	<label for="username" class = "">Username:</label><input type='text' name='user' required><br> 
	<label>Password:</label><input type='password' name='pass' required><br>
	<label>Admin?</label><input type='checkbox' name='isAdmin' value='1'><br>
	<input type="submit" name="submit" value="Login"><br>
	"Don't have an account yet? Click <a href='projRegister.php'>here</a> to register."<br>
</form> 
	</fieldset>
    <?php
if (isset ($_POST["submit"])){
	$form_user = $_POST['user'];
	$form_pass = $_POST['pass'];
	if (isset($_POST['isAdmin'])) {
		$form_isAdmin = 1;
    } else {
		$form_isAdmin = 0;
    }
	$sqlConnect = mysqli_connect('localhost', 'root', '', 'BorrowingSystem'); //Temporarily store login credentials
    if ($sqlConnect) {
		//Clear table if any data exists
		if (!mysqli_query($sqlConnect, "TRUNCATE TABLE LoginCreds")) {
			echo "Error: " . $sql . "<br>" . mysqli_error($sqlConnect);
        }
		//Retrieve user's saved StudentID
		$sql = "SELECT StudentID FROM Records WHERE UserName='$form_user'";

        // Execute the query and retrieve the result set
        $result = $sqlConnect->query($sql);

		// Fetch the StudentID from the result set
		$StudentID = $result->fetch_assoc()['StudentID'];

		//Temporarily store user's login credentials in a table
		$sql = "INSERT INTO LoginCreds (UserName, passWord, isAdmin, StudentID) VALUES ('$form_user', '$form_pass', $form_isAdmin, $StudentID)";
		if(!mysqli_query($sqlConnect, $sql)){ // If insert error: display error...
            die("Connection failed: line 130 LoginPHP" . mysqli_connect_error());
		} 
    }
	$sqlConnectUser = mysqli_connect('localhost', $form_user, $form_pass, 'BorrowingSystem');
	if ($sqlConnectUser) {
		echo 'Connection successful!';
	} else {
		die("Connection failed: line 137 LoginPHP" . mysqli_connect_error());
    }

	$sqlConnect = mysqli_connect('localhost', 'root', '', 'BorrowingSystem');
	$query = "SELECT * FROM Records WHERE UserName='$form_user' AND passWord='$form_pass' AND isAdmin='$form_isAdmin'";
	$result = mysqli_query($sqlConnect, $query);

	if (mysqli_num_rows($result) > 0) {
		$data = mysqli_fetch_array($result);
		if ($data['isAdmin'] == '1') {
			header('Location: projAdmin.php');
			exit();
		} elseif ($data['isAdmin'] == '0') {
			header('Location: projUser.php');
			exit();
		} else {
			echo "Admin authentication check failed.";
			exit();
		}
	}
	else {
		echo "Invalid username or password.<br>";
	}

	mysqli_close($sqlConnect);
}


    ?>
</body>
</html>