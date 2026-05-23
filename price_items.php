<?php
include 'db.php';

$min_price = $_GET['min_price'];
$max_price = $_GET['max_price'];

$sql = "SELECT i.name, i.price, i.quantity, i.quality, v.v_name AS vendor_name, c.c_name AS category_name
        FROM items i
        JOIN vendors v ON i.FID_Vendor = v.ID_Vendors
        JOIN category c ON i.FID_Category = c.ID_Category
        WHERE i.price BETWEEN :min_price AND :max_price
        ORDER BY i.price ASC";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    'min_price' => $min_price,
    'max_price' => $max_price
]);
$res = $stmt->fetchAll();

echo "<h2>Товари в діапазоні цін від {$min_price} до {$max_price} грн</h2>";

if (!$res) {
    echo "<p>Товарів у цьому діапазоні не знайдено.</p>";
} else {
    echo "<table border='1' cellpadding='5' cellspacing='0'>
            <tr>
                <th>Назва</th>
                <th>Ціна</th>
                <th>Кількість</th>
                <th>Якість</th>
                <th>Виробник</th>
                <th>Категорія</th>
            </tr>";

    foreach ($res as $row) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['price']}</td>
                <td>{$row['quantity']}</td>
                <td>{$row['quality']}</td>
                <td>{$row['vendor_name']}</td>
                <td>{$row['category_name']}</td>
              </tr>";
    }
    echo "</table>";
}
echo "<br><a href='index.php'>Повернутися назад</a>";
?>