<?php
include("connection.php");

$name = $_POST['name'];
$adhar = $_POST['adhar'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$address = $_POST['address'];
$role = $_POST['role'];
$image = $_FILES['photo']['name'];
$tmp_name = $_FILES['photo']['tmp_name'];

if ($password == $cpassword) {
    move_uploaded_file($tmp_name, "../upload/$image");
    $insert = mysqli_query($connect, "INSERT INTO user (name, adhar, password, address, photo, role, status, votes) VALUES ('$name', '$adhar', '$password', '$address', '$image', '$role', 0, 0)");

    if ($insert) {
        echo '
      <script>
      alert("Registration Successfully completed.");
      window.location = "../login.html";
      </script>
    ';
    } else {
        echo '
      <script>
      alert("Something went wrong!");
      window.location = "../register.html";
      </script>
    ';
    }
} else {
    echo '
      <script>
      alert("Password and Confirm password do not match!");
      window.location = "../register.html";
      </script>
    ';
}
?>
