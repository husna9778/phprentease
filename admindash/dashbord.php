<?php
$conn = new mysqli('localhost', 'root', '', 'rentease');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO staff (name, username, password, contact, address) VALUES ('$name', '$username', '$password', '$contact', '$address')";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project Staff</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="sidebar">
        <h2>Madani</h2>
        <p>Welcome,<br>Super Admin</p>
        <ul>
            <li>Home</li>
            <li>Projects</li>
            <li>Staff
                <ul>
                    <li>All Staff</li>
                    <li>Add Staff</li>
                </ul>
            </li>
            <li>Equipments</li>
        </ul>
    </div>

    <div class="main-content">
        <h1>Project Staff</h1>
        <button class="add-btn">Add New Staff</button>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>User Name</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($staff as $index => $member) : ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= htmlspecialchars($member['name']) ?></td>
                    <td><?= htmlspecialchars($member['username']) ?></td>
                    <td><?= htmlspecialchars($member['contact']) ?></td>
                    <td><?= htmlspecialchars($member['address']) ?></td>
                    <td>
                        <button class="edit-btn">Edit</button>
                        <button class="delete-btn">Delete</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
