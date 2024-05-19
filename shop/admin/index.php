<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri&family=Cairo:wght@200&family=Poppins:wght@100;200;300&family=Tajawal:wght@300&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jojo store | admin page</title>
    <link rel="stylesheet" href="inddex.css">
    <style>
    body{
        backrpund-color:#FCF7EE;
        background-color:#a4c4e4;

    }
    .main{
        background-color: #ECF4F4;
        width: 500px;
        height:630px;
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
    <center>
        <div class="main">
            <form action="insert.php" method="post" enctype="multipart/form-data">
                <h2>jojo store </h2>
                <img src="shop.png" alt="logo" width="450px">
                <input type="text" name='name' placeholder='Product Name' required>
                <br>
                <input type="text" name='price' placeholder='Product Price' required>
                <br>
                <input type="file" id="file" name='image' style='display:none;'>
                <label for="file"> choose file</label>
                <button name='upload'>Add Product✅</button>
                <br><br>
                <a href="products.php">All Products</a>
            </form>
        </div>
    </center>
</body>
</html>