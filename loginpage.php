<?php include 'Config/config.php';?>
<?php
session_start();
$emailErr = $email = '';
$passwordErr = $password =$error = '';
if(isset($_POST['submit']))
{
    if(empty($_POST['email']))
    {
        $emailErr = 'Email required';
    }
    else
    {
        $email =filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        mysqli_real_escape_string($conn,$email);

    }

    if(empty($_POST['password']))
    {
        $passwordErr = 'Password required';
    }
    else
    {
        $password = filter_var($_POST['password'],FILTER_SANITIZE_SPECIAL_CHARS);
        mysqli_real_escape_string($conn,$password);
    }

    if(!empty($email) && !empty($password))
    {
        $sql = "SELECT * FROM users WHERE email ='$email' AND password ='$password'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count =mysqli_num_rows($result);
        
        if($count == 1)
        {
            $_SESSION['login_user'] = $email;
            header("Location:homepage.php");
        }
        else{
            $error = 'Error Invalid login';
        }

    }
}

?>

<center><form action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>" method="Post" >
<label for="email">Email</label><br>
<input type="text" name="email" placeholder="Enter Email"><br>
<?php if(!empty($emailErr)){echo "<p style='color:red;'>$emailErr.</p>";}?>
<label for="password">Password</label><br>
<input type="password" name="password" placeholder="Enter Password"><br>
<?php if(!empty($passwordErr)){echo "<p style='color:red;'>$passwordErr.</p>";}?><br>
<input type="submit" name="submit"  value="LOG IN"style=" height: 50px; width: 220px" >
<div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
</form></center>