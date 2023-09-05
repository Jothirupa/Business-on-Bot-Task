<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $number = $_POST["mob"];
    $password = $_POST["password"];

    echo 'Username: '.$fname. '<br> pass: '.$password;
    echo "<script>console.log('In registration'".$fname." );</script>";

    // $host = "3.14.1";
    // $servername = "sut";
    // $serverpassword = "come@123";
    // $dbname = "te";

    $host = "sql12.freesqldatabase.com";
    $servername = "sql12644465";
    $serverpassword = "W8lyKGYc7e";
    $dbname = "sql12644465";

    // Create connection
    $conn = new mysqli($host, $servername, $serverpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("<br>Connection failed: " . $conn->connect_error);
    }
    echo "<br>Connected successfully";

    $registered = registerUser($conn, $fname, $lname, $email, $number, $password);

    if ($registered == 1){
        echo 'REgistered successfully';
    }
    else{
        echo '! registered';
    }

    CloseCon($conn);
}

function registerUser($conn, $fname, $lname, $mail, $num, $pass)
{
    echo'<br> in verifyUser';
    $details = "INSERT INTO userDetails (firstname, lastname, email, mobile)
    VALUES ('".$fname."', '".$lname."', '".$mail."', '".$num."')";

    $creds = "INSERT INTO userCreds (username, password) VALUES (".$num.", '".$pass."')";

    if (mysqli_query($conn, $details) and mysqli_query($conn, $creds)) {
        echo "New record created successfully";
        return 1;
    } else {
        echo "Error: " . $details . "<br>" . mysqli_error($conn);
        return 0;
    }


    // $res = [];
    // $result = mysqli_query($conn, "SELECT user_id FROM user_credentials WHERE user_name = '$username' AND password = '$password'");
    // $row = mysqli_fetch_assoc($result);
    // $userID = $row['user_id'];
    // echo'<br>userID: '.$userID;
    // if(empty($userID)){
    //     echo'<br>Its empty';
    //     return 0;
    // }
    // return $userID;
}
?>
