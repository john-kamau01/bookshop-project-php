<!DOCTYPE html>
<html>
<head>
    <title>Bookshop Sales</title>
</head>
<body>
    <h1>Bookshop Sales</h1>

    <form method="post" action="index.php">
        <input type="hidden" name="action" value="post_sales">
        <button type="submit">Post Sales Data</button>
    </form>

    <form method="get" action="index.php">
        <input type="text" name="customer" placeholder="Customer Name" value="<?= htmlspecialchars($_GET['customer'] ?? '') ?>">
        <input type="text" name="product" placeholder="Product Name" value="<?= htmlspecialchars($_GET['product'] ?? '') ?>">
        <input type="number" name="price" placeholder="Max Price" step="0.01" value="<?= htmlspecialchars($_GET['price'] ?? '') ?>">
        <button type="submit">Filter Sales</button>
    </form>

    <?php if ($sales): ?>
        <table border="1">
            <tr>
                <th>Sale ID</th>
                <th>Customer Name</th>
                <th>Customer Mail</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Sale Date</th>
            </tr>
            <?php foreach ($sales as $sale): ?>
                <tr>
                    <td><?= htmlspecialchars($sale['sale_id']) ?></td>
                    <td><?= htmlspecialchars($sale['customer_name']) ?></td>
                    <td><?= htmlspecialchars($sale['customer_mail']) ?></td>
                    <td><?= htmlspecialchars($sale['product_id']) ?></td>
                    <td><?= htmlspecialchars($sale['product_name']) ?></td>
                    <td><?= htmlspecialchars($sale['product_price']) ?></td>
                    <td><?= htmlspecialchars($sale['sale_date']) ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="6">Total Price</td>
                <td>
                    <?= number_format(array_sum(array_column($sales, 'product_price')), 2) ?>
                </td>
            </tr>
        </table>
    <?php else: ?>
        <p>No sales data found.</p>
    <?php endif; ?>
</body>
</html>
