<?php
include 'config.php';
session_start();

// Check if admin is logged in, otherwise redirect to login page
if (!isset($_SESSION['admin_id'])) {
   header('location:login.php');
   exit(); // Stop further execution after redirection
}

// Perform database query to fetch products
$select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('Query failed');

if(isset($_GET['search'])){
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $query = "SELECT * FROM `products` WHERE 
              id LIKE '%$search%' OR 
              name LIKE '%$search%' OR 
              type LIKE '%$search%' OR 
              price LIKE '%$search%' OR 
              event LIKE '%$search%' OR 
              stock LIKE '%$search%' OR 
              sold LIKE '%$search%'";
    $select_products = mysqli_query($conn, $query) or die('Query failed');
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>List of Product</title>

   <!-- font awesome cdn link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link -->
   <link rel="stylesheet" href="css/admin_style.css">

   <style>
      /* Moved CSS styles to an external stylesheet for better organization */
   </style>
</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="revenue">
   <h1 class="title">List of Product</h1>

   <form method="GET" action="">
      <input type="text" name="search" placeholder="Search...">
      <button type="submit">Search</button>
   </form>
   <div class="table-container">
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Image</th>
                <th>Name</th>
                <th>Type</th>
                <th>Price</th>
                <th>Event</th>
                <th>Stock</th>
                <th>Sold</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody> 
            <?php
            // Inisialisasi counter
            $counter = 1;
            // Check if there are any products
            if(mysqli_num_rows($select_products) > 0){
                // Loop through each product and display its details
                while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
            <tr>
                <td><?php echo $counter; ?></td>
                <!-- Jika Anda memiliki kolom gambar, Anda bisa menampilkannya di sini -->
                <td><img src="../upload/<?php echo $fetch_products['image']; ?>" alt="<?php echo $fetch_products['name']; ?>" style="width: 100px; height: auto;"></td>
                <td><?php echo $fetch_products['name']; ?></td>
                <td><?php echo $fetch_products['type']; ?></td>
                <td><?php echo $fetch_products['price']; ?></td>
                <td><?php echo $fetch_products['event']; ?></td>
                <td><?php echo $fetch_products['stock']; ?></td>
                <td><?php echo $fetch_products['sold']; ?></td>
                <td>
                    <!-- Tambahkan tautan untuk tindakan seperti penghapusan atau pengeditan -->
                    <a href="admin_products.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">update</a>
                    <a href="delete_product.php?id=<?php echo $fetch_products['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')" class="btn">Delete</a>
                </td>
            </tr>
            <?php
                    // Tingkatkan nilai counter setiap kali loop
                    $counter++;
                }
            } else {
                // Tampilkan pesan jika tidak ada produk yang ditemukan
                echo '<tr><td colspan="10" class="empty">No products found!</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>
</section>
</body>
</html>
