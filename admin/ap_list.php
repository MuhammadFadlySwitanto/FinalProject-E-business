<?php
include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

// Delete functionality
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM account_payable WHERE invoice_id = '$delete_id'") or die('Query failed');
    header('location:ap_list.php');
}

// Update payment status
if (isset($_POST['update_payment_status'])) {
    $invoice_id = $_POST['invoice_id'];
    $new_payment_status = $_POST['new_payment_status'];

    $update_query = "UPDATE account_payable SET payment_status='$new_payment_status' WHERE invoice_id='$invoice_id'";
    if (mysqli_query($conn, $update_query)) {
        header('Location: ap_list.php');
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Payable List</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/admin_style.css">

    <!-- Custom CSS -->
    <style>
        body {
            font-size: 1.2rem;
        }
        .table-container {
            max-width: 100%;
            overflow-x: auto;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #f2f2f2;
        }

        th, td {
            padding: 16px 20px;
            border: 1px solid #ddd;
            text-align: left;
            font-size: 1.2rem; /* Increase font size */
        }

        th {
            font-weight: bold;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        select, input[type="submit"] {
            padding: 12px 16px;
            font-size: 1.2rem; /* Increase font size */
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f2f2f2;
            cursor: pointer;
        }

        .btn {
            padding: 12px 20px; /* Increase padding */
            border: none;
            border-radius: 4px;
            color: #fff;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 1.2rem; /* Increase font size */
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-add {
            background-color: #28a745;
            margin-bottom: 20px;
        }

        .btn-add:hover {
            background-color: #218838;
        }

        .empty {
            text-align: center;
            padding: 20px;
            font-size: 1.2rem; /* Increase font size */
            color: #555;
        }

        @media print {
            body * {
                visibility: hidden;
            }
            .print-section, .print-section * {
                visibility: visible;
            }
            .print-section {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                padding: 20px;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
<?php include 'admin_header.php'; ?>
<section class="account-payable-list">
    <h1 class="title text-center my-4">ACCOUNT PAYABLE</h1>
    <div class="mb-4 no-print text-end">
            <button onclick="window.print()" class="btn btn-secondary">Print Report</button>
        </div>
    <div class="container">
        <a href="ap_form.php" class="btn btn-add mb-4">Add New</a>

        <!-- Form to select month and year -->
        <form action="ap_list.php" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="month" class="form-label">Select Month</label>
                    <select name="month" id="month" class="form-select">
                        <option value="">--Select Month--</option>
                        <?php
                        for ($m = 1; $m <= 12; $m++) {
                            $month = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
                            echo "<option value='$m'>$month</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="year" class="form-label">Select Year</label>
                    <select name="year" id="year" class="form-select">
                        <option value="">--Select Year--</option>
                        <?php
                        $current_year = date('Y');
                        for ($y = $current_year; $y >= $current_year - 10; $y--) {
                            echo "<option value='$y'>$y</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4 align-self-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <div class="table-container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Invoice Number</th>
                        <th>Invoice Date</th>
                        <th>Due Date</th>
                        <th>Vendor Name</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Step 2: Process month and year filter
                    $month = isset($_GET['month']) ? $_GET['month'] : '';
                    $year = isset($_GET['year']) ? $_GET['year'] : '';

                    $query = "SELECT * FROM account_payable";
                    if ($month && $year) {
                        $query .= " WHERE MONTH(invoice_date) = '$month' AND YEAR(invoice_date) = '$year'";
                    }

                    $select_ap = mysqli_query($conn, $query) or die('Query failed');
                    $total_amount = 0;

                    if (mysqli_num_rows($select_ap) > 0) {
                        while ($row = mysqli_fetch_assoc($select_ap)) {
                            $total_amount += $row['amount'];
                    ?>
                            <tr>
                                <td><?php echo $row['invoice_number']; ?></td>
                                <td><?php echo $row['invoice_date']; ?></td>
                                <td><?php echo $row['due_date']; ?></td>
                                <td><?php echo $row['vendor_name']; ?></td>
                                <td><?php echo $row['amount']; ?></td>
                                <td><?php echo $row['description']; ?></td>
                                <td>
                                    <?php if (isset($_GET['edit']) && $_GET['edit'] == $row['invoice_id']): ?>
                                        <form action="ap_list.php" method="post">
                                            <input type="hidden" name="invoice_id" value="<?php echo $row['invoice_id']; ?>">
                                            <select name="new_payment_status" class="form-select">
                                                <option value="unpaid" <?php if ($row['payment_status'] === 'unpaid') echo 'selected'; ?>>Unpaid</option>
                                                <option value="partially_paid" <?php if ($row['payment_status'] === 'partially_paid') echo 'selected'; ?>>Partially Paid</option>
                                                <option value="paid" <?php if ($row['payment_status'] === 'paid') echo 'selected'; ?>>Paid</option>
                                            </select>
                                            <button type="submit" name="update_payment_status" class="btn btn-sm btn-primary mt-2">Update</button>
                                        </form>
                                    <?php else: ?>
                                        <?php echo $row['payment_status']; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (isset($_GET['edit']) && $_GET['edit'] == $row['invoice_id']): ?>
                                        <a href="ap_list.php" class="btn btn-sm btn-primary">Cancel</a>
                                    <?php else: ?>
                                        <a href="ap_list.php?edit=<?php echo $row['invoice_id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="ap_list.php?delete=<?php echo $row['invoice_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="8" class="empty">No records found!</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Display total amount -->
        <div class="mt-4">
            <h3>Total Amount: <?php echo $total_amount; ?></h3>
        </div>

    

        <!-- Print Section -->
        <div class="print-section">
            <h1 class="text-center mb-4">ACCOUNT PAYABLE REPORT</h1>
            <div class="table-container">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Invoice Number</th>
                            <th>Invoice Date</th>
                            <th>Due Date</th>
                            <th>Vendor Name</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Repeat the filtered data for print view
                        $select_ap = mysqli_query($conn, $query) or die('Query failed');
                        if (mysqli_num_rows($select_ap) > 0) {
                            while ($row = mysqli_fetch_assoc($select_ap)) {
                        ?>
                                <tr>
                                    <td><?php echo $row['invoice_number']; ?></td>
                                    <td><?php echo $row['invoice_date']; ?></td>
                                    <td><?php echo $row['due_date']; ?></td>
                                    <td><?php echo $row['vendor_name']; ?></td>
                                    <td><?php echo $row['amount']; ?></td>
                                    <td><?php echo $row['description']; ?></td>
                                    <td><?php echo $row['payment_status']; ?></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo '<tr><td colspan="7" class="empty">No records found!</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                <h3>Total Amount: <?php echo $total_amount; ?></h3>
            </div>
        </div>
    </div>
</section>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
