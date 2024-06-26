<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

// Database connection details
$host = 'localhost';
$dbname = 'foodhunter';
$username = 'root'; // Your database username
$password = ''; // Your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch user's comments
    $stmt = $pdo->prepare("SELECT id, comment, created_at FROM restaurant_comments WHERE email = ?");
    $stmt->execute([$_SESSION['email']]);
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Database connection error: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Comment History - Food Hunter</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            color: black;
        }
        .container {
            margin-top: 50px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: black;
        }
        h2 {
            margin-bottom: 30px;
            color: black;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            color: black;
        }
        th, td {
            padding: 15px;
            text-align: left;
            color: black;
        }
        th {
            background-color: #f2f2f2;
            color: black;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
            color: black;
        }
        .btn {
            margin: 5px;
            color: black;
        }
        .btn-primary {
            background-color: #4CAF50;
            border: none;
            color: white;
        }
        .btn-danger {
            background-color: #f44336;
            border: none;
            color: white;
        }
        .btn-secondary {
            background-color: #555;
            border: none;
            color: white;
        }
        .btn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Your Comment History</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Comment</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comments as $comment): ?>
                <tr>
                    <td><?php echo htmlspecialchars($comment['comment']); ?></td>
                    <td><?php echo htmlspecialchars($comment['created_at']); ?></td>
                    <td>
                        <a href="edit_comment.php?id=<?php echo $comment['id']; ?>" class="btn btn-primary">Edit</a>
                        <a href="delete_comment.php?id=<?php echo $comment['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this comment?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button onclick="window.location.href='index.php'" class="btn btn-secondary">Back to Home</button>
    </div>
</body>
</html>
