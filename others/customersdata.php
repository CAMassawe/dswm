<?php
include 'mainfile.php';

//if user did not log in, be directed back to log in
if (!isset($_SESSION['loggedinADMIN'])){
	header('Location: swm.html');
}
if ($_SESSION['verified'] != "Verified"){
	header('Location: swm.html');
}

//selecting user data from database
 $id = $_SESSION['idADMIN'];
 if ($sql = "SELECT * FROM other_admin WHERE id = $id"){
 	$result = $conn->query($sql);
 	//checking if there is any available data
 	if ($result->num_rows > 0){
 		//data is available 
 		$row = $result->fetch_assoc();
 	}
 }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Customer Data</title>
        <meta charset="uft-8">
    </head>

    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0 0 0 0;
            background-color: #9999ff;
        }
        #header {
            top: 0;
            width: 94%;
            height: 60px;
            background-color: white;
            margin: 10px 0 0 3%;
            box-shadow: 0 0 3px;
            border-radius: 3px;
            position: fixed;
        }
        #header h2 {
            text-align: center;
            color: blue;
        }
        #user-side {
            display: inline-block;
            margin: 80px 0 0 3%;
            width: 20%;
            background-color: #123;
            height: 100%;
            position: absolute;
            border-radius: 5px;
            box-shadow: 0 0 5px;
            border: 1px solid white;
        }
        #user-side h4 {
            text-align: center;
            color: white;
        }
        #user-side img {
            width: 50%;
            border: 2px solid blue;
            border-radius: 50%;
        }
        #user-side button {
            width: 80%;
            margin: 0 0 10px 10%;
            border: 2px solid blue;
            padding: 5px;
            border-radius: 10px;
            background-color: white;
            font-weight: bold;
        }
        #user-side button:active {
            background-color: #80b3ff;
        }


        #other-side {
            display: inline-block;
            width: 70%;
            height: 100%;
            float: right;
            margin: 80px 0 0 27%;
            border-radius: 5px;
            box-shadow: 0 0 3px;
            position: absolute;
            background-color: white;
            overflow-y: auto;
        }
        #data-database {
            width: 100%;
        }
        #data-database h4 {
            text-align: center;
            color: blue;
        }
        #total-admins {
            display: inline-block;
            width: 20%;
            background-color: #d9d9d9;
            border-left: 4px solid grey;
            border-radius: 10px;
            margin: 0 0 0 3%;
        }
        #total-customers {
            display: inline-block;
            width: 20%;
            background-color: #d9d9d9;
            border-left: 4px solid grey;
            border-radius: 10px;
            margin: 0 0 0 3%;
        }
        #total-metersON {
            display: inline-block;
            width: 20%;
            background-color: #d9d9d9;
            border-left: 4px solid grey;
            border-radius: 10px;
            margin: 0 0 0 3%;
        }
        #total-metersOFF {
            display: inline-block;
            width: 20%;
            background-color: #d9d9d9;
            border-left: 4px solid grey;
            border-radius: 10px;
            margin: 0 0 0 3%;
        }
        #data-database p {
            text-align: center;
        }
        #data-database span {
            margin: 0 0 0 40%;
            font-size: 40px;
            color: blue;
        }


        
        #table-customers h4 {
            text-align: center;
            color: blue;
        }
       
        table {
            border-collapse: collapse;
            width: 90%;
            margin: 0 0 0 5%;
        }
        th, td {
            tex-align: left;
            padding: 10px;
            border: 1px solid grey;
        }
        tr:nth-child(even) {
            background-color: #d9d9d9;
        }
        #no-data {
            text-align: center;
            color: red;
        }
        td button {
            width: 80%;
            margin: 0 0 0 10%;
            border: none;
            background-color: green;
            color: white;
            padding: 2px;
            border-radius: 10px;
        }
        td button:active {
            background-color: lightgreen;
        }



        #add-customers {
            width: 70%;
            margin: 10px auto;
        }
        #addCustomer {
            width: 25%;
            padding: 5px;
            border-radius: 10px;
            border: none;
            background-color: blue;
            color: white;
            font-weight: bold;
        }
        #addCustomer:active {
            background-color: #9999ff;
        }
        #customer-form {
            display: none;
            width: 50%;
            border: 1px solid blue;
            border-radius: 10px;
            margin: 10px 0 20px 0;
        }
        #customer-form h5 {
            text-align: center;
            color: blue;
        }
        #customer-form input[type="text"], input[type="tel"], input[type="email"] {
            width: 80%;
            margin: 0 0 10px 10%;
            padding: 5px;
            border: 1px solid blue;
            color: #123;
            border-radius: 10px;
        }
        #customer-form button {
            width: 60%;
            margin: 0 0 10px 20%;
            padding: 5px;
            border: none;
            background-color: blue;
            color: white;
            font-weight: bold;
            border-radius: 10px;
        }
        #customer-form button:active {
            background-color: #9999ff;
        }
    </style>

    <body>
        <div id="header">
            <div id="title">
                <h2>SMART WATER METER</h2>
            </div>
        </div>

        <div id="user-side">
            <h4>ADMIN</h4>
            <h4><img src="profile.jpeg" alt="user dp"></h4>
            <h4><?php echo $row["firstname"] . " " . $row["lastname"]; ?></h4>

            <div id="nav-side">
                <button id="home-page">Home</button>
                <button id="meter-data">Meters Data</button>
                <button id="customers">Customers</button>
                <button id="logout-button">Log Out</button>
            </div>
        </div>

        <div id="other-side">
           
            <div id="customers-data">
                <span id="table-customers">
                    <h4>CUSTOMERS DATA</h4>

                    <div id="add-customers">
                        <button id="addCustomer">Add Customers</button>

                        <form id="customer-form">
                            <h5>Enter Customer Info</h5>
                            <input type="text" name="meter_number" placeholder="Meter Number:" required><br>
                            <input type="text" name="full_name" placeholder="Customer Full Name:" required><br>
                            <input type="tel" name="phone_number" placeholder="Customer Phone Number" required><br>
                            <input type="text" name="ward" placeholder="Ward Name:" required><br>
                            <input type="email" name="email" placeholder="Customer Email:" required><br>
                            <input type="text" name="registrar" placeholder="Registered By:" required><br>
                            <button type="submit" id="addcustomerButton">Submit</button>
                            <h4 id="output"></h4>
                        </form>
                    </div>


                    <table>
                        <?php
                            //selecting data from database
                            $statement = $conn->prepare("SELECT * FROM customer ORDER BY reg_time DESC");
                            $statement->execute();
                            $statement->store_result();
                            //output data of each row in array
                            $idarray = array();

                            //checking if any data is available
                            if ($statement->num_rows > 0){
	                            //data is available
	                            $statement->bind_result($meter_number, $name, $phone_number, $ward_name, $email, $service, $registered_by, $reg_time);
	                            while ($statement->fetch()){
		                            //creating an array to store IDs
		                            array_push($idarray, $meter_number);
	                            }
                            } else {
	                            //no any data available
	                            echo '<h5 id="no-data">No Available data</h5>';
                            }
                        ?>
                        <tr>
                            <th>Meter No.</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Ward</th>
                            <th>Email</th>
                            <th>Service</th>
                            <th>Registrar</th>
                        </tr>
                        <?php
                            for ($x = 0; $x < count($idarray); $x++){
	                            //the stored posts
	                            if (isset($x)) {
		                            $query = $conn->query("SELECT * FROM customer WHERE meter_number = $idarray[$x] ");
		                            $res = $query->fetch_array();

		                            //defining values
                                    $meter_no = $res["meter_number"];
                                    $name = $res["name"];
                                    $phoneNumber = $res["phone_number"];
                                    $ward = $res["wardname"];
                                    $cust_email = $res["email"];
                                    $cus_service = $res["service"];
                                    $registrar = $res["registered_by"];
                        ?>
                        <tr>
                            <td><?php echo $meter_no; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $phoneNumber; ?></td>
                            <td><?php echo $ward; ?></td>
                            <td><?php echo $cust_email; ?></td>
                            <td><button class="serviceButton" data-post-id="<?php echo $meter_no; ?>"><?php echo $cus_service; ?></button></td>
                            <td><?php echo $registrar; ?></td>
                        </tr>
                        <?php
                                }
                            }
                        ?>
                    </table>
                </span>
            </div>


        <script>
            var logout = document.getElementById('logout-button');
            logout.addEventListener('click', function() {
                window.location.href = "logout.php";
            });

            
            var homeButton = document.getElementById('home-page');
            homeButton.addEventListener('click', function() {
                window.location.href = "home.php";
            });


            var meterButton = document.getElementById('meter-data');
            meterButton.addEventListener('click', function() {
                window.location.href = "meterdata.php";
            });


            var custButton = document.getElementById('customers');
            custButton.addEventListener('click', function() {
                window.location.href = "customersdata.php";
            });


           


            var custForm = document.getElementById('customer-form');
            custForm.addEventListener('submit', submitCustomer);

            document.getElementById('addCustomer').addEventListener('click', function() {
                custForm.style.display = 'block';
            });

            function submitCustomer(e) {
                e.preventDefault();

                var formData = new FormData(custForm);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'insertcustomer.php', true);

                xhr.onload = function() {
                    if (this.status == 200) {
                        console.log(this.responseText);
                        var output = this.responseText;

                        if (output == "Registered") {
                            window.location.href = "customersdata.php";
                        } else {
                            document.getElementById('output').innerHTML = output;
                        }
                    }
                }

                xhr.send(formData);
            }


            var solenoidButton = document.querySelectorAll('.serviceButton');

            for (let i = 0; i < solenoidButton.length; i++) {
                if (solenoidButton[i].textContent === "OFF") {
                    solenoidButton[i].style.backgroundColor = 'red';
                }
                var status = solenoidButton[i].textContent;
                solenoidButton[i].addEventListener('click', changeSolenoid);
            }

            function changeSolenoid() {
                //get the id of the results
                var idMeter = event.target.dataset.postId;

                var formData = new FormData();
                formData.append('solenoid_id', idMeter);
                formData.append('solenoid_rate', status);

                if (status == "ON") {
                    //changing service to off

                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'solenoidoff.php', true);

                    xhr.onload = function() {
                        var output = this.responseText;
                        console.log(output);

                        if (output == "Changed") {
                            window.location.href = "customersdata.php";
                        }
                    }

                    xhr.send(formData);

                } else if (status == "OFF") {
                    //changing service to ON

                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'solenoid.php', true);

                    xhr.onload = function() {
                        var output = this.responseText;
                        console.log(output);

                        if (output == "Changed") {
                            window.location.href = "customersdata.php";
                        }
                    }

                    xhr.send(formData);

                }
            }
        </script>
    </body>
</html>