<html>
<body style="background-color:#E4DFDA;"></body>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Borrowing Form</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script> 
        <style>
        
        body{display: flex;
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
<body>
    <h2>Borrowing Form</h2>
<!---->
    <form action="projBorrowingForm.php" method="POST">
        Item Name: <input type="text" name="ItemName"><br>
        Quantity: <input type="number" name="quantity"><br>
        <input type="submit" name="add" value="Add">
        <input type="submit" name="edit" value="Edit">
        <input type="submit" name="delete" value="Delete">
        <input type="submit" name="placeOrder" value="Place Order">
        <input type="submit" name="select" value="Select">
        <br>
        <input type="submit" name="totalBorrowed" value="Total Borrowed">
        <a href="projUser.php">Go to Main Menu</a>
    </form>

    <?php
    // Connect to MySQL server
    $conn = mysqli_connect("localhost", "username", "password", "BorrowingSystem");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if form submitted
    if(isset($_POST['add'])){
        $ItemName = $_POST['ItemName'];
        $quantity = $_POST['quantity'];

        /* Check if material exists
        $sql = "SELECT * FROM ItemsTable WHERE ItemName='$ItemName'"; //itemsTable is table name
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Item exists, add to borrowing list
            $row = mysqli_fetch_assoc($result);
            $itemID = $row['ItemID'];

            // Check if item is available
            if($row['Quantity'] >= $quantity) {
                // Item is available, add to borrowing list
                $sql = "INSERT INTO BorrowingsTable (ItemID, Quantity) VALUES ('$itemID', '$quantity')";
                mysqli_query($conn, $sql);
                echo "Item added to borrowing list.";
            } else {
                // Item is not available
                echo "Item is not available.";
            }
        } else {
            // Item does not exist
            echo "Item does not exist.";
        }
    } elseif(isset($_POST['edit'])){
        // TODO: Edit borrowing list item
    } elseif(isset($_POST['delete'])){
        // TODO: Delete borrowing list item
    } elseif(isset($_POST['placeOrder'])){
        // TODO: Place order for borrowing list items
    } elseif(isset($_POST['select'])){
        // TODO: Select item from ItemsTable
    } elseif(isset($_POST['totalBorrowed'])){*/
        // Get total number of items being borrowed
        $sql = "SELECT SUM(Quantity) AS TotalBorrowed FROM BorrowingsTable"; //table name for borrowing history
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $totalBorrowed = $row['TotalBorrowed'];
        echo "Total borrowed items: $totalBorrowed";
    }
// MODIFY CODE HERE THAT ADDS CURRENT USER INPUT TO BorrowingsHistory, DISPLAY CURRENT/PAST BORROWING HISTORY OF CURRENT USER; CHANGE
// SELECT, EDIT, ADD AND DELETE VARIABLES TO MATCH OTHER TABLES

// REFERENCE FOR ADDING MULTIPLE ENTRIES INTO ONE COLUMN: https://stackoverflow.com/questions/11801911/insert-multiple-rows-into-single-column
        //INSERT DATA
    function InsertData($conn, $itemname, $itemid, $quantity, $pricebox){
        $sql = "INSERT INTO BorrowingsTable (ItemName, ItemQuantity, )
             VALUES ('$itemname', '$itemid', '$quantity', '$pricebox')";
    
        if (mysqli_query($conn, $sql)) {
            echo "Data Stored Successfully";
        } else {
            echo "Unsuccessful, Error" . mysqli_error($conn);
        }

        clear();
    }

    //SELECT DATA
    function SelectData($conn, $itemid){
        $sql = "SELECT * FROM BorrowingsTable WHERE ItemID='$itemid'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["ItemID"] . "</td>";
                echo "<td>" . $row["ItemName"] . "</td>";
                echo "<td>" . $row["Quantity"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "No Data Found";
        }

        clear();
    }

    //EDIT   DATA
    function UpdateData($conn, $itemname, $itemid, $quantity, $pricebox){
        $sql = "UPDATE BorrowingsTable SET ItemName='$itemname', Quantity='$quantity', Price='$pricebox' WHERE ItemID='$itemid'";
        
        if (mysqli_query($conn, $sql)) {
            echo "Data Updated Successfully";
        } else {
            echo "Unsuccessful, Error" . mysqli_error($conn);
        }

        clear();
    }

    //DELETE DATA
    function DeleteData($conn, $itemid){
        if ($itemid != '') {
            $sql = "DELETE FROM BorrowingsTable WHERE ItemID='$itemid'";

            if (mysqli_query($conn, $sql)) {
                echo "Data Removed Successfully";
            } else {
                echo "Unsuccessful, Error" . mysqli_error($conn);
            }
        } else {
            echo "Please fill up the item code field";
        }

        clear();
    }

    // edit here

    

    $servername = "localhost";
    $username = "yourusername";
    $password = "yourpassword";
    $dbname = "BorrowingSystem";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }

    // call the functions with the appropriate arguments
    //InsertData($conn, $itemname, $itemid, $quantity, $pricebox);
    //SelectData($conn, $itemid);
    //UpdateData($conn, $itemname, $itemid, $quantity, $pricebox);
    //DeleteData($conn, $itemid);

    // close the database connection
    


    // Close MySQL connection
    mysqli_close($conn);
    ?>
</body>
</html>
