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
 
 Created On: Jun 21, 2017
 */
$(function () {

 $("#cpass").change(function (e) {
        e.preventDefault();
        var cpass = $(this).val();
        var pass = document.getElementById("pass");
        if (pass.value != cpass)
        {
            $(this).val("");
            $("#cpasserr").html("<font color='red'>Passwords do not match</font>");
        }
        else
        {
            $("#cpasserr").html("<font color='green'>Passwords Match</font>");
        }

    });

    $("#pass").change(function (e) {
        e.preventDefault();
        //var cpass=$(this).val();
        var cpass = document.getElementById("cpass");
        cpass.value = "";
        $(this).focus();
        /*if(pass.value!=cpass)
         {
         $(this).val("");
         $("#cpasserr").html("<font color='red'>Passwords do not match</font>");
         }*/

    });

    $("#oldpass").change(function (e) {
        e.preventDefault();
        var pass = $(this).val();
        var user = document.getElementById("user").value;
        var dataString = 'user=' + user + '&pass=' + pass;

        $.ajax({
            type: 'POST',
            url: 'checkpass.php',
            data: dataString,
            cache: false,
            success: function (html)
            {
                var msg = null;
                if (html == "false") {
                    msg = "<font color='red'>Wrong Password</font>";
                }
                else {
                    msg = "<font color='green'>Correct Password</font>";
                    document.getElementById("pass").disabled = false;
                    document.getElementById("cpass").disabled = false;
                }
                $("#passerr").html(msg);
            }
        });

        });
        
    $(".btn-delete").on('click',function (e) {
        e.preventDefault();
        var id = $(this).attr("id");
        var btn=this;
        var dataString = 'msgid=' + id;
        $.ajax({
            type: 'POST',
            url: 'deletemsg.php',
            data: dataString,
            cache: false,
            success: function (html)
            {
                $(btn).parent().html(html);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });
    
    
});