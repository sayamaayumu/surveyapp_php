<?php
if (!isset($_GET['id'])) {
    exit('IDが指定されていません');
}

$host = 'localhost';
$db = 'surveyapp';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

try {
    $options = [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $pdo = new PDO($dsn, $user, $pass, $options);

    $stmt = $pdo->prepare("DELETE FROM survey_responses WHERE id = ?");
    $stmt->execute([$_GET['id']]);

    header("Location: admin.php");
    exit;
} catch (PDOException $e) {
    echo 'DBエラー：' . $e->getMessage();
    exit;
}
?>