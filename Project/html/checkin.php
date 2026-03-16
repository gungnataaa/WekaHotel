<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $roomType = $_POST['roomType'];
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $checkIn = $_POST['checkIn'];
    $checkOut = $_POST['checkOut'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'hotel');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert into status_checkin table
    $sql = "INSERT INTO status_checkin (roomType, fullName, email, phone, checkIn, checkOut, status, createdAt) 
            VALUES (?, ?, ?, ?, ?, ?, 'pending', NOW())";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $roomType, $fullName, $email, $phone, $checkIn, $checkOut);

    if ($stmt->execute()) {
        // Get the last inserted checkinID
        $lastId = $stmt->insert_id;

        // Redirect to confirmation.php with the ID of the new booking
        header("Location: confirmation.php?checkinID=$lastId");
        exit();
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<p>Invalid request!</p>";
}
?>
