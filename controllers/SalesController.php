<?php

require_once "../models/Sales.php";

class SalesController
{
    private $conn;
    private $salesModel;

    public function __construct($conn){
        $this->conn = $conn;
        $this->salesModel = new Sales($conn);
    }

    public function insertSalesData(){
        $json_data = file_get_contents("../public/sales_data.json");
        $sales_data = json_decode($json_data, true);
        $this->salesModel->insertData($sales_data);
        // echo "Sales data processed successfully!";
        header("Location: index.php");
        exit;
    }

    public function handleRequest()
    {
        // Get filter parameters
        $customer = $_GET['customer'] ?? '';
        $product = $_GET['product'] ?? '';
        $price = $_GET['price'] ?? '';

        // Fetch filtered sales data
        $sales = $this->salesModel->filterSales($customer, $product, $price);

        // Render the view
        require '../views/home.php';
    }
}