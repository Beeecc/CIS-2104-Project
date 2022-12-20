<?php
    include_once("db_connect.php");
    $retVal = "Item update failed.";
    $status = 400;
    $isValid = true;

    //6. Add item code here
    $item_id = trim($_REQUEST["item_id"] ?? ''); // Receives item_id
    $item_name_edit = trim($_REQUEST["item_name_edit"] ?? '');
    $item_description_edit = trim($_REQUEST["item_description_edit"] ?? ''); // If description does not exist, uses empty string.

    if ($item_id == '' || $item_name_edit == '') { // If ID and new edit doesnt exist
        $isValid = false;
        $retVal = "Fill in the necessary fields to edit.";
    }

    if ($isValid) { //If fields are filled, query is ran
        $stmt = $con->prepare("UPDATE items SET item_name = ?, item_description = ? WHERE item_id = ?");
        $stmt->bind_param("ssi", $item_name_edit, $item_description_edit, $item_id);
        $isValid = $stmt->execute();
        if ($isValid) {
            $status = 200;
            $retVal = "Item has been successfully edited.";
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