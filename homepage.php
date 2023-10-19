<?php
 include('H&F/header.php');
 ?>
<html>
<body>
    <h1>Welcome <?php echo $login_session?></h1>
    <center><h2>Avalible Beds</h2></center>

<center>

    <?php 
    if(isset($_POST['Reserve']))
    {
       if(empty($login_session))
       {
           header("Location:landingpage.php");
           
       }
       else
       {
        $_SESSION['rproperty_code'] =($_POST['code']);
      header("Location:reservepage.php");
       }
    }
   
    $sql = "SELECT * FROM properties";
    $results =mysqli_query($conn,$sql);
     while($rows =mysqli_fetch_array($results))
     {
    echo "<div class='card'>";
    echo "<img width='auto' height='100%' align='left' src='Properties/".$rows['img_name']."'>";
    echo "<h1>".$rows['property_name']."</h1>";
    echo "<h2 > Located:".$rows['property_location']."</h2>";
    echo "<p> Price at $".$rows['property_price']."/PER DAY</p>";
    echo "<p>".$rows['property_details']."</p>";
    echo "<p>".$rows['avg_rating']." stars</p>";
    echo  "<form action ='homepage.php' method='POST'>";
    echo  "<input type = 'submit' name='Reserve' value='Reserve'>";
    echo "<input type = 'hidden' name='code' id='jason' value=".$rows['property_code'].">";
    echo  "</form>";
    
    echo "</div>";
     }
    
     
    ?>



</center>
</body>
</html>
<?php include('H&F/footer.php');
 ?>

  
