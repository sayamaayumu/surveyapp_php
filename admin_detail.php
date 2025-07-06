<?php
$host = 'localhost';
$db = 'migal_surveyapp';
$user = 'migal_surveyuser';
$pass = 'yayoi0107';
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

        .response-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff0f5;
            border: 1px solid #ffd1e1;
            border-radius: 10px;
            padding: 1em;
            margin-bottom: 1em;
            box-shadow: 0 0 5px rgba(0,0,0,0.05);
            cursor: pointer;
        }

        .response-content {
            display: flex;
            flex-direction: column;
            font-size: 14px;
        }

        .response-meta {
            font-size: 12px;
            color: #555;
            margin-top: 0.3em;
        }

        .delete-btn {
            background-color: #ff6681;
            border: none;
            color: white;
            padding: 0.4em 0.7em;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            margin-left: 1em;
            white-space: nowrap;
        }

        .empty-msg {
            text-align: center;
            color: #d63384;
            font-weight: bold;
            margin-top: 2em;
        }

        @media (max-width: 600px) {
            .response-box {
                flex-direction: row;
                align-items: center;
            }
        }
    </style>
    <script>
        function confirmDelete(event, id) {
            event.stopPropagation();
            if (confirm("本当に削除しますか？")) {
                window.location.href = 'delete.php?id=' + id;
            }
        }
    </script>
</head>
<body>
    <h2>アンケート回答一覧</h2>

    <?php if (count($responses) > 0): ?>
        <?php foreach ($responses as $index => $res): ?>
            <div class="response-box" onclick="window.location.href='admin_detail.php?id=<?= $res['id'] ?>'">
                <div class="response-content">
                    <div><strong>#<?= $index + 1 ?></strong> <?= htmlspecialchars($res['name'] ?? '') ?> / <?= htmlspecialchars($res['email'] ?? '') ?></div>
                    <div class="response-meta"><?= htmlspecialchars($res['submitted_at'] ?? '') ?></div>
                </div>
                <button class="delete-btn" onclick="confirmDelete(event, <?= $res['id'] ?>)">削除</button>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="empty-msg">回答が空です</div>
    <?php endif; ?>
</body>
</html>