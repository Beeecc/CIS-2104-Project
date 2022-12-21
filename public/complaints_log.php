<?php 
    include "../src/php/db_connect.php"
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Complaints Log | NAC Management</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <link rel="stylesheet" href="../src/css/styles.css" />
        <link rel="stylesheet" href="styles.css">
    </head>
    <!-- Navigation Bar -->
    <body>
        <nav class="navbar navbar-expand- bg-dark navbar-dark py-3">
            <div class="container">
                <a href="dashboard.php" class="navbar-brand">NAC Management</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navmenu">
                    <ul class="navbar-nav ms-auto">
                        <li>
                            <a href="index.php" class="nav-link">Sign Out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Table Showcase -->
        <section class="bg-white p-5 text-center text-sm-start">
            <div class="container">
                <h1>Complaints Log</h1>
                <div class="align-items-center justify-content-between">
                    <div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Tenant First Name</th>
                                    <th scope="col">Tenant Last Name</th>
                                    <th scope="col">Subject Matter</th>
                                    <th scope="col">Date</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <!--<tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td colspan="2">Larry the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                            </tbody> -->
                            <?php

                                // display data from database in tables
                                $sql = "SELECT t.fname, t.lname, c.complaint, c.date_received
                                FROM tenant_t t,
                                     complaint_t c
                                WHERE c.tenant_id = t.tenant_id
                                ORDER BY c.date_received DESC;";
                                $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                   while($row = mysqli_fetch_assoc($result)) {
                            ?>

                            <tbody>
                                <tr><td><?php echo $row['fname']?></td>
                                <td><?php echo $row['lname']?></td>
                                <td><?php echo $row['complaint']?></td>
                                <td><?php echo $row['date_received']?></td>
                                <td><button type="button" class="btn btn-danger">Delete</button></td>
                            </tbody>
                            <?php 
                                   }
                                } else {
                                    echo "0 results";
                                }
                                mysqli_close($con);
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>