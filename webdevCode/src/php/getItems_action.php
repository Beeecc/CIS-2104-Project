<?php
    include_once("db_connect.php");
    $status = 400;
    $data = array();
    $count = 0;
    $isValid = true;

    //8. Get items code here

    $user_id = trim($_REQUEST['user_id'] ?? '');
    $in_status = trim($_REQUEST['status'] ?? '');

    if ($user_id == '' || $in_status == '') {
        $isValid = false;
        $retVal = "Please enter all necessary fields.";
    }

    if ($isValid) {
        $stmt = $con->prepare("SELECT * FROM items WHERE user_id = ? AND status = ?");
        $stmt->bind_param("is", $user_id, $in_status);
        $isValid = $stmt->execute();
        if ($isValid) {
            $result = $stmt->get_result();
            $count = $result->num_rows;
            if ($count > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($data, array(
                        'item_id' => $row['item_id'],
                        'item_name' => $row['item_name'],
                        'item_description' => $row['item_description']
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
?>