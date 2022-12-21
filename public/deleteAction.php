<?php 

require_once("../php/db_connect.php");

if(isset($_GET['Del']))
{
    $ID = $_GET['Del'];
    $sql = "DELETE FROM complaint_t WHERE tenant_id = '".$ID."';";
    $result = mysqli_query($con, $sql);
    if($result)
    {
        header("location:complaints_log.php");
    }
    else
    {
        echo 'Please check your query.';
    }
}
else
{
    header("location:complaints_log.php");
}

?>