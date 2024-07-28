<?php
// Include database connection
include_once "db_connection.php";

// Delete user if delete button is clicked
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$delete_id]);
}

// Update user if edit form is submitted
if (isset($_POST['edit_id'])) {
    $edit_id = $_POST['edit_id'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $stmt = $pdo->prepare("UPDATE restaurants SET name = ?, location = ?, description = ? WHERE id = ?");
    $stmt->execute([$name, $location, $description, $edit_id]);
}

// Fetch all users from the database
$stmt = $pdo->query("SELECT * FROM restaurants");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Users Info - Food Hunter</title>

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
        /* Custom CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa; /* Set the background color */
            padding-top: 50px;
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

<body>

    <div class="container mt-5">
        <div class="title-box">
            <button class="btn btn-primary mb-3" onclick="window.location.href = 'admin.php'">Go Back</button>
            <h1 class="text-center mb-4">Restaurants Info</h1>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $key => $user) : ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['location'] ?></td>
                        <td><?= $user['description'] ?></td>
                        <td>
                            <button class="btn btn-danger" onclick="confirmDelete(<?= $user['id'] ?>)">Delete</button>
                            <button class="btn btn-primary" onclick="openEditModal(<?= $user['id'] ?>, '<?= $user['name'] ?>', '<?= $user['location'] ?>', '<?= $user['description'] ?>')">Edit</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Restaurant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" action="">
                        <input type="hidden" name="edit_id" id="edit_id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to handle delete confirmation and edit modal -->
    <script>
        function confirmDelete(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                window.location.href = `user.php?delete_id=${userId}`;
            }
        }

        function openEditModal(id, name, location, description) {
            document.getElementById('edit_id').value = id;
            document.getElementById('name').value = name;
            document.getElementById('location').value = location;
            document.getElementById('description').value = description;
            var editModal = new bootstrap.Modal(document.getElementById('editModal'));
            editModal.show();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>

</body>

</html>
