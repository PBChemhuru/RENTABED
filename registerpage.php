<?php include 'Config/config.php';?>
<?php
$name =$email =$password ='';
$nameErr=$emailErr=$passwordErr='';
if(isset($_POST['submit']))
{
    if(empty($_POST['name']))
    {
        $nameErr = 'Name is required';
    }
    else
    {
        $name = filter_var($_POST['name'],FILTER_SANITIZE_SPECIAL_CHARS);
    }

    if(empty($_POST['email']))
    {
        $emailErr = 'Email is required';
    }
    else
    {
        $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    }

    if(empty($_POST['password']))
    {
        $passwordErr = 'password is required';
    }
    else
    {
        $password = filter_var($_POST['password'],FILTER_SANITIZE_SPECIAL_CHARS);
    }

    if(!empty($name) && !empty($email) && !empty($password))
    {
        $sql = "INSERT INTO users(name,email,password) VALUES('$name','$email', '$password')";
        if(mysqli_query($conn,$sql)){
            header("Location:loginpage.php");
        }
        else
        {
            echo 'Error: '.mysqli_error($conn);
        }
        
    }
    
}

?>

<center><form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" >
<label for="name">Name</label><br>
<input type="text" name="name" placeholder="Enter Name"><br>
<?php if(!empty($nameErr)){echo "<p style='color:red;'>$nameErr.</p>";}?>
<label for="email">Email</label><br>
<input type="text" name="email" placeholder="Enter Email"><br>
<?php if(!empty($emailErr)){echo "<p style='color:red;'>$emailErr.</p>";}?>
<label for="password">Password</label><br>
<input type="password" name="password" placeholder="Enter Password"><br>
<?php if(!empty($passwordErr)){echo "<p style='color:red;'>$passwordErr.</p>";}?>
<input type="submit" name="submit"  value="REGISTER"style=" height: 70px; width: 250px" >
</form></center>