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
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=asm2', 'postgres', '123123');
}  else {
     echo '<p>The DB exists</p>';
     echo getenv("dbname");
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
        "host=ec2-34-195-169-25.compute-1.amazonaws.com;port=5432;user=ofkkzlyhrgqvon;password=3ca8b5195671b9be562a825fd29b00e7aceb569b6b920ea40031c0e7ecf222a3;dbname=deooeltd4qvo32",
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

//$stmt->bindParam(':id','1');
//$stmt->bindParam(':name','khoa1');
//$stmt->bindParam(':email', '0987654321');
//$stmt->bindParam(':class', 'danang');
//$stmt->execute();
//$sql = "INSERT INTO customer(customerid, customername, customerphone, address) VALUES('1', 'khoa1','0987654321','danang')";
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
