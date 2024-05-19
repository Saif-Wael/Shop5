
















<?php
include 'config.php';

$message = array();

if (isset($_POST['submit'])) {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    

    $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('Query failed');

    if (mysqli_num_rows($select) > 0) {
        $message[] = 'User already exists!';
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        

        mysqli_query($conn, "INSERT INTO `users` (fname, lname, email, password ) VALUES ('$fname', '$lname', '$email', '$hashed_password')") or die('Query failed');
        $message[] = 'Registered successfully!';
        header('location:login.php');
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
    <title>Sign up | jojo store</title>

    <link rel="stylesheet" href="css/sttyle.css">
    <style>
        body{
            background-color:#7CB4E4;
        }
        

        .main {

            background-color:#A4C4E4;
            width: 450px;
            height: 600px;
            box-shadow: 1px 1px 10px black;
            border-radius: 10px;
            margin-top: 50px;
            padding: 10px;
        }

        h3 {
            font-size: 25px;
            margin-top: 45px;

        }

        input {
            margin-top: 15px;
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
        }
    </style>
</head>

<body>

    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '<div class="message" onclick="this.remove();">' . $message . '</div>';
        }
    }
    ?>

    <div class="form-container">
        

        <form action="" method="post">
            <center>
                <div class="main">
                    <h3>Sign Up</h3>
                    <input type="text" name="fname" required placeholder="frist name" class="box">
                    <input type="text" name="lname" required placeholder="last name" class="box">
                    <input type="email" name="email" required placeholder="email" class="box">
                    <input type="password" name="password" required placeholder="password" class="box">
                    <input type="submit" name="submit" class="btn btn-primary" value="Create Account">
                    <p>Already have an account?<a href="login.php"> Sign In</a></p>

                </div>
            </center>

        </form>

    </div>

</body>

</html>
