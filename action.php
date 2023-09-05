<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<script>console.log('In PHP' );</script>";
    // include 'dbConnect.php';
    // $conn = OpenCon();

    $username = $_POST["username"];
    $password = $_POST["password"];

    // echo 'Username: '.$username. '<br> pass: '.$password;

    // $host = "3.14.";
    // $servername = "skt";
    // $serverpassword = "ome@123";
    // $dbname = "test_db";

    $host = "sql12.freesqldatabase.com";
    $servername = "sql12644465";
    $serverpassword = "W8lyKGYc7e";
    $dbname = "sql12644465";

    // Create connection
    // $conn = new mysqli($servername, $username, $password);
    $conn = new mysqli($host, $servername, $serverpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("<br>Connection failed: " . $conn->connect_error);
    }
    echo "<br>Connected successfully";

    $UserID = verifyUser($conn, $username, $password);
    if($UserID != 0){
        echo'<br> id: '.$UserID;
        
        header("Location: getDetails.php");
    }
    else{
        echo'<br> Invalid credentials';
    }
    CloseCon($conn);

    
    // echo'UserID: '.$UserID;
    // // echo "<script>console.log('Debug Objects: " . $output . "' );</script>";

    // echo "<script>console.log('Debug Objects: " . $username . "' );</script>";
}

function verifyUser($conn, $username, $password)
{
    $res = [];
    $result = mysqli_query($conn, "SELECT userID FROM userCreds WHERE username = '$username' AND password = '$password'");
    $row = mysqli_fetch_assoc($result);
    $userID = $row['userID'];
    echo'<br>userID: '.$userID;
    if(empty($userID)){
        echo'<br>Its empty';
        return 0;
    }
    return $userID;
}
?>
