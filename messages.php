<?php

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
        <title>User Messenger: Messages</title>
    </head>
    <body>
        <?php require_once 'navigationbar.php'?>
        <div class="container">
<?php if($loggedin){ 
            if($_POST){
                insertMsg();
                if(!empty($_POST['user']))
                    $user= sanitizeString ($_POST['user']);
                else 
                    $user=$_SESSION['userid'];
            }
            $result=  queryMysql("Select * from Messages where userid='$user' order by time_stamp");    
?>
            <h2 class="text-center">Message Board</h2>
            <form method="post" action="messages.php">
                <textarea class="message-post" rows="5" name="post_message" placeholder="What is in your mind? Share with us..."></textarea>
                <button type="submit" id="msgSubmit" class="btn btn-primary col-lg-3 col-md-4 col-sm-10">Post</button>    
            </form>
          
<?php
if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_array($result)){
           echo '<div class="message col-lg-6 col-md-8 col-sm-10">'.$row[msg].
                '<div class="text-right">'.date('d-m-Y H:i:s a', strtotime($row[time_stamp])).'</div>'
                   . '<button class="btn btn-delete" id="'.$row[idMsg].'">Delete</button></div>';
    }
}
else{
    echo '<div class="message alert alert-info col-lg-12 col-md-12 col-sm-12">No Message to display!</div>';
}                
}
else{ 
    echo '<div class="alert alert-danger">Please LogIn to use System</div>';
    header("Refresh: 2; url=login.php");
}            
    echo '<br><br>';
require_once 'footer.php';
