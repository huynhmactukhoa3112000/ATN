<!DOCTYPE html>
<html>
<body>

<h1>DELETE DATA TO DATABASE</h1>

<?php
ini_set('display_errors', 1);
echo "Delete database!";
?>

<?php


if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
}  else {
     
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
        "host=ec2-34-200-15-192.compute-1.amazonaws.com;port=5432;user=eserwscvrdgahc;password=4acf4bf1a57d5db44a787ca00629cb4e4719a2ea120c22bf9cfd84e368e89853;dbname=dpqj69sdonv1p",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  

$sql = "DELETE FROM customer WHERE customerid= 'cus01'";
$stmt = $pdo->prepare($sql);
if($stmt->execute() == TRUE){
    echo "Record deleted successfully.";
} else {
    echo "Error deleting record: ";
}

?>
</body>
</html>
