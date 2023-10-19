<?php include 'Config/config.php';?>
<?php session_start();

if(!isset($_SESSION['login_user'])){
    $login_session ='';
 }
 else
 {
$useremail = $_SESSION['login_user'];
$sql ="SELECT name FROM users WHERE email='$useremail'";
$result= mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
$login_session = $row['name'];
 }
?>

