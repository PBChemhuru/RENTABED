<?php include 'H&F/header.php';
$property_code = $_SESSION['rproperty_code'];
$count=0;
$avg=0;
?>

<h1>Booking for your Property</h1>


<div class="card">
<?php
$sql3= "SELECT * FROM booking WHERE property_code ='$property_code'";
$result3 = mysqli_query($conn,$sql3);
$row3=mysqli_fetch_all($result3, MYSQLI_ASSOC);
$result3ran=mysqli_num_rows($result3);

if(empty($result3ran))
{
echo "<h2>No bookings yet</h2>";
}
?>
  <div class="table" style="width: fit-content;">
    <table>
      <tr>
      <th>Booking Code</th>
      <th>Customer Name</th>
      <th>Customer Phone</th>
      <th>Booking Date</th>
      <th>Stay Duration</th>
    </tr>
    <?php foreach ($row3 as $item): ?>
    <tr>
      <td><?php echo $item['booking_code']?></td>
      <td><?php echo $item['customer_name']?></td>
      <td><?php echo $item['customer_pnumber']?></td>
      <td><?php echo $item['booking_date']?></td>
      <td><?php echo $item['stay_duration']?></td>
    </tr>
      
<?php endforeach; ?>
</div>
</div>