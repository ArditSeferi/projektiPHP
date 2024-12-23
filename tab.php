<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4; /* Soft background color */
        }

        .tbl1 {
            width: 90%;
            max-width: 1000px;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Light shadow */
        }

        .tbl1 th {
            background-color: darkblue;
            color: white;
            padding: 15px;
            font-size: 18px;
            text-transform: uppercase;
        }

        .tbl1 td {
            padding: 12px;
            font-size: 16px;
            text-align: center;
            color: #333;
        }

        .tbl1 tr:nth-child(odd) td {
            background-color: #f7f7f7; /* Light gray for odd rows */
        }

        .tbl1 tr:nth-child(even) td {
            background-color: #ffffff; /* White for even rows */
        }

        .tbl1 tr:hover {
            background-color: #e6f3ff; /* Light blue hover effect */
        }

        a {
            text-decoration: none;
            font-size: 14px;
            padding: 8px 15px;
            border-radius: 4px;
            font-weight: bold;
            transition: background-color 0.3s, color 0.3s;
        }

        a.update-btn {
            background-color: #007bff; /* Blue button for update */
            color: white;
            margin-right: 5px;
        }

        a.update-btn:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        a.delete-btn {
            background-color: #dc3545; /* Red button for delete */
            color: white;
        }

        a.delete-btn:hover {
            background-color: #a71d2a; /* Darker red on hover */
        }

        .button-container {
            display: inline-block;
            margin: 20px 0;
            padding: 10px 20px;
            background-color: #28a745; /* Green for create */
            color: white;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            text-align: center;
        }

        .button-container:hover {
            background-color: #218838; /* Darker green on hover */
        }

        #h1 {
            text-align: center;
            font-size: 20px;
            color: #28a745; /* Green for success message */
        }
    </style>
</head>
<body>
    <?php 
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "crud3";
    $table = "tbl1";
    
    try {
        $dsn = "mysql:host=$host; dbname=$dbname";
        $conn = new PDO($dsn, $username, $password);

        $sql = "SELECT * FROM $table";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();

        if ($data) {
            echo "<table class='tbl1'>
            <tr>
            <th>Emri</th> <th>Mbiemri</th> <th>Numri personal</th> <th>Shuma</th> <th>Statusi</th> <th>Data</th> <th>Actions</th>
            </tr>";

            foreach ($data as $x) {
                echo "
                <tr>
                <td>{$x['Emri']}</td>
                <td>{$x['Mbiemri']}</td>
                <td>{$x['Nrpersonal']}</td>
                <td>{$x['Shuma']}</td>
                <td>{$x['Status']}</td>
                <td>{$x['Data']}</td>
                <td>
                    <a href='update.php?ID={$x['ID']}' class='update-btn'>UPDATE</a>
                    <a href='delete.php?ID={$x['ID']}' class='delete-btn'>DELETE</a>
                </td>
                </tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No records found.</p>";
        }
    } catch (PDOException $a) {
        echo "Error: " . $a->getMessage();
    }
    ?>

    <a class="button-container" href="dashboard.php">Create a user</a>

    <?php 
    if (isset($_GET['accept'])) {
        echo "<h2 id='h1'>Record deleted successfully.</h2>";
        echo "
        <script>
            setTimeout(function() {
                document.getElementById('h1').style.display = 'none';
            }, 5000);
        </script>";
    }

    if (isset($_GET['message'])) {
        echo "<h2 id='h1'>Record updated successfully.</h2>";
        echo "
        <script>
            setTimeout(function() {
                document.getElementById('h1').style.display = 'none';
            }, 5000);
        </script>";
    }
    ?>
</body>
</html>
