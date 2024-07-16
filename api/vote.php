<?php
session_start();
include('connection.php');

$votes=$_POST['gvotes'];
$total_votes = $votes+1;
$gid = $_POST['gid'];
$uid = $_SESSION['userdata']['id'];

$update_votes = mysqli_query($connect, "UPDATE user SET votes='$total_votes' WHERE id='$gid' ");
$update_user_status=mysqli_query($connect, "UPDATE user SET status=1 WHERE id='$uid' ");

if($update_votes and $update_user_status){
    $group = mysqli_query($connect, "SELECT * FROM user WHERE role='party' ");
    $groupdata = mysqli_fetch_all($group, MYSQLI_ASSOC);
    $_SESSION['userdata']['status']=1;
    $_SESSION['groupdata']=$groupdata;

    echo '
    <script>
    alert("Voting Successfull");
    window.location = "../dashboard.php";
    </script>
  ';

}else{
    echo '
      <script>
      alert("Something went wrong!");
      window.location = "../dashboard.php";
      </script>
    ';
}


?>