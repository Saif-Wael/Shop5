<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri&family=Cairo:wght@200&family=Poppins:wght@100;200;300&family=Tajawal:wght@300&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jojo store | edit</title>
    <link rel="stylesheet" href="inddex.css">
    <style>
    body{
        backrpund-color:#FCF7EE;

    }
    .main{
        background-color: #ECF4F4;
        width: 500px;
        height:400px;
        box-shadow: 1px 1px 10px black;
        border-radius:10px;
        margin-top: 45px;
        padding: 10px;
    }
    h2{
        font-family: Arial, Helvetica, sans-serif;
    }
    input{
    
    margin-bottom: 10px;
    width: 60%;
    padding: 10px;
    font-family: arial;
    font-size: 15px;
    font-weight: bold;
    border-radius:10px;
    }
    button{
        border:none;
        border-radius:8px;
        padding: 12px;
        width: 40%;
        font-weight: bold;
        font-size: 15px;
        background-color: #1AC15C;
        cursor: pointer;
        font-family: arial;
        margin-bottom: 15px;
    }
    label{
        padding: 10px;
        border-radius:8px;
        cursor: pointer;
        font-weight: bold;
        font-size: 15px;
        background-color: #1F87CF;
        font-family: arial;
        color:white;
    }
    a{
        background-color:#ADFA25;
        color:black;
        text-decoration: none;
        border:none;
        border-radius:6px;
        padding:8px;
        font-family: arial;
        font-weight: bold;
    }
    </style>
</head>
<body>
    <?php
    include('config.php');
    $ID=$_GET['id'];
    $up = mysqli_query($con, "select * from products where id =$ID");
    $data = mysqli_fetch_array($up);
    
    ?>
    <center>
        <div class="main">
            <form action="up.php" method="post" enctype="multipart/form-data">
                <h2>Update Product</h2>
                <br><br>
                <input type="text" name='id' value='<?php echo $data['id']?>'  style='display:none;'>
                <br>
                <input type="text" name='name' value='<?php echo $data['name']?>'>
                <br>
                <input type="text" name='price' value='<?php echo $data['price']?>'>
                <br>
                <input type="file" id="file" name='image' style='display:none;'>
                <label for="file"> Update File</label>
                <button name='update' type='submit'>Update Product</button>
                <br><br>
                <a href="products.php">All Products</a>
            </form>
        </div>
    </center>
</body>
</html>