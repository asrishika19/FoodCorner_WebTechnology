
<?php
require_once "db.php";

$menu = [
    "burger" => ["name" => "Classic Burger", "price" => 120],
    "pizza" => ["name" => "Italian Pizza", "price" => 250],
    "sandwich" => ["name" => "Sandwich", "price" => 100],
    "fries" => ["name" => "French Fries", "price" => 80],
    "pasta" => ["name" => "Creamy Pasta", "price" => 180],
    "coffee" => ["name" => "Cold Coffee", "price" => 90]
];

$error = "";
$items = [];
$subtotal = 0;
$gst = 0;
$total = 0;
$orderId = null;
$customer = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $customer = trim($_POST["customer"] ?? "");

    if ($customer === "") {
        $error = "Please enter your name.";
    } else {

        foreach ($menu as $key => $food) {
            $quantity = filter_var(
                $_POST[$key] ?? 0,
                FILTER_VALIDATE_INT
            );

            if ($quantity === false || $quantity < 0 || $quantity > 20) {
                $error = "Invalid quantity entered.";
                break;
            }

            if ($quantity > 0) {
                $itemTotal = $food["price"] * $quantity;

                $items[] = [
                    "name" => $food["name"],
                    "price" => $food["price"],
                    "quantity" => $quantity,
                    "total" => $itemTotal
                ];

                $subtotal += $itemTotal;
            }
        }

        if ($error === "" && count($items) === 0) {
            $error = "Please select at least one food item.";
        }

        if ($error === "") {
            $gst = $subtotal * 0.05;
            $total = $subtotal + $gst;

            try {
                $conn->beginTransaction();

                $orderQuery = $conn->prepare(
                    "INSERT INTO orders
                    (customer_name, subtotal, gst, grand_total)
                    VALUES (?, ?, ?, ?)"
                );

                $orderQuery->execute([
                    $customer,
                    $subtotal,
                    $gst,
                    $total
                ]);

                $orderId = $conn->lastInsertId();

                $itemQuery = $conn->prepare(
                    "INSERT INTO order_items
                    (order_id, item_name, price, quantity, item_total)
                    VALUES (?, ?, ?, ?, ?)"
                );

                foreach ($items as $item) {
                    $itemQuery->execute([
                        $orderId,
                        $item["name"],
                        $item["price"],
                        $item["quantity"],
                        $item["total"]
                    ]);
                }

                $conn->commit();

            } catch (PDOException $e) {
                if ($conn->inTransaction()) {
                    $conn->rollBack();
                }

                $error = "Could not save your order. Please try again.";
            }
        }
    }
} else {
    $error = "Please place an order from the menu page.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Bill | FoodCorner</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="bill-page">

<?php if ($error !== ""): ?>

    <div class="bill-card">
        <h2>Something went wrong</h2>
        <p><?php echo htmlspecialchars($error); ?></p>
        <a href="index.php" class="secondary-btn">Back to Menu</a>
    </div>

<?php else: ?>

    <div class="bill-card">

        <div class="bill-header">
            <h1>FoodCorner</h1>
            <p>Fresh food. Happy moments.</p>
            <h2>ORDER BILL</h2>
        </div>

        <div class="customer-details">
            <p><strong>Order ID:</strong> #<?php echo htmlspecialchars((string)$orderId); ?></p>
            <p><strong>Customer:</strong> <?php echo htmlspecialchars($customer); ?></p>
            <p><strong>Date:</strong> <?php echo date("d-m-Y h:i A"); ?></p>
        </div>

        <table class="bill-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item["name"]); ?></td>
                        <td>₹<?php echo number_format($item["price"], 2); ?></td>
                        <td><?php echo $item["quantity"]; ?></td>
                        <td>₹<?php echo number_format($item["total"], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="bill-summary">
            <p>Subtotal: ₹<?php echo number_format($subtotal, 2); ?></p>
            <p>GST (5%): ₹<?php echo number_format($gst, 2); ?></p>

            <h2 class="grand-total">
                Grand Total: ₹<?php echo number_format($total, 2); ?>
            </h2>
        </div>

        <p class="thank-you">Thank you for ordering with FoodCorner!</p>

        <div class="bill-actions">
            <button onclick="window.print()">Print Bill</button>
            <a href="index.php" class="secondary-btn">Back to Menu</a>
        </div>

    </div>

<?php endif; ?>

</body>
</html>
