<?php include 'H&F/header.php';
$property_code = $_SESSION['rproperty_code'];
$sum='0';
?>

<h1>Reviews for your Property</h1>


<div class="card">
<?php
$sql3= "SELECT * FROM reviews WHERE property_code ='$property_code'";
$result3 = mysqli_query($conn,$sql3);
$row3=mysqli_fetch_all($result3, MYSQLI_ASSOC);
$countrow=mysqli_num_rows($result3);

if(empty($countrow))
{
echo "<h2>No reviews yet</h2>";
}
else
{
  

}

?>
<?php foreach ($row3 as $item): ?>
  <div class="">
    <h2><?php echo $item['r_name']?></h2>
    <p><?php echo $item['review']?></p>
    <p><?php echo $item['rating']?> Stars</p>
    <?php $sum+=intval($item['rating']);?>
<?php endforeach; ?>
</div>
</div>