<?php
$servername = "localhost"; // Change if your database is hosted elsewhere
$username = "root"; // Default for XAMPP
$password = ""; // Default for XAMPP (leave blank)
$database = "art_gallery"; // Change this to match your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from tables
$users = mysqli_query($conn, "SELECT * FROM user_register");
$cards = mysqli_query($conn, "SELECT * FROM cards_details");
$bills = mysqli_query($conn, "SELECT * FROM bill");
$contacts = mysqli_query($conn, "SELECT * FROM contact");
 // Fetch contact details

// Delete record
if (isset($_GET['delete']) && isset($_GET['table'])) {
    $id = $_GET['delete'];
    $table = $_GET['table'];
    mysqli_query($conn, "DELETE FROM $table WHERE id='$id'");
    header("Location: admin_dashboard.php");
}

// Update record
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $table = $_POST['table'];
    $fields = [];
    foreach ($_POST as $key => $value) {
        if ($key !== 'id' && $key !== 'table' && $key !== 'update') {
            $fields[] = "$key='$value'";
        }
    }
    $query = "UPDATE $table SET " . implode(', ', $fields) . " WHERE id='$id'";
    mysqli_query($conn, $query);
    header("Location: admin_dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Add your custom styles here -->
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            background: #f8f9fa;
        }
        .sidebar {
            width: 250px;
            background:rgb(240, 11, 160);
            color: white;
            height: 100vh;
            padding: 20px;
            position: fixed;
        }
        .sidebar a {
            color: white;
            display: block;
            padding: 12px;
            text-decoration: none;
            border-radius: 5px;
            margin: 5px 0;
            cursor: pointer;
        }
        .sidebar a:hover {
            background: #495057;
        }
        .content {
            margin-left: 270px;
            padding: 20px;
            width: 100%;
        }
        .table-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            display: none;
        }
        .active {
            display: block !important;
        }
        .bottom-link {
            margin-top: auto;
            background: #007bff;
            color: white;
            padding: 12px;
            text-align: center;
            border-radius: 5px;
            font-weight: bold;
            position: absolute;
            bottom: 20px;
            left: 50%;
            width: 80%;
            transform: translateX(-50%);
        }
        .bottom-link:hover {
            background: #0056b3;
        }
        @media (max-width: 768px) {
            .bottom-link {
                width: 90%;
                font-size: 14px;
            }
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            border-radius: 10px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2 class="text-center">Admin Panel</h2>
        <a onclick="showSection('users')"><i class="fas fa-users"></i> Users</a>
        <a onclick="showSection('cards')"><i class="fas fa-credit-card"></i> Card Details</a>
        <a onclick="showSection('bills')"><i class="fas fa-file-invoice"></i> Bill Details</a>
        <a onclick="showSection('contacts')"><i class="fas fa-envelope"></i> Contact Details</a>
        <a onclick="showSection('paintings')"><i class="fas fa-palette"></i> Paintings Overview</a>
        <!-- New link for contact details -->
        <a href="login.php" class="bottom-link">Home</a>
    </div>
    
    <div class="content">
        <h1 class="mb-4">Admin Dashboard</h1>
        
        <section id="users" class="table-container">
            <h2>Users</h2>
            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Actions</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($users)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['mobile']; ?></td>
                        <td>
                            <button class="btn btn-warning" onclick="openUpdateForm('user_register', <?php echo $row['id']; ?>, {username: '<?php echo $row['username']; ?>', email: '<?php echo $row['email']; ?>', mobile: '<?php echo $row['mobile']; ?>'})">Update</button>
                            <a href="admin_dashboard.php?delete=<?php echo $row['id']; ?>&table=user_register" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </section>
        
        <section id="cards" class="table-container">
            <h2>Card Details</h2>
            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Card Number</th>
                    <th>Expiry Date</th>
                    <th>Transaction Date</th>
                    <th>Actions</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($cards)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo str_repeat('*', 12) . substr($row['card_number'], -4); ?></td>
                        <td><?php echo $row['expiry_date']; ?></td>
                        <td><?php echo $row['transaction_date']; ?></td>
                        <td>
                            <button class="btn btn-warning" onclick="openUpdateForm('cards_details', <?php echo $row['id']; ?>, {name: '<?php echo $row['name']; ?>', email: '<?php echo $row['email']; ?>', card_number: '<?php echo $row['card_number']; ?>', expiry_date: '<?php echo $row['expiry_date']; ?>', transaction_date: '<?php echo $row['transaction_date']; ?>'})">Update</button>
                            <a href="admin_dashboard.php?delete=<?php echo $row['id']; ?>&table=cards_details" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </section>
        
        <section id="bills" class="table-container">
            <h2>Bill Details</h2>
            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Painting Title</th>
                    <th>Price</th>
                    <th>Transaction Date</th>
                    <th>Actions</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($bills)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['painting_title']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['transaction_date']; ?></td>
                        <td>
                            <button class="btn btn-warning" onclick="openUpdateForm('bill', <?php echo $row['id']; ?>, {name: '<?php echo $row['name']; ?>', email: '<?php echo $row['email']; ?>', painting_title: '<?php echo $row['painting_title']; ?>', price: '<?php echo $row['price']; ?>', transaction_date: '<?php echo $row['transaction_date']; ?>'})">Update</button>
                            <a href="admin_dashboard.php?delete=<?php echo $row['id']; ?>&table=bill" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </section>

        <!-- Contact Details Section -->
        <section id="contacts" class="table-container">
            <h2>Contact Details</h2>
            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Actions</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($contacts)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['subject']; ?></td>
                        <td><?php echo $row['message']; ?></td>
                        <td>
                            <button class="btn btn-warning" onclick="openUpdateForm('contact', <?php echo $row['id']; ?>, {name: '<?php echo $row['name']; ?>', email: '<?php echo $row['email']; ?>', subject: '<?php echo $row['subject']; ?>', message: '<?php echo $row['message']; ?>'})">Update</button>
                            <a href="admin_dashboard.php?delete=<?php echo $row['id']; ?>&table=contact" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </section>
    </div>
    <!-- Update Form Modal -->
    <div id="updateModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeUpdateForm()">&times;</span>
            <form id="updateForm" method="POST">
                <input type="hidden" name="id" id="updateId">
                <input type="hidden" name="table" id="updateTable">
                <div id="updateFields"></div>
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

    <script>
        function showSection(sectionId) {
            document.querySelectorAll('.table-container').forEach(section => {
                section.classList.remove('active');
            });
            document.getElementById(sectionId).classList.add('active');
        }

        function openUpdateForm(table, id, fields) {
            document.getElementById('updateId').value = id;
            document.getElementById('updateTable').value = table;
            const updateFields = document.getElementById('updateFields');
            updateFields.innerHTML = '';
            for (const [key, value] of Object.entries(fields)) {
                const label = document.createElement('label');
                label.innerText = `${key}:`;
                const input = document.createElement('input');
                input.type = 'text';
                input.name = key;
                input.value = value;
                updateFields.appendChild(label);
                updateFields.appendChild(input);
            }
            document.getElementById('updateModal').style.display = 'block';
        }

        function closeUpdateForm() {
            document.getElementById('updateModal').style.display = 'none';
        }
    </script>
</body>
</html>