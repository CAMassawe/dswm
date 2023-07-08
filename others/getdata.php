<?php
include 'mainfile.php';

$sqlCus = $conn->prepare("SELECT meter_number FROM customer");
$sqlCus->execute();
$sqlCus->store_result();
$customers_array = array();

if ($sqlCus->num_rows > 0) {
    //data available
    $sqlCus->bind_result($id_customers);
    while ($sqlCus->fetch()) {
        array_push($customers_array, $id_customers);
    }
} else {
    //no data available
    $no_customers = "No other admin";
}
$other_customers = count($customers_array);


$sqlON = $conn->prepare("SELECT id FROM results WHERE solenoid_rate = 'ON'");
$sqlON->execute();
$sqlON->store_result();
$ON_array = array();

if ($sqlON->num_rows > 0) {
    //data available
    $sqlON->bind_result($id_ON);
    while ($sqlON->fetch()) {
        array_push($ON_array, $id_ON);
    }
} else {
    //no data available
    $no_ON = "No other admin";
}
$other_ON = count($ON_array);



$sqlOFF = $conn->prepare("SELECT id FROM results WHERE solenoid_rate = 'OFF'");
$sqlOFF->execute();
$sqlOFF->store_result();
$OFF_array = array();

if ($sqlOFF->num_rows > 0) {
    //data available
    $sqlOFF->bind_result($id_OFF);
    while ($sqlOFF->fetch()) {
        array_push($OFF_array, $id_OFF);
    }
} else {
    //no data available
    $no_OFF = "No OFF";
}
$other_OFF = count($OFF_array);

$data = array(
    'customers' => $other_customers,
    'meter_ON' => $other_ON,
    'meter_OFF' => $other_OFF
);

echo json_encode($data);
?>