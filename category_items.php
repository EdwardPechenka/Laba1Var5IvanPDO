<?php
include 'db.php';

$category_id = $_GET['category'];

$sql = "SELECT i.name, i.price, i.quantity, i.quality, v.v_name AS vendor_name
        FROM items i
        JOIN vendors v ON i.FID_Vendor = v.ID_Vendors
        WHERE i.FID_Category = :category_id";

$stmt = $pdo->prepare($sql);
$stmt->execute(['category_id' => $category_id]);
$res = $stmt->fetchAll();

$category_stmt = $pdo->prepare("SELECT c_name FROM category WHERE ID_Category = :id");
$category_stmt->execute(['id' => $category_id]);
$category_name = $category_stmt->fetch()['c_name'];

echo "<h2>Товари з категорії: " . htmlspecialchars($category_name) . "</h2>";

if (!$res) {
    echo "<p>Товарів у цій категорії немає.</p>";
} else {
    echo "<table border='1' cellpadding='5' cellspacing='0'>
            <tr>
                <th>Назва</th>
                <th>Ціна</th>
                <th>Кількість</th>
                <th>Якість</th>
                <th>Виробник</th>
            </tr>";

    foreach ($res as $row) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['price']}</td>
                <td>{$row['quantity']}</td>
                <td>{$row['quality']}</td>
                <td>{$row['vendor_name']}</td>
              </tr>";
    }
    echo "</table>";
}
echo "<br><a href='index.php'>Повернутися назад</a>";
?>