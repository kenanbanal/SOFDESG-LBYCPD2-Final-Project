<html lang='en'>
<body style="background-color:#E4DFDA;"></body>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registration Form</title>

             <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script> 
        <style>body{display: flex;
        justify-content: center; /*where the objects will be placed*/
        align-items: center;
        height: 100vh; /*bring height down*/
        width: 100vw;
        margin: 0px;

        }
		    .hidden {
			    display: none;
		    }
        </style>
    </head>
<h2>Registration Form</h2>
<body>
<form action="projRegister.php" method="POST">
    First Name: <input type="text" name="FirstName"><br>
    Last Name: <input type="text" name="LastName"><br>
    Username: <input type="text" name="UserName"><br>
    Email: <input type="email" name="email"><br>
    Password: <input type="password" name="passWord"><br>
    Confirm Password: <input type="password" name="passWord_confirm"><br>
    Admin: <input type="checkbox" name="isAdmin" id="isAdmin"><br> <!-- Add a checkbox input for signing up as an admin -->
    <div id="authPassword" class="hidden">
        <!-- Admin Authentication Password is hidden until Admin checkbox is ticked. -->
        Authentication Password: <input type="password" name="authPassword" /><br />
    </div>
    <input type="submit" name="submit" value="Register">
	<a href="projLogin.php" >Already have an account?</a>
</form>

    <?php
if(isset($_POST['submit'])){
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $UserName = $_POST['UserName'];
    $email = $_POST['email'];
    $passWord = $_POST['passWord'];
    $passWord_confirm = $_POST['passWord_confirm'];
    $isAdmin = isset($_POST['isAdmin']) ? 1 : 0; // Check if the checkbox is checked and set isAdmin variable accordingly
    $authPassword = isset($_POST['authPassword']) ? $_POST['authPassword'] : ''; }// Grab authPassword if exists

    if(empty($FirstName) || empty($LastName) || empty($UserName) || empty($email) || empty($passWord) || empty($passWord_confirm)){
        echo "Please fill in all fields.";
    } elseif($passWord !== $passWord_confirm){
        echo "Password and confirmation do not match.";
    } elseif ($isAdmin && $authPassword !== 'OrgaMoloRamosCPG2') { /*OrgaMoloRamosCPG2 is the authentication password*/
        echo "Invalid authentication password.";
    } else {
        $sqlConnect = mysqli_connect('localhost', 'root', '', 'BorrowingSystem');
        $sql = "INSERT INTO Records (FirstName, LastName, UserName, Email, Password, isAdmin) VALUES ('$FirstName', '$LastName', '$UserName', '$email', '$passWord', $isAdmin)";
        if(mysqli_query($sqlConnect, $sql)){ //Records is the Table Name
            echo "Registration successful!<br>";
        } else{
            echo "Error: " . $sql . "<br>" . mysqli_error($sqlConnect);
        }
        $sql = "CREATE USER '$UserName'@'localhost' IDENTIFIED BY '$passWord'";
        if(mysqli_query($sqlConnect, $sql)){ //Create admin_or_user with zero privileges
            echo "User created!<br>";
        } else{
            echo "Error: " . $sql . "<br>" . mysqli_error($sqlConnect);
        }
        if($isAdmin == 1) { /*If applying for admin, grant user with normal privileges*/
                $sql = "GRANT ALL PRIVILEGES ON BorrowingSystem.* TO '$UserName'@'localhost'";
                if(mysqli_query($sqlConnect, $sql)){
                    echo "You have been given ADMIN privileges!<br>";
                    $sql = "FLUSH PRIVILEGES";
                    mysqli_query($sqlConnect, $sql); //Save privileges
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($sqlConnect);
                }
            } elseif($isAdmin == 0) { /*If NOT applying for admin, grant ADMIN privileges*/
                $sql = "GRANT SELECT, INSERT, UPDATE, DELETE ON BorrowingSystem.BorrowingsTable TO '$UserName'@'localhost'";
                if(mysqli_query($sqlConnect, $sql)){ //Grant user non-admin privileges
                    echo "You have been given basic user privileges!<br>";
                    $sql = "FLUSH PRIVILEGES";
                    mysqli_query($sqlConnect, $sql); //Save privileges
                } else{
                echo "Error: isAdmin is " .$isAdmin. " " . $sql . "<br>" . mysqli_error($sqlConnect);
            }
        }
        mysqli_close($sqlConnect);
    }

    ?>
    <script>
        /* Script that hides/unhides the authentication field.*/
        const checkbox = document.getElementById('isAdmin');
		const field = document.getElementById('authPassword');

        checkbox.addEventListener('change', function () {
            console.log('I am here');
            console.log(this);
            console.log(this.checked);
			if (this.checked) {
				field.classList.remove('hidden');
			} else {
				field.classList.add('hidden');
			}
		});
    </script>
</body>
</html>
