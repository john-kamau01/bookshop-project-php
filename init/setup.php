<?php
require '../config/config.php';

// Connect to MySQL
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Load and execute schema
$sql = file_get_contents('../init/schema.sql');
if ($conn->multi_query($sql)) {
    do {
        if ($result = $conn->store_result()) {
            $result->free();
        }
    } while ($conn->more_results() && $conn->next_result());
    echo "Database setup complete!";
} else {
    echo "Error setting up database: " . $conn->error;
}

$conn->close();
