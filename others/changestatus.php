<?php
include 'mainfile.php';

$admin_id = $_POST["adminID"];
$admin_status = $_POST["admin_status"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($admin_id, $admin_status)) {
        //data received

        if ($admin_status == "Unverified") {
            //changing to verified
            $status = "Verified";

            $sql = "UPDATE other_admin SET status='$status' WHERE id=$admin_id";

            if ($conn->query($sql) === TRUE) {
                //status changed successfully
                echo "Changed";
            } else {
                //failed to change status
                echo "Not changed";
            }

        } else if ($admin_status == "Verified") {
            //changing to Unverified
            $status = "Unverified";

            $sql = "UPDATE other_admin SET status='$status' WHERE id=$admin_id";

            if ($conn->query($sql) === TRUE) {
                //status changed successfully
                echo "Changed";
            } else {
                //failed to change status
                echo "Not changed";
            }

        }

    } else {
        //data not received
        echo "Could not receive the admin ID";
    }
}
?>