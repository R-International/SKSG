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
          <th>Phone Number</th>
          <th>Secret Key</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Database connection
        include "config.php";
        // Retrieve data from the register table
        $sql = "SELECT phone_number, secret_key FROM register";
        $result = mysqli_query($con, $sql);

        // Display data in table rows
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . $row['phone_number'] . "</td>";
          echo "<td>" . $row['secret_key'] . "</td>";
          echo "</tr>";
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
