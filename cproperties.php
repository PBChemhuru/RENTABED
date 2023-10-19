<?php
 include('H&F/header.php');
 ?>

<center>

<?php 
if(isset($_POST['vbooking']))
{
   if(empty($login_session))
   {
       header("Location:landingpage.php");
       
   }
   else
   {
    $_SESSION['rproperty_code'] =($_POST['code']);
  header("Location:pbookingpage.php");
   }
}
if(isset($_POST['reviews']))
{
   if(empty($login_session))
   {
       header("Location:landingpage.php");
       
   }
   else
   {
    $_SESSION['rproperty_code'] =($_POST['code']);
  header("Location:reviewpages.php");
   }
}
if(isset($_POST['delete']))
{
   if(empty($login_session))
   {
       header("Location:landingpage.php");
       
   }
   else
   {
    $prop_code=($_POST['code']);
    $sql3="DELETE FROM properties WHERE property_code='$prop_code' ";
    $results3=mysqli_query($conn,$sql3);
   }
}
if(isset($_POST['amend']))
{
   if(empty($login_session))
   {
       header("Location:landingpage.php");
       
   }
   else
   {
    $_SESSION['rproperty_code'] =$_POST['code'];
  header("Location:amend.php");
   }
}

echo "<h1>Your Properties</h1>";

$sql = "SELECT * FROM properties WHERE property_owner='$login_session' ";
$results =mysqli_query($conn,$sql);
$count =mysqli_num_rows($results);

if(empty($count))
{
  echo "<h2>You currently don't have any properties for rent.</h2>";
}
 while($rows =mysqli_fetch_array($results))
 {
echo "<div class='card'>";
echo "<img width='auto' height='100%' align='left' src='Properties/".$rows['img_name']."'>";
echo "<h1>".$rows['property_name']."</h1>";
echo "<h2 > Located:".$rows['property_location']."</h2>";
echo "<p> Price at $".$rows['property_price']."/PER DAY</p>";
echo "<p>".$rows['property_details']."</p>";
echo "<p>".$rows['avg_rating']." stars</p>";
echo  "<form action ='' method='POST'>";
echo  "<input type = 'submit' name='vbooking' value='Bookings' style='margin-right:5px'>";
echo  "<input type = 'submit' name='reviews' value='Reviews' style='margin-right:5px'><br><br>";
echo  "<input type = 'submit' name='delete' value='Delete'style='margin-right:5px'>";
echo  "<input type = 'submit' name='amend' value='Amend property details' >";
echo "<input type = 'hidden' name='code' id='jason' value=".$rows['property_code'].">";
echo  "</form>";

echo "</div>";
 }

 
?>



</center>