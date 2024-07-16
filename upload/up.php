<?php
session_start();
include("connection.php");

$adhar= $_POST['adhar'];
$password= $_POST['password'];
$role = $_POST['role'];

$check = mysqli_query($connect, "SELECT * FROM user WHERE adhar='$adhar' AND password='$password' AND role='$role' ");
if(mysqli_num_rows($check)>0){
    $userdata = mysqli_fetch_array($check);
    $group = mysqli_query($connect, "SELECT * FROM user WHERE role='party' ");
    $groupdata = mysqli_fetch_all($group, MYSQLI_ASSOC);

    $_SESSION['userdata']=$userdata;
    $_SESSION['groupdata']=$groupdata;

    echo '
    <script>
    window.location = "../dashboard.php";
    </script>
  ';

}
else{
    echo '
    <script>
    alert("Invalid Credentials or User not Found!");
    window.location = "../login.html";
    </script>
  ';
}


?>
