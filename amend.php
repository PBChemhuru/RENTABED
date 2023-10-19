<?php include 'H&F/header.php'?>
<?php
$property_name = $property_location = $property_price = $property_details = $property_pnumber='';
$property_nameErr = $property_locationErr = $property_priceErr = $property_detailsErr = $property_pnumberErr='';
$prop_code=$_SESSION['rproperty_code'];
if(isset($_POST['submit']))
{
    //validating entries

    if(empty($login_session))
    {
        header("Location:landingpage.php");
    }
    else
    {
        if(empty($_POST['property_name']))
        {
            $property_nameErr = 'Property Name is required';
        }
        else
        {
            $property_name= filter_var($_POST['property_name'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
    
        if(empty($_POST['property_location']))
        {
            $property_locationErr = 'Address is required';
        }
        else
        {
            $property_location= filter_var($_POST['property_location'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
        
        if(empty($_POST['property_price']))
        {
            $property_priceErr = 'Price is required';
        }
        else
        {
            $property_price= filter_var($_POST['property_price'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
        
        if(empty($_POST['property_details']))
        {
            $property_detailsErr = 'Please add description of property';
        }
        else
        {
            $property_details= mysqli_real_escape_string($conn,$_POST['property_details']);
        }
    
        if(empty($_POST['phonenumber']))
        {
            $property_pnumberrErr = 'Please add phonenumber';
        }
        else
        {
            $property_pnumber= mysqli_real_escape_string($conn,$_POST['phonenumber']);
        }
    
        if(!empty($_FILES['upload']['name'])){
            if(!empty($property_name)  && !empty($property_name)  && !empty($property_price)  && !empty($property_details))
    {
        $filename = $_FILES['upload']['name'];
        $filetmp = $_FILES['upload']['tmp_name'];
        $target_dir = "Properties/".basename($filename);
        $fileext =explode(".",$filename);
        $file_ext= $fileext[1];
    
        $allowed_ext=array('jpg','jpeg','png');
        if(in_array($file_ext,$allowed_ext))
        {
           if(move_uploaded_file($filetmp,$target_dir))
           {
            $sql3 = "UPDATE properties
            SET property_name = '$property_name',property_location = '$property_location',property_price = '$property_price',property_details = '$property_details',img_name = '$filename',property_pnumber = '$property_pnumber'
            WHERE property_code = '$prop_code'";
            $result3 = mysqli_query($conn,$sql3);
            header("Location:homepage.php");
           }
        }
        else
        {
            echo 'Invlaid file type:Please upload either jpeg,jpg or png';
        }

        }
        }
        else
        {
            $sql4 = "UPDATE properties
            SET property_name = '$property_name',property_location = '$property_location',property_price = '$property_price',property_details = '$property_details',property_pnumber = '$property_pnumber'
            WHERE property_code = '$prop_code'";
            $result4 = mysqli_query($conn,$sql4);
            header("Location:homepage.php");

        }

    }
    
}

$sql2="SELECT * FROM properties WHERE property_code='$prop_code'";
$result2=mysqli_query($conn,$sql2);
$row2=mysqli_fetch_array($result2);
?>

<center><form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" style="height: 500px; width: 300px" enctype="multipart/form-data">
<label for="property_name">Property Name</label><br>
<input type="text" name="property_name" value=<?php echo $row2['property_name']?>><br>
<?php if(!empty($property_nameErr)){echo "<p style='color:red;'>$property_nameErr.</p>";}?>
<label for="property_location">Property Location</label><br>
<input type="text" name="property_location" value=<?php echo $row2['property_location']?>><br>
<?php if(!empty($property_locationErr)){echo "<p style='color:red;'>$property_locationErr.</p>";}?>
<label for="property_price">Property Price</label><br>
<input type="text" name="property_price" value=<?php echo $row2['property_price']?>><br>
<label for="property_price">Phone Number</label><br>
<input type="tel" name="phonenumber" value=<?php echo $row2['property_pnumber']?>><br>
<?php if(!empty($property_priceErr)){echo "<p style='color:red;'>$property_priceErr.</p>";}?>
<label for="property_details">Property Description</label><br>
<textarea  name="property_details"style="height: 100px; width: fit-content"><?php echo $row2['property_details']?></textarea><br><br>
<?php if(!empty($property_detailsErr)){echo "<p style='color:red;'>$property_detailsErr.</p>";}?>

<input type="file" name="upload"><br><br>

<input type="submit" name="submit" value="Amend data" ><br>
</form></center>