<?php
// DB接続設定
$host = 'localhost';
$db = 'surveyapp';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';
ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    $options = [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $pdo = new PDO($dsn, $user, $pass, $options);

    $stmt = $pdo->query("SELECT * FROM survey_responses ORDER BY submitted_at DESC");
    $responses = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'DBエラー：' . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理者ページ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: sans-serif; padding: 1em; background: #fff; }
        h2 { text-align: center; color: #d63384; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1em;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 0.7em;
            text-align: left;
        }
        th { background-color: #ffe6f0; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        tr:hover { background-color: #f1f1f1; cursor: pointer; }
        .delete-btn {
            background-color: #ff6681;
            border: none;
            color: white;
            padding: 0.3em 0.6em;
            border-radius: 5px;
            cursor: pointer;
        }
        @media (max-width: 600px) {
            td, th { font-size: 14px; }
        }
    </style>
    <script>
        function confirmDelete(event, id) {
            event.stopPropagation(); // 行クリックイベントを防ぐ
            if (confirm("本当に削除しますか？")) {
                window.location.href = 'delete.php?id=' + id;
            }
        }
    </script>
</head>
<body>
    <h2>アンケート回答一覧</h2>
    <?php if (count($responses) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>氏名</th>
                    <th>メール</th>
                    <th>生年月日</th>
                    <th>送信日時</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($responses as $res): ?>
                    <tr onclick="window.location.href='admin_detail.php?id=<?= $res['id'] ?>'">
                        <td><?= htmlspecialchars($res['name']) ?></td>
                        <td><?= htmlspecialchars($res['email']) ?></td>
                        <td><?= htmlspecialchars($res['birthdate']) ?></td>
                        <td><?= isset($res['submitted_at']) && $res['submitted_at'] !== null ? htmlspecialchars($res['submitted_at']) : '' ?></td>
                        <td>
                            <button class="delete-btn" onclick="confirmDelete(event, <?= $res['id'] ?>)">削除</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>回答が空です</p>
    <?php endif; ?>
</body>
</html>