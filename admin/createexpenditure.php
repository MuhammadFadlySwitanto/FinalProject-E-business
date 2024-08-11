<?php
include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location: login.php');
    exit; // Stop further execution
}

if (isset($_POST['add_btn'])) {
    // Escape and retrieve form data
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $categories = mysqli_real_escape_string($conn, $_POST['categories']);
    $pic = mysqli_real_escape_string($conn, $_POST['pic']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);
    $invoice_number = mysqli_real_escape_string($conn, $_POST['invoice']);
    $recipient = mysqli_real_escape_string($conn, $_POST['recipient']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Insert data into expenditures table
    $query = "INSERT INTO expenditures (date, categories, pic, amount, payment_method, invoice, recipient, description)
              VALUES ('$date', '$categories', '$pic', '$amount', '$payment_method', '$invoice_number', '$recipient', '$description')";
    
    if (mysqli_query($conn, $query)) {
        echo "Record added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Expenditure</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

   <!-- custom admin css file link  -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600&display=swap');

:root{
   --purple:#747264;
   --red:#c0392b;
   --orange:#f39c12;
   --black:#333;
   --white:#fff;
   --light-color:#666;
   --light-white:#ccc;
   --light-bg:#f5f5f5;
   --border:.1rem solid var(--black);
   --box-shadow:0 .5rem 1rem rgba(0,0,0,.1);
}

html{
   font-size: 70%;
   overflow-x: hidden;
}

body{
   background-color: var(--light-bg);
}

*{
   font-family: 'Rubik', sans-serif;
   margin:0; padding:0;
   box-sizing: border-box;
   outline: none; border:none;
   text-decoration: none;
   transition:all .2s linear;
}

.title{
   text-align: center;
   margin-bottom: 2rem;
   text-transform: uppercase;
   color:var(--black);
   font-size: 4rem;
}

.header{
   position: sticky;
   top:0; left:0; right:0;
   z-index: 1000;
   background-color: var(--white);
   box-shadow: var(--box-shadow);
}

.header .flex{
   display: flex;
   align-items: center;
   padding:2rem;
   justify-content: space-between;
   position: relative;
   max-width: 1200px;
   margin:0 auto;
}
 
.header .flex .logo{
   font-size: 2.5rem;
   color:var(--black);
}

.header .flex .logo span{
   color:var(--purple);
}

.header .flex .navbar a{
   margin:0 1rem;
   font-size: 2rem;
   color:var(--black);
}

.header .flex .navbar a:hover{
   color:var(--purple);
}

.header .flex .icons div{
   margin-left: 1.5rem;
   font-size: 2.5rem;
   cursor: pointer;
   color:var(--black);
}

.header .flex .icons div:hover{
   color:var(--purple);
}

.header .flex .account-box{
   position: absolute;
   top:120%; right:2rem;
   width: 30rem;
   box-shadow: var(--box-shadow);
   border-radius: .5rem;
   padding:2rem;
   text-align: center;
   border-radius: .5rem;
   border:var(--border);
   background-color: var(--white);
   display: none;
   animation:fadeIn .2s linear;
}

.header .flex .account-box.active{
   display: inline-block;
}

.header .flex .account-box p{
   font-size: 2rem;
   color:var(--light-color);
   margin-bottom: 1.5rem;
}

.header .flex .account-box p span{
   color:var(--purple);
}

.header .flex .account-box .delete-btn{
   margin-top: 0;
}

.header .flex .account-box div{
   margin-top: 1.5rem;
   font-size: 2rem;
   color:var(--light-color);
}

.header .flex .account-box div a{
   color:var(--orange);
}

.header .flex .account-box div a:hover{
   text-decoration: underline;
}
</style>
</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="revenue">
   <h1 class="title">NEW EXPENSES</h1>
   <form action="#" method="POST" id="add_form">
      <div class="container">
         <div class="row my-4">
            <div class="col-lg-10 mx-auto"> 
               <div class="card shadow">
                  <div class="card-header">
                     <h4>New Expenses Form</h4>
                  </div>
                  <div class="card-body p-4">
                    <div class="column">
                    <div class="col mb-3">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control" value="<?php echo isset($date) ? $date : ''; ?>" required>
                    </div>
                    <div class="col mb-3">
                            <label for="categories">Categories</label>
                            <input type="text" name="categories" id="categories" class="form-control" placeholder="Categories" value="<?php echo isset($categories) ? $categories : ''; ?>" required>
                    </div>
                    <div class="col mb-3">
                            <label for="pic">PIC (Person in Charge)</label>
                            <input type="text" name="pic" id="pic" class="form-control" placeholder="PIC" value="<?php echo isset($pic) ? $pic : ''; ?>" required>
                    </div>
                    <div class="col mb-3">
                            <label for="amount">Amount</label>
                            <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount" value="<?php echo isset($amount) ? $amount : ''; ?>" required>
                    </div>
                    <div class="col mb-3">
                            <label for="payment_method">Payment Method</label>
                           <select name="payment_method" id="payment_method" class="form-control" required>
                           <option value="cash">Cash</option>
                           <option value="debit">Debit Card</option>
                           <option value="gopay">Gopay</option>
                           <option value="dana">Dana</option>
                           </select>
                   </div>

                    <div class="col mb-3">
                            <label for="invoice_number">Invoice Number</label>
                            <input type="text" name="invoice" id="invoice" class="form-control" placeholder="Invoice Number" value="<?php echo isset($invoice_number) ? $invoice_number : ''; ?>" required>
                    </div>
                    <div class="col mb-3">
                            <label for="recipient">Recipient</label>
                            <input type="text" name="recipient" id="recipient" class="form-control" placeholder="Recipient" value="<?php echo isset($recipient) ? $recipient : ''; ?>" required>
                    </div>
                    <div class="col mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" placeholder="Description" required><?php echo isset($description) ? $description : ''; ?></textarea>
                    </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <!-- Buyer Details Card -->
         <!-- Repeat a similar structure for Buyer Details -->

         <!-- Requirements Card -->
         <!-- Repeat a similar structure for Requirements -->

         <!-- Products Card -->
         <!-- Repeat a similar structure for Products -->
         <!-- You can use the dynamic addition of product rows as you implemented -->

         <div>
            <a href="admin_expenditure.php" class="btn btn-secondary me-3 w-25">Cancel</a>
         <input type="submit" value="Create" class="btn btn-dark w-25" name="add_btn" id="add_btn">
      </div>
   </form>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
   // Your JavaScript scripts and functions
</script>

</body>
</html>
