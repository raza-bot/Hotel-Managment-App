<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="inventory.css">
    
    <!-- <!--  Styling taken from: https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_popup_form -->
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        * {box-sizing: border-box;}

        /* Button used to open the contact form - fixed at the bottom of the page */
        .open-button {
          background-color: #555;
          color: white;
          padding: 16px 20px;
          border: none;
          cursor: pointer;
          opacity: 0.8;
          position: fixed;
          bottom: 23px;
          right: 28px;
          width: 280px;
        }

        /* The popup form - hidden by default */
        .form-popup {
          display: none;
          position: fixed;
          bottom: 0;
          right: 15px;
          border: 3px solid #f1f1f1;
          z-index: 9;
        }

        /* Add styles to the form container */
        .form-container {
          max-width: 300px;
          padding: 10px;
          background-color: white;
        }

        /* Full-width input fields */
        .form-container input[type=text], .form-container input[type=password] {
          width: 100%;
          padding: 15px;
          margin: 5px 0 22px 0;
          border: none;
          background: #f1f1f1;
        }

        /* When the inputs get focus, do something */
        .form-container input[type=text]:focus, .form-container input[type=password]:focus {
          background-color: #ddd;
          outline: none;
        }

        /* Set a style for the submit/login button */
        .form-container .btn {
          background-color: #4CAF50;
          color: white;
          padding: 16px 20px;
          border: none;
          cursor: pointer;
          width: 100%;
          margin-bottom:10px;
          opacity: 0.8;
        }

        /* Add a red background color to the cancel button */
        .form-container .cancel {
          background-color: red;
        }

        /* Add some hover effects to buttons */
        .form-container .btn:hover, .open-button:hover {
          opacity: 1;
        }
</style>
</head>

<body>

        <button class="open-button" onclick="openForm()">Edit Inventory</button>
        <div class="form-popup" id="myForm">
          <form action="index.php" class="form-container" method="post">
            <h1>Add New Item</h1>

            <label for="id"><b>ID</b></label>
            <input type="text" placeholder="Enter ID" name="id" required>

            <label for="name"><b>Name</b></label>
            <input type="text" placeholder="Enter Name" name="name" required>

            <label for="description"><b>Description</b></label>
            <input type="text" placeholder="Enter Description" name="description" required>

            <label for="quantity"><b>Quantity</b></label>
            <input type="text" placeholder="Enter Quantity" name="quantity" required>

            <button type="submit" class="btn" name="addInfo">Add</button>
            <button type="submit" class="btn" name="delInfo">Delete</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
            <input type='hidden' name='inventory-submit'>
          </form>
        </div>

        <script>
            function openForm() {
              document.getElementById("myForm").style.display = "block";
            }

            function closeForm() {
              document.getElementById("myForm").style.display = "none";
            }

        </script>

        <?php
             require_once 'db_connection.php';
             require_once 'utilities.php';

             if(isset($_POST['addInfo'])) {
                $item_id = mysql_entities_fix_string($conn, $_POST['id']);
                $item_name = mysql_entities_fix_string($conn, $_POST['name']);
                $item_description = mysql_entities_fix_string($conn, $_POST['description']);
                $item_quantity = mysql_entities_fix_string($conn, $_POST['quantity']);

                $query = "INSERT INTO inventory(itemID, name, description, quantity) VALUES ('$item_id', '$item_name', '$item_description', '$item_quantity')";

                $result = $conn->query($query);

                if(!$result){
                    echo "Yikes";   
                }
            }

            if(isset($_POST['delInfo'])) {
                $item_id = mysql_entities_fix_string($conn, $_POST['id']);

                $query = "DELETE FROM inventory WHERE itemId = ('$item_id')";

                $result = $conn->query($query);

                if(!$result){
                    echo "Yikes";   
                }
            }
        ?>


<table id = "inventory">
    <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Description</th>
    <th>Quantity</th>
    <th>Modifications</th>
    </tr>   
    
    <?php
        require_once 'db_connection.php';
        
        $query = "SELECT * FROM Inventory"; // Select 'all' from 'Inventory' table
        $result = $conn->query($query);
        if (!$result) {
            echo "Something went wrong!";  // Statement so we know something didn't go as planned
        }
        else{
            $rows = $result->num_rows;
            for ($j = 0; $j < $rows; $j++)  // Go through each row
            {
                $result->data_seek($j);     // Get data from row
                $row = $result->fetch_array(MYSQLI_NUM);    // Put row data into array
                
                echo "<tr><td>" . $row[0]. "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td>
                <td>  
                                                     
                    <form action='index.php' method='post'>
                            <button type='submit' name='add_btn'>Add One</button>  
                            <button type='submit' name='sub_btn'>Sub One</button>  
                            <input type='hidden' name='inventory-submit'>
                    </form>
                    
                </td>
                </tr>";
            };
        }
    ?>
</table>
   
   
    <script>
        $num = 1;
        $('.test_btn').click(function () {
            num = $(this).closest("tr").find("td:eq(0)").text();    
            alert($num);
        });
        
    
    <?php   
        $id = 1;
        
        if(isset($_POST['add_btn'])){
            $query = "UPDATE inventory SET quantity = (quantity+1) WHERE itemId = ".$id."";
            $result = $conn->query($query); 
        }
        if(isset($_POST['sub_btn'])){
            $query = "UPDATE inventory SET quantity = (quantity-1) WHERE itemId = ".$id."";
            $result = $conn->query($query);  
        }
    ?>
    </script> 
</body>
</html>


