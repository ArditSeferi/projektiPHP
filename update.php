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
    height: 100vh;
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f4f4f4; /* Soft background color */
}

form {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for form */
    width: 100%;
    max-width: 500px; /* Restrict maximum width for better responsiveness */
}

form h2 {
    text-align: center;
    color: darkblue;
    margin-bottom: 20px;
}

form input[type="text"],
form input[type="number"],
form input[type="date"],
form input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc; /* Light border */
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
}

form input[type="submit"] {
    background-color: darkblue;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form input[type="submit"]:hover {
    background-color: #003366; /* Darker blue for hover effect */
}

form a {
    display: block;
    text-align: center;
    margin-top: 10px;
    color: darkblue;
    text-decoration: none;
    font-size: 14px;
    transition: color 0.3s ease;
}

form a:hover {
    color: #003366;
}
</style> 
</head>
<body>
<?php
    // Database connection
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "crud3";
    $table = "tbl1";

    // Fetch record based on ID if it's provided in the URL
    if (isset($_GET['ID'])) {
        $id = $_GET['ID'];
        $dsn = "mysql:host=$host; dbname=$dbname";
        try {
            $conn = new PDO($dsn, $username, $password);
            $sql = "SELECT * FROM $table WHERE ID = :id";
            $stmt = $conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            $rez = $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
?>

<!-- HTML Form -->
<form action="" method="post">
    <h2>Update</h2>
    <input type="text" name="emri" placeholder="Shkruani emrin tuaj" required value="<?php echo htmlspecialchars($rez['Emri'] ?? ''); ?>">
    <input type="text" name="mbiemri" placeholder="Shkruani mbiemrin tuaj" required value="<?php echo htmlspecialchars($rez['Mbiemri'] ?? ''); ?>">
    <input type="number" name="nrpersonal" placeholder="Shkruani numrin personal tuaj" required value="<?php echo htmlspecialchars($rez['Nrpersonal'] ?? ''); ?>">
    <input type="number" name="shuma" placeholder="Shkruani shumen tuaj" required value="<?php echo htmlspecialchars($rez['Shuma'] ?? ''); ?>">
    <input type="text" name="statusi" placeholder="Shkruani statusin tuaj" required value="<?php echo htmlspecialchars($rez['Statusi'] ?? ''); ?>">
    <input type="date" name="data" placeholder="Shkruani daten e pageses tuaj" required value="<?php echo htmlspecialchars($rez['Data'] ?? ''); ?>">
    <input type="submit" class="btn" name="update" value="Update Record">
    <a href="tab.php" style="text-decoration:none; text-align:center;">Go back to dashboard</a>
</form>

<?php
    // Process form submission for updating record
    if (isset($_POST['update'])) {
        // Get form data
        $emri = $_POST['emri'];
        $mbiemri = $_POST['mbiemri'];
        $nrpersonal = $_POST['nrpersonal'];
        $shuma = $_POST['shuma'];
        $statusi = $_POST['statusi'];
        $data = $_POST['data'];

        try {
            // Database connection
            $dsn = "mysql:host=$host; dbname=$dbname";
            $conn = new PDO($dsn, $username, $password);

            // Update SQL query
            $sql = "UPDATE $table SET
                    Emri = :emri,
                    Mbiemri = :mbiemri,
                    Nrpersonal = :nrpersonal,
                    Shuma = :shuma,
                    Status = :statusi,
                    Data = :data
                    WHERE ID = :id";

            // Prepare and execute the query
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ":emri" => $emri,
                ":mbiemri" => $mbiemri,
                ":nrpersonal" => $nrpersonal,
                ":shuma" => $shuma,
                ":statusi" => $statusi,
                ":data" => $data,
                ":id" => $id
            ]);

            // Redirect after update with a success message
            header("Location: tab.php?message=Record updated successfully");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
?>


</body>
</html>