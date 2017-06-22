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

Created on: Jun 22, 2017
*/
?>
<html>
    <head>
        <?php require_once 'header.php' ?>
        <title>User Messenger: Block Users</title>
    </head>
    <body>
        <?php require_once 'navigationbar.php'?>
        <div class="container">
<?php if($loggedin){ 
    if($_SESSION['role']==1 || $_SESSION['role']==2){
            if($_POST){
                blockUnblockUser();
            }
            $result_block=  queryMysql("Select userid from Access where userid!='$user' and blocked=0 order by userid");    
            $result_unblock=  queryMysql("Select userid from Access where userid!='$user' and blocked=1 order by userid");    
?>
            <h2 class="text-center">Block / Unblock Users</h2>
            
<?php
if(mysqli_num_rows($result_block)>0){
    echo '<h3>Block User</h3>
        <form role="form" method="post" action="block.php">
                <fieldset class="form-group">
                    <label for="user">Select User</label>
                    <select class="form-control" id="user" name="user" required>';
    echo "<option value=''>------</option>";
    while($row=mysqli_fetch_array($result_block)){
            echo "<option value='".$row['userid']."'>".$row['userid']."</option>";    
    }
 
            echo    ' </select>
                    <input type="hidden" name="block" value="1"/>
                    <br>
                    <button type="submit" id="bSubmit" class="btn btn-primary col-lg-3 col-md-4 col-sm-10">Block</button>    
            </form>'; 
}
else{
    echo '<br><br><div class="message alert alert-info col-lg-12 col-md-12 col-sm-12">Currently all users are blocked, Except You!</div>';
}
if(mysqli_num_rows($result_unblock)>0){
    echo '<br><br><h3>Unblock User</h3>
        <form role="form" method="post" action="block.php">
                <fieldset class="form-group">
                    <label for="user">Select User</label>
                    <select class="form-control" id="user" name="user" required>';
    echo "<option value=''>------</option>";
    while($row=mysqli_fetch_array($result_unblock)){
            echo "<option value='".$row['userid']."'>".$row['userid']."</option>";    
    }
 
            echo    ' </select>
                    <input type="hidden" name="block" value="0"/>
                    <br>
                    <button type="submit" id="ubSubmit" class="btn btn-primary col-lg-3 col-md-4 col-sm-10">Unblock</button>    
            </form>'; 
}
else{
    echo '<br><br><div class="message alert alert-info col-lg-12 col-md-12 col-sm-12">Currently there are no users blocked!</div>';
}
}
else{
       echo '<div class="alert alert-danger">Access Denied! You are not authorized to view this section.</div>';
       header("Refresh: 2; url=index.php");
}
}
else{ 
    echo '<div class="alert alert-danger">Please LogIn to use System</div>';
    header("Refresh: 2; url=login.php");
}            
    echo '<br><br>';
require_once 'footer.php';
?>