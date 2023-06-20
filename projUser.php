<?php
$sqlConnect = mysqli_connect("localhost", "root", "", "BorrowingSystem");
$result = mysqli_query($sqlConnect, "SELECT * FROM LoginCreds LIMIT 1");
// Check if query was successful
if ($result) {
    // Fetch row as an associative array
    $row = mysqli_fetch_assoc($result);

    // Store row data in a new array
    $loginData = array(
      'UserName' => $row['UserName'],
      'passWord' => $row['passWord'],
      'isAdmin' => $row['isAdmin'],
      'StudentID' => $row['StudentID']
    );

    // Free result set
    mysqli_free_result($result);
} else {
    // Query failed
    echo "Error executing query: " . mysqli_error($sqlConnect);
}

$UserName = $loginData['UserName'];
$passWord = $loginData['passWord'];
$StudentID = $loginData['StudentID'];
$servername = 'localhost';
$dbname = 'BorrowingSystem';

$sqlConnect = mysqli_connect($servername, $UserName, $passWord, $dbname);
    if (!$sqlConnect) {
        die("Connection failed: line 58 UserPHP" . mysqli_connect_error());
    }

// Get overdue borrowings
$sql = "SELECT * FROM BorrowingsTable WHERE StudentID = '$StudentID'";
$result = mysqli_query($sqlConnect, $sql);

// Display overdue borrowings if any
if (mysqli_num_rows($result) > 0) {
    echo "<h2>Overdue Borrowings:</h2>";
    echo "<table><tr><th>RequestID</th><th>StudentID</th><th>ItemName</th><th>ItemQuantity</th><th>RequestDate</th><th>ReturnedDate</th><th>Remarks</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" .$row["RequestID"] . "</td>";
        echo "<td>" .$row["StudentID"] . "</td>";
        echo "<td>" .$row["ItemName"] . "</td>";
        echo "<td>" .$row["ItemQuantity"] . "</td>";
        echo "<td>" .$row["RequestDate"] . "</td>";
        echo "<td>" .$row["ReturnedDate"] . "</td>";
        echo "<td>" .$row["Remarks"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<h2>No overdue borrowings.</h2>";
}

?>

<!DOCTYPE html>
<body style="background-color:#E4DFDA;"></body>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
       <!--<style>body{display: flex;
        justify-content: center; /*where the objects will be placed*/
        align-items: center;
        height: 100vh; /*bring height down*/
        width: 100vw;
        margin: 0px;

        }
		    .hidden {
			    display: none;
		    }
        </style>-->
</head>
<body>
<head>
	<style>
		body {
			background-color: #f2f2f2;
			font-family: Arial, sans-serif;
		}
	</style>
</head>
<head>
    <title>User Dashboard</title>
</head>
<body>
    <h1>Welcome to the User Dashboard</h1>
    <button onclick="location.href='projLogin.php'">Sign Out</button>
    <button onclick="location.href='projBorrowingForm.php'">Borrowing Form</button>

</body>
</html>
