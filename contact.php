<?php
function OpenCon()
{
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "contactDB";
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n". $conn -> error);
 
    return $conn;
}
 
function CloseCon($conn)
{
    $conn -> close();
}

 function SaveToDB($conn)
 {
     if (isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['text'])) {
         $name=$_POST['name'];
         $email=$_POST['email'];
         $text=$_POST['text'];

         $sql="INSERT INTO contactTable
         VALUES ('$name', '$email', '$text')";

         if (mysqli_query($conn, $sql)) {
             echo "New record created successfully";
         } else {
             echo "Error: " . $sql . "<br>" . mysqli_error($conn);
         }
     }
 }

 SaveToDB(OpenCon());