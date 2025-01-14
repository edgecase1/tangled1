<?php

$host = "127.0.0.1";
$user = "root";
$pass = "elonisgreat";
$dbname = "promodb";
$charset = 'utf8mb4';

try {
    // Create a DSN (Data Source Name)
    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

    // Options for PDO
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Enable exceptions for errors
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch results as associative arrays
        PDO::ATTR_EMULATE_PREPARES   => true,                  // Disable emulation of prepared statements
    ];

} catch (PDOException $e) {
    // Handle connection errors
    echo "Database connection failed: " . $e->getMessage();
}

$date = $_GET['date'];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    $sql = "SELECT * FROM promotions WHERE start_day <= ? AND ? <= end_day"; 
    //$pdo->query('SET NAMES gbk');
    //$pdo->query($sql);
    //$var = "\xbf\x27 OR 1=1 /*";
    $stmt = $pdo->prepare($sql);
    //$stmt->bindValue(1, $date);
    //$stmt->bindValue(2, $date);
    $stmt->execute(array($date, $date));
    //$stmt->execute();
    while ($row = $stmt->fetch()) {
        echo "ID: " . $row['id'] . "<br>";
        echo "text: " . $row['text'] . "<br>";
    }
} catch (PDOException $e) {
    // Handle connection errors
    echo "Database connection failed: " . $e->getMessage();
}

?>