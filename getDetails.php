<?php
    //$host = "3.13.172";
    //$servername = "sukt";
    //$serverpassword = "ome@123";
    //$dbname = "tesdb";

    $host = "sql12.freesqldatabase.com";
    $servername = "sql12644465";
    $serverpassword = "W8lyKGYc7e";
    $dbname = "sql12644465";

    $movieName = array();
    $theaterName = array();
    $theaterLoc = array();
    $releaseDate = array();
    
    $conn = new mysqli($host, $servername, $serverpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("<br>Connection failed: " . $conn->connect_error);
    }
    // echo "<br>Connected successfully";

    $sql = "select distinct release_date, theatre_location,theatre_name, movie_name  from movie_data";
    $result = $conn->query($sql);
    // $row = $result -> fetch_array(MYSQLI_ASSOC);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        
          array_push($movieName, $row["movie_name"]);
          array_push($theaterName, $row["theatre_name"]);
          array_push($theaterLoc, $row["theatre_location"]);
          array_push($releaseDate, $row["release_date"]);
        }
      } 
    
    

    $arr = array();
    function test($dat, $cond, $fetch){
        
        // unset($arr);
        echo "In test<br><br>";
        $sql1 = "select ".$fetch." from movie_data where ".$cond." = '".$dat."';";
        echo $sql1;
        if ($conn->connect_error) {
            die("<br>Connection failed: " . $conn->connect_error);
        }
        echo "<br>Connected successfully";
        // $mysqli->query($sql1);
        // $result1 = $conn->query($sql1);

        // if ($result->num_rows > 0) {
        //     // output data of each row
        //     while($row = $result->fetch_assoc()) {
        //     //   echo "id: " . $row["movie_name"]."<br>";
        //       array_push($arr, $row[$fetch]);
        //     }
        // } 


    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Movie Ticket Booking</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="resources/css/style.css">
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Movie Ticket Booking</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="index.html"> Logout <span class="glyphicon glyphicon-log-out"></span></a></li>
    </ul>
  </div>
</nav>
  
<div class="container" align = "center">
    <h3 align = "center"><u>Movie Ticket</u></h3>
    <p>Book movie tickets here!</p>
    <select id="releaseDateDropDown"></select>
    <select id="theaterLocDropDown"></select>
    <select id="theaterNameDropDown"></select>
    <select id="movieNamesDropDown"></select>
    <select id = "timing"></select>
    <select id = "seat"></select>
    <br><br>
    <div  align="center">
        <button class="button" type="submit" onClick = "display()">Submit</button>
    </div>

    <div class = "row" align = "left" id = "confirm" style = "display:none">
      <div class="col-md-6">
        <h3><u id = "head"></u></h3>
        <b><ul id = "det" style = "list-style-type: none"></ul></b>
        <button class = "button" type="submit" onClick = "storage()"> Confirm</button>
      </div>
      <div class="col-md-6">
      <h3><u id = "his"></u></h3>
        <b><ul id = "history" style = "list-style-type: none"></ul></b>
      </div>
    </div>
</div>
</body>
</html>


  
<script>
var movieNames = <?php echo json_encode($movieName); ?>;
var theaterName = <?php echo json_encode($theaterName); ?>;
var theaterLoc = <?php echo json_encode($theaterLoc); ?>;
var releaseDate = <?php echo json_encode($releaseDate); ?>;



var mName = document.getElementById("movieNamesDropDown");
var tName = document.getElementById("theaterNameDropDown");
var tLoc = document.getElementById("theaterLocDropDown");
var relDate = document.getElementById("releaseDateDropDown");


for (var i = -1; i < releaseDate.length; i++){
    var item;
    if (i == -1)
        item = "Choose a Date";
    else
        item = releaseDate[i];

    var element = document.createElement("option");
    element.innerText = item;
    relDate.append(element);
}

for (var i = -1; i < movieNames.length; i++){
    var item;
    if (i == -1)
        item = "Choose a Movie";
    else
        item = movieNames[i];
  var element = document.createElement("option");
  element.innerText = item;
  mName.append(element);
}

for (var i = -1; i < theaterName.length; i++){
  var item 
  if(i == -1)
    item = "Choose a Theater";
  else 
    item = theaterName[i];
  var element = document.createElement("option");
  element.innerText = item;
  tName.append(element);
}

for (var i = -1; i < theaterLoc.length; i++){
  var item;
  if(i == -1)
    item = "Choose a location";
  else 
    item = theaterLoc[i];
  var element = document.createElement("option");
  element.innerText = item;
  tLoc.append(element);
}

for (var i = 0; i < 11; i++){
  var item 
  if(i == 0)
    item = "No. of seats";
  else
    item = i;
  var element = document.createElement("option");
  element.innerText = item;
  seat.append(element);
}

var timings = ["10AM", "2PM", "6PM", "10PM"];

for (var i = -1; i < timings.length; i++){
  var item 
  if(i == -1)
    item = "Choose a slot";
  else
    item = timings[i];
  var element = document.createElement("option");
  element.innerText = item;
  timing.append(element);
}



function display(){

    document.getElementById("head").innerHTML = "Confirm Details";
    var arr = new Array();
    var select = document.getElementById('releaseDateDropDown'); 
    var option = select.options[select.selectedIndex]; 
    console.log("option.value: "+option.value);
    arr.push("Date of booking: "+ option.value);

    var select = document.getElementById('theaterLocDropDown'); 
    var option = select.options[select.selectedIndex]; 
    console.log("Loc: "+option.value);
    arr.push("Location: "+option.value);

    var select = document.getElementById('theaterNameDropDown'); 
    var option = select.options[select.selectedIndex]; 
    console.log("ThName: "+option.value);
    arr.push("Name of the Theater: "+option.value);

    var select = document.getElementById('movieNamesDropDown'); 
    var option = select.options[select.selectedIndex]; 
    console.log("mName: "+option.value);
    arr.push("Movie: "+option.value);

    var select = document.getElementById('timing'); 
    var option = select.options[select.selectedIndex]; 
    console.log("time: "+option.value);
    arr.push("Timing: "+option.value);

    var select = document.getElementById('seat'); 
    var option = select.options[select.selectedIndex]; 
    console.log("slot: "+option.value);
    arr.push("No. of seats booked: "+option.value);

    for (let i = 0; i < arr.length; i++){
        let list = document.createElement('li');
        list.innerText=arr[i];
        document.querySelector('#det').appendChild(list);
    }

    document.querySelector('#confirm').style.display="block";
    // <php echo test(); ?>
    // var <php $myname;?> = t;
    // var text = "<php echo test('" + t + "', 'release_date', 'theatre_location') ?>";
    // console.log("txt: "+text);
}


function storage(){
  console.log("Here");
  alert("Booking Confirmed!");

}


</script>
