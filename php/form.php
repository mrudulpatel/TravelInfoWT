<?php
session_start();
// Connect to the MySQL database
$servername = "localhost";
$username = "root";
$password = '';
$dbname = "travelinfo";
$port = 9989;

$conn = mysqli_connect($servername, $username, $password, $dbname, $port);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$review = $_POST['review'];
$destination = $_POST['destination'];
$interest = $_POST['interest'];

$name = $firstName . " " . $lastName; //concatenation of first and last name
// name = first name + last name;

if (preg_match("/[0-9!@#$%^&*]/", $firstName)) {
  $_SESSION['error_message'] = "First Name should not contain any special characters or numbers";
  header("Location: http://localhost/TravelInfoWT/html/form_html.php");
  exit();
} else if(preg_match("/[0-9!@#$%^&*]/", $lastName)) {
  $_SESSION['error_message'] = "Last Name should not contain any special characters or numbers";
  header("Location: http://localhost/TravelInfoWT/html/form_html.php");
  exit();
} else if(preg_match("/[0-9!@#$%^&*]/", $review)) {
  $_SESSION['error_message'] = "Review should not contain any special characters or numbers";
  header("Location: http://localhost/TravelInfoWT/html/form_html.php");
  exit();
}

$sql = "INSERT INTO feedbacks (name, review, most_liked_destination, next_destination) VALUES ('$name', '$review', '$destination', '$interest')";

if (mysqli_query($conn, $sql)) {
  $_SESSION['message'] = "Form submitted successfully!";
  header("Location: http://localhost/TravelInfoWT/html/form_html.php");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
