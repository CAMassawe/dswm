<?php
include 'mainfile.php';

$meter_number = $_GET["meter_number"];

if (isset($meter_number)) {
    //meter number received

    //checking the service status of meter number
    $sql = "SELECT * FROM customer WHERE meter_number = $meter_number";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        //data exists
        $row = $result->fetch_assoc();
        echo $row["service"];

    } else {
        //data does not exists
        echo "Meter number is not Registered in the System";
    }

} else {
    //meter number was not received
    echo "Meter number was not received";
}
?>