<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Management</title>
    <link rel="stylesheet" href="style.css?v=<?= time() ?>">
</head>

<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Miniver&family=Poppins:wght@400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #F7E9CC, #F4DADF, #DFAAB2, #F8C7CA);
            background-size: 400% 400%;
            animation: gradientBG 20s ease infinite;
            min-height: 100vh;
            padding: 20px;
            color: #8B5A3C;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 25px;
            box-shadow:
                0 20px 40px rgba(223, 170, 178, 0.15),
                0 10px 25px rgba(223, 170, 178, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.8);
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            border: 2px solid rgba(244, 218, 223, 0.5);
            position: relative;
            overflow: hidden;
        }

        .container::before {
            content: "";
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #F7E9CC, #F4DADF, #DFAAB2, #F8C7CA);
            border-radius: 25px;
            z-index: -1;
            animation: borderGlow 3s ease-in-out infinite alternate;
        }

        @keyframes borderGlow {
            0% {
                opacity: 0.5;
            }

            100% {
                opacity: 1;
            }
        }

        h1 {
            font-family: 'Miniver', cursive;
            color: #8B5A3C;
            font-size: 48px;
            text-align: center;
            margin-bottom: 40px;
            text-shadow: 0 2px 4px rgba(223, 170, 178, 0.2);
        }

        .add-user-btn {
            background: linear-gradient(135deg, #DFAAB2, #F8C7CA);
            color: #8B5A3C;
            padding: 12px 25px;
            border: none;
            border-radius: 15px;
            font-size: 16px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 6px 15px rgba(223, 170, 178, 0.3);
        }

        .add-user-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(223, 170, 178, 0.4);
            background: linear-gradient(135deg, #F8C7CA, #DFAAB2);
        }

        .add-user-btn::after {
            content: " ✨";
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
            border-radius: 20px;
            background: rgba(247, 233, 204, 0.2);
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(223, 170, 178, 0.1);
            background: white;
        }

        thead {
            background: linear-gradient(135deg, #F7E9CC, #F4DADF);
        }

        th {
            padding: 18px 20px;
            text-align: left;
            color: #8B5A3C;
            font-weight: 600;
            font-size: 16px;
            border-bottom: 2px solid rgba(223, 170, 178, 0.3);
            position: relative;
        }

        th:first-child::before {
            content: "📊 ";
        }

        th:nth-child(2)::before {
            content: "👤 ";
        }

        th:nth-child(3)::before {
            content: "📝 ";
        }

        th:nth-child(4)::before {
            content: "📧 ";
        }

        th:last-child::before {
            content: "⚙️ ";
        }

        tbody tr {
            transition: all 0.3s ease;
        }

        tbody tr:nth-child(even) {
            background: rgba(247, 233, 204, 0.3);
        }

        tbody tr:nth-child(odd) {
            background: rgba(244, 218, 223, 0.2);
        }

        tbody tr:hover {
            background: rgba(223, 170, 178, 0.4);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(223, 170, 178, 0.2);
        }

        td {
            padding: 16px 20px;
            color: #8B5A3C;
            border-bottom: 1px solid rgba(244, 218, 223, 0.4);
            font-weight: 400;
        }

        .user-number {
            font-weight: 600;
            color: #A67B6A;
            text-align: center;
        }

        .username {
            font-weight: 600;
            color: #8B5A3C;
        }

        .email {
            color: #A67B6A;
            font-style: italic;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .actions a {
            background: linear-gradient(135deg, #DFAAB2, #F8C7CA);
            color: #8B5A3C;
            padding: 8px 16px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(223, 170, 178, 0.3);
            min-width: 70px;
            text-align: center;
        }

        .actions a:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(223, 170, 178, 0.4);
            background: linear-gradient(135deg, #F8C7CA, #DFAAB2);
        }

        .delete-btn {
            background: linear-gradient(135deg, #F8C7CA, #DFAAB2) !important;
        }

        .delete-btn:hover {
            background: linear-gradient(135deg, #DFAAB2, #F4DADF) !important;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: linear-gradient(135deg, rgba(247, 233, 204, 0.8), rgba(244, 218, 223, 0.6));
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(223, 170, 178, 0.2);
            border: 1px solid rgba(223, 170, 178, 0.3);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(223, 170, 178, 0.3);
        }

        .stat-number {
            font-size: 32px;
            font-weight: 700;
            color: #8B5A3C;
            font-family: 'Miniver', cursive;
        }

        .stat-label {
            font-size: 14px;
            color: #A67B6A;
            font-weight: 500;
            margin-top: 5px;
        }

        .search-container {
            margin-bottom: 25px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            align-items: center;
        }

        .search-input {
            flex: 1;
            min-width: 250px;
            padding: 12px 20px;
            border: 2px solid rgba(244, 218, 223, 0.8);
            border-radius: 15px;
            font-size: 15px;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, rgba(247, 233, 204, 0.3), rgba(244, 218, 223, 0.3));
            color: #8B5A3C;
            transition: all 0.3s ease;
            outline: none;
        }

        .search-input:focus {
            border-color: #DFAAB2;
            box-shadow: 0 0 0 4px rgba(223, 170, 178, 0.2);
            background: linear-gradient(135deg, rgba(247, 233, 204, 0.5), rgba(244, 218, 223, 0.5));
        }

        .search-input::placeholder {
            color: #B8A194;
        }

        .filter-select {
            padding: 12px 15px;
            border: 2px solid rgba(244, 218, 223, 0.8);
            border-radius: 15px;
            font-size: 15px;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, rgba(247, 233, 204, 0.3), rgba(244, 218, 223, 0.3));
            color: #8B5A3C;
            cursor: pointer;
            outline: none;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .pagination a,
        .pagination span {
            padding: 10px 15px;
            background: linear-gradient(135deg, #F7E9CC, #F4DADF);
            color: #8B5A3C;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(223, 170, 178, 0.2);
        }

        .pagination a:hover {
            background: linear-gradient(135deg, #DFAAB2, #F8C7CA);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(223, 170, 178, 0.3);
        }

        .pagination .current {
            background: linear-gradient(135deg, #DFAAB2, #F8C7CA);
            font-weight: 600;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #A67B6A;
        }

        .empty-state h3 {
            font-family: 'Miniver', cursive;
            font-size: 28px;
            margin-bottom: 15px;
            color: #8B5A3C;
        }

        .empty-state h3::after {
            content: " 📭";
        }

        .empty-state p::after {
            content: " 🌸";
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .container {
                padding: 30px 20px;
            }

            h1 {
                font-size: 36px;
            }

            .stats-container {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px 15px;
                margin: 10px;
            }

            h1 {
                font-size: 28px;
            }

            .admin-header {
                flex-direction: column;
                text-align: center;
            }

            .table-container {
                padding: 15px;
            }

            table {
                font-size: 13px;
            }

            th,
            td {
                padding: 12px 8px;
            }

            .actions {
                flex-direction: column;
                gap: 5px;
            }

            .actions a {
                font-size: 12px;
                padding: 6px 12px;
            }

            .search-container {
                flex-direction: column;
                align-items: stretch;
            }

            .search-input {
                min-width: auto;
            }
        }

        @media (max-width: 480px) {
            .stats-container {
                grid-template-columns: 1fr;
            }

            .stat-number {
                font-size: 24px;
            }

            th::before {
                display: none;
            }

            .pagination {
                gap: 5px;
            }

            .pagination a,
            .pagination span {
                padding: 8px 12px;
                font-size: 14px;
            }
        }

        /* Custom scrollbar for table */
        .table-container::-webkit-scrollbar {
            height: 8px;
        }

        .table-container::-webkit-scrollbar-track {
            background: rgba(247, 233, 204, 0.5);
            border-radius: 10px;
        }

        .table-container::-webkit-scrollbar-thumb {
            background: linear-gradient(90deg, #DFAAB2, #F8C7CA);
            border-radius: 10px;
        }

        .table-container::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(90deg, #F8C7CA, #F4DADF);
        }

        /* Loading animation */
        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .loading {
            animation: pulse 2s infinite;
        }

        /* Success/Error messages for admin actions */
        .admin-message {
            padding: 15px 20px;
            border-radius: 15px;
            margin-bottom: 25px;
            font-weight: 500;
            text-align: center;
        }

        .admin-success {
            background: linear-gradient(135deg, rgba(247, 233, 204, 0.8), rgba(244, 218, 223, 0.6));
            color: #6B4A2A;
            border: 2px solid rgba(166, 123, 106, 0.5);
        }

        .admin-success::after {
            content: " 🎉";
        }

        .admin-error {
            background: linear-gradient(135deg, rgba(248, 199, 202, 0.6), rgba(244, 218, 223, 0.4));
            color: #8B5A3C;
            border: 2px solid rgba(223, 170, 178, 0.5);
        }

        .admin-error::after {
            content: " 😊";
        }

        /* Tombol Cetak Laporan */
        .btn-cetak {
            display: inline-block;
            padding: 18px 35px;
            background: linear-gradient(135deg, #DFAAB2, #F8C7CA, #F4DADF);
            color: #8B5A3C;
            text-decoration: none;
            border-radius: 20px;
            font-weight: 600;
            font-size: 18px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(223, 170, 178, 0.3);
            border: 2px solid rgba(244, 218, 223, 0.5);
            position: relative;
            overflow: hidden;
        }

        .btn-cetak::before {
            content: "🖨️";
            margin-right: 10px;
            font-size: 16px;
        }

        .btn-cetak:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(223, 170, 178, 0.4);
            background: linear-gradient(135deg, #F8C7CA, #DFAAB2, #F4DADF);
            border-color: #DFAAB2;
        }

        .btn-cetak:active {
            transform: translateY(-1px);
        }

        .btn-cetak::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transform: rotate(45deg);
            transition: all 0.5s;
            opacity: 0;
        }

        .btn-cetak:hover::after {
            animation: shimmer 0.6s ease-in-out;
        }

        @keyframes shimmer {
            0% {
                left: -100%;
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                left: 100%;
                opacity: 0;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .btn-cetak {
                padding: 15px 25px;
                font-size: 16px;
            }
        }

        @media (max-width: 480px) {
            .btn-cetak {
                padding: 12px 20px;
                font-size: 14px;
            }
        }
    </style>
    <div class="container">
        <h1>User Management</h1>
        <table>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <?php
            include_once 'service/config.php';
            $sql = "SELECT * FROM users ORDER BY username";
            $result = $db->query($sql);
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $username = $row['username'];
                $full_name = $row['full_name'];
                $email = $row['email'];
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($username); ?></td>
                    <td><?php echo htmlspecialchars($full_name); ?></td>
                    <td><?php echo htmlspecialchars($email); ?></td>
                    <td class="actions">
                        <a href='user_edit.php?action=edit&id=<?= urlencode($id) ?>' title='Edit User'>Edit</a>
                        <a href='user_delete.php?action=delete&id=<?= urlencode($id) ?>' title='Delete User'>Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <div style="text-align: center; margin: 20px 0;">
            <a class="btn-cetak" target="_blank" href="cetak.php">Print Report</a>
        </div>
    </div>
</body>

</html>