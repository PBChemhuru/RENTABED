<?php include "H&F/header.php"?>
<H1>These are your current booking</H1>
<?php
$sql = "SELECT * FROM booking where customer_email='$useremail'";
$results =mysqli_query($conn,$sql);

while($row =mysqli_fetch_array($results))
 {
    $property_code = $row['property_code'];
    $sql2 ="SELECT * FROM properties where property_code='$property_code'";
    $results2= mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($results2);
echo "<center>";
echo "<div class='card'>";
echo "<img width='auto' height='100%' align='left' src='Properties/".$row2['img_name']."'>";
echo "<h1>".$row2['property_name']."</h1>";
echo "<h2 > Located:".$row2['property_location']."</h2>";
echo "<p> Price at $".$row2['property_price']."/PER DAY</p>";
echo "<p>Property owned by ".$row2['property_owner']." for inquires call :".$row2['property_pnumber']."</p>";
echo "<p>".$row2['avg_rating']." stars</p>";
echo "<p>Booking_Ref:".$row['booking_code']."</p>";
echo "<p>Booked for ".$row['booking_date']."</p>";
echo "<p>Booked for ".$row['stay_duration']." days</p>";
echo  "<form action ='bookingpage.php' method='POST'>";
echo  "<input type = 'submit' name='Cancel' value='Cancel'>";
echo "<input type = 'hidden' name='code' id='jason' value=".$row['booking_code'].">";
echo  "</form>";
echo "</div>";
echo "</center>";
 }

 if(isset($_POST['Cancel']))
 {
    $booking_ref = $_POST['code'];
    $sql3 ="DELETE FROM booking WHERE booking_code='$booking_ref'";
    $results3=mysqli_query($conn,$sql3);
    header("Location:homepage.php");
    echo "Booking Cancelled";
 }
 
?>


<?php include "H&F/footer.php"
?>