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
        <title>Urban Messenger: Account Creation</title>
    </head>
<body>
<?php
if($loggedin){
    require_once 'navigationbar.php';
        if($_POST) 
        {
            if(!empty($_POST[user]))
                $user= sanitizeString ($_POST[user]);
           
            else {
                $user=$_SESSION['user'];
            }
        }
    $result=  queryMysql("Select * from UserProfile where userid='$user'");    

?>
<div class="container text-center">
    <br>
    
    <h1 class="text-center">Profile</h1>
<?php        
if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_array($result)){
        
 ?>
        <img class="profile-img" src="img/mumbra.jpg" alt="User Messenger"/>
        <div>
            <span><?php echo $row[fname]." ".$row[lname]?></span>
        </div>
        <div>
            <span><?php echo $row[headline]?$row[headline]:"No Headline Found"; ?></span>
        </div>
        <div>
            <span><label>Gender:</label><?php echo $row[gender]?$row[gender]:" Not Provided";?> <label>Born on:</label><?php echo $row[dob]?date('d/m/Y', strtotime($row[dob])):" Not Known";?></span>
        </div>
        <div>
            <span><label>Mobile Number:</label> <?php echo $row[phoneno]?$row[phoneno]:" Not provided"; ?></span>
        </div>
        <div>
            <div><label>Profile Description</label></div>
            <div> <?php echo $row[description]?$row[description]:"No description found"; ?></div>
        </div>
        <div>
            <span><label>Current Position:</label> <?php echo $row[current_pos]?$row[current_pos]:" Not Known"; ?></span>
        </div>
        <div>
            <span>
                <label>Education:</label>
                <?php echo $row[highest_edu]?$row[highest_edu]:" Not Known"." at ";
                echo $row[highest_univ]?$row[highest_univ]:" Unknown University";
                ?>
            </span>
            
        </div>
        <div>
            <span>
                <label>Country:</label>
                <?php echo $row[city]?$row[city]:"unknown location".", ";
                echo $row[state]?$row[state]:"unknown state".", ";
                echo $row[country]?$row[country]:"unknown country";
                ?>
            </span>    
        </div>
        <div>
           <span>
               <label>Last Updated By:</label><?php echo $row[updated_by]?$row[updated_by]:" Not Applicable".", ";?> 
               <label>Last Updated on:</label><?php echo $row[last_updated]?date('d/m/Y H:i:m:s a', strtotime($row[last_updated])):" Not Known";?>
           </span>
        </div>
        <a href="updateprofile.php"><button class="btn btn-primary">Update Profile</button></a>
    </form><br><br>
<?php 
    }
}
else{
    echo '<div class="message alert alert-info col-lg-12 col-md-12 col-sm-12">Profile Not Found!</div>';
}   
}
else {
      echo '<div class="container"><div class="alert alert-danger">Please Login to Use System</div></div>';
      header('refresh: 2; url=login.php');
}
require_once 'footer.php';?>
