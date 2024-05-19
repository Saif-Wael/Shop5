<?php
include 'config.php';
session_start();

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);   
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

    if(mysqli_num_rows($select) > 0){
        $row = mysqli_fetch_assoc($select);

        if(password_verify($password, $row['password'])){
            $_SESSION['user_id'] = $row['id'];
            header('location:index.php');
        } else {
            $message[] = 'Incorrect password!';
        }
    } else {
        $message[] = 'User not found!';
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
    <title>Login | jojo store</title>

    <link rel="stylesheet" href="css/style.css">
    <style>
        body{
            background-color:#7CB4E4;
        }

        .main {
            background-color:#A4C4E4;
            width: 450px;
            height: 400px;
            box-shadow: 1px 1px 10px black;
            border-radius: 10px;
            margin-top: 60px;
            padding: 10px;
        }

        h3 {
            margin-top: 30px;
            font-size:25px;
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
        }
    </style>
</head>

<body>

<?php
if(isset($message)){
    foreach($message as $message){
        echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
    }
}
?>

<div class="form-container">
    <form action="" method="post">
        <center>
            <div class="main">
                <h3>Sign In</h3>
                <input type="email" name="email" required placeholder="Email" class="box">
                <input type="password" name="password" required placeholder="Password" class="box">
                <input type="submit" name="submit" class="btn btn-primary" value="Sign In">
                <p>Don't have an account? <a  href="register.php">Sign Up</a></p>
            </div>
        </center>
    </form>
</div>

</body>

</html>
