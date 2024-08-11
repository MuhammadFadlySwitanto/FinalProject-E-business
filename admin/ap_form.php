<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $invoice_number = mysqli_real_escape_string($conn, $_POST['invoice_number']);
    $invoice_date = mysqli_real_escape_string($conn, $_POST['invoice_date']);
    $due_date = mysqli_real_escape_string($conn, $_POST['due_date']);
    $vendor_name = mysqli_real_escape_string($conn, $_POST['vendor_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $payment_status = mysqli_real_escape_string($conn, $_POST['payment_status']);

    // Attempt to insert data into table
    $sql = "INSERT INTO account_payable (invoice_number, invoice_date, due_date, vendor_name, description, amount, payment_status) VALUES ('$invoice_number', '$invoice_date', '$due_date', '$vendor_name', '$description', '$amount', '$payment_status')";
    if (mysqli_query($conn, $sql)) {
        // Redirect to ap_list.php after successful insertion
        header("Location: ap_list.php");
        exit();
    } else {
        echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Payable Form</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/admin_style.css">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            font-size: 1.2rem; /* Increase base font size */
        }

        .container {
            margin-top: 50px;
        }

        .form-control {
            margin-bottom: 20px;
            font-size: 1.2rem; /* Increase input font size */
        }

        .btn {
            padding: 10px 20px; /* Increase button padding */
            font-size: 1.2rem; /* Increase button font size */
        }

        .btn-primary {
            background-color: #343a40;
            border-color: #343a40;
        }

        .btn-primary:hover {
            background-color: #23272b;
            border-color: #23272b;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        .form-label {
            font-weight: bold;
            font-size: 1.2rem; /* Increase label font size */
        }

        .text-center {
            font-size: 2rem; /* Increase header font size */
            font-weight: bold;
        }
    </style>
</head>
<body>

<section class="account-payable-form">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center mb-4">Account Payable Form</h2>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="invoice_number" class="form-label">Invoice Number</label>
                        <input type="text" class="form-control" name="invoice_number" id="invoice_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="invoice_date" class="form-label">Invoice Date</label>
                        <input type="date" class="form-control" name="invoice_date" id="invoice_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="due_date" class="form-label">Due Date</label>
                        <input type="date" class="form-control" name="due_date" id="due_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="vendor_name" class="form-label">Vendor Name</label>
                        <input type="text" class="form-control" name="vendor_name" id="vendor_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" step="0.01" class="form-control" name="amount" id="amount" required>
                    </div>
                    <div class="mb-3">
                        <label for="payment_status" class="form-label">Payment Status</label>
                        <select class="form-select" name="payment_status" id="payment_status" required>
                            <option value="unpaid">Unpaid</option>
                            <option value="paid">Paid</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="ap_list.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
