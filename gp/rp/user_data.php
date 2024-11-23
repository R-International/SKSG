<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>Registration Data</title>
</head>
<body>
  <div class="container mt-5">
    <h2>Registration Data</h2>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Serial</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Phone Number</th>
          <th>Address</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Database connection
        include "config.php";
        // Retrieve data from the register table
        $sql = "SELECT * FROM register";
        $result = mysqli_query($con, $sql);

        // Display data in table rows
        $i=1;
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . $i . "</td>";
          echo "<td>" . $row['first_name'] . "</td>";
          echo "<td>" . $row['last_name'] . "</td>";
          echo "<td>" . $row['email'] . "</td>";
          echo "<td>" . $row['phone_number'] . "</td>";
          echo "<td>" . $row['city'] . ", ".$row['state'] .", ".$row['pin_code'] ."</td>";
          echo "</tr>";
          $i++;
        }

        // Close the database connection
        mysqli_close($con);
        ?>
      </tbody>
    </table>
  </div>
  <script src="assets/js/session.js"></script>
</body>
</html>
