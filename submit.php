<?php
// DB接続情報（変更なし）
$host = '127.0.0.1';
$port = '3306';
$db   = 'surveyapp';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

// エラーメッセージ出す
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 入力値取得（変更なし）
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$birthdate = $_POST['birthdate'] ?? null;
if ($birthdate === ''){
    $birthdate = null;
}
$note = $_POST['note'] ?? '';
function normalize($arr) {
    return implode(',', array_map(function($v){ return trim($v); }, $arr));
}

$choices1 = isset($_POST['choices1']) ? normalize($_POST['choices1']) : '';
$choices2 = isset($_POST['choices2']) ? normalize($_POST['choices2']) : '';
$choices3 = isset($_POST['choices3']) ? normalize($_POST['choices3']) : '';
$choices4 = isset($_POST['choices4']) ? normalize($_POST['choices4']) : '';
$choices5 = isset($_POST['choices5']) ? normalize($_POST['choices5']) : '';
$charset = 'utf8mb4';
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
try {
    $options = [
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

$pdo = new PDO($dsn, $user, $pass, $options);

    $sql = "INSERT INTO survey_responses (name, email, birthdate, note, choices1, choices2, choices3, choices4, choices5) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $email, $birthdate, $note, $choices1, $choices2, $choices3, $choices4, $choices5]);
    // メール送信
$to = 'lymph.salon.u@gmail.com';
$subject = '【アンケート通知】新しい回答が送信されました';
$body = "アンケートが送信されました。\n\n";
$body .= "●氏名: {$name}\n";
$body .= "●メール: {$email}\n";
$body .= "●生年月日: {$birthdate}\n";
$body .= "●ご相談内容:\n{$note}\n";

$headers = 'From: Kouyadoufu08292002@gmail.com'; // 任意（必要に応じて変更）

// 日本語メールを使う設定
mb_language("Japanese");
mb_internal_encoding("UTF-8");

// メール送信（エラーハンドリングは省略）
$success = mb_send_mail($to, $subject, $body, $headers);
if ($success) {
    echo "メール送信成功";
}else{
    echo "メール送信失敗";
}

} catch (PDOException $e) {
    echo 'DBエラー: ' . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>送信完了</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { 
            font-family: sans-serif; 
            text-align: center; 
            background-color: #fff; 
            margin-top: 5em;
        }
        .completion-box {
            background-color: #ffe6f0;
            border-radius: 8px;
            padding: 2em;
            display: inline-block;
        }
        h2 { 
            color: #d63384; 
            margin-bottom: 0.5em;
        }
        p {
            font-size: 1em;
        }
        .btn-top {
            display: inline-block;
            margin-top: 1em;
            padding: 0.5em 1em;
            background-color: pink;
            color: black;
            border-radius: 4px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="completion-box">
        <h2>送信完了</h2>
        <p>アンケートの送信が完了しました。<br>ご協力ありがとうございました。</p>
</body>
</html>