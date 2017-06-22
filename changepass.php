<!DOCTYPE html>
<!--

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

Created On: 
 */-->
<html>
    <head>
        <?php require_once 'header.php' ?>
        <title>Urban Mumbra</title>
    </head>
    <body>
        <?php require_once 'navigationbar.php'?>
        <div class="container">
<?php            
if($loggedin){
        if($_POST){
            changePass();
        }

echo <<<_END
        <form role="form" method="post" action="changepass.php">
        <h1>Change Password</h1>
            <fieldset class="form-group">
            <label for="user">Username:</label>
                
_END;
if($_SESSION['grid']!=='3')
    echo '<input class="form-control" type="text" id="user" name="user" readonly="true" required value="'.$_SESSION['user'].'"/>';
else{
    echo '<select class="form-control"  id="user" name="user"  required>';
    loadUserId();
    echo '</select>';
}        
echo '</fieldset>';
if($_SESSION['grid']!=='3'){
echo <<<_END
            <fieldset class="form-group">
                <label for="oldpass">Enter Old Password:</label>
                <input class="form-control" type="password" id="oldpass" name="oldpass" required><br><span id="passerr"></span>
            </fieldset>
            <fieldset class="form-group">
                <label for="pass">Enter New Password:</label>
                <input class="form-control" type="password" placeholder="Min 8 char, 1 Lowercase,1 Uppercase, 1 Special Charcter" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" id="pass" name="pass" disabled="true" required>
            </fieldset>
            <fieldset class="form-group">
                <label for="cpass">Confirm Password:</label>
                <input class="form-control" type="password" id="cpass" placeholder="Repeat Password" name="cpass" disabled="true" required><br><span id="cpasserr"></span>
            </fieldset>
_END;
}
else{
echo <<<_END
           <fieldset class="form-group">
                <label for="pass">Enter New Password:</label>
                <input class="form-control" type="password" placeholder="Min 8 char, 1 Lowercase,1 Uppercase, 1 Special Charcter" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" id="pass" name="pass" required>
            </fieldset>
            <fieldset class="form-group">
                <label for="cpass">Confirm Password:</label>
                <input class="form-control" type="password" id="cpass" placeholder="Repeat Password" name="cpass" required><br><span id="cpasserr"></span>
            </fieldset>
_END;
}
echo <<<_END
            <input type="submit" class="btn btn-primary" value="Change Password"> 
        </form>
<br><br>
_END;
}
else
     echo '<div class="alert alert-danger">Please LogIn to use System</div>';
require_once 'footer.php';
?>