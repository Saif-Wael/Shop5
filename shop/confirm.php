<?php
include 'config.php';

$message = array();

if (isset($_POST['confirm'])) {
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $card_number = mysqli_real_escape_string($conn, $_POST['card_number']);
    $expiry = mysqli_real_escape_string($conn, $_POST['expiry']);
    $card_cvv = mysqli_real_escape_string($conn, $_POST['card_cvv']);

    $select = mysqli_query($conn, "SELECT * FROM `confirm` WHERE email = '$email'") or die('Query failed');

    if (mysqli_num_rows($select) > 0) {
        $message[] = 'User already exists!';
    } else {
        mysqli_query($conn, "INSERT INTO `confirm` (email, name, address, card_number, expiry, card_cvv) VALUES ('$email', '$name', '$address', '$card_number', '$expiry', '$card_cvv')") or die('Query failed');
        
        header('location:end.php');
    }
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
        body {
            background-color:#A4C4E4;

        }

        .main {

            background-color:#A4C4E4;
            width: 500px;
            height: 680px;
            box-shadow: 1px 1px 20px black;
            border-radius: 10px;
            margin-top: 20px;
            padding: 10px;
        }

        h3 {
            font-size: 25px;
            margin-top: 15px;

        }
        img{
            margin-top:5px;
        }

        input {

            margin-bottom: 20px;
            width: 60%;
            padding: 10px;
            font-family: arial;
            font-size: 15px;
            font-weight: bold;
            border-radius: 10px;
        }

        p {
            font-size: 20px;
        }

        .btn {
            background-color: #8CCCF4;
            cursor: pointer;
            width:180px;
        }
        img{
            margin-right:110px;
        }



    </style>
</head>

<body>
    <div classs="form-container">
        <form action="" method="POST">
            <center>
                <div class="main">
                    <h3>Confirm Your Order</h3>
                    <br>
                    <img src="visa.png" alt="visa" width="120">
                    <br> <br>
                    <?php
                    if (isset($message)) {
                        foreach ($message as $msg) {
                            echo '<p>' . $msg . '</p>';
                        }
                    }
                    ?>
                    <input type="email" name="email" placeholder="your email" required>
                    <input type="text" name="name" placeholder="your name" required>
                    <input type="text" name="address" placeholder="your address" required>
                    <input type="text" id="cardnumber" name="card_number" pattern="\d{16,19}" title="Please enter a 16 to 19-digit card number" placeholder="Card Number" required>
                    <input type="text" id="expiry Date" name="expiry" placeholder="Expiry Date" required>
                    <input type="text" id="card_cvv" name="card_cvv" pattern="\d{3}" title="Please enter a 3-digit CVV number" placeholder="cvc/cvv" required>
                    <br>
                    <input type="submit" name="confirm" class="btn btn-primary" value="Confirm">
                    <br>
                    <a href="cart.php">Back to My cart</a>
                </div>
                </center>
        </form>
            
       
    </div>
    

</html>
