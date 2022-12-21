<?php
session_start();
require '../src/php/db_connect.php' ;
$ID = $_GET['GetID']; //gets ID from index.php
$sql = "SELECT * FROM tenant_t t, payment_t p, complaint_t c WHERE t.tenant_id = p.tenant_id && t.tenant_id = c.tenant_id && t.tenant_id='".$ID."';"; // "sql code'" -> php code -> "sql code'"
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$firstName = $row['fname'];
$lastName = $row['lname'];
$sex = $row['sex'];
$contact = $row['contact_no'];
$address = $row['address'];
$apartment = $row['apartment_no'];
$end = $row['contract_end'];
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../src/css/styles.css" />
        <!-- JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <title>My Account | NAC Management</title>
    </head>
    <body class="tenant_account_body" onload="ready()">
        <div class="dropdown position-absolute top-0 end-0 m-1">
            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false"></button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li>
                    <a class="dropdown-item" href="#">Logout</a>
                </li>
            </ul>
        </div>
        <div id="payment_box">
            <h1>Payments</h1>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Amount</th>
                        <th>Mode of Payment</th>
                        <th>Date</th>
                    </tr>
                </thead> <?php
                    $payments = "SELECT p.amount, p.payment_method, p.date_paid FROM tenant_t t, payment_t p WHERE t.tenant_id = p.tenant_id && t.tenant_id='".$ID."';";
                    $paymentResult = mysqli_query($con, $payments);
                    if(mysqli_num_rows($paymentResult) > 0) {
                        while($paymentrow = mysqli_fetch_assoc($paymentResult)) {
                ?> <tbody>
                    <!--
                    <tr><td>5500</td><td>online payment</td><td>12/05/2022</td><td><button type="button" class="btn btn-danger">Delete</button></td></tr>-->
                    <tr>
                        <td> <?php echo $paymentrow['amount'] ?> </td>
                        <td> <?php echo $paymentrow['payment_method'] ?> </td>
                        <td> <?php echo $paymentrow['date_paid'] ?> </td>
                    </tr>
                </tbody> <?php
                }
            } else {
                echo "0 results";
            }
        ?>
        </table>
        </div>
        <!-- Complaints -->
        <div id="payment_box">
            <h1>Complaints</h1>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Complaint</th>
                    </tr>
                </thead>
                <?php
                    $complaint = "SELECT c.complaint FROM tenant_t t, complaint_t c WHERE t.tenant_id = c.tenant_id && t.tenant_id='".$ID."';";
                    $complaintResult = mysqli_query($con, $complaint);
                    if(mysqli_num_rows($complaintResult) > 0) {
                        while($complaintRow = mysqli_fetch_assoc($complaintResult)) {
                ?>
                <tbody>
                <!--
                    <tr>v
                        <td>5500</td>
                        <td>online payment</td>
                        <td>12/05/2022</td>
                        <td>
                            <button type="button" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>-->
                <tr>
                    <td><?php echo $complaintRow['complaint'] ?></td>
                </tr>
                </tbody>
                <?php
                }
            } else {
                echo "0 results";
            }
        ?>
        </table>
    </body>
</html>