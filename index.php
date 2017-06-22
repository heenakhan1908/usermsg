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

Created on: Jun 21, 2017
*/
?>
<html>
    <head>
        <?php require_once 'header.php' ?>
        <title>User Messenger</title>
    </head>
    <body>
        <?php require_once 'navigationbar.php'?>
        <div class="container">
<?php if($loggedin){ ?>  
            <ul>
                <li><a href="createuser.php">Create User</a></li>
                <li><a href="viewprofile.php">View Profile</a></li>
                <li><a href="viewall.php">View All Users</a></li>
                <li><a href="block.php">Block Users</a></li>
                <li><a href="updateprofile.php">Update Profile</a></li>
                <li><a href="updateall.php">Update Others Profile</a></li>
                <li><a href="messages.php">Messages</a></li>
                <li><a href="deleteothers.php">Delete Others Message</a></li>    
            </ul>
            
            <br><br>
<?php 
        }
else{ 
    echo '<div class="alert alert-danger">Please LogIn to use System</div>';
    header("Refresh: 2; url=login.php");
}
?>            
            <br><br>
<?php require_once 'footer.php';?>
