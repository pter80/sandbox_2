<?php
$pdo = new PDO("mysql:host=localhost;dbname=BTS", 'pter_root', 'plopplip');
$pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

$unbufferedResult = $pdo->query("SELECT * FROM users");
foreach ($unbufferedResult as $row) {
    echo "<p>" . 
        $row['nom'] .
        '<img src="data:image/png;base64,'.base64_encode($row['avatar']).'"/>' .
    "</p>";
}