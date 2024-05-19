<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    header('location:index.php');
 }
 
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>jojo store</title>
    <style>
        body{
            background-color:#7CB4E4;
        }
        .class{
            
            margin-top:60px;
            padding:15px;
            box-shadow:1px 1px 10px black;
            width:530px;
            border-radius:10px;
        }
        h3{
            margin-top:15px;
        }
        a{
            font-size:20px;   
            
        }
    </style>
</head>
<body>
    <center>
        <div class="main">
            <form action="" method="post">
                <div class="class">

                <h3>"Thank you for visiting our website"</h3>
                </div>
                <br>
                <a href="index.php?delete_all" onclick="return confirm('You will receive your order within 3-5 Days');" class=" <?php echo ($grand_total > 1)?'':'disabled'; ?>">Back to Home page</a>
                
            </form>
        </div>
    </center>
    
</body>
</html>