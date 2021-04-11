<!DOCTYPE html>
<html>
<head>
    <title>Transcation History.</title>
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
    text-align: left;
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
    border: 1px solid ;
    transition: 0.6s ease;
}

ul li a:hover{
    background-color: #fff;
   /* background-image: url(../Downloads/ContactUs7.jpg);  */
    color:#000;
}
ul li.active a{
    background-color:green;
    color:000;

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
            <th>ID</th>
            <th>Sender_Name</th>
            <th>Reciever_Name</th>
            <th>Amount</th>
            <th>Time</th>
            <th>Status</th>
        </tr>


        <?php
        $conn = mysqli_connect("localhost", "root", "", "bank",3308);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        $sql = "select ID,Sender_Name,Reciever_Name,Amount,Time,Status from Transcation";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row

        while($row = $result->fetch_assoc()) 
        {
        echo "<tr><td>" . $row["ID"]. 
            "</td><td>". $row["Sender_Name"].
            "</td><td>" . $row["Reciever_Name"] . 
            "</td><td>". $row["Amount"]. 
            "</td><td>". $row["Time"].
            "</td><td>". $row["Status"].
            "</td></tr>";
        }
        echo "</table>";
        } else { echo "0 results"; }
        $conn->close();
        ?>
    </table>
</body>
</html>