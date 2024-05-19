<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri&family=Cairo:wght@200&family=Poppins:wght@100;200;300&family=Tajawal:wght@300&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jojo store | admin page</title>
    <style>
        body{
            background-color:#a4c4e4;
        }
        h3{
            margin-top:10px;
            font-family: arial;
            font-weight: bold;
        }
        #add{
            margin-top:10px;
        }
        .cart{
            float: right;
            margin-top: 20px;
            margin-left: 10px;
            margin-right: 10px;
            background-color:#a4c4e4;

        }
        .cart img{
            width: 100%;
            height: 200px;
        }
        main{
            margin-right:90px;
            width: 80%;
        }

    </style>
</head>
<body>

    <center>
        <a class="btn btn-info" id="add" href="index.php">Add Product</a>
        <h3>All Products Available</h3>
    </center>
    <?php
    include('config.php');
    $result = mysqli_query($con, "SELECT * FROM products");
    while($row = mysqli_fetch_array($result)){
        echo "
        <center>
        <main>
            <div class='cart' style='width: 15rem;'>
                <img src='$row[image]' class='card-img-top'>
                <div class='card-body'>
                    <h5 class='cart-title'>$row[name]</h5>
                    <p class='cart-text'>$row[price]</p>
                    <a href='delete.php? id=$row[id]' class='btn btn-danger'>Delete</a>
                    <a href='update.php? id=$row[id]' class='btn btn-primary'>Edit</a>
                </div>
            </div>
        </main>
        <center>
        ";
    }
    ?>
    
    
</body>
</html>