<?php
$success = 0;
$servername = "sql6.freemysqlhosting.net";
$username = "sql6444579";
$password = "EJ34UxIstj";
$dbname = "sql6444579";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Creating array for ids of the entries for random selection
$id_array = array();

$sql = "select id from lottery where count<>3";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Pushing the id twice to double the chances
        if($row["id"]==2)
        {
            array_push($id_array, $row["id"]);
            array_push($id_array, $row["id"]);
        }
         // Pushing the id thrice to triple the chances
        else if($row["id"]==2)
        {
            array_push($id_array, $row["id"]);
            array_push($id_array, $row["id"]);
            array_push($id_array, $row["id"]);
        }
        else
        {
            array_push($id_array, $row["id"]);
        }
    }
} 


// Generating a random number between 0 and the (length of $id_array)-1
$random_value=rand(0,count($id_array)-1);

//Selecting the id which is in the position of the $random_value

$email="none";
$phone="none";

$sql = "select email,phone from lottery where id=$id_array[$random_value]";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        global $email,$phone;
        $email=$row['email'];
        $phone=$row['phone'];
        
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css" rel="stylesheet" />
    <title>Lottery</title>
</head>

<body>
    <div class="container">
        <div class="card col-md-8 my-5 mx-auto text-center">
            <div class="card-body">
                <h5 class="card-title text-primary">Lottery Winner</h5>
                <p class="card-text">Details of the lottery winner are</p>
            </div>
            <div class="card-body text-dark">
                <b>Email: </b><?php echo $email; ?></li><br>
                <b>Phone: </b><?php echo $phone; ?></li>
            </div>
        </div>

    </div>
</body>
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"></script>

</html>