<?php
include 'db.php';

$vendor_id = $_GET['vendor'];

$sql = "SELECT i.name, i.price, i.quantity, i.quality, c.c_name AS category_name
        FROM items i
        JOIN category c ON i.FID_Category = c.ID_Category
        WHERE i.FID_Vendor = :vendor_id";

$stmt = $pdo->prepare($sql);
$stmt->execute(['vendor_id' => $vendor_id]);
$res = $stmt->fetchAll();

$vendor_stmt = $pdo->prepare("SELECT v_name FROM vendors WHERE ID_Vendors = :id");
$vendor_stmt->execute(['id' => $vendor_id]);
$vendor_name = $vendor_stmt->fetch()['v_name'];

echo "<h2>Товари від виробника: " . htmlspecialchars($vendor_name) . "</h2>";

if (!$res) {
    echo "<p>Товарів цього виробника немає.</p>";
} else {
    echo "<table border='1' cellpadding='5' cellspacing='0'>
            <tr>
                <th>Назва</th>
                <th>Ціна</th>
                <th>Кількість</th>
                <th>Якість</th>
                <th>Категорія</th>
            </tr>";

    foreach ($res as $row) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['price']}</td>
                <td>{$row['quantity']}</td>
                <td>{$row['quality']}</td>
                <td>{$row['category_name']}</td>
              </tr>";
    }
    echo "</table>";
}
echo "<br><a href='index.php'>Повернутися назад</a>";
?>