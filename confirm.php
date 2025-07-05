<?php
// エスケープ関数
function esc($str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}

// 配列を hidden input に出力
function hidden_array($name, $values) {
    foreach ($values as $v) {
        $safe = esc($v);
        echo "<input type='hidden' name='{$name}[]' value='{$safe}'>\n";
    }
}

// POSTデータ受け取り
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
    <title>確認画面</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: sans-serif; margin: 1em; }
        h2 { text-align: center; color: #d63384; }
        .section { background: #ffe6f0; padding: 1em; margin-bottom: 1em; border-radius: 8px; }
        .button-area {
            display: flex;
            justify-content: space-between;
            margin-top: 2em;
        }
        button {
            padding: 0.6em 1.5em;
            font-size: 1em;
            border: none;
            border-radius: 4px;
        }
        .btn-edit { background-color: green; color: white; }
        .btn-submit { background-color: pink; }
        ul { margin: 0.5em 0 0 1em; }
    </style>
</head>
<body>
    <h2>入力内容の確認</h2>

    <form action="submit.php" method="post">
        <div class="section">
            <strong>お名前：</strong><?= $name ?><br>
            <strong>メール：</strong><?= $email ?><br>
            <strong>生年月日：</strong><?= $birthdate ?><br>
            <strong>ご相談欄：</strong><br><?= nl2br($note) ?>
        </div>

        <div class="section">
            <strong>自律神経系:</strong>
            <ul><?php foreach ($choices1 as $c) echo '<li>' . esc($c) . '</li>'; ?></ul>

            <strong>ホルモン系:</strong>
            <ul><?php foreach ($choices2 as $c) echo '<li>' . esc($c) . '</li>'; ?></ul>

            <strong>骨・筋肉・関節系:</strong>
            <ul><?php foreach ($choices3 as $c) echo '<li>' . esc($c) . '</li>'; ?></ul>

            <strong>血管系:</strong>
            <ul><?php foreach ($choices4 as $c) echo '<li>' . esc($c) . '</li>'; ?></ul>

            <strong>腸系:</strong>
            <ul><?php foreach ($choices5 as $c) echo '<li>' . esc($c) . '</li>'; ?></ul>
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

        <div class="button-area">
            <button type="submit" formaction="survey.php" class="btn-edit" name="back_from_confirm" value="1">編集する</button>
            <button type="submit" class="btn-submit">送信</button>
        </div>
    </form>
</body>
</html>