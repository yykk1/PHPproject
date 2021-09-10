<?php
$sql_host = "cmslamp14.aut.ac.nz";
$sql_user = "yxn9194";
$sql_pass = "mr.liu1009.";
$sql_db = "yxn9194";


$q = $_POST['cname'];
$w = $_POST['phone'];
$e = $_POST['unnumber'];
$r = $_POST['snumber'];
$t = $_POST['stname'];
$y = $_POST['sbname'];
$u = $_POST['dsbname'];
$i = $_POST['PickDate'];
$o = $_POST['PickTime'];

	// Here we get the current day and time as booking day and booking time, 
	// for each posted booking from the users, the current booking day and
	// current booking will be recorded automatically in the database.    

$currentDateTime = date('d-m-Y');
date_default_timezone_set('Pacific/Auckland');
$currentDateTime1 = date_default_timezone_get();
$currentDateTime1 = date('H:i');

$conn = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);
if ($conn->connect_error) {
    die("connection fail:" . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS assign2(
			bookingNumber int(30) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			cname VARCHAR(30) NOT NULL,
			phoneNumber VARCHAR(30) NOT NULL,
			unitNumber int(20) NOT NULL,
			streetNumber int(20) NOT NULL,
			streetName VARCHAR(30) NOT NULL,
			suburb VARCHAR(30) NOT NULL,
			destinationSuburb VARCHAR(30) NOT NULL,
			pickUpDate VARCHAR(30) NOT NULL,
			pickUpTime VARCHAR(30) NOT NULL,
			status1 VARCHAR(30) NOT NULL,
			bookingDate VARCHAR(30) NOT NULL,
			bookingTime VARCHAR(30) NOT NULL
			)ENGINE=InnoDB DEFAULT CHARSET=utf8";
if ($conn->query($sql) === TRUE) {
    echo "";
} else {
    echo "Create table failed: " . $conn->error;
}


$sql = "INSERT INTO assign2 (cname,phoneNumber,unitNumber,streetNumber,streetName,suburb,destinationSuburb,pickUpDate,pickUpTime,status1,bookingDate,bookingTime ) VALUES ('$q','$w','$e','$r','$t','$y','$u','$i','$o','unassigned','$currentDateTime','$currentDateTime1')";
mysqli_query($conn, $sql);
$sql1 = "SELECT bookingNumber FROM assign2 WHERE cname = '$q'";
$data1 = mysqli_query($conn, $sql1);

if (isset($data1)) {
    // $result = mysqli_query($con, $query) or die(mysqli_error($con));
    while ($row = mysqli_fetch_array($data1, MYSQLI_BOTH)) {
        $id['bookingNumber'] = $row['bookingNumber'];
       
    }

    echo 'Thank you! Your booking reference number is ' . $id['bookingNumber'] . '. You will be picked up in front of your provided address at ' . $o . ' on ' . $i . '.';
} else {
    echo "error";
}

?>