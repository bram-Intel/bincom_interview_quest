<!DOCTYPE html>
<html>
<head>
  <title>Local Government Results</title>
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

    .table-container {
      width: 80%;
      margin: 0 auto;
    }

    /* create a container for the select box and table */
    .container {
      width: 80%;
      margin: 0 auto;
    }

    /* style the select box */
    select {
      padding: 12px;
      border-radius: 4px;
      border: 1px solid #dddddd;
      margin-bottom: 12px;
    }
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
  <div class="container">
    <form action="" method="get">
      <label for="lga_id">Select Local Government:</label>
      <select name="lga_id" id="lga_id">
        <?php
          //connect to the database
          $conn = mysqli_connect("localhost", "root", "", "bincon_test");
          //select all local governments from the lga table
          $sql = "SELECT lga_id, lga_name FROM lga";
          $result = mysqli_query($conn, $sql);
          if(!$result) {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          } else {

          //display the local governments as options in the select box
          while($row = mysqli_fetch_assoc($result)) {
            echo "<option value='".$row['lga_id']."'>".$row['lga_name']."</option>";
          }
}
          //close the database connection
          mysqli_close($conn);
        ?>
      </select>
      <input name="submit" type="submit" value="Submit">
     </form>
    
    <?php
      //connect to the database
      $conn = mysqli_connect("localhost", "root", "", "bincon_test");

      //get the lga id from the user's selection
      $lga_id = $_GET['lga_id'];

      //select the total results from the polling_unit table where the lga id matches the user's selection
      $sql = "SELECT * FROM announced_pu_results
     JOIN polling_unit ON polling_unit.uniqueid = uniqueid
     WHERE polling_unit.lga_id = '$lga_id'
      ";
      $result = mysqli_query($conn, $sql);

      //display the total results on the web page
      if(!$result) {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      } else {
        echo "<table>
                <tr>
                  <th>polling unit Name</th>
                  <th>polling unit number</th>
                  <th>polling unit description</th>
                  <th>polling result</th>
                  <th>party name</th>
                </tr>";
        while($row = mysqli_fetch_assoc($result)) {
          echo "<tr>
                  <td>".$row['polling_unit_name']."</td>
                  <td>".$row['polling_unit_number']."</td>
                  <td>".$row['polling_unit_description']."</td>
                  <td>".$row['party_score']."</td>
                  <td>".$row['party_abbreviation']."</td>
                </tr>";
        }
        echo "</table>";
      }

      //close the database connection
      mysqli_close($conn);
    ?>
  </div>
</body>
</html>
