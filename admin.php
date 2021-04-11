<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<style>

body{
background-color:#ff8025
}

.wrapper {	
    margin-top: 80px;
  margin-bottom: 80px;
}
.button{
    width:100%
}

.form-signin {
  max-width: 380px;
  padding: 15px 35px 45px;
  margin: 0 auto;
  background-color: #fff;
 

}
.item{
    max-width: 800px;
    margin:0 auto;
    margin-top:100px;
   
}

</style>
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


function getClients()
{
    $clients=array();
    return $result=mysqli_query(OpenCon(), "select * from contacttable");
    while ($user =  mysql_fetch_assoc($records)) {
        $clients[] = $client;
    }
    return $clients;
}

 function verifyAdmin()
 {
     if (isset($_POST['username'])) {
         $username = $_POST['username'];
         $password = $_POST['password'];
        
            
         $result = mysqli_query(OpenCon(), "select * from admin where username='".$username."' and password='".$password."'");
         if (!$result) {
             return false;
         }
         if (mysqli_num_rows($result) > 0) {
             return true;
         } else {
             return false;
         }
         //  $users=getUsers();
        //  foreach ($users as $user) {
        //      if ($user['password']===$_POST['password']&&$user['username']===$_POST['username']) {
                 
        //      }
        //  }
    //  } else {
    //      return false;
     } else {
         return null;
     }
 }

function showClients()
{
    $clients=getClients();
    foreach ($clients as $client) {
        echo'<div href="#" class="list-group-item list-group-item-action item" style=" margin-top: 15px; border-radius:10px;
        opacity: 0.9;">
      <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">'.$client['nomComplet'].'</h5>
    </div>
      <p class="mb-1">'.$client['text'].'</p>
      <small class="text-muted">'.$client['email'].'</small>
      </div>';
    }
}
$res=verifyAdmin();
if ($res) {
    showClients();
} elseif ($res===null) {
    echo'<body><div class="wrapper" >
    <form class="form-signin" method="post" style=" border-radius:10px;
    opacity: 0.9;" >       
        <h2 class="form-signin-heading">Please login</h2>
        <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="" />
        <input type="password" class="form-control" name="password" placeholder="Password" required=""/>      
        <button class="btn btn-lg btn-primary btn-block button " type="submit">Login</button>   
    </form>
</div>';
} elseif ($res===false) {
    echo'<body><div class="wrapper" >
    <form class="form-signin" method="post" style="border-radius:10px;
    opacity: 0.9;">       
        <h2 class="form-signin-heading">Please login</h2>
        <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="" />
        <input type="password" class="form-control" name="password" placeholder="Password" required=""/>      
        <button class="btn btn-lg btn-primary btn-block button " type="submit">Login</button>   
    </form>
</div>';
    echo '<script>alert("mot de pass et username sont incorrects")</script>';
}
?>
</body>

</html>