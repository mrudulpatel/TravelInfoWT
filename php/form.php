<?php
  // Connect to the MySQL database
  $servername = "localhost";
  $username = "root";
  $password = '';
  $dbname = "travelinfo";
  $port = 9989;

  $conn = mysqli_connect($servername, $username, $password, $dbname, $port);
  if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  } 

  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $review = $_POST['review'];

  $destination = $_POST['destination'];
  $interest = $_POST['interest'];

  $name = $firstName . " " . $lastName;


  $sql = "INSERT INTO feedbacks (name, review, most_liked_destination, next_destination) VALUES ('$name', '$review', '$destination', '$interest')";

  if(mysqli_query($conn, $sql)) {
    session_start();
    $_SESSION['formsubmitsuccess'] = "Form submitted successfully!";
    header("Location: http://localhost/TravelInfoWT/html/form_html.php");
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
?>