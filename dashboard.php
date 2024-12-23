<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regjistrimi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            width: 100%;
            max-width: 500px;
            background-color: #ffffff;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        form h2 {
            margin-bottom: 20px;
            color: #003366;
            font-size: 24px;
        }

        input, select {
            display: block;
            width: calc(100% - 20px);
            height: 40px;
            margin: 10px auto;
            padding: 0 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input:focus, select:focus {
            border-color: #003366;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 51, 102, 0.5);
        }

        .btn {
            display: block;
            width: calc(100% - 20px);
            height: 45px;
            margin: 20px auto;
            border: none;
            border-radius: 8px;
            background-color: #003366;
            color: white;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #001f4d;
        }

        .link-btn {
            text-align: center;
            margin-top: 15px;
        }

        .link-btn a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #f0f8ff;
            color: #003366;
            border: 1px solid #003366;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .link-btn a:hover {
            background-color: #003366;
            color: white;
        }

        .success-message {
            color: #28a745;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }

        .error-message {
            color: #dc3545;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <h2>Formulari i Regjistrimit</h2>
        <input type="text" name="emri" placeholder="Shkruani emrin tuaj" required>
        <input type="text" name="mbiemri" placeholder="Shkruani mbiemrin tuaj" required>
        <input type="number" name="nrpersonal" placeholder="Shkruani numrin personal tuaj" required>
        <input type="number" name="shuma" placeholder="Shkruani shumën tuaj" required>
        <select name="statusi" required>
            <option value="" disabled selected>Zgjidhni statusin</option>
            <option value="I paguar">I paguar</option>
            <option value="I papaguar">I papaguar</option>
        </select>
        <input type="date" name="data" required>
        <input type="submit" class="btn" name="regjistrohu" value="Regjistrohu"> 
        <div class="link-btn">
            <a href="tab.php">Shiko tabelën</a>
        </div>
    </form>

    <?php 
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "crud3";
        $table = "tbl1";

        if (isset($_POST['regjistrohu'])) {
            $emri = $_POST['emri'];
            $mbiemri = $_POST['mbiemri'];
            $nrpersonal = $_POST['nrpersonal'];
            $shuma = $_POST['shuma'];
            $statusi = $_POST['statusi'];
            $data = $_POST['data'];

            if (empty($emri) || empty($mbiemri) || empty($statusi) || empty($nrpersonal) || empty($shuma) || empty($data)) {
                echo "<p class='error-message'>Ju lutem plotësoni të gjitha fushat!</p>";
            } else {
                try {
                    $dsn = "mysql:host=$host; dbname=$dbname";
                    $conn = new PDO($dsn, $username, $password);
                    $sql = "INSERT INTO $table (Emri, Mbiemri, Nrpersonal, Shuma, Status, Data)
                            VALUES (:emri, :mbiemri, :nrpersonal, :shuma, :statusi, :data)";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([
                        ':emri' => $emri,
                        ':mbiemri' => $mbiemri,
                        ':nrpersonal' => $nrpersonal,
                        ':shuma' => $shuma,
                        ':statusi' => $statusi,
                        ':data' => $data
                    ]);
                    echo "<p class='success-message'>Të dhënat u shtuan me sukses!</p>";
                    header("Location: tab.php");
                    exit;
                } catch (PDOException $a) {
                    echo "<p class='error-message'>Gabim: " . $a->getMessage() . "</p>";
                }
            }
        }
    ?>
</body>
</html>
