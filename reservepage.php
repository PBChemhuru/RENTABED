<?php
 include('H&F/header.php');
 //session passed data
 $property_code = $_SESSION['rproperty_code'];
 $user_email = $_SESSION['login_user'];
 //fetching database
$usql = "SELECT * FROM users WHERE email = '$user_email'";
$uresult= mysqli_query($conn,$usql);
$urow = mysqli_fetch_array($uresult);
$ucount =mysqli_num_rows($uresult);
$sql = "SELECT * FROM properties WHERE property_code = '$property_code'";
$result= mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);
$count =mysqli_num_rows($result);
$phonenumerErr= $staydurationErr= $bookingdateErr='';
//submiting data to database
if(isset($_POST['Book']))
{
   if(empty($_POST['phonenumber']))
   {
    $phonenumerErr ="Please enter phone number."; 
   }
   else
   {
    $customer_pnumber = filter_var($_POST['phonenumber'],FILTER_SANITIZE_NUMBER_INT);
   }

   if(empty($_POST['stayduration']))
   {
    $staydurationErr ="Please enter duration of stay."; 
   }
   else
   {
    $stay_duration = filter_var($_POST['stayduration'],FILTER_SANITIZE_NUMBER_INT);
   }
  }
   

   if(empty($_POST['date']))
   {
    $bookingdateErr ="Please select booking date."; 
   }
   else
   {
    $newDate = filter_var($_POST['date'],FILTER_SANITIZE_SPECIAL_CHARS);
    $orgDate =  $newDate;  
    $booking_date = date("Y/m/d", strtotime($orgDate)); 
    if
    ($booking_date > date("Y/m/d"))
    {
      if(!empty($customer_pnumber) && !empty($booking_date))
      {
       $booking_code= rand();
       $sqliran= "SELECT * FROM booking WHERE booking_code = '$booking_code' ";
           $resultran = mysqli_query($conn,$sqliran);
           $rowran = mysqli_num_rows($resultran);
           if(!empty($rowran))
           {
               $booking_code= rand();
           }
   
         
         
       $sql= "INSERT INTO booking(property_code,booking_code,customer_pnumber,customer_email,booking_date,customer_name,stay_duration)VALUES('$property_code','$booking_code','$customer_pnumber','$user_email','$booking_date','$login_session','$stay_duration')";
       $result=mysqli_query($conn,$sql);
       header("Location:bookingpage.php");
      }  
    }
    else
    {
      echo '<script>alert("Booking date has already passed")</script>'; 
    }
   }

   $sql3= "SELECT * FROM reviews WHERE property_code ='$property_code'";
   $result3 = mysqli_query($conn,$sql3);
   $row3=mysqli_fetch_all($result3, MYSQLI_ASSOC);
   $count2=mysqli_num_rows($result3);
   $sum=0;
   $avg=0;
   foreach ($row3 as $item)
   {
     $sum+=intval($item['rating']);
     $avg=$sum/$count2;
   }
   
$review = $rating = '';
$reviewErr = $ratingErr= '';
$sql5="SELECT* FROM booking WHERE property_code='$property_code' AND customer_email='$user_email'";
$result5=mysqli_query($conn,$sql5);
$count5=mysqli_num_rows($result5);
if(isset($_POST['subreview']))
   {
    if($count5 >0)
    {
    if(empty($_POST['review']))
    {
      $reviewErr="Leave a comment before leaving review.";
    }
    else
    {
      $review=filter_var($_POST['review'],FILTER_SANITIZE_SPECIAL_CHARS);
    }

    if(empty($_POST['rating']))
    {
      $ratingErr="Select rating before leaving review.";
    }
    else
    {
      $rating=$_POST['rating'];
    }

    if(!empty($review) && !empty($rating))
    {
        $sql2="INSERT INTO reviews(property_code,r_name,review,rating) VALUES('$property_code','$login_session','$review','$rating')";
        $result2=mysqli_query($conn,$sql2);

        $sql4="UPDATE properties SET avg_rating='$avg' WHERE property_code='$property_code'";
        $result4=mysqli_query($conn,$sql4);

    }
  }
  else
  {
    echo '<script>alert("You dont any previous booking on this property ratings can only be left by previous costumers")</script>'; 
  }
   }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
</head>
<body>
<center>
<form stlye=height:fit-content action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method='POST'>
<div class='card' stlye=height:fit-content>
<img width='auto' height='100%' align='left' src='Properties/<?php echo $row['img_name']?>'>
<h1><?php echo  $row['property_name']?></h1>
<p>Located:<?php echo $row['property_location']?></p>
<p>Price at $<?php echo $row['property_price']?> per day</p>
<p>Rating:<?php echo $avg?> stars</p>
<label for='phonenumber'>Phone Number</label><br>
<?php if(!empty($phonenumerErr)){echo $phonenumerErr;}?><br>
<input type='tel' name='phonenumber' placeholder='0712345678' pattern="[0]{1}[7]{1}[0-9]{8}"><br>
<label for='bookingdate'>Booking date</label><br>
<?php if(!empty($bookingdateErr)){echo $bookingdateErr;}?><br>
<input type="text" id="datepicker" name="date"><br>
<label for='stayduration'>How many days will you stay</label><br>
<?php if(!empty($staydurationErr)){echo $staydurationErr;}?><br>
<input type="number" name="stayduration"><br><br>
<input type='submit' value='Reserve'  name='Book'>
</form>
</center>

<center>
<form style="width:80%; height:fit-content" action="reservepage.php" method="POST">
  <h1>Reviews</h1>

<div class="comment">
<label for="Review">Leave a review</label><br><br>
<?php if(!empty($reviewErr)){ echo "<p style='color:red;'>".$reviewErr."</p>";}?>
<textarea name="review" style="width:60%; height: 100px;; float:left; margin-left:30px;"></textarea>
<label>Rating</label><i class="fa fa-star" style="color: gold;"></i><br>
<select name="rating">
  <option value=" " disabled selected>Select...</option>
  <option value="1">1 Star</option>
  <option value="2">2 Star</option>
  <option value="3">3 Star</option>
  <option value="4">4 Star</option>
  <option value="5">5 Star</option>
</select><br><br>
<input type="submit" name="subreview" value="Review">
<?php if(!empty($ratingErr)){ echo "<p style='color:red;'>".$ratingErr."</p>";}?>
</div>

<div class="card">
<?php
if(empty($count2))
{
echo "<h2>No reviews yet</h2>";
}
?>
<?php foreach ($row3 as $item): ?>
  <div class="">
    <h2><?php echo $item['r_name']?></h2>
    <p><?php echo $item['review']?></p>
    <p><?php echo $item['rating']?> Stars</p>
<?php endforeach;
?>
</div>
</div>

</form>


</center
    
</body>
</html>

