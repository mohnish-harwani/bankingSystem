<?php

    $conn = mysqli_connect("localhost", "root", "", "bank",3308);

    // Check connection
    if ($conn->connect_error)
     {
         die("Connection failed: " . $conn->connect_error);
     }
     else 
     {
       //  echo"Connected Suucessfully u can continue";
     }
     

if(isset($_POST['submit']))
{

    $from = $_GET['id12'];

    //echo "<h2>" . $from . "</h2>";

    $to = $_POST['to'];

    //echo "<h2>" . $to . "</h2>";

    $amount = $_POST['amount'];

    //echo "<h2>" . $amount . "</h2>";

    $sql = "SELECT * from Customer where CustomerID=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); // returns array or output of user from which the amount is to be transferred.

    

    

    $sql = "SELECT * from Customer where CustomerID=$to";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);

    



    // constraint to check input of negative value by user
    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")';  // showing an alert box.
        echo '</script>';

        $sender = $sql1['Name'];
        // echo "<h2>" . $sender . "</h2>";

        $receiver = $sql2['Name'];
        // echo "<h2>" . $receiver . "</h2>";

        $Failed="<font color=red>Failed </font>";

        

        $sql = "INSERT INTO Transcation(`Sender_Name`, `Reciever_Name`, `Amount`,`Status`) VALUES ('$sender','$receiver','$amount','$Failed')";
        $query=mysqli_query($conn,$sql);

        if($query){
             echo "<script> alert('Transaction Unsuccessful .');
                             window.location='transcactionhistory.php';
                   </script>";
            
        }
    }


  
    // constraint to check insufficient balance.
    else if($amount > $sql1['Amount']) 
    {
        
        echo '<script type="text/javascript">';
        echo ' alert("Bad Luck! Insufficient Balance")';  // showing an alert box.
        echo '</script>';

        $sender = $sql1['Name'];
        // echo "<h2>" . $sender . "</h2>";

        $receiver = $sql2['Name'];
        // echo "<h2>" . $receiver . "</h2>";

        $Failed="<font color=red>Failed </font>";

        

        $sql = "INSERT INTO Transcation(`Sender_Name`, `Reciever_Name`, `Amount`,`Status`) VALUES ('$sender','$receiver','$amount','$Failed')";
        $query=mysqli_query($conn,$sql);

        if($query){
             echo "<script> alert('Transaction Unsuccessful .');
                             window.location='transcactionhistory.php';
                   </script>";
            
        }
                   
    }
    


    // constraint to check zero values
    else if($amount == 0){

         echo "<script type='text/javascript'>";
         echo "alert('Oops! Zero value cannot be transferred')";
         echo "</script>";

         $sender = $sql1['Name'];
        // echo "<h2>" . $sender . "</h2>";

        $receiver = $sql2['Name'];
        // echo "<h2>" . $receiver . "</h2>";

        $Failed="<font color=red>Failed </font>";

        

        $sql = "INSERT INTO Transcation(`Sender_Name`, `Reciever_Name`, `Amount`,`Status`) VALUES ('$sender','$receiver','$amount','$Failed')";
        $query=mysqli_query($conn,$sql);

        if($query){
             echo "<script> alert('Transaction Unsuccessful .');
                             window.location='transcactionhistory.php';
                   </script>";
            
        }
     }


    else {
        
                // deducting amount from sender's account
                $newbalance = $sql1['Amount'] - $amount;
                $sql = "UPDATE Customer set Amount=$newbalance where CustomerID=$from";
                mysqli_query($conn,$sql);
             

                // adding amount to reciever's account
                $newbalance = $sql2['Amount'] + $amount;
                $sql = "UPDATE Customer set Amount=$newbalance where CustomerID=$to";
                mysqli_query($conn,$sql);
                
                $sender = $sql1['Name'];
                // echo "<h2>" . $sender . "</h2>";

                $receiver = $sql2['Name'];
                // echo "<h2>" . $receiver . "</h2>";

                $Success="<font color=green>Success </font>";

                

                $sql = "INSERT INTO Transcation(`Sender_Name`, `Reciever_Name`, `Amount`,`Status`) VALUES ('$sender','$receiver','$amount','$Success')";
                $query=mysqli_query($conn,$sql);

                //Column name:- select ID,Sender_Name,Reciever_Name,Amount,Time,Status from Transcation;

                

                if($query){
                     echo "<script> alert('Transaction Successfully Done.');
                                     window.location='transcactionhistory.php';
                           </script>";
                    
                }
                else
                {
                    echo " <script> alert('Transaction done');
                                     window.location='error.php';
                           </script>";

                }

                $newbalance= 0;
                $amount =0;
        }
    
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perform Transaction</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">

    <style type="text/css">

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
    	
		button{
			border:none;
			background: #d9d9d9;
		}
	    button:hover{
			background-color:#777E8B;
			transform: scale(1.1);
			color:white;
		}

    </style>
</head>

<body>
 
<!--   <?php include 'navbar.php'; ?>   -->

	<div class="container">
        <h2 class="text-center pt-4">Perform Transaction</h2>
            <?php
               $conn = mysqli_connect("localhost", "root", "", "bank",3308);

               // Check connection
               if ($conn->connect_error)
                {
                    die("Connection failed: " . $conn->connect_error);
                }
                


                $sid=$_GET['id12'];
                //echo "<h2>" . $sid . "</h2>";

                $sql = "SELECT * FROM  Customer where CustomerID=$sid";

                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>

            <!--  updateDetailsToDatabase.php  -->
            <form method="post"  name="tcredit" class="tabletext" ><br>
        <div>
            <table class="table table-striped table-condensed table-bordered">
                <tr>
                    <th class="text-center">CustomerID</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Amount</th>
                </tr>
                <tr>
                    <td class="py-2"><?php echo $rows['CustomerID'] ?></td>
                    <td class="py-2"><?php echo $rows['Name'] ?></td>
                    <td class="py-2"><?php echo $rows['Email'] ?></td>
                    <td class="py-2"><?php echo $rows['Amount'] ?></td>
                </tr>
            </table>
        </div>

        


        <br><br><br>
        <label>Transfer To:</label>
        <select name="to" class="form-control" required>
            <option value="" disabled selected>Choose</option>
            <?php
                $conn = mysqli_connect("localhost", "root", "", "bank",3308);

                // Check connection
                if ($conn->connect_error)
                 {
                     die("Connection failed: " . $conn->connect_error);
                 }
                 
                $sid=$_GET['id12'];
                $sql = "SELECT * FROM Customer where CustomerID!=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows['CustomerID'];?>" >
                
                    <?php echo $rows['Name'] ;?> (Balance: 
                    <?php echo $rows['Amount'] ;?> ) 
               
                </option>
            <?php 
                } 
            ?>
            <div>
        </select>
        <br>
        <br>
            <label>Amount:</label>
            <input type="number" class="form-control" name="amount" required>   
            <br><br>
                <div class="text-center" >
            <button class="btn mt-3" name="submit" type="submit" id="myBtn">Transfer</button>
            </div>
        </form>
    </div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>