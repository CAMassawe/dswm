<?php
include 'mainfile.php';

$solenoid_id = $_POST["solenoid_id"];
$solenoid_rate = $_POST["solenoid_rate"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($solenoid_id, $solenoid_rate)) {
        //data received

        $status = "ON";
        $sql = "UPDATE customer SET service='$status' WHERE meter_number=$solenoid_id";

        if ($conn->query($sql) === TRUE) {
            //status changed successfully
            echo "Changed";
        } else {
            //failed to change status
            echo "Not changed";
        }

    } else {
        //data not received
        echo "Could not receive the admin ID";
    }
}
?>