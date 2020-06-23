<!DOCTYPE html>
<html>
<body>

<h1>UPDATE DATA TO DATABASE</h1>

<?php
ini_set('display_errors', 1);
echo "Update database!";
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

//$sql = 'UPDATE student '
//                . 'SET name = :name, '
//                . 'WHERE ID = :id';
// 
//      $stmt = $pdo->prepare($sql);
//      //bind values to the statement
//        $stmt->bindValue(':name', 'hoan');
//        $stmt->bindValue(':id', 'cus01');
        // update data in the database
//        $stmt->execute();

        // return the number of row affected
        //return $stmt->rowCount();
$sql = "UPDATE student SET customername = 'hoan' WHERE customerid = 'cus01'";
      $stmt = $pdo->prepare($sql);
if($stmt->execute() == TRUE){
    echo "Record updated successfully.";
} else {
    echo "Error updating record. ";
}
    
?>
</body>
</html>
