<?php
session_start();
/*
This Work is Licensed under a Creative Commons Attribution-NonCommercial 4.0 International License.
You are free to:
Share — copy and redistribute the material in any medium or format
Adapt — remix, transform, and build upon the material
The licensor cannot revoke these freedoms as long as you follow the license terms.
Under the following terms:
Attribution — You must give appropriate credit, provide a link to the license, and indicate if changes were made. You may do so in any reasonable manner, but not in any way that suggests the licensor endorses you or your use.
NonCommercial — You may not use the material for commercial purposes.
No additional restrictions — You may not apply legal terms or technological measures that legally restrict others from doing anything the license permits.

Notices:
You do not have to comply with the license for elements of the material in the public domain or where your use is permitted by an applicable exception or limitation.
No warranties are given. The license may not give you all of the permissions necessary for your intended use. For example, other rights such as publicity, privacy, or moral rights may limit how you use the material.

Author: Muhammed Salman Shamsi

Created on: Jun 22, 2017
*/
?>
<html>
    <head>
        <?php require_once 'header.php' ?>
        <title>User Messenger: Users</title>
    </head>
    <body>
        <?php require_once 'navigationbar.php'?>
        <div class="container">
<?php if($loggedin){ 
            $result=  queryMysql("Select a.userid,fname,lname from Access a left outer join UserProfile u on a.userid=u.userid order by userid");
?>
            <h2 class="text-center">Current Users</h2>
            
<?php
if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_array($result)){
            echo "<div class='message'>".$row['userid']." (";
            echo $row['fname']?$row['fname']:"First Name not provided";
            echo " ";
            echo $row['lname']?$row['lname']:" Last Name not provided";
            echo ")</div>";    
    }
 }
else{
    echo '<br><br><div class="message alert alert-info col-lg-12 col-md-12 col-sm-12">Currently there are no users of system!</div>';
}

}
else{ 
    echo '<div class="alert alert-danger">Please LogIn to use System</div>';
    header("Refresh: 2; url=login.php");
}            
    echo '<br><br>';
require_once 'footer.php';
?>