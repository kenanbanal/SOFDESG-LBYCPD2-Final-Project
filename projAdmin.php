<!DOCTYPE html>
<html>
<body style="background-color:#E4DFDA;"></body>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up</title>

             <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script> 
		
		<!----
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
		------->
</head>   
<body>
	<h1>Admin Dashboard</h1>
	<table>
		<button onclick="goToBorrowingForm()">Edit</button> <!-- Button for editing table -->
	</table>

	<h2>Borrowings Table</h2>
	<table border="1">
		<tr>
			<th>Request ID</th>
			<th>Student ID</th>
			<th>Item Name</th>
			<th>Quantity</th>
			<th>Request Date</th>
			<th>Returned Date</th>
			<th>Remarks</th>
		</tr>

		<button onclick="location.href='projLogin.php'">Sign Out</button>
		<?php
			// Connect to MySQL database
			$conn = mysqli_connect("localhost", "root", "", "BorrowingSystem");

			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			// Fetch data from BorrowingsTable
			$sql = "SELECT * FROM BorrowingsTable";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// Output data of each row
				while($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td>" . $row["RequestID"] . "</td>";
					echo "<td>" . $row["StudentID"] . "</td>";
					echo "<td>" . $row["ItemName"] ."</td>";
					echo "<td>" . $row["ItemQuantity"] . "</td>";
					echo "<td>" . $row["RequestDate"] . "</td>";
					echo "<td>" . $row["ReturnedDate"] . "</td>";
					echo "<td>" . $row["Remarks"] . "</td>";
					echo "</tr>";
					}
				echo "</table>";
				} else {
					echo "0 results";
				}
			$conn->close();
        ?>
	<script>
		function goToBorrowingForm() {
			header('Location: projBorrowingForm.php');
			exit();
		}
    </script>
</body>
					
</html>
					
					
					
					