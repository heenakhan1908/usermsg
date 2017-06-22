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
        <title>Urban Messenger: Account Creation</title>
    </head>
<body>
<?php
if($loggedin){
    require_once 'navigationbar.php';
        if($_POST) 
        {
            updateProfile();
            if(!empty($_POST[user]))
                $user= sanitizeString ($_POST[user]);
           
            else {
                $user=$_SESSION['user'];
            }
        }
    $result=  queryMysql("Select * from UserProfile where userid='$user'");    
    echo '<div class="container">
    <br>';
    if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_array($result)){
?>
    
    <form role="form" method="post" action="updateprofile.php">
        <img class="profile-img" src="img/mumbra.jpg" alt="User Messenger"/>
        <h1> Update Profile</h1>
        <fieldset class="form-group">
            <label for="fname">First Name</label>
            <input class="form-control" type="text" placeholder="Your First Name" maxlength="25" id="fname" name="fname" value="<?php echo $row[fname]?>" required><br>
            <span id="fnameerr"></span>
        </fieldset>
        <fieldset class="form-group">
            <label for="lname">Last Name</label>
            <input class="form-control" type="text" placeholder="Your Last Name" maxlength="25" id="lname" name="lname" value="<?php echo $row[lname]?>" required><br>
            <span id="lnameerr"></span>
        </fieldset>
        <fieldset class="form-group">
            <label for="gender">Gender</label>
            <div class="form-control">
                <input type="radio" name="gender" id="male" value="MALE"  required> Male&nbsp;
                <input type="radio" name="gender" id="female" value="FEMALE" required> Female
            </div>
        </fieldset>
        <fieldset class="form-group">
            <label for="mobile">Mobile Number</label>
            <input class="form-control" type="number" placeholder="10 digits mobile number" maxlength="10" id="mobile" name="mobile" value="<?php echo $row[phoneno]?>" required>
        </fieldset>    
        <fieldset class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" placeholder="username@example.com"  id="email" name="email" value="<?php echo $row[email]?>" required>
        </fieldset>    
        <fieldset class="form-group">
            <label for="dob">Date of Birth</label>
            <input class="form-control" type="date" placeholder="dd/mm/yyyy" id="dob" name="dob" value="<?php echo $row[dob]?date('d/m/Y', strtotime($row[dob])):FALSE; ?>" required/>
        </fieldset> 
        <fieldset class="form-group">
            <label for="headline">Profile Headline</label>
            <input class="form-control" type="text" placeholder="A Passionate Web Designer with 3 years of experience" maxlength="90" id="headline" name="headline" value="<?php echo $row[headline]?>" required><br>
        </fieldset>
        <fieldset class="form-group">
            <label for="cpos">Current Position</label>
            <input class="form-control" type="text" placeholder="Your Current Designation" maxlength="35" id="cpos" name="cpos" value="<?php echo $row[current_pos]?>" required><br>
        </fieldset>
        <fieldset class="form-group">
            <label for="desc">Profile Description</label>
            <textarea class="form-control" placeholder="Your Profile Description" id="desc" name="desc" maxlength="250" required><?php echo $row[description]?></textarea>
        </fieldset>
        <fieldset class="form-group">
            <label for="edu">Education</label>
            <select name="edu" id="edu" class="form-control" required>
                <option value="<?php echo $row[highest_edu]?>"><?php echo $row[highest_edu]?></option>
                <option value="SSC/Metric">SSC/Metric</option>
                <option value="HSC/Post Metric">HSC/Post Metric</option>
                <option value="B.Sc">B.Sc</option>
                <option value="B.Com">B.Com</option>
                <option value="B.A">B.A</option>
                <option value="B.E/B.Tech">B.E/B.Tech</option>
                <option value="B.C.A">B.C.A</option>
                <option value="M.Com">M.Com</option>
                <option value="M.Sc">M.Sc</option>
                <option value="M.C.A">M.C.A</option>
                <option value="M.E/M.Tech">M.E/M.Tech</option>
                <option value="P.hd">P.hd</option>
            </select><br>
            <input class="form-control" type="text" placeholder="University Name" maxlength="60" id="univ" name="univ" value="<?php echo $row[highest_univ]?>" required><br>
        </fieldset>
        <fieldset class="form-group">
            <label for="city">City</label>
            <input class="form-control" type="text" placeholder="Your Current Location" maxlength="30" id="city" name="city" value="<?php echo $row[city]?>" required><br>
        </fieldset>
        <fieldset class="form-group">
            <label for="state">State</label>
            <input class="form-control" type="text" placeholder="Your Current State" maxlength="25" id="state" name="state" value="<?php echo $row[state]?>" required><br>
        </fieldset>
        <fieldset class="form-group">
            <label for="country">Country</label>
            <input class="form-control" type="text" placeholder="Your Current Country" maxlength="20" id="country" name="country" value="<?php echo $row[country]?>" required><br>
        </fieldset>
        <fieldset class="form-group">
            <label for="image">Update Your Photo</label>        
            <input class="form-input" type="file" name="image" required="true"/>
        </fieldset>
        <input type="submit" class="btn btn-primary" value="Update Profile">
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
require_once 'footer.php';
?>
