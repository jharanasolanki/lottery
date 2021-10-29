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
        <div class="col-12 text-center my-5">

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
            $email = $_POST['email'];
            $phone = $_POST['phone'];

            // Updating the count if entry already exists
            $sql = "UPDATE lottery SET count=count+1 WHERE email='$email' and phone='$phone'";
            if ($conn->query($sql) === TRUE) {
                // Checking if same entry exists
                if (mysqli_affected_rows($conn) > 0) {
                    $success = 1;
                } else {
                    // Inserting entry if it doesn't exist
                    $sql = "INSERT INTO lottery (email, phone, count)
    VALUES ('$email', '$phone', 1)";
                    if ($conn->query($sql) === TRUE) {
                        $success = 1;
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                }
            } else {
                echo "Error updating record: " . $conn->error;
            }
            // Alerts for users
            if ($success == 1) {
            ?>
                <div class="alert alert-success" role="alert">
                    Your lottery entry is succesful!
                </div>
            <?php
            } else {
            ?>
                <div class="alert alert-danger" role="alert">
                    Your lottery entry failed!
                </div>
            <?php
            }
            ?>

        </div>
    </div>
</body>
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"></script>

</html>