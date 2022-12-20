<?php
    include_once("db_connect.php");
    $retVal = "Status update failed.";
    $status = 400;
    $isValid = true;

    //7. Update item status
    $item_id = trim($_REQUEST['item_id'] ?? ''); // Retrieve item_id, if empty returns empty string
    $in_status = trim($_REQUEST['status'] ?? ''); // Returns empty string if empty
    
    if ($item_id == '' || $in_status == '') { // Checks if fields are empty
        $isValid = false;
        $retVal = "Enter the necessary fields.";
    }
    
    if ($isValid) {
        $stmt = $con->prepare("UPDATE items SET status = ? WHERE item_id = ?");
        $stmt->bind_param("si", $in_status, $item_id);
        $isValid = $stmt->execute();
        if ($isValid) {
            $retVal = "Status has been successfully updated.";
            $status = 200;
        }
    }

    $myObj = array(
        'status' => $status,
        'message' => $retVal  
    );

    $myJSON = json_encode($myObj, JSON_FORCE_OBJECT);
    echo $myJSON;
    $con->close();
?>