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

Created On: 
 */
$link=null;

function queryMysql($query)
{
    connectdB();
    global $link;
    $result=  mysqli_query($link,$query);
    if(!$result)
    {   echo $query;
        echo'<div class="alert alert-danger">Failed to execute query<br>Mysql Error: '.mysqli_error($link).'</div>';
        die();
    }
    mysqli_close($link);
    return $result;
}

function connectdB(){

    $db_host="localhost";

    $db_user="root";

    $db_password="2549root";

    $db_name="myAssignDb";

    $appname="User Messenger";

    global $link;
    $link=mysqli_connect($db_host,$db_user,$db_password) or die(mysql_error());

    mysqli_select_db($link,$db_name) or die(mysql_error());
}

function destroySession()
{
    $_SESSION=  array();
    if(session_id()!=""||isset($_COOKIE[session_name()]))
        setcookie (session_name (), '', time()-259200, '/');
    session_destroy();
}

function sanitizeString($var)
{
    connectdB();
    global $link;
    $var =  strip_tags($var);
    $var=  htmlentities($var);
    $var= stripcslashes($var);
    return mysqli_real_escape_string($link,$var);
}

function loadUserId()
{
    
    $sql_query = "select userid from `Access` order by userid";

    $result= queryMysql($sql_query);

    if(mysqli_num_rows($result)==0){
        echo '<option value="">No Records!</option>';
    }
    echo "<option value=''>------</option>";
    while($row = mysqli_fetch_array($result)){
        echo "<option value='".$row['userid']."'>".$row['userid']."</option>";
    }    
}

function loadRoles()
{
    
    $sql_query = "select * from `Roles` order by role_name";

    $result= queryMysql($sql_query);

    if(mysqli_num_rows($result)==0){
        echo '<option value="">No Records!</option>';
    }
    echo "<option value=''>------</option>";
    while($row = mysqli_fetch_array($result)){
        echo "<option value='".$row['role_id']."'>".$row['role_name']."</option>";
    }    
}

function insertMsg()
{
    
    if($_POST){
        if(!empty($_POST['post_message'])){
            $msg= sanitizeString(trim($_POST['post_message']));
            $creation=date("Y-m-d H:i:s",time());
            $user=$_SESSION['user'];
            $query="Insert into Messages (userid,msg,time_stamp) values('$user','$msg','$creation')";
            $result=  queryMysql($query);
            if($result){
                echo '<div class="alert alert-success">Your Message is Successfully Posted</div>';
            }        
        }
    }    
}

function insertUser(){

    if($_POST){
        if(!empty($_POST['user'])&& !empty($_POST['pass'])&& !empty($_POST['cpass'])&& !empty($_POST['userrole'])){
            $user= strtolower(sanitizeString(trim($_POST['user'])));
            $pass=  sanitizeString($_POST['pass']);
            $cpass=  sanitizeString($_POST['cpass']);
            $userrole=  sanitizeString(trim($_POST['userrole']));   
            $creation=date("Y-m-d H:i:s",time());
            $createdby=$_SESSION['user'];
            if($cpass!=$pass){
                echo '<div  class="alert alert-danger">Passwords does not match</span>';
                die();
            }
            else{
                $s1="ht*!#wr";
                $s2="st&f@q#";
                $token = hash('ripemd128', "$s1$pass$s2");
                $query="Insert into Access values('$user','$token','$creation','$userrole','$createdby',0)";
                $result=  queryMysql($query);
                if($result){
                    echo '<div class="alert alert-success">User '.$user.' is Successfully Created</div>';
                }
                $query="Insert into UserProfile (userid,last_updated,updated_by) values('$user','$creation','$createdby')";
                $result=  queryMysql($query);
                if($result){
                    echo '<div class="alert alert-success">Am Empty User Profile for '.$user.' is Successfully Created. Please Update the required profile from home / dashboard.</div>';
                }
            }
                     
        }
    }
}


function blockUnblockUser(){
//    echo $_POST[user].'-'.$_POST[block];
    if(!empty($_POST[user]) && isset($_POST[block])){
            $user= sanitizeString($_POST[user]);
            $block= sanitizeString($_POST[block]);
            $query="update Access set blocked=$block where userid='$user'";
//            echo $query;
            $result=  queryMysql($query);
                if($result){
                    echo "<div class='alert alert-success'><strong>Success! </strong>User $user is ";
                    echo $block?"blocked":"unblocked";
                    echo "!</div>";
                }            
    }
}

function updateProfile(){

    if($_POST){
        if(!empty($_POST[user])&& isset($_POST[fname])&& isset($_POST[lname])&& isset($_POST[email])&& isset($_POST[mobile])&& isset($_POST[gender])&& isset($_POST[dob])&& isset($_POST[desc])&& isset($_POST[headline])&& isset($_POST[cpos])&& isset($_POST[edu])&& isset($_POST[univ])&& isset($_POST[city])&& isset($_POST[state])&& isset($_POST[country])&& isset($_POST[updated_by])){
            $user= sanitizeString($_POST[user]);
            $fname=sanitizeString($_POST[fname]);
            $lname=sanitizeString($_POST[lname]);
            $email=sanitizeString($_POST[email]);
            $mobile=sanitizeString($_POST[mobile]);
            $gender=sanitizeString($_POST[gender]);
            $dob=$_POST[dob]?date('Y-m-d', strtotime(str_replace('/','-',$_POST[dob]))):NULL;
//            echo $dob;
            $desc=sanitizeString($_POST[desc]);
            $headline=sanitizeString($_POST[headline]);
            $cpos=sanitizeString($_POST[cpos]);
            $edu=sanitizeString($_POST[edu]);
            $univ=sanitizeString($_POST[univ]);
            $city=sanitizeString($_POST[city]);
            $state=sanitizeString($_POST[state]);
            $country=sanitizeString($_POST[country]);
            $update_by=sanitizeString($_POST[updated_by]);
            $updatetime=date('Y-m-d H:i:s');
            if(getimagesize($_FILES['image']['tmp_name'])==FALSE)
            {
                echo "<div class='alert alert-warning'>Image not selected by user or Image size exceeding server upload size.</div>";
            }
            else
            {
                $size = getimagesize($_FILES['image']['tmp_name']);
                $size = $size[3];
                $maxsize = 1048576;
                $image= addslashes($_FILES['image']['tmp_name']);
                $name= addslashes($_FILES['image']['name']);
                $image= file_get_contents($image);
                $image= base64_encode($image);
                if($_FILES['image']['size'] <= $maxsize ){
                    $query="update UserProfile set image='$image', last_updated='$updatetime', updated_by='$update_by' where userid='$user'";
          
                    $result=  queryMysql($query);
                    if($result){
                        echo '<div class="alert alert-success"><strong>Success!</strong> Profile Image has been updated!.</div>';
                    }
                }
                else {
                    echo '<div class="alert alert-danger">Profile photo not updated. Image File Size should less than equal to 1 Mb</div>';
                }
            }
                $query="update UserProfile set fname='$fname', lname='$lname', email='$email', dob='$dob', headline='$headline', current_pos='$cpos', gender='$gender', highest_edu='$edu', highest_univ='$univ', city='$city', state='$state', country='$country', phoneno='$mobile', description='$desc', last_updated='$updatetime', updated_by='$update_by' where userid='$user'";
//                echo $query;
                $result=  queryMysql($query);
                if($result){
                    echo '<div class="alert alert-success"><strong>Success!</strong> Profile Information has been updated!.</div>';
                } 
        }    
    }
 }

function displayImage($id)
{
    $query="select image from UserProfile where userid='$id'";
    $result= queryMysql($query);
  
    while($row = mysqli_fetch_array($result)){
        if($row[image]!=null)
            echo '<img class="profile-img" src="data:image/png/jpeg/bmp/gif;base64,'. $row['image'] .'"/> ';
        else 
            echo '<img class="profile-img" src="img/mumbra.jpg" alt="User Messenger"/>';
    }
}


function changePass(){

if($_POST){
    if(!empty($_POST['user'])&& !empty($_POST['pass'])&& isset($_POST['cpass'])){
        $user= strtolower(sanitizeString(trim($_POST['user'])));
        $pass=  sanitizeString(trim($_POST['pass']));
        $cpass=  sanitizeString(trim($_POST['cpass']));
        
        if($cpass!=$pass){
            echo '<div class="alert alert-danger">Passwords does not match</div>';
        }
        else
        {
            $s1="ht*!#wr";
            $s2="st&f@q#";
            $token= hash('ripemd128', "$s1$pass$s2");
            $query="update Access set pass='".$token."' where userid='".$user."'";
            $result=  queryMysql($query);
            if($result)
            {
                echo '<div class="alert alert-success">Password Successfully Changed</div>';
                if($_SESSION['role']=='3'){
                    echo '<script language="javascript">';
                    echo 'alert("Password Successfully Changed!\n'.
                    'Please Login Again.")';
                    echo '</script>';
                    header("Refresh: 0; url=logout.php");
                }
                
                
            }
            
        }
                     
    }
  }

}

function auto_copy_year($year='auto')
{
    if(intval($year) == 'auto'){$year=date('Y');}
    if(intval($year) == date('Y')){echo intval($year);}
    if(intval($year) < date('Y')){echo intval($year).'-'.date('Y');}
    if(intval($year) > date('Y')){echo date('Y');}
}