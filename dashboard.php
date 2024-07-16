<?php

session_start();
if(!isset($_SESSION['userdata'])){
    header("localhost: ../");
}

$userdata=$_SESSION['userdata'];
$groupdata=$_SESSION['groupdata'];

if($_SESSION['userdata']['status']==0){
    $status = '<b style="color:red;">Not Voted </b>';
}else{
     $status = '<b style="color:green;">Voted </b>';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
        }
        #header{
            background-color: rgba(105, 176, 196, 0.653);
            height: 80px;
            width: 100%;
            margin-top: 0%;
            display: inline-flex;
        }
        #header img{
            margin-left: 20px;
            height: auto;
            width: 100px;
        
        }
        #header #buttons{     
            border-radius: 5px;
             padding: 5px;
             margin-left: 80%;
             margin-top: 20px;
        }
        #header #buttons button{
            border-radius: 5px;
            margin-left: 10px;
            padding: 8px;
            background-color: rgb(153, 193, 224);

        }
        #container {
            margin-top: 2%;
            display: flex;
        }
        #content1 {
            height: 550px;
            width: 35%;
            background-color: rgb(211, 223, 228);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px;
        }
        #content1 img {
            height: 40%;
            width: 40%;
            margin-top: 3%;
            border-radius: 50%;
            border: 2px solid black;
        }
        #content1 b {
            margin: 10px 0;
        }
        #content2 {
            margin-left: 5%;
            width: 60%;
            background-color: rgb(211, 223, 228);
            display: flex;
            flex-wrap: wrap;
        }
        .group-item {
            width: 100%;
            display: flex;
            padding: 10px;
            border-bottom: 1px solid #ccc;
            margin-top: 2%;
            margin-bottom: 2%;
        }
        .group-item:last-child {
            border-bottom: none;
        }
        .group-item .details {
            width: 70%;
            padding: 10px;
        }
        .group-item .details b {
            display: block;
            margin-bottom: 5px;
        }
        .group-item img {
            width: 30%;
            max-width: 150px;
            object-fit: cover;
        }
        button {
            border-radius: 5px;
            padding: 5px;
            background-color: rgb(133, 199, 227);
            cursor: pointer;
        }
    </style>
</head>
<body>

<div id="header">
        <img src="image/vote.png">
        <div id="buttons">
            <a href="logout.php"><button>Logout</button></a>
        </div>
    </div>

<div id="container">
    <div id="content1">
        <img src="upload/<?php echo $userdata['photo']; ?>"><br>
        <b>Name : <?php echo $userdata['name']; ?></b><br>
        <b>Adhar No : <?php echo $userdata['adhar']; ?></b><br>
        <b>Address : <?php echo $userdata['address']; ?></b><br>
        <b>Status : <?php echo $status; ?></b><br>
    </div>

    <div id="content2">
        <?php
        if ($groupdata) {
            foreach ($groupdata as $group) {
                ?>
                <div class="group-item">
                    <div class="details">
                        <b>Party Name : <?php echo $group['name']; ?></b><br>
                        <b>Vote : <?php echo $group['votes']; ?></b><br>
                        <form action="api/vote.php" method="post">
                        <input type="hidden" name="gvotes" value="<?php echo $group['votes']; ?>">
                        <input type="hidden" name="gid" value="<?php echo $group['id']; ?>">
                        <?php 
                         
                         if($_SESSION['userdata']['status']==0){ ?>
                            <button type="submit" name="votebtn" value="vote" id="votebtn">Vote</button>
                            <?php 
                        }else{ ?>
                            <button type="button" name="votebtn" value="vote" id="votebtn">Voted</button>
                            <?php 
                        }
                        
                        ?>
                         </form>
                    </div>
                    <img src="upload/<?php echo $group['photo']; ?>" alt="group logo">
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>

</body>
</html>
