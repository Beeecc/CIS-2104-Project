<?php
include_once("db_connect.php");
$data = [];
$retVal = "Item not added";
$isValid = true;
$status = 400;

//5. Add item code here
$user_id = trim($_REQUEST["user_id"] ?? ''); // Retrieves value, if null, returns empty string
$item_name = trim($_REQUEST["item_name"] ?? '');
$item_description = trim($_REQUEST["item_description"] ?? '');

// Checks if input was valid, if so, performs query
if ($isValid) {
    $stmt = $con->prepare("INSERT INTO items (user_id, item_name, item_description) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $item_name, $item_description);
    $isValid = $stmt->execute();
    if ($isValid) {
        $retVal = "Item has been successfully added.";
        $status = 200;
    }
    $stmt->close();
}

// Checks if input are not empty
if ($user_id == '' || $item_name == '') {
    $isValid = false;
    $retVal = "Fill in the necessary blanks.";
}

$myObj = array(
    'status' => $status,
    'data' => "",
    'message' => $retVal
);
$myJSON = json_encode($myObj, JSON_FORCE_OBJECT);
echo $myJSON;

$con->close();
