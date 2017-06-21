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
$(document).ready(function () {

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
        
    $("#bzone").change(function (e) {
        e.preventDefault();
        var zone = $(this).val();
        $('#bbuilding').prop('selectedIndex',0);
        $('#wing').prop('selectedIndex',0);
        $('#seflat').prop('selectedIndex',0);
        
        $('#sebuilding').val("");
        $('#sewing').val("");
        $('#seflatedit').val("");
        
        var dataString = 'zone=' + zone;
        $.ajax({
            type: 'POST',
            url: 'loadZoneBuilding.php',
            data: dataString,
            cache: false,
            success: function (html)
            {
                $("#bbuilding").html(html);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });
    
    $("#bbuilding").change(function (e) {
        e.preventDefault();
        var building= $(this).val();
        var zone=$('#bzone').val();
        $('#wing').prop('selectedIndex',0);
        $('#seflat').prop('selectedIndex',0);
        
        $('#sebuilding').val(building);
        $('#sewing').val("");
        $('#seflatedit').val("");
        
        var dataString = 'building=' + building+'&zone='+zone;
        $.ajax({
            type: 'POST',
            url: 'loadBuildingWing.php',
            data: dataString,
            cache: false,
            success: function (html)
            {
                $("#wing").html(html);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });
    
    $("#wing").change(function (e) {
        e.preventDefault();
        var wing = $(this).val();
        var zone = $('#bzone').val();
        var building = $('#bbuilding').val();
        $('#seflat').prop('selectedIndex',0);
        
        $('#sewing').val(wing);
        $('#seflatedit').val("");
        
        var dataString = 'zone='+zone+'&building='+building+'&wing=' + wing;
        $.ajax({
            type: 'POST',
            url: 'loadSurveyWing.php',
            data: dataString,
            cache: false,
            success: function (html)
            {
                $("#seflat").html(html);
                
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });
    
    $("#seflat").change(function (e) {
        e.preventDefault();
        var flat = $(this).val();
        var wing = $('#wing').val();
        var zone = $('#bzone').val();
        var building = $('#bbuilding').val();
        
        $('#seflatedit').val(flat);
        $('#sebuilding').attr('disabled',false);
        $('#sewing').attr('disabled',false);
        $('#seflatedit').attr('disabled',false);
        
        var dataString = 'zone='+zone+'&building='+building+'&wing=' + wing+'&flat=' + flat;
        $.ajax({
            type: 'POST',
            url: 'loadSurveyEdit.php',
            data: dataString,
            cache: false,
            success: function (html)
            {
                $("#surveydata").html(html);
                $('#seedit').attr('disabled',false);
                
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });
    
    $("#bezone").change(function (e) {
        e.preventDefault();
        var zone = $(this).val();
        $('#bebuilding').prop('selectedIndex',0);
        $('#bewing').prop('selectedIndex',0);
        
        $('#bebuildingedit').val("");
        $('#bewingedit').val("");
        
        var dataString = 'zone=' + zone;
        $.ajax({
            type: 'POST',
            url: 'loadBuildingBuilding.php',
            data: dataString,
            cache: false,
            success: function (html)
            {
                $("#bebuilding").html(html);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });
    
    $("#bebuilding").change(function (e) {
        e.preventDefault();
        var building= $(this).val();
        var zone=$('#bezone').val();
        $('#bewing').prop('selectedIndex',0);
        
        $('#bebuildingedit').val(building);
        $('#bewingedit').val("");
        
        var dataString = 'building=' + building+'&zone='+zone;
        $.ajax({
            type: 'POST',
            url: 'loadBuildingEditWing.php',
            data: dataString,
            cache: false,
            success: function (html)
            {
                $("#bewing").html(html);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });
    
    $("#bewing").change(function (e) {
        e.preventDefault();
        var wing = $(this).val();
        var zone = $('#bezone').val();
        var building = $('#bebuilding').val();
        
        $('#bewingedit').val(wing);
        $('#bebuildingedit').attr('disabled',false);
        $('#bewingedit').attr('disabled',false);
        
        var dataString = 'zone='+zone+'&building='+building+'&wing=' + wing;
        $.ajax({
            type: 'POST',
            url: 'loadBuildingEdit.php',
            data: dataString,
            cache: false,
            success: function (html)
            {
                $("#buildingdata").html(html);
                $('#beedit').attr("disabled",false);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });
});