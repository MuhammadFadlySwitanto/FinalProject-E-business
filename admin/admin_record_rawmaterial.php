<?php
include 'config.php';
session_start();

// Check if admin is logged in, otherwise redirect to login page
if (!isset($_SESSION['admin_id'])) {
   header('location:login.php');
   exit(); // Stop further execution after redirection
}

// Perform database query to fetch purchase products
$select_orders = mysqli_query($conn, "SELECT * FROM `purchase_products`") or die('Query failed');

if(isset($_GET['search'])){
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $query = "SELECT * FROM `purchase_products` WHERE 
              id LIKE '%$search%' OR 
              purchase_id LIKE '%$search%' OR 
              product_name LIKE '%$search%' OR 
              product_price LIKE '%$search%' OR 
              product_qty LIKE '%$search%'";
    $select_orders = mysqli_query($conn, $query) or die('Query failed');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>List of Raw Materials</title>

   <!-- font awesome cdn link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link -->
   <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="revenue">
   <h1 class="title">List of Raw Materials</h1>

   <form method="GET" action="">
      <input type="text" name="search" placeholder="Search...">
      <button type="submit">Search</button>
   </form>
   <div class="table-container">
      <table>
         <thead>
            <tr>
               <th>No</th>
               <th>Purchase ID</th>
               <th>Product Name</th>
               <th>Product Price</th>
               <th>Quantity</th>
            </tr>
         </thead>
         <tbody> 
            <?php
            // Check if there are any purchase products
            if(mysqli_num_rows($select_orders) > 0){
               // Loop through each purchase product and display its details
               $counter = 1; // Initialize the counter
               while($fetch_orders = mysqli_fetch_assoc($select_orders)){
                  ?>
                  <tr>
                     <td><?php echo $counter++; ?></td>
                     <td><?php echo $fetch_orders['id']; ?></td>
                     <td><?php echo "PO -" . $fetch_orders['purchase_id']; ?></td>
                     <td><?php echo $fetch_orders['product_name']; ?></td>
                     <td><?php echo $fetch_orders['product_price']; ?></td>
                     <td><?php echo $fetch_orders['product_qty']; ?></td>
                  </tr>
                  <?php
               }
            } else {
               // Display a message if there are no purchase products
               echo '<tr><td colspan="6" class="empty">No purchase order placed yet!</td></tr>';
            }
            ?>
         </tbody>
      </table>
   </div>
</section>
</body>
</html>
