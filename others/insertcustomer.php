<?php
include 'mainfile.php';

if (empty($_POST["meter_number"]) || empty($_POST["full_name"]) || empty($_POST["phone_number"]) || empty($_POST["ward"]) || empty($_POST["email"]) || empty($_POST["registrar"])) {
    echo "Please fill all fields";
}

if (isset($_POST["meter_number"]) && isset($_POST["full_name"]) && isset($_POST["phone_number"]) && isset($_POST["ward"]) && isset($_POST["email"]) && isset($_POST["registrar"])) {

    //checking if the meter number exists
    $meter_number = $_POST["meter_number"];
    if ($statement = "SELECT * FROM customer WHERE meter_number = $meter_number") {
        $result = $conn->query($statement);

        if ($result->num_rows > 0) {
            //meter number exists
            echo "Meter Number is already registered";
        } else {
             //insert data

            if ($sql =  $conn->prepare("INSERT INTO customer(meter_number, name, phone_number, wardname, email, registered_by, reg_time) VALUES(?, ?, ?, ?, ?, ?, now())")) {
                $status = "Unverified";
                $sql->bind_param('ssssss', $meter_number, $_POST["full_name"], $_POST["phone_number"], $_POST["ward"], $_POST["email"], $_POST["registrar"]);
                $sql->execute();
                echo "Registered";
        
            } else {
                echo "Failed to Add Customer";
            }
            
        }
    }
} else {
    echo "Could not receive all requuired data";
}
?>