<!DOCTYPE html>
<html>
<head>
  <title>Polling Unit Results</title>
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

    /* create a container for the table */
    .table-container {
      width: 80%;
      margin: 0 auto;
    }

    /* style the table */
    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      border: 1px solid #dddddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #dddddd;
    }

    /* center the input field and submit button */
    .input-container {
      text-align: center;
    }

    /* style the input field and submit button */
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
  </style>
</head>
<body>
<nav>
  <ul>
    <li><a href="index.php">Question1</a></li>
    <li><a href="quest2.php">Question2</a></li>
    <li><a href="question3">Question3</a></li>
    
  </ul>
</nav>

  <div class="input-container">
    <form action="" method="get">
      <label for="polling_unit_uniqueid">Enter Polling Unit Unique ID:</label>
      <input type="text" name="polling_unit_uniqueid" id="polling_unit_uniqueid">
      <input type="submit" value="Submit">
    </form>
  </div>

  <div class="table-container">
    <?php
      //connect to the database
      $conn = mysqli_connect("localhost", "root", "", "bincon_test");

      //get the polling unit unique id from the user input
      $polling_unit_uniqueid = $_GET['polling_unit_uniqueid'];

      //select the results from the announced_pu_results table where the polling_unit_uniqueid matches the user's input
      $sql = "SELECT * FROM announced_pu_results WHERE polling_unit_uniqueid = '$polling_unit_uniqueid'";
      $result = mysqli_query($conn, $sql);

      //display the results on the web page
      echo "<table>";
      echo "<tr>
              <th>Party</th>
              <th>Score</th>
            </tr>";
      while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>".$row['party_abbreviation']."</td>
                <td>".$row['party_score']."</td>
              </tr>";
      }
      echo "</table>";

      //close the database connection
      mysqli_close($conn);
    ?>
  </div>
</body>
</html>
