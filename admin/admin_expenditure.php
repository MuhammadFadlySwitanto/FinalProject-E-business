<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Expenditure</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/admin_style.css"> <!-- Custom admin CSS file link -->

   <style>
      .table-container {
        max-width: 100%;
        overflow-x: auto;
      }

      table {
        width: 100%;
        border-collapse: collapse;
      }

      thead {
        background-color: #f2f2f2;
      }

      th, td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        text-align: left;
      }

      th {
        font-weight: bold;
      }

      tbody tr:nth-child(even) {
        background-color: #f2f2f2;
      }

      tbody tr:hover {
        background-color: #ddd;
      }

      .delete-btn {
        padding: 8px 16px;
        margin-right: 5px;
        border: none;
        border-radius: 4px;
        color: #fff;
        background-color: #dc3545;
        text-decoration: none;
        cursor: pointer;
      }

      .delete-btn:hover {
        background-color: #a02833;
      }

      .empty {
        text-align: center;
        padding: 10px 0;
        font-size: 20px;
      }
      /* CSS for Search Form */
.search-form {
   display: flex;
   align-items: center;
}

/* Style for Search Input */
.search-form input[type="text"] {
   width: 300px;
   padding: 8px;
   font-size: 16px;
   border: 1px solid #ccc;
   border-radius: 4px;
   margin-right: 5px;
}

/* Style for Search Button */
.search-form .search-btn {
   padding: 8px;
   background-color: #007bff;
   color: #fff;
   border: none;
   border-radius: 4px;
   cursor: pointer;
}

/* Hover Effect for Search Button */
.search-form .search-btn:hover {
   background-color: #0056b3;
}

/* Font Awesome Icon Inside Search Button */
.search-form .search-btn i {
   margin-right: 5px;
}

   </style>
</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="revenue">
   <h1 class="title">EXPENDITURE/CASH OUT</h1>

   <!-- Add New Button -->
   <a href="createexpenditure.php" class="btn">Add New</a>

  <!-- Search Form -->
<form method="GET" action="admin_expenditure.php" class="search-form">
   <input type="text" name="search" placeholder="Search by PIC, Categories, or Date">
   <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
</form>



   <br><br>

   <div class="table-container">
      <!-- Display Table of Expenditures -->
      <table>
         <thead>
            <tr>
               <th>ID</th>
               <th>Date</th>
               <th>Categories</th>
               <th>PIC</th>
               <th>Amount</th>
               <th>Payment Method</th>
               <th>Invoice Number</th>
               <th>Recipient</th>
               <th>Description</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>
            <!-- PHP Code to Display Filtered Results -->
            <?php
            include 'config.php';

            // Check if search parameter is provided
            if(isset($_GET['search'])) {
               $search_term = mysqli_real_escape_string($conn, $_GET['search']);

               // Query to retrieve filtered expenditure
               $select_expenditures = mysqli_query($conn, "SELECT * FROM `expenditures` WHERE 
                  categories LIKE '%$search_term%' OR 
                  pic LIKE '%$search_term%' OR
                  date LIKE '%$search_term%'") or die('Query failed');

               if(mysqli_num_rows($select_expenditures) > 0){
                  while($fetch_expenditure = mysqli_fetch_assoc($select_expenditures)){
            ?>
            <tr>
               <td><?php echo $fetch_expenditure['expenditure_id']; ?></td>
               <td><?php echo $fetch_expenditure['date']; ?></td>
               <td><?php echo $fetch_expenditure['categories']; ?></td>
               <td><?php echo $fetch_expenditure['pic']; ?></td>
               <td>Rp. <?php echo number_format($fetch_expenditure['amount']); ?></td>
               <td><?php echo $fetch_expenditure['payment_method']; ?></td>
               <td><?php echo $fetch_expenditure['invoice']; ?></td>
               <td><?php echo $fetch_expenditure['recipient']; ?></td>
               <td><?php echo $fetch_expenditure['description']; ?></td>
               <td>
                  <a href="detailexp.php?id=<?php echo $fetch_expenditure['expenditure_id']; ?>" class="btn">Detail</a>
                  <a href="admin_expenditure.php?delete=<?php echo $fetch_expenditure['expenditure_id']; ?>" onclick="return confirm('Delete this expenditure?');" class="delete-btn">Delete</a>
               </td>
            </tr>
            <?php
                  }
               } else {
                  echo '<tr><td colspan="10" class="empty">No Expenditures match the search criteria!</td></tr>';
               }
            } else {
               // Display all expenditures if no search term is provided
               $select_expenditures = mysqli_query($conn, "SELECT * FROM `expenditures`") or die('Query failed');
               if(mysqli_num_rows($select_expenditures) > 0){
                  while($fetch_expenditure = mysqli_fetch_assoc($select_expenditures)){
            ?>
            <tr>
               <td><?php echo $fetch_expenditure['expenditure_id']; ?></td>
               <td><?php echo $fetch_expenditure['date']; ?></td>
               <td><?php echo $fetch_expenditure['categories']; ?></td>
               <td><?php echo $fetch_expenditure['pic']; ?></td>
               <td>Rp. <?php echo number_format($fetch_expenditure['amount']); ?></td>
               <td><?php echo $fetch_expenditure['payment_method']; ?></td>
               <td><?php echo $fetch_expenditure['invoice']; ?></td>
               <td><?php echo $fetch_expenditure['recipient']; ?></td>
               <td><?php echo $fetch_expenditure['description']; ?></td>
               <td>
                  <a href="detailexp.php?id=<?php echo $fetch_expenditure['expenditure_id']; ?>" class="btn">Detail</a>
                  <a href="admin_expenditure.php?delete=<?php echo $fetch_expenditure['expenditure_id']; ?>" onclick="return confirm('Delete this expenditure?');" class="delete-btn">Delete</a>
               </td>
            </tr>
            <?php
                  }
               } else {
                  echo '<tr><td colspan="10" class="empty">No Expenditures placed yet!</td></tr>';
               }
            }
            ?>
         </tbody>
      </table>
   </div>
</section>

</body>
</html>
