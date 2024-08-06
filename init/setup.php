<?php
require "../config/config.php";

$config = require "../config/config.php";

$conn = new mysqli($config["db_host"],$config["db_user"], $config["db_password"], $config["db_name"]);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

// Read and execute the schema.sql file
$schema = file_get_contents(__DIR__ . "/schema.sql");

if($conn->multi_query($schema)){
    echo "Database schema created successfully!";
} else {
    echo "Error creating database schema: " . $conn->error;
}

$conn->close();