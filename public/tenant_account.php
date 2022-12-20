<?php
session_start();
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
        <title>Document</title>
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
        <div id="payment_history_box">
            <h2>Payment History</h2>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Amount</th>
                        <th>Mode of Payment</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody id="payments">
                    <tr>
                        <td>5500</td>
                        <td>online payment</td>
                        <td>12/05/2022</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="complaint_box">
            <h2>Complaints</h2>
            <div class="input-group mb-3">
                <input type="text" class="form-control bg-secondary" aria-label="Username" aria-describedby="input-group-button-right">
                <button type="button" class="btn btn-success" id="input-group-button-right">Add</button>
            </div>
            <div class="card bg-dark">
                <div class="card-body">
                    <p class="card-text text-light">I need a plumber ASAP xoxo</p>
                    <button type="button" class="btn btn-danger float-end">Delete</button>
                </div>
            </div>
            <div class="card bg-dark">
                <div class="card-body">
                    <p class="card-text text-light">Ceiling gone from odette</p>
                    <button type="button" class="btn btn-danger float-end">Delete</button>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var userID = < ? php echo $_SESSION["user_id"]; ? > ;
            var xhttp = new XMLHttpRequest();

            function showPayments(amount, MOP, date) {
                $("#payments").append('\
                 < tr > \ < td > '+ amount +' < /td>\ < td > '+ MOP +' < /td>\ < td > '+ date +' < /td>\ < /tr>\
                    ');
                }

                function ready() {
                    getPayments(true);
                }

                function getPayments(isActive = tabClicked === 0) {
                    removeAllCards();
                    var url = "../src/php/getPayments_action.php";
                    var urlData = url + "?user_id=" + userID;
                    xhttp.open("GET", urlData, true);
                    xhttp.send();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var res = JSON.parse(this.responseText);
                            if (res["status"] == 200) {
                                for (var i = 0; i < res["count"]; i++) {
                                    addCard(res["data"][i]["item_id"], res["data"][i]["item_name"], res["data"][i]["item_description"]);
                                }
                            }
                        }
                    };
                }

                function removeAllCards() {
                    $("#activeCards").empty();
                    console.log("Test");
                }
        </script>
    </body>
</html>