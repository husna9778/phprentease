<!DOCTYPE html>
<html>
<head>
    <title>Customer Marketing</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
            background: url('images/bb.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
        }
        .container {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6); /* full-screen transparent overlay */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }
        h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }
        p {
            font-size: 18px;
            margin-bottom: 30px;
        }
        button {
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            margin: 10px;
            cursor: pointer;
        }
        .user-btn {
            background-color: #f5a623;
            color: white;
        }
        .admin-btn {
            background-color: #4a90e2;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Happy customers are your best marketers.</h1>
        <p><b>Voyago</b> helps you acquire, convert, retain, and understand customers through user-generated content.</p>
        <form method="POST" action="">
            <button type="submit" name="user" class="user-btn">Go User</button>
            <button type="submit" name="admin" class="admin-btn">Go Admin</button>
        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['user'])) {
            header("Location: login.php");
            exit();
        } elseif (isset($_POST['admin'])) {
            header("Location: adminlogin.php");
            exit();
        }
    }
    ?>
</body>
</html>
