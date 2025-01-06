<?php

try {
    $username = "root";
    $password = "";
    $servername = "mysql:host=localhost;dbname=restaurant;charset=utf8";
    $conn = new PDO(
        $servername,
        $username,
        $password
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Database connection error : ". $e->getMessage();
    exit();
}


$customerQuery = $conn->prepare('SELECT * FROM customers');
$customerQuery->execute();
$customers = $customerQuery->fetchAll(PDO::FETCH_ASSOC);


$menuQuery = $conn->prepare('SELECT * FROM manus');
$menuQuery->execute();
$menus = $menuQuery->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer and Menu List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Customer List</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>City</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $customer): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($customer['id']); ?></td>
                        <td><?php echo htmlspecialchars($customer['name']); ?></td>
                        <td><?php echo htmlspecialchars($customer['city']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h1 class="mt-5">Menu List</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Menu Name</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($menus as $menu): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($menu['manu_id']); ?></td>
                        <td><?php echo htmlspecialchars($menu['manu_name']); ?></td>
                        <td><?php echo htmlspecialchars($menu['price']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>