<?php
include 'mainfile.php';

$meter_number = $_GET["meter_number"];
$solenoid_rate = "ON";
$flow_rate = $_GET["flow_rate"];
$total_volume = $_GET["total_volume_used"];

//inserting data to the database
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($meter_number) && isset($flow_rate) && isset($total_volume)) {

        //checking if meter number exists
        $sql = "SELECT * FROM customer WHERE meter_number=$meter_number";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            //meter number exists

            //inserting data to the database
            if ($sql = $conn->prepare("INSERT INTO results(id, meter_number, solenoid_rate, flow_rate, total_volume_used) VALUES('', ?, ?, ?, ?)")) {

                $sql->bind_param('ssss', $meter_number, $solenoid_rate, $flow_rate, $total_volume);
                $sql->execute();
                echo "data inserted successfully";

            } else {
                echo "Failed to Insert data into the database";
            }

        } else {
            //meter number does not exists
            exit("Meter number does not exists");
        }

    }
}
?>