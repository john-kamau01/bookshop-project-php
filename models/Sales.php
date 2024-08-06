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

    // Function to filter data
    public function filterSales($customer, $product, $price)
    {
        $sql = "SELECT * FROM sales WHERE 1=1";
        if ($customer) {
            $sql .= " AND customer_name LIKE ?";
        }
        if ($product) {
            $sql .= " AND product_name LIKE ?";
        }
        if ($price) {
            $sql .= " AND product_price <= ?";
        }

        $stmt = $this->conn->prepare($sql);

        if ($customer && $product && $price) {
            $stmt->bind_param("ssi", "%$customer%", "%$product%", $price);
        } elseif ($customer && $product) {
            $stmt->bind_param("ss", "%$customer%", "%$product%");
        } elseif ($customer && $price) {
            $stmt->bind_param("si", "%$customer%", $price);
        } elseif ($product && $price) {
            $stmt->bind_param("si", "%$product%", $price);
        } elseif ($customer) {
            $stmt->bind_param("s", "%$customer%");
        } elseif ($product) {
            $stmt->bind_param("s", "%$product%");
        } elseif ($price) {
            $stmt->bind_param("i", $price);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $sales = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $sales;
    }
}