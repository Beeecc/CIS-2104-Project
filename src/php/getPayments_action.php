<?php
    include_once("db_connect.php");
    $status = 400;
    $data = array();
    $count = 0;
    $isValid = true;

    $user_id = trim($_REQUEST['user_id'] ?? '');

    if ($user_id == '') {
        $isValid = false;
        $retVal = "Please enter all necessary fields.";
    }

    if ($isValid) {
        $stmt = $con->prepare("SELECT * FROM payment_t WHERE tenant_id = ?");
        $stmt->bind_param("i", $user_id);
        $isValid = $stmt->execute();
        if ($isValid) {
            $result = $stmt->get_result();
            $count = $result->num_rows;
            if ($count > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($data, array(
                        'tenant_id' => $row['tenant_id'],
                        'amount' => $row['amount'],
                        'payment_method' => $row['payment_method'],
                        'date_paid' => $row['date_paid']
                    ));
                }
            }
            $status = 200;
        }
    }
    $myObj = array(
        'status' => $status,
        'data' => $data,
        'count' => $count
    );

    $myJSON = json_encode($myObj, JSON_FORCE_OBJECT);
    echo $myJSON;
    $con->close();

    $myObj = array(
        'status' => $status,
        'data' => $data,
        'count' => $count
    );

    $myJSON = json_encode($myObj, JSON_FORCE_OBJECT);
    echo $myJSON;
    $con->close();

?>