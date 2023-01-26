<!DOCTYPE html>
<html>
<head>
  <title>New Polling Unit Results</title>
  <style>

    /* add some basic styling */
    body {
      font-family: Arial, sans-serif;
    }
nav {
  background-color: #333;
  color: #fff;
  padding: 10px;
}

nav ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
}

nav li {
  float: left;
}

nav a {
  color: #fff;
  text-decoration: none;
  padding: 10px 20px;
  display: block;
}

nav a:hover {
  background-color: #555;
}

    /* center the input fields and submit button */
    .input-container {
      text-align: center;
    }

    /* style the input fields and submit button */
    input[type="text"], input[type="submit"] {
      padding: 12px;
      border-radius: 4px;
      border: 1px solid #dddddd;
      margin-bottom: 12px;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      cursor: pointer;
    }

    /* style the error message */
    .error {
      color: red;
    }
  </style>
</head>
<body>
<nav>
  <ul>
    <li><a href="index.php">Question1</a></li>
    <li><a href="quest2.php">Question2</a></li>
    <li><a href="question3.php">Question3</a></li>
    
  </ul>
</nav>
  <div class="input-container">
    <form action="" method="post">
      <label for="polling_unit_uniqueid">Polling Unit Unique ID:</label>
<input type="text" name="polling_unit_uniqueid" id="polling_unit_uniqueid">
<br>
<label for="party">Party:</label>
<input type="text" name="party" id="party">
<br>
<label for="score">Score:</label>
<input type="text" name="score" id="score">
<br>
<input name="submit" type="submit" value="Submit">
</form>
</div>

  

  <div class="table-container">
<?php
//connect to the database
$conn = mysqli_connect("localhost", "root", "", "bincon_test");
  //get the results from the user input
  $polling_unit_uniqueid = $_POST['polling_unit_uniqueid'];
  $party = $_POST['party'];
  $score = $_POST['score'];

  //validate the inputs
  //validate the inputs
      if(empty($polling_unit_uniqueid) || empty($party) || empty($score)) {
        echo "<p class='error'>All fields are required!</p>";
      } else {
          if(isset($_POST['submit'])){
        //insert the results into the announced_pu_results table
        $sql = "INSERT INTO announced_pu_results (polling_unit_uniqueid, party_abbreviation, party_score) VALUES ('$polling_unit_uniqueid', '$party', '$score')";
        if(mysqli_query($conn, $sql)) {
          echo "<p>Results added successfully!</p>";
        } else {
          echo "<p class='error'>Error: ".mysqli_error($conn)."</p>";
        }
          }
      }

  //close the database connection
  mysqli_close($conn);
?>
</div>
</body>
</html>
