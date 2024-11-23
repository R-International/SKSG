<?php
// Establish a MySQL connection
include "config.php"; // Make sure to replace this with your DB connection code

// Fetch all data from the register table
$registerQuery = "SELECT * FROM register";
$registerResult = $con->query($registerQuery);

$data = array();

if ($registerResult->num_rows > 0) {
    while ($registerRow = $registerResult->fetch_assoc()) {
        $phone_number = $registerRow['phone_number'];

        // Fetch sum of prayCounter FROM pray_counter1 table using RIGHT JOIN
        $prayCounterQuery = "SELECT SUM(prayCounter) AS totalPrayCounter FROM pray_counter1 WHERE phone_number = ?";
        $stmt = $con->prepare($prayCounterQuery);
        $stmt->bind_param("s", $phone_number);
        $stmt->execute();
        $prayCounterResult = $stmt->get_result();
        $stmt->close();

        $prayCounterRow = $prayCounterResult->fetch_assoc();
        $totalPrayCounter = $prayCounterRow['totalPrayCounter'];

        // Combine data from both tables
        if (!$totalPrayCounter) {
            $totalPrayCounter = 0;
        }

        $combinedData = array(
            "userName" => $registerRow['first_name'] . " " . $registerRow['last_name'],
            "phoneNumber" => $registerRow['phone_number'],
            "location" => $registerRow['state'] . "," . $registerRow['city'] . "," . $registerRow['pin_code'],
            "totalCount" => $totalPrayCounter
        );

        $data[] = $combinedData;
    }
}

// Close the MySQL connection
$con->close();

// Sort the data array based on highest totalCount in descending order
usort($data, function($a, $b) {
    return $b['totalCount'] - $a['totalCount'];
});

// Set rank as per order, or set "NA" if totalCount is 0
$rank = 1;
foreach ($data as &$item) {
    if ($item['totalCount'] == 0) {
        $item['rank'] = "NA";
    } else {
        $item['rank'] = $rank;
        $rank++;
    }
}

// Output data in JSON format
header('Content-Type: application/json');
echo json_encode($data);
?>
