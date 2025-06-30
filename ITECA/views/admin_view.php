<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
    <h1>Logged in as Admin</h1>
    <hr>
    <h2>Generate CSV Reports</h2>
    <div class="reports-container">
        <a href="download-report?action=user-report">Download User Report</a><br>
        <a href="download-report?action=provinces-report">Download Provinces Report</a><br>
        <a href="download-report?action=products-report">Download All Products Report</a><br>
    </div>
    <hr>
    <h2>Admin Controls</h2>
    <hr>
    <h3>Users Table</h3>
    <table>
        <thead>
            <th>Name</th>
            <th>Email</th>
            <th>Province</th>
        </thead>
        <tbody>
            <?php foreach($users as $user): ?>
                <?php $userProvince = $user['province']; ?>
                <tr>
                    <form action="controllers/update_user.php" method="post">
                        <input type="hidden" value="<?php echo $user['id'] ?>" name="id">
                        <td><input type="text" value="<?php echo $user['name'] ?>" name="name"></td>
                        <td><input type="text" value="<?php echo $user['email'] ?>" name="email"></td>
                        <td>
                            <select name="province" id="province">
                                <?php foreach ($provinces as $province): ?>
                                    <option value="<?= $province ?>" <?= $province === $userProvince ? 'selected' : '' ?>>
                                    <?= $province ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <input type="submit" value="Update">
                            
                        </td>
                    </form>
                    <td>
                        <form action="controllers/delete_user.php" method="post">
                            <input type="hidden" value="<?php echo $user['id'] ?>" name="id">
                            <input type="submit" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <hr>

    <h3>Products</h3>
    <table>
        <thead>
            <th>Title</th>
            <th>Price</th>
            <th>Description</th>
        </thead>
        <tbody>
            <?php foreach($products as $product): ?>
                <form action="controllers/delete_product.php" method="post">
                    <tr>
                        <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
                        <td><?php echo $product['title'] ?></td>
                        <td>R<?php echo $product['price'] ?></td>
                        <td><?php echo $product['description'] ?></td>
                        <td><input type="submit" value="delete"></td>
                    </tr>
                </form>
            <?php endforeach; ?>
        </tbody>
    </table>
    
</body>
</html>

