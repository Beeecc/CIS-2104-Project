<?php
    include_once("db_connect.php");
    $retVal = "Delete failed.";
    $status = 400;
    $isValid = true;

    //9. Delete item code here
    $item_id = trim($_REQUEST['item_id'] ?? ''); // Retrieves id if it exists, if not, empty string

    if ($item_id == '') { // Checks if ID actually exists
        $isValid = false;
        $retVal = "No item ID.";
    }

    if ($isValid) { // Checks if item to be deleted is valid
        $stmt = $con->prepare("DELETE FROM items WHERE item_id = ?");
        $stmt->bind_param("i", $item_id);
        $isValid = $stmt->execute();
        if ($isValid) {
            $retVal = "Delete successful.";
            $status = 200;
        }
        $stmt->close();
    }

    $myObj = array(
        'status' => $status,
        'message' => $retVal
    );

    $myJSON = json_encode($myObj, JSON_FORCE_OBJECT);
    echo $myJSON;
    $con->close();
?>