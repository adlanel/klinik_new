<?php
// Fix fasilitas table script
require_once 'vendor/autoload.php';

// Load environment variables from .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Database connection parameters from .env
$host = $_ENV['DB_HOST'];
$database = $_ENV['DB_DATABASE'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];

// Connect to the database
try {
    $pdo = new PDO("mysql:host={$host};dbname={$database}", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get the current table structure
    $sql = "DESCRIBE fasilitas";
    $stmt = $pdo->query($sql);
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h2>Current fasilitas table structure:</h2>";
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
    
    foreach ($columns as $column) {
        echo "<tr>";
        echo "<td>{$column['Field']}</td>";
        echo "<td>{$column['Type']}</td>";
        echo "<td>{$column['Null']}</td>";
        echo "<td>{$column['Key']}</td>";
        echo "<td>{$column['Default']}</td>";
        echo "<td>{$column['Extra']}</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    
    echo "<h2>Modifying table structure...</h2>";
    
    // First, drop the primary key if it exists
    try {
        $sql = "ALTER TABLE fasilitas DROP PRIMARY KEY";
        $pdo->exec($sql);
        echo "Successfully removed existing primary key.<br>";
    } catch (PDOException $e) {
        echo "No primary key found or couldn't be dropped: {$e->getMessage()}<br>";
    }
    
    // Now modify the id column to be auto_increment
    try {
        $sql = "ALTER TABLE fasilitas MODIFY id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY";
        $pdo->exec($sql);
        echo "Successfully modified id column to be auto_increment.<br>";
    } catch (PDOException $e) {
        echo "Error modifying id column: {$e->getMessage()}<br>";
        
        // Try an alternate approach if that failed
        try {
            $sql = "ALTER TABLE fasilitas MODIFY id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT";
            $pdo->exec($sql);
            $sql = "ALTER TABLE fasilitas ADD PRIMARY KEY (id)";
            $pdo->exec($sql);
            echo "Successfully added auto_increment and primary key using alternate method.<br>";
        } catch (PDOException $e2) {
            echo "Error with alternate approach: {$e2->getMessage()}<br>";
        }
    }
    
    // Show the updated table structure
    $sql = "DESCRIBE fasilitas";
    $stmt = $pdo->query($sql);
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h2>Updated fasilitas table structure:</h2>";
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
    
    foreach ($columns as $column) {
        echo "<tr>";
        echo "<td>{$column['Field']}</td>";
        echo "<td>{$column['Type']}</td>";
        echo "<td>{$column['Null']}</td>";
        echo "<td>{$column['Key']}</td>";
        echo "<td>{$column['Default']}</td>";
        echo "<td>{$column['Extra']}</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    
    echo "<p>Process completed. You can now <a href='/klinik/public/admin/content/fasilitas/create'>go back to create a fasilitas</a>.</p>";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "<br>";
    echo "Please contact your administrator.";
}