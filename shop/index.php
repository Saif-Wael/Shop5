<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'The product has already been added to the shopping cart!';
   } else {
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
      $message[] = 'The product is added to the shopping cart!';
   }
}

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
   <title>jojo store</title>
   
   <link rel="stylesheet" href="style.css">
   <style>
      body {
         background-color: #A4C4E4;
         font-family: Arial, sans-serif;
      }

      .container {
         font-size: 20px;
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
         font-size: 20px;
         margin: 0 20px;
         display: inline-block;
         padding: 10px 20px;
         border-radius: 5px;
         transition: background-color 0.3s;
      }

      nav a:hover {
         background-color: #0056b3;
      }

      nav a i {
         color: red;
      }

      .message {
         background: #f1c40f;
         padding: 10px;
         margin: 10px 0;
         border-radius: 5px;
         cursor: pointer;
         max-width: 600px;
         text-align: center;
         margin-left: auto;
         margin-right: auto;
      }

      .products {
         text-align: center;
      }

      .box-container {
         display: flex;
         flex-wrap: wrap;
         justify-content: center;
      }

      .box {
         background: #fff;
         border: 1px solid #ccc;
         margin: 10px;
         padding: 10px;
         border-radius: 5px;
         text-align: center;
         max-width: 300px;
         box-shadow: 0 0 10px rgba(0,0,0,0.1);
         transition: transform 0.3s;
      }

      .box img {
         max-width: 100%;
         border-radius: 5px;
      }

      .box .name {
         font-size: 18px;
         margin: 10px 0;
      }

      .box .price {
         color: #e67e22;
         font-size: 16px;
         margin: 10px 0;
      }

      .box input[type="number"] {
         width: 50px;
         padding: 5px;
         margin: 10px 0;
      }

      .box .btn {
         background: #007bff;
         color: white;
         border: none;
         padding: 10px 20px;
         border-radius: 5px;
         cursor: pointer;
         transition: background-color 0.3s;
      }

      .box .btn:hover {
         background-color: #0056b3;
      }

      .filter-container {
         text-align: center;
         margin-top: 20px;
      }

      .filter-container h3 {
         margin-bottom: 10px;
      }

      .filter-container input[type="number"] {
         width: 100px;
         margin: 5px;
         padding: 5px;
      }

      .filter-container button {
         background: #007bff;
         color: white;
         border: none;
         padding: 5px 10px;
         border-radius: 5px;
         cursor: pointer;
         transition: background-color 0.3s;
      }

      .filter-container button:hover {
         background-color: #0056b3;
      }
   </style>
</head>
<body>
   <nav>
        <a id="home" href="index.php">
            <u>Home</u>
        </a>
        <a id="cart" href="cart.php">
            <i class="fa fa-shopping-cart"></i>
            <u>My Cart</u>
        </a>
        <a href="index.php?logout=<?php echo $user_id; ?>" onclick="return confirm('Are you sure you want to log out?');">Log Out</a>
    </nav>
   
   <?php
   if(isset($message)){
      foreach($message as $message){
         echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
      }
   }
   ?>
   <center>
   <div class="container">
      <div class="products">
         <h1 class="heading">Latest products</h1>
         
         <div class="filter-container">
            <h3>Filter by Price</h3>
            <label for="minPrice">Min Price:</label>
            <input type="text" id="minPrice" >
            <label for="maxPrice">Max Price:</label>
            <input type="text" id="maxPrice" >
            <button id="filterBtn">Apply </button>
         </div>
         
         <div class="box-container">
            <?php
            include('config.php');
            $result = mysqli_query($conn, "SELECT * FROM products");      
            while($row = mysqli_fetch_array($result)){
            ?>
               <form method="post" class="box" action="index.php">
                  <img src="admin/<?php echo $row['image']; ?>" width="200">
                  <div class="name"><?php echo $row['name']; ?></div>
                  <div class="price"><?php echo $row['price']; ?></div>
                  <input type="number" min="1" name="product_quantity" value="1">
                  <input type="hidden" name="product_image" value="<?php echo $row['image']; ?>">
                  <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                  <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                  <button type="submit" name="add_to_cart" class="btn">Add to Cart</button>
               </form>
            <?php
            };
            ?>
         </div>
      </div>
   </div>
   </center>

   <script>
      document.addEventListener('DOMContentLoaded', function() {
          const messages = document.querySelectorAll('.message');
          messages.forEach(message => {
              message.addEventListener('click', function() {
                  this.remove();
              });
          });

          // Function to filter products by price range
          function filterProductsByPrice(minPrice, maxPrice) {
              const boxes = document.querySelectorAll('.box');
              boxes.forEach(box => {
                  const price = parseFloat(box.querySelector('.price').textContent);
                  if (price >= minPrice && price <= maxPrice) {
                      box.style.display = 'block';
                  } else {
                      box.style.display = 'none';
                  }
              });
          }

          // Event listener for filter button
          document.getElementById('filterBtn').addEventListener('click', function() {
              const minPrice = parseFloat(document.getElementById('minPrice').value);
              const maxPrice = parseFloat(document.getElementById('maxPrice').value);
              filterProductsByPrice(minPrice, maxPrice);
          });
      });
   </script>
</body>
</html>

