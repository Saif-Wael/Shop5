<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
};



if(isset($_POST['update_cart'])){
   $update_quantity = $_POST['cart_quantity'];
   $update_id = $_POST['cart_id'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
   $message[] = 'Shopping cart quantity updated successfully!';
}

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
   header('location:index.php');
}
  
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

   <link rel="stylesheet" href="style.css">
   <style>
      body{
         background-color:#A4C4E4;
      }
    h1{
        margin-top:20px;
        font-size:25px;
        font-family:arial;
    }
    nav {
            background-color: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
        }
        nav a {

            color: white;
            text-decoration: none;
            font-size:20px;
            margin:0 20px;
        }
        nav a i{
                    color:red;
        }
        .shopping-cart{
            margin-top:20px;
            padding:20px;

        }
        table{
            background-color:#ACCCFC;
            margin-top:20px;
            width: 60%;
            text-align: center;
            border:2px gray solid;
            padding:5px;
            border-radius: 10px;
            
        }
        thead{
            color:black;
            text-align: center;
            margin-left:5px;
        }
        tbody{
            
        }
         table thead th{
            padding:10px;
            color:black;
            font-size:20px;
            font-family:arial;
            text-transform: capitalize;
            font-size: 15px;
        }
         table .table-bottom{
            background-color: var(--light-bg);
        }

         table tr td{
            padding:10px;
            font-size: 16px;
            color:black;
            background-color:#ACCCFC;

        }


   </style>
</head>
<body>
    <nav >
        <a class="btn btn-primary" id="home" href="index.php">
            <u> Home</u>
        </a>
        <a id="cart" class="btn btn-info" href="cart.php">
            <i class="fa fa-shopping-cart"></i>
            <u>My Cart</u>
        </a>
        <a href="index.php?logout=<?php echo $user_id; ?>" onclick="return confirm('Are you sure you want to log out?');" class="btn btn-info">Log Out
        </a>
        
    </nav>
    <center>
    <div class="shopping-cart">

<h1 class="heading"> My Cart</h1>

<table>
   <thead>
      <th>Image</th>
      <th>Name</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Total price</th>
      <th>Delete</th>
   </thead>
   <tbody>
   <?php

      $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      $grand_total = 0;
      if(mysqli_num_rows($cart_query) > 0){
         while($fetch_cart = mysqli_fetch_assoc($cart_query)){
   ?>
      <tr>
         <td><img src="admin/<?php echo $fetch_cart['image']; ?>" height="75" alt=""></td>
         <td><?php echo $fetch_cart['name']; ?></td>
         <td><?php echo $fetch_cart['price']; ?>$ </td>
         <td>
            <form action="" method="post">
               <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
               <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
               <input type="submit" name="update_cart" value="Update" class="option-btn">
            </form>
         </td>
         <td><?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>$</td>
         <td><a href="index.php?remove=<?php echo $fetch_cart['id']; ?>" class="delete-btn" onclick="return confirm('Remove the item from the shopping cart');">Delete</a></td>
      </tr>
   <?php
      $grand_total += $sub_total;
         }
      }else{
         echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">The cart is empty</td></tr>';
      }
   ?>
   <tr class="table-bottom">
      <td colspan="4">Total Price:</td>
      <td><?php echo $grand_total; ?>$</td>
      <td><a href="index.php?delete_all" onclick="return confirm('Delete All Product?');" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Delet All</a></td>
   </tr>
</tbody>
</table>
<a class="btn btn-primary" name="confirm" href="confirm.php">confirm Buying</a>



</div>

</div>

    </center>

    
</body>






