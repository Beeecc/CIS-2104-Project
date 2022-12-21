<?php 

require_once("../src/php/db_connect.php");
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
$start = $row['contract_start'];
while($row=mysqli_fetch_assoc($result))
{
}

?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            h1 {
                text-align: center;
            }
        </style>
        <!-- CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../src/css/styles.css" />
        <!-- JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <title>Document</title>
    </head>
    <body class="tenant_name_clicked_body">
        <div id="tenantInfo_box">
            <h2>Tenant Info</h2>
            <table class="table_tenant">
                <tr>
                    <th>Full name:</th>
                    <td><?php echo "$firstName $lastName" ?></td>
                </tr>
                <tr>
                    <th>Sex:</th>
                    <td><?php echo "$sex" ?></td>
                </tr>
                <tr>
                    <th>Contact:</th>
                    <td><?php echo "$contact" ?></td>
                </tr>
                <tr>
                    <th>Address:</th>
                    <td><?php echo "$address" ?></td>
                </tr>
                <tr>
                    <th>Apartment:</th>
                    <td><?php echo "$apartment" ?></td>
                </tr>
                <tr>
                    <th>Contract End:</th>
                    <td><?php echo "$end" ?></td>
                </tr>
            </table>
        </div>
        <!--<div id="status_box">
            <h1>Status</h1>
            <table class="table_status">
                <tr>
                    <th>Remaining Balance:</th>
                    <td>5266.00</td>
                </tr>
                <tr>
                    <th>Unresolved Complaints:</th>
                    <td>5</td>
                </tr>
            </table>
        </div>-->
        <div id="payment_box">
            <h1>Payments</h1>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Amount</th>
                        <th>Mode of Payment</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>
                <?php
                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                ?>
                <tbody>
                <!--
                    <tr>
                        <td>5500</td>
                        <td>online payment</td>
                        <td>12/05/2022</td>
                        <td>
                            <button type="button" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>-->
                <tr>
                    <td><?php echo $row['amount'] ?></td>
                    <td><?php echo $row['payment_method'] ?></td>
                    <td><?php echo $row['date_paid'] ?></td>
                </tr>
                </tbody>
                <?php
                }
            } else {
                echo "0 results";
            }
                
            mysqli_close($con);
        ?>

        </table>
            </table>
        </div>
        <div id="complaintLog_box">
            <h1>Complaints</h1>
            <div class="card bg-dark">
                <div class="card-body ">
                    <p class="card-text text-light">I need a plumber ASAP xoxo</p>
                    <button type="button" class="btn btn-success float-end">Solved</button>
                </div>
            </div>
            <div class="card bg-dark">
                <div class="card-body">
                    <p class="card-text text-light">Ceiling gone from odette</p>
                    <button type="button" class="btn btn-success float-end">Solved</button>
                </div>
            </div>
            <div class="card bg-dark">
                <div class="card-body ">
                    <p class="card-text text-light">I need a plumber ASAP xoxo</p>
                    <button type="button" class="btn btn-success float-end">Solved</button>
                </div>
            </div>
            <div class="card bg-dark">
                <div class="card-body">
                    <p class="card-text text-light">Ceiling gone from odette</p>
                    <button type="button" class="btn btn-success float-end">Solved</button>
                </div>
            </div>
            <div class="card bg-dark">
                <div class="card-body ">
                    <p class="card-text text-light">I need a plumber ASAP xoxo</p>
                    <button type="button" class="btn btn-success float-end">Solved</button>
                </div>
            </div>
            <div class="card bg-dark">
                <div class="card-body">
                    <p class="card-text text-light">Ceiling gone from odette</p>
                    <button type="button" class="btn btn-success float-end">Solved</button>
                </div>
            </div>
        </div>
    </body>
</html>