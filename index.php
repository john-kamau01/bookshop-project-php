<?php

require "./config/config.php";
require "./controllers/SalesController.php";

$config = require "./config/config.php";

$conn = new mysqli($config["db_host"], $config["db_user"], $config["db_password"], $config["db_name"]);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

$salesController = new SalesController($conn);

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $salesController->insertSalesData();
}

$conn->close();