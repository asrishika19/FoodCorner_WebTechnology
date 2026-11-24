
<?php
require_once "db.php";

$query = $conn->query("SELECT * FROM orders ORDER BY id DESC");
$orders = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History | FoodCorner</title>
    <link rel="stylesheet" href="style.css">

    <style>
        .history-page {
            background: #faf7f2;
            min-height: 100vh;
            padding: 45px 7%;
        }

        .history-container {
            max-width: 1000px;
            margin: auto;
        }

        .history-title {
            text-align: center;
            color: #4b3025;
            margin-bottom: 35px;
        }

        .history-title h1 {
            font-size: 36px;
            margin-bottom: 8px;
        }

        .order-card {
            background: white;
            padding: 25px;
            border-radius: 14px;
            margin-bottom: 22px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.06);
        }

        .order-top {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }

        .order-top h3 {
            color: #75452f;
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .history-table th,
        .history-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .history-table th {
            color: #75452f;
            background: #faf7f2;
        }

        .order-total {
            text-align: right;
            margin-top: 15px;
            color: #4b3025;
        }

        .back-link {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 22px;
            background: #75452f;
            color: white;
            text-decoration: none;
            border-radius: 7px;
        }

        .empty-history {
            background: white;
            padding: 35px;
            text-align: center;
            border-radius: 12px;
        }

        @media(max-width: 600px) {
            .history-table {
                font-size: 13px;
            }

            .history-table th,
            .history-table td {
                padding: 8px 5px;
            }
        }
    </style>
</head>

<body class="history-page">

<div class="history-container">

    <div class="history-title">
        <h1>Order History</h1>
        <p>Your previous FoodCorner orders</p>
    </div>

    <?php if (count($orders) > 0): ?>

        <?php foreach ($orders as $order): ?>

            <div class="order-card">

                <div class="order-top">
                    <div>
                        <h3>Order #<?php echo $order["id"]; ?></h3>
                        <p>
                            Customer:
                            <?php echo htmlspecialchars($order["customer_name"]); ?>
                        </p>
                    </div>

                    <div>
                        <p>
                            <?php echo date("d-m-Y h:i A", strtotime($order["order_date"])); ?>
                        </p>
                    </div>
                </div>

                <?php
                $itemQuery = $conn->prepare(
                    "SELECT * FROM order_items WHERE order_id = ?"
                );
                $itemQuery->execute([$order["id"]]);
                $orderItems = $itemQuery->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <table class="history-table">
                    <thead>
                        <tr>
                            <th>Food Item</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($orderItems as $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item["item_name"]); ?></td>
                                <td>₹<?php echo number_format($item["price"], 2); ?></td>
                                <td><?php echo $item["quantity"]; ?></td>
                                <td>₹<?php echo number_format($item["item_total"], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="order-total">
                    <p>Subtotal: ₹<?php echo number_format($order["subtotal"], 2); ?></p>
                    <p>GST: ₹<?php echo number_format($order["gst"], 2); ?></p>
                    <h3>Grand Total: ₹<?php echo number_format($order["grand_total"], 2); ?></h3>
                </div>

            </div>

        <?php endforeach; ?>

    <?php else: ?>

        <div class="empty-history">
            <h2>No orders yet!</h2>
            <p>Your order history will appear here.</p>
        </div>

    <?php endif; ?>

    <div style="text-align:center;">
        <a href="index.php" class="back-link">Back to Home</a>
    </div>

</div>

</body>
</html>
