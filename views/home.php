<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Dashboard</title>
</head>
<body>
    <h1>Sales Dashboard</h1>

    <!-- Form to Post Sales Data -->
    <form action="index.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="post_sales">
        <button type="submit">Insert Sales Data</button>
    </form>

    <!-- Form for Filtering Sales Data -->
    <form action="index.php" method="get">
        <input type="text" name="customer" placeholder="Customer Name">
        <input type="text" name="product" placeholder="Product Name">
        <input type="number" step="0.01" name="price" placeholder="Max Price">
        <button type="submit">Filter Sales</button>
    </form>

    <?php if (isset($sales)): ?>
        <!-- Display Filtered Sales Data -->
        <h2>Filtered Sales Data</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Sale ID</th>
                    <th>Customer Name</th>
                    <th>Customer Email</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Sale Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sales as $sale): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($sale['sale_id']); ?></td>
                        <td><?php echo htmlspecialchars($sale['customer_name']); ?></td>
                        <td><?php echo htmlspecialchars($sale['customer_mail']); ?></td>
                        <td><?php echo htmlspecialchars($sale['product_id']); ?></td>
                        <td><?php echo htmlspecialchars($sale['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($sale['product_price']); ?></td>
                        <td><?php echo htmlspecialchars($sale['sale_date']); ?></td>
                    </tr>
                <?php endforeach; ?>
                <!-- Total Price Row -->
                <tr>
                    <td colspan="6">Total Price</td>
                    <td>
                        <?php echo number_format(array_sum(array_column($sales, 'product_price')), 2); ?>
                    </td>
                </tr>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
