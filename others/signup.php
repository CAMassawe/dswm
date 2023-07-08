<?php
include 'mainfile.php';

if (empty($_POST["firstname"]) || empty($_POST["lastname"]) || empty($_POST["email"]) || empty($_POST["password"])) {
    echo "Please fill all fields";
}

if (isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["email"]) && isset($_POST["password"])) {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if ($sql =  $conn->prepare("INSERT INTO other_admin(id, firstname, lastname, email, password, status) VALUES('', ?, ?, ?, ?, ?)")) {
        $status = "Unverified";
        $sql->bind_param('sssss', $firstname, $lastname, $email, $password, $status);
        $sql->execute();
        echo "Registered, Please wait for Verification from Main Admin to Log In";

    } else {
        echo "Failed to register";
    }
}
?>