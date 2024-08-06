<?php
class Sales
{
    private $conn;

    public function __construct($conn)
    {
        $this->$conn = $conn;
    }

    // Function to insert data to sales table in the database
    public function insertData($sales_data){
        // Statements
        $checkStmt = $this->conn->prepare("SELECT sale_id FROM sales WHERE sale_id = ?");

        $insertStmt = $this->conn->prepare("INSERT INTO sales (sale_id, customer_name, customer_mail, product_id, product_name, product_price, sale_date) VALUES (?, ?, ?, ?, ?, ?, ?)");

        foreach($sales_data as $sale){
            // Bind the sale_id to the check statement
            $checkStmt->bind_param("i", $sale["sale_id"]);
            $checkStmt->execute();
            $checkStmt->store_result();

            // if sale_id doesn't exist, insert new record
            if($checkStmt->num_rows == 0){
                $insertStmt->bind_params(
                    "issisds",
                    $sale["sale_id"],
                    $sale["customer_name"],
                    $sale["customer_mail"],
                    $sale["product_id"],
                    $sale["product_name"],
                    $sale["product_price"],
                    $sale["sale_date"]
                );
                $insertStmt->execute();
            }
        }
        $checkStmt->close();
        $insertStmt->close();
    }
}