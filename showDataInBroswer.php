<!DOCTYPE html>
<html>
<head>
    <title>Customer Database.</title>
    
<style>

body
    {
        background-color:LightGray;
    }

    
    table {
    border-collapse: collapse;
    width: 100%;
    color: rgb(0, 0, 0);
    font-family: monospace;
    font-size: 25px;
    text-align: center;
    
    }
    th {
    background-color: #588c7e;
    color: white;
    }
    tr:nth-child(even) {background-color: #f2f2f2}



/* For Navigation table */
    ul{
    float:right;
    list-style-type: none;
    margin-top: 25px;

}


ul li{
    display: inline-block;
    
    
}

ul li a{
    text-decoration: none;
    color:#fff;
    padding:5px 20px;
    border: 1px solid transparent;
    transition: 0.6s ease;
}

ul li a:hover{
    background-color: green;
   /* background-image: url(../Downloads/ContactUs7.jpg);  */
    color:#000;
}

ul li.active a{
    background-color:rgb(0, 0, 255);
    color:000;
}

}
</style>
</head>
<body>

    

    <header>
        <div class="main">


            <ul>
                <li class="active"><a href="index.php">Home</a></li>
        
                <li><a href="helpdesk.html">Help</a></li>
            </ul>
        </div>
    
    </header>



    <table>
        <tr>
            <th>CustomerId</th>
            <th>Name</th>
            <th>Email</th>
            <th>Amount</th>
        </tr>

        <?php
        $conn = mysqli_connect("localhost", "root", "", "bank",3308);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }



        $sql = "select CustomerID,Name,Email,Amount,Operation from Customer";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row

        while($row = $result->fetch_assoc()) 
        {
        echo "<tr><td>" . $row["CustomerID"]. 
            "</td><td>" . $row["Name"] . 
            "</td><td>". $row["Email"]. 
            "</td><td>". $row["Amount"].
            "</td></tr>";
        }
        echo "</table>";
        } else { echo "0 results"; }
        $conn->close();
        ?>
    </table>
</body>
</html>