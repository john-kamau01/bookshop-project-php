<?php

require_once "../models/Sales.php";

class SalesController
{
    private $salesModel;

    public function __construct($conn){
        $this->salesModel = new Sales($conn);
    }

    public function insertSalesData(){
        $json_data = file_get_contents("../public/sales_data.json");
        $sales_data = json_decode($json_data, true);
        $this->salesModel->insertData($sales_data);
        echo "Sales data processed successfully!";
    }
}