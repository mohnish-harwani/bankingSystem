<?php

$Name = $_POST['name'];
$Email=$_POST['email'];
$Mobile=$_POST['mobile'];
$Subject=$_POST['subject'];


    $conn = mysqli_connect("localhost", "root", "", "bank",3308);

    // Check connection
    if ($conn->connect_error)
     {
         die("Connection failed: " . $conn->connect_error);
     }
     else 
     {
        // echo"Connected Suucessfully u can continue";
     }
     




    


$sql = "INSERT INTO helpdesk(Name, Email, MobileNo,Subject)VALUES ('$Name', '$Email', '$Mobile','$Subject')";

//Column name:- select ID,Name,Email,MobileNo,Time,Subject from helpdesk;

    if ($conn->query($sql) === TRUE) 
    {
        echo "New record created successfully";

        echo "<script> alert('Your query is recorded.We will get back to u soon.');
                             window.location='index.php';
                   </script>";
    } 
    else {
          echo "Error: " . $sql . "<br>" . $conn->error;

          echo "<script> alert('We will get back to u soon.');
                             window.location='index.php';
                   </script>";
    }

    $conn->close();







?>