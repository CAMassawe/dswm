<?php
include 'mainfile.php';

//if user did not log in, be directed back to log in
if (!isset($_SESSION['loggedin'])){
	header('Location: index.html');
}

//selecting user data from database
 $id = $_SESSION['id'];
 if ($sql = "SELECT * FROM main_admin WHERE id = $id"){
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
        <title>Other admins</title>
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


        #table-otheradmins h4 {
            text-align: center;
            color: blue;
        }
        #table-otheradmins button {
            width: 80%;
            margin: 0 0 0 10%;
            padding: 5px;
            border: none;
            color: white;
            background-color: red;
            border-radius: 10px;
        }
        #table-otheradmins button:active {
            background-color: grey;
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
    </style>

    <body>
        <div id="header">
            <div id="title">
                <h2>SMART WATER METER</h2>
            </div>
        </div>

        <div id="user-side">
            <h4>MAIN ADMIN</h4>
            <h4><img src="profile.jpeg" alt="user dp"></h4>
            <h4><?php echo $row["firstname"] . " " . $row["lastname"]; ?></h4>

            <div id="nav-side">
                <button id="home-page">Home</button>
                <button id="meter-data">Meters Data</button>
                <button id="customers">Customers</button>
                <button id="other-admins">Other Admins</button>
                <button id="logout-button">Log Out</button>
            </div>
        </div>

        <div id="other-side">

            <div id="otherAd-data">
                <span id="table-otheradmins">
                    <h4>OTHER ADMINS DATA</h4>
                    <table>
                        <?php
                            //selecting data from database
                            $statement = $conn->prepare("SELECT * FROM other_admin ORDER BY id DESC");
                            $statement->execute();
                            $statement->store_result();
                            //output data of each row in array
                            $idarray = array();

                            //checking if any data is available
                            if ($statement->num_rows > 0){
	                            //data is available
	                            $statement->bind_result($id, $firstn, $lastn, $Email, $passwords, $status);
	                            while ($statement->fetch()){
		                            //creating an array to store IDs
		                            array_push($idarray, $id);
	                            }
                            } else {
	                            //no any data available
	                            echo '<h5 id="no-data">No Available data</h5>';
                            }
                        ?>
                        <tr>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Status</th>
                        </tr>
                        <?php
                            for ($x = 0; $x < count($idarray); $x++){
	                            //the stored posts
	                            if (isset($x)) {
		                            $query = $conn->query("SELECT * FROM other_admin WHERE id = $idarray[$x] ");
		                            $res = $query->fetch_array();

		                            //defining values
                                    $idN = $res["id"];
                                    $firstname = $res["firstname"];
                                    $lastname = $res["lastname"];
                                    $email = $res["email"];
                                    $statusUs = $res["status"];
                        ?>
                        <tr>
                            <td><?php echo $res["firstname"]; ?></td>
                            <td><?php echo $res["lastname"]; ?></td>
                            <td><?php echo $res["email"]; ?></td>
                            <td><button class="statusAdmin" data-post-id="<?php echo $idN; ?>"><?php echo $res["status"]; ?></button></td>
                        </tr>
                        <?php
                                }
                            }
                        ?>
                    </table>
                </span>
            </div>
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


            var otherButton = document.getElementById('other-admins');
            otherButton.addEventListener('click', function() {
                window.location.href = "otheradmins.php";
            });


            var statusButton = document.querySelectorAll('.statusAdmin');

            for (let i = 0; i < statusButton.length; i++) {
                if (statusButton[i].innerHTML === "Verified") {
                    statusButton[i].style.backgroundColor = 'green';
                }
                var adminStatus = statusButton[i].innerHTML;
                statusButton[i].addEventListener('click', changeStatus);
            }

            function changeStatus() {
                var idNumber = event.target.dataset.postId;
                console.log(idNumber);
                
                var formData = new FormData();
                formData.append('adminID', idNumber);
                formData.append('admin_status', adminStatus);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'changestatus.php', true);

                xhr.onload = function() {
                    if (this.status == 200) {
                        var output = this.responseText;
                        console.log(adminStatus);

                        if (output == "Changed") {
                            window.location.href = "otheradmins.php";
                        }
                    }
                }

                xhr.send(formData);
            }
        </script>
    </body>
</html>