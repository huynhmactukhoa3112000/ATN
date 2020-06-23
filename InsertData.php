<!DOCTYPE html>
<html>
    <head>
<title>Insert data to PostgreSQL with php - creating a simple web application</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
li {
list-style: none;
}
</style>
</head>
<body>
<h1>INSERT DATA TO DATABASE</h1>
<h2>Enter data into customer table</h2>
<ul>
    <form name="InsertData" action="InsertData.php" method="POST" >
<li>Customer ID:</li><li><input type="text" name="customerid" /></li>
<li>Customer Name:</li><li><input type="text" name="customername" /></li>
<li>Customer Phone:</li><li><input type="text" name="customerphone" /></li>
<li>Address:</li><li><input type="text" name="address" /></li>
<li><input type="submit" /></li>
</form>
</ul>

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

if($pdo === false){
     echo "ERROR: Could not connect Database";
}

//Khởi tạo Prepared Statement
//$stmt = $pdo->prepare('INSERT INTO student (customerid, customername, customerphone, address) values (:id, :name, :phone, :address)');

//$stmt->bindParam(':id','cus01');
//$stmt->bindParam(':name','hoan');
//$stmt->bindParam(':email', '23454675784');
//$stmt->bindParam(':class', '24 le loi');
//$stmt->execute();
//$sql = "INSERT INTO customer(customerid, customername, customerphone, address) VALUES('cus01', 'hoan','23454675784','24 le loi')";
$sql = "INSERT INTO customer(customerid, customername, customerphone, address)"
        . " VALUES('$_POST[customerid]','$_POST[customername]','$_P111OST[customerphone]','$_POST[address]')";
$stmt = $pdo->prepare($sql);
//$stmt->execute();
 if (is_null($_POST[customerid])) {
   echo "customerid must be not null";
 }
 else
 {
    if($stmt->execute() == TRUE){
        echo "Record inserted successfully.";
    } else {
        echo "Error inserting record: ";
    }
 }
?>
</body>
</html>
