<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Korean Beauty Nepal</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        /* Sidebar */
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background: #f4f6f8;
        }

        .sidebar {
            width: 220px;
            background: #e91e63;
            color: #fff;
            position: fixed;
            top: 0;
            bottom: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: 700;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 12px 15px;
            margin-bottom: 8px;
            border-radius: 5px;
            font-weight: 500;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #c2185b;
        }

        .sidebar a.logout {
            margin-top: auto;
            background: #b71c1c;
            text-align: center;
        }

        /* Main content */
        .main {
            margin-left: 240px;
            padding: 30px 40px;
            min-height: 100vh;
        }

        /* Dashboard cards */
        .dashboard-cards {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            flex: 1 1 200px;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            text-align: center;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .card span {
            font-size: 28px;
            display: block;
            margin-bottom: 8px;
        }

        .card strong {
            font-size: 24px;
            display: block;
            margin-top: 5px;
            color: #e91e63;
        }

        /* Tables */
        .table-container {
            overflow-x: auto;
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Roboto', sans-serif;
        }

        .admin-table thead tr {
            background: #e91e63;
            color: #fff;
            text-transform: uppercase;
        }

        .admin-table th,
        .admin-table td {
            padding: 12px 15px;
            text-align: left;
        }

        .admin-table tbody tr.even {
            background: #f9f9f9;
        }

        .admin-table tbody tr.odd {
            background: #fff;
        }

        .admin-table tbody tr:hover {
            background: #ffe6f0;
            transition: 0.3s;
        }

        .btn-edit,
        .btn-delete {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: 500;
        }

        .btn-edit {
            color: #fff;
            background: #2196f3;
            margin-right: 5px;
        }

        .btn-edit:hover {
            background: #1976d2;
        }

        .btn-delete {
            color: #fff;
            background: #f44336;
        }

        .btn-delete:hover {
            background: #d32f2f;
        }

        .no-data {
            text-align: center;
            color: #777;
            padding: 20px;
        }

        @media(max-width:768px) {
            .main {
                margin-left: 0;
                padding: 20px;
            }

            .dashboard-cards {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                flex-direction: row;
                overflow-x: auto;
            }

            .sidebar a {
                flex: 1;
                text-align: center;
                margin-bottom: 0;
            }

            .admin-table th,
            .admin-table td {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="products.php">Manage Products</a>
        <a href="categories.php">Manage Categories</a>
        <a href="manorder.php">Manage Orders</a>
        <a href="manusers.php">Manage Users</a>
        <a href="reports.php">Sales Reports</a>
        <a href="profile.php">Profile</a>
        <a href="../logout.php" class="logout">Logout</a>
    </div>