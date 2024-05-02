<?php
session_start();
// Include the database connection file
include_once "db_connection.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page if not logged in
    header("Location: ../Lib/index.php");
    exit;
}

// Check if a comment ID is provided for deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    // Prepare and execute the delete statement
    $stmt = $pdo->prepare("DELETE FROM restaurant_comments WHERE id = ?");
    $stmt->execute([$delete_id]);
    // Redirect to the same page after deletion
    header("Location: comment.php");
    exit;
}

// Retrieve comments from the database
$stmt = $pdo->query("SELECT * FROM restaurant_comments");
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Comments - Food Hunter</title>

    <link rel="stylesheet" type="text/css" href="css/vendor.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost&family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <script type="module"
        src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule
        src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- script ================================================== -->
    <script src="js/modernizr.js"></script>

    <style>
        /* Your CSS styles for the comments page */
        body {
    font-family: Arial, sans-serif;
    background-color: #9EB7E9; /* Change this color to your desired background color */
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }

        .table {
            width: 100%;
            background-color: #fff;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        .table th {
            background-color: #f8f9fa;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .table tbody tr:hover {
            background-color: #f0f0f0;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example2" tabindex="0">

    <section id="comments" class="my-5">
    <div class="container">
    <button class="btn btn-primary mb-3" onclick="window.location.href = 'admin.php'">Go Back</button>
            <h1 class="text-center mb-4">Comments</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Restaurant ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Comment</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comments as $key => $comment): ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo $comment['restaurant_id']; ?></td>
                            <td><?php echo $comment['name']; ?></td>
                            <td><?php echo $comment['email']; ?></td>
                            <td><?php echo $comment['comment']; ?></td>
                            <td><?php echo $comment['created_at']; ?></td>
                            <td>
                                <button class="btn btn-danger delete-comment" data-comment-id="<?php echo $comment['id']; ?>">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <script>
        // Get all delete buttons
        const deleteButtons = document.querySelectorAll('.delete-comment');

        // Add event listener to each delete button
        deleteButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Get the comment ID from the data attribute
                const commentId = button.getAttribute('data-comment-id');
                // Ask for confirmation before deletion
                const isConfirmed = confirm('Are you sure you want to delete this comment?');
                // If confirmed, redirect to delete page with comment ID
                if (isConfirmed) {
                    window.location.href = `comment.php?delete_id=${commentId}`;
                }
            });
        });
    </script>

    

</body>

</html>

