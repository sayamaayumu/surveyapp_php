<?php
function esc($str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}

function hidden_array($name, $values) {
    foreach ($values as $v) {
        echo "<input type='hidden' name='{$name}[]' value='" . esc($v) . "'>\n";
    }
}

$name = esc($_POST['name'] ?? '');
$email = esc($_POST['email'] ?? '');
$birthdate = esc($_POST['birthdate'] ?? '');
$note = esc($_POST['note'] ?? '');

$choices1 = $_POST['choices1'] ?? [];
$choices2 = $_POST['choices2'] ?? [];
$choices3 = $_POST['choices3'] ?? [];
$choices4 = $_POST['choices4'] ?? [];
$choices5 = $_POST['choices5'] ?? [];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ご入力内容の確認</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 2em;
            background-color: #fff0f5;
        }
        .container {
            background-color: #fff;
            padding: 1.5em;
            border-radius: 15px;
            max-width: 500px;
            margin: 2em auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        h2 {
            color: #d63384;
            text-align: center;
            margin-bottom: 1em;
        }
        .field {
            margin-bottom: 1em;
        }
        .label {
            font-weight: bold;
            color: #d63384;
        }
        .value {
            margin-top: 0.3em;
            border-bottom: 1px solid #ddd;
            padding-bottom: 0.5em;
        }
        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 2em;
        }
        .btn {
            flex: 1;
            padding: 0.8em 0;
            border: none;
            border-radius: 8px;
            font-size: 1em;
            color: #fff;
            cursor: pointer;
            margin: 0 0.3em;
        }
        .btn-back { background-color: #ccc; color: #000; }
        .btn-edit { background-color: #28a745; }
        .btn-submit { background-color: #d63384; }
    </style>
</head>
<body>
    <form action="submit.php" method="post">
        <div class="container">
            <h2>ご入力内容の確認</h2>

            <div class="field">
                <div class="label">お名前：</div>
                <div class="value"><?= $name ?></div>
            </div>
            <div class="field">
                <div class="label">メール：</div>
                <div class="value"><?= $email ?></div>
            </div>
            <div class="field">
                <div class="label">生年月日：</div>
                <div class="value"><?= $birthdate ?></div>
            </div>
            <div class="field">
                <div class="label">ご相談欄：</div>
                <div class="value"><?= nl2br($note) ?></div>
            </div>

            <!-- hiddenで全データ送信 -->
            <input type="hidden" name="name" value="<?= $name ?>">
            <input type="hidden" name="email" value="<?= $email ?>">
            <input type="hidden" name="birthdate" value="<?= $birthdate ?>">
            <input type="hidden" name="note" value="<?= $note ?>">
            <?php
                hidden_array('choices1', $choices1);
                hidden_array('choices2', $choices2);
                hidden_array('choices3', $choices3);
                hidden_array('choices4', $choices4);
                hidden_array('choices5', $choices5);
            ?>

            <div class="buttons">
                <button type="button" class="btn btn-back" onclick="location.href='page5.php'">戻る</button>
                <button type="submit" formaction="survey.php" class="btn btn-edit" name="back_from_confirm" value="1">編集する</button>
                <button type="submit" class="btn btn-submit">送信</button>
            </div>
        </div>
    </form>
</body>
</html>