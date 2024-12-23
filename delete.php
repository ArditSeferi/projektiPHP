<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
                $host="localhost";
                $username="root";
                $password="";
                $dbname="crud3";
                $table="tbl1";
                  if(isset($_GET['ID'])){
                    $ID=$_GET['ID'];}

try{
              
                $dsn="mysql:host=$host; dbname=$dbname";
                $conn=new PDO($dsn,$username,$password);

                $sql="DELETE FROM $table WHERE ID=:id";
                $stmt=$conn->prepare($sql);
                $stmt->execute([':id'=>$ID]);
                header("Location:tab.php?accept");
                exit;
                }
              
       
      catch(PDOException $a){
                    echo "ERROR: ".$a->getMessage();
                }
            
    ?>
</body>
</html>