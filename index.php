<?php 
include 'db.php'; 
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Інтернет-магазин (Варіант 5)</title>
</head>
<body>
    <h1>Розклад та пошук товарів</h1>
    
    <form action="vendor_items.php" method="GET">
        <label for="vendor">Оберіть виробника:</label>
        <select name="vendor" id="vendor">
            <?php
            $stmt = $pdo->query('SELECT ID_Vendors, v_name FROM vendors');
            while ($row = $stmt->fetch()) { 
                echo "<option value=\"{$row['ID_Vendors']}\">{$row['v_name']}</option>";
            }
            ?>
        </select>
        <button type="submit">Отримати товари</button>
    </form>
    <br>

    <form action="category_items.php" method="GET">
        <label for="category">Оберіть категорію:</label>
        <select name="category" id="category">
            <?php
            $stmt = $pdo->query('SELECT ID_Category, c_name FROM category');
            while ($row = $stmt->fetch()) { 
                echo "<option value=\"{$row['ID_Category']}\">{$row['c_name']}</option>";
            }
            ?>
        </select>
        <button type="submit">Отримати товари</button>
    </form>
    <br>

    <form action="price_items.php" method="GET">
        <label>Оберіть ціновий діапазон (грн):</label>
        <input type="number" name="min_price" placeholder="Мін. ціна" required min="0">
        <input type="number" name="max_price" placeholder="Макс. ціна" required min="0">
        <button type="submit">Фільтрувати за ціною</button>
    </form>
</body>
</html>