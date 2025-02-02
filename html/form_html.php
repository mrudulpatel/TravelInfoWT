<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="/TravelInfoWT/styles/form.css" />
  <title>Feedback Form</title>
</head>

<body>
  <?php
    session_start();
    if(isset($_SESSION['error_message'])) {
      echo "<div style='text-align: center; padding: 10px; background: rgb(240, 168, 168); color: red; margin-bottom: 10px;'>
      " . $_SESSION['error_message'] . "</div>";
      unset($_SESSION['error_message']);
    }
  ?>
  <?php
  if (isset($_SESSION['message'])) {
    echo "<div style='text-align: center; padding: 10px; background: rgb(168, 240, 177); color: green; margin-bottom: 10px;'>
    " . $_SESSION['message'] . "</div>";
    unset($_SESSION['message']);
  }
  ?>
  <form method="post" action="/TravelInfoWT/php/form.php">
    <h1>Please Give Us Your Feedback</h1>
    <p>It Means alot to Us !</p>
    <fieldset>
      <!-- Section 1 -->
      <legend><span class="section">1</span>Your Basic Info</legend>
      <label class="" for="First_Name">First Name:</label>
      <input type="text" name="firstName" value="" id="firstName" placeholder="Write Your First Name" required />

      <label class="" for="lastName">Last Name:</label>
      <input type="text" name="lastName" value="" id="lastName" placeholder="Write Your Last Name" required />
    </fieldset>

    <fieldset>
      <!-- section 2 -->
      <legend><span class="section">2</span>Feedback</legend>

      <label class="" for="review">Your Review !</label>
      <textarea name="review" id="review" placeholder="Write Your Review" required></textarea>

      <label for="destination">Which Destination you liked most ?</label>
      <select name="destination" id="destination" required>
        <option value="Paris" id="Paris">Paris</option>
        <option value="Rome" id="Rome">Rome</option>
        <option value="India" id="India">India</option>
        <option value="Brazil" id="Brazil">Brazil</option>
      </select>
      <br /><br />
      <label>Which Destination's info would you like to see next ?</label>

      <select id="interest" name="interest" required>
        <option value="Honkong">Honkong</option>
        <option value="Dubai">Dubai</option>
        <option value="Egypt">Egypt</option>
      </select>

      <input type="submit" value="Submit" />
    </fieldset>
  </form>
</body>

</html>