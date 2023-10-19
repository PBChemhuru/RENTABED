<?php  
include('Session/session.php');
include('styles/homepage.css');?>
<html>
<div class="topnav">
    <a class= "active" href="homepage.php">HOME</a>
    <a href="bookingpage.php">Bookings</a>
    <div class='dropdown'>
        <button class="dropdownbtn" onclick="myFunction()">Properties<i class="fa fa-caret-down"></i></button>
        <div class='dropdowncontent' id='myDropdown'>
            <a href="properties.php">Rent out Property</a>
            <a href="cproperties.php">Manage Properties</a>
        </div>
    </div>
    <a href="landingpage.php" class="signin" >Sign In</a>
    <a href="logoutpage.php" class="spilt">Sign Out</a>
</div>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <script>
        function myFunction()
        {
            document.getElementById("myDropdown").classList.toggle("show");
        }

    window.onclick=function(e)
    {
        if(!e.target.matches('.dropdownbtn'))
        {
            var myDropdown =document.getElementById("myDropdown");
            if(myDropdown.classList.contains('show'))
            {
                myDropdown.classList.remove('show');
            }
        }

    }
    </script>
    
</body>
</html>