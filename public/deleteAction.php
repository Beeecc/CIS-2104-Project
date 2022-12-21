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
        echo "<script type='text/javascript'>alert('Should work');</script>";
    }
    else
    {
        echo 'Please check your query.';
        echo "<script type='text/javascript'>alert('Something wrong');</script>";
    }
}
else
{
    header("location:complaints_log.php");
    echo "<script type='text/javascript'>alert('Didn't get DEL');</script>";
}

?>