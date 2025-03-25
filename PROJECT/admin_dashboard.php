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

// Get counts for each table
$user_count = mysqli_num_rows($users);
$card_count = mysqli_num_rows($cards);
$bill_count = mysqli_num_rows($bills);
$contact_count = mysqli_num_rows($contacts);

// Reset result pointers to use again in tables
mysqli_data_seek($users, 0);
mysqli_data_seek($cards, 0);
mysqli_data_seek($bills, 0);
mysqli_data_seek($contacts, 0);

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
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            background: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .sidebar {
            width: 250px;
            background: linear-gradient(135deg, #6e48aa 0%, #9d50bb 100%);
            color: white;
            height: 100vh;
            padding: 20px;
            position: fixed;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        .sidebar a {
            color: white;
            display: block;
            padding: 12px;
            text-decoration: none;
            border-radius: 5px;
            margin: 5px 0;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .sidebar a:hover {
            background: rgba(255,255,255,0.2);
            transform: translateX(5px);
        }
        .sidebar a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        .content {
            margin-left: 270px;
            padding: 20px;
            width: calc(100% - 270px);
        }
        .table-container {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 30px;
            display: none;
            animation: fadeIn 0.5s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .active {
            display: block !important;
        }
        .bottom-link {
            margin-top: auto;
            background: #4a00e0;
            color: white;
            padding: 12px;
            text-align: center;
            border-radius: 5px;
            font-weight: bold;
            position: absolute;
            bottom: 20px;
            left: 10%;
            width: 80%;
           
        }
        .bottom-link:hover {
            background: #2d00b3;
            transform: translateX(-50%) scale(1.02);
            text-decoration: none;
        }
        .stats-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            flex: 1;
            min-width: 200px;
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            cursor: pointer;
            border-top: 5px solid #6e48aa;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .stat-card h3 {
            color: #6e48aa;
            margin-top: 0;
            font-size: 1.1rem;
        }
        .stat-card .count {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
            margin: 10px 0;
        }
        .stat-card i {
            font-size: 2rem;
            color: #9d50bb;
            margin-bottom: 10px;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 25px;
            border-radius: 15px;
            width: 50%;
            max-width: 600px;
            box-shadow: 0 5px 30px rgba(0,0,0,0.3);
            animation: modalFadeIn 0.3s ease;
        }
        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            transition: all 0.2s ease;
        }
        .close:hover,
        .close:focus {
            color: #333;
            text-decoration: none;
            cursor: pointer;
            transform: scale(1.2);
        }
        #updateFields label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #555;
        }
        #updateFields input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .btn-primary {
            background-color: #6e48aa;
            border: none;
            padding: 10px 20px;
            margin-top: 20px;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #9d50bb;
            transform: translateY(-2px);
        }
        .btn-warning {
            transition: all 0.3s ease;
        }
        .btn-warning:hover {
            transform: translateY(-2px);
        }
        .btn-danger {
            transition: all 0.3s ease;
        }
        .btn-danger:hover {
            transform: translateY(-2px);
        }
        .table th {
            background-color: #6e48aa;
            color: white;
        }
        .table tr:hover {
            background-color: rgba(110, 72, 170, 0.05);
        }
        h1 {
            color: #6e48aa;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #eee;
        }
        h2 {
            color: #6e48aa;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2 class="text-center" style="margin-bottom: 30px;"><i class="fas fa-tachometer-alt"></i> Admin Panel</h2>
        <a onclick="showSection('dashboard')"><i class="fas fa-chart-line"></i> Dashboard</a>
        <a onclick="showSection('users')"><i class="fas fa-users"></i> Users</a>
        <a onclick="showSection('cards')"><i class="fas fa-credit-card"></i> Card Details</a>
        <a onclick="showSection('bills')"><i class="fas fa-file-invoice"></i> Bill Details</a>
        <a onclick="showSection('contacts')"><i class="fas fa-envelope"></i> Contact Details</a>
        <a href="login.php" class="bottom-link"><i class="fas fa-home"></i> Back to Home</a>
    </div>
    
    <div class="content">
        <h1><i class="fas fa-tachometer-alt"></i> Admin Dashboard</h1>
        
        <!-- Dashboard Overview Section -->
        <section id="dashboard" class="table-container active">
            <div class="stats-container">
                <div class="stat-card" onclick="showSection('users')">
                    <i class="fas fa-users"></i>
                    <h3>Total Users</h3>
                    <div class="count"><?php echo $user_count; ?></div>
                    <p>Registered users in the system</p>
                </div>
                <div class="stat-card" onclick="showSection('cards')">
                    <i class="fas fa-credit-card"></i>
                    <h3>Card Transactions</h3>
                    <div class="count"><?php echo $card_count; ?></div>
                    <p>Payment cards registered</p>
                </div>
                <div class="stat-card" onclick="showSection('bills')">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <h3>Total Bills</h3>
                    <div class="count"><?php echo $bill_count; ?></div>
                    <p>Completed transactions</p>
                </div>
                <div class="stat-card" onclick="showSection('contacts')">
                    <i class="fas fa-envelope"></i>
                    <h3>Contact Messages</h3>
                    <div class="count"><?php echo $contact_count; ?></div>
                    <p>Customer inquiries</p>
                </div>
            </div>
            
            <div style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                <h3><i class="fas fa-chart-pie"></i> Quick Stats</h3>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <canvas id="statsChart" height="250"></canvas>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-info">
                            <h4><i class="fas fa-info-circle"></i> System Information</h4>
                            <p>Welcome to the admin dashboard. Here you can manage all aspects of the art gallery system.</p>
                            <hr>
                            <p class="mb-0">Last updated: <?php echo date("F j, Y, g:i a"); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section id="users" class="table-container">
            <h2><i class="fas fa-users"></i> Users Management</h2>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($users)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['mobile']; ?></td>
                            <td>
                                <button class="btn btn-warning" onclick="openUpdateForm('user_register', <?php echo $row['id']; ?>, {username: '<?php echo addslashes($row['username']); ?>', email: '<?php echo addslashes($row['email']); ?>', mobile: '<?php echo addslashes($row['mobile']); ?>'})">
                                    <i class="fas fa-edit"></i> Update
                                </button>
                                <a href="admin_dashboard.php?delete=<?php echo $row['id']; ?>&table=user_register" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
        
        <section id="cards" class="table-container">
            <h2><i class="fas fa-credit-card"></i> Card Details Management</h2>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Card Number</th>
                        <th>Expiry Date</th>
                        <th>Transaction Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($cards)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo str_repeat('*', 12) . substr($row['card_number'], -4); ?></td>
                            <td><?php echo $row['expiry_date']; ?></td>
                            <td><?php echo $row['transaction_date']; ?></td>
                            <td>
                                <button class="btn btn-warning" onclick="openUpdateForm('cards_details', <?php echo $row['id']; ?>, {name: '<?php echo addslashes($row['name']); ?>', email: '<?php echo addslashes($row['email']); ?>', card_number: '<?php echo addslashes($row['card_number']); ?>', expiry_date: '<?php echo addslashes($row['expiry_date']); ?>', transaction_date: '<?php echo addslashes($row['transaction_date']); ?>'})">
                                    <i class="fas fa-edit"></i> Update
                                </button>
                                <a href="admin_dashboard.php?delete=<?php echo $row['id']; ?>&table=cards_details" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this card?')">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
        
        <section id="bills" class="table-container">
            <h2><i class="fas fa-file-invoice-dollar"></i> Bill Details Management</h2>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Painting Title</th>
                        <th>Price</th>
                        <th>Transaction Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($bills)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['painting_title']; ?></td>
                            <td>$<?php echo number_format($row['price'], 2); ?></td>
                            <td><?php echo $row['transaction_date']; ?></td>
                            <td>
                                <button class="btn btn-warning" onclick="openUpdateForm('bill', <?php echo $row['id']; ?>, {name: '<?php echo addslashes($row['name']); ?>', email: '<?php echo addslashes($row['email']); ?>', painting_title: '<?php echo addslashes($row['painting_title']); ?>', price: '<?php echo addslashes($row['price']); ?>', transaction_date: '<?php echo addslashes($row['transaction_date']); ?>'})">
                                    <i class="fas fa-edit"></i> Update
                                </button>
                                <a href="admin_dashboard.php?delete=<?php echo $row['id']; ?>&table=bill" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this bill?')">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>

        <section id="contacts" class="table-container">
            <h2><i class="fas fa-envelope"></i> Contact Details Management</h2>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($contacts)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['subject']; ?></td>
                            <td><?php echo substr($row['message'], 0, 50); ?>...</td>
                            <td>
                                <button class="btn btn-warning" onclick="openUpdateForm('contact', <?php echo $row['id']; ?>, {name: '<?php echo addslashes($row['name']); ?>', email: '<?php echo addslashes($row['email']); ?>', subject: '<?php echo addslashes($row['subject']); ?>', message: '<?php echo addslashes($row['message']); ?>'})">
                                    <i class="fas fa-edit"></i> Update
                                </button>
                                <a href="admin_dashboard.php?delete=<?php echo $row['id']; ?>&table=contact" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this contact?')">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </div>
    
    <!-- Update Form Modal -->
    <div id="updateModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeUpdateForm()">&times;</span>
            <h3><i class="fas fa-edit"></i> Update Record</h3>
            <form id="updateForm" method="POST">
                <input type="hidden" name="id" id="updateId">
                <input type="hidden" name="table" id="updateTable">
                <div id="updateFields"></div>
                <button type="submit" name="update" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function showSection(sectionId) {
            document.querySelectorAll('.table-container').forEach(section => {
                section.classList.remove('active');
            });
            document.getElementById(sectionId).classList.add('active');
            
            // If showing a section other than dashboard, initialize its table
            if (sectionId !== 'dashboard') {
                initializeTable(sectionId);
            }
        }

        function openUpdateForm(table, id, fields) {
            document.getElementById('updateId').value = id;
            document.getElementById('updateTable').value = table;
            const updateFields = document.getElementById('updateFields');
            updateFields.innerHTML = '';
            
            for (const [key, value] of Object.entries(fields)) {
                const div = document.createElement('div');
                div.className = 'form-group';
                
                const label = document.createElement('label');
                label.innerText = `${key.replace('_', ' ').toUpperCase()}:`;
                
                const input = document.createElement('input');
                input.type = 'text';
                input.className = 'form-control';
                input.name = key;
                input.value = value;
                
                div.appendChild(label);
                div.appendChild(input);
                updateFields.appendChild(div);
            }
            
            document.getElementById('updateModal').style.display = 'block';
        }

        function closeUpdateForm() {
            document.getElementById('updateModal').style.display = 'none';
        }

        // Initialize charts when dashboard is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Show dashboard by default
            showSection('dashboard');
            
            // Initialize chart
            const ctx = document.getElementById('statsChart').getContext('2d');
            const statsChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Users', 'Cards', 'Bills', 'Contacts'],
                    datasets: [{
                        label: 'System Statistics',
                        data: [<?php echo $user_count; ?>, <?php echo $card_count; ?>, <?php echo $bill_count; ?>, <?php echo $contact_count; ?>],
                        backgroundColor: [
                            'rgba(110, 72, 170, 0.7)',
                            'rgba(157, 80, 187, 0.7)',
                            'rgba(74, 0, 224, 0.7)',
                            'rgba(45, 0, 179, 0.7)'
                        ],
                        borderColor: [
                            'rgba(110, 72, 170, 1)',
                            'rgba(157, 80, 187, 1)',
                            'rgba(74, 0, 224, 1)',
                            'rgba(45, 0, 179, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('updateModal');
            if (event.target == modal) {
                closeUpdateForm();
            }
        }
    </script>
</body>
</html>