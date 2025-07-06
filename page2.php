<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ホルモン系 未病タイプ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: sans-serif; margin: 1em; }
        h2 { text-align: center; color: #d63384; }
        .question-box { background: #ffe6f0; padding: 1em; border-radius: 8px; }
        .checkbox-group { margin-top: 1em; }
        .checkbox-group div { margin-bottom: 0.5em; }
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
        .btn-back { background-color: gray; color: white; }
        .btn-next { background-color: pink; }
    </style>
</head>
<body>
    <h2>ホルモン系 未病タイプ</h2>

    <?php
    function esc($v) {
        return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8');
    }
    function hidden_array($name, $values) {
        foreach ((array)$values as $v) {
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

    <form action="page3.php" method="post">
        <div class="question-box">
            <div class="checkbox-group">
                <div><input type="checkbox" name="choices2[]" value="和菓子より洋菓子が好き" <?= in_array("和菓子より洋菓子が好き", $choices2) ? 'checked' : '' ?>> 和菓子より洋菓子が好き</div>
                <div><input type="checkbox" name="choices2[]" value="冷たいものが好き" <?= in_array("冷たいものが好き", $choices2) ? 'checked' : '' ?>> 冷たいものが好き</div>
                <div><input type="checkbox" name="choices2[]" value="薬をよく飲む方だ" <?= in_array("薬をよく飲む方だ", $choices2) ? 'checked' : '' ?>> 薬をよく飲む方だ</div>
                <div><input type="checkbox" name="choices2[]" value="人の顔色が気になる" <?= in_array("人の顔色が気になる", $choices2) ? 'checked' : '' ?>> 人の顔色が気になる</div>
                <div><input type="checkbox" name="choices2[]" value="落ち込みやすい" <?= in_array("落ち込みやすい", $choices2) ? 'checked' : '' ?>> 落ち込みやすい</div>
                <div><input type="checkbox" name="choices2[]" value="人のために何かをすることが好きだ" <?= in_array("人のために何かをすることが好きだ", $choices2) ? 'checked' : '' ?>> 人のために何かをすることが好きだ</div>
                <div><input type="checkbox" name="choices2[]" value="シャンプーや洗剤は香りで選ぶ" <?= in_array("シャンプーや洗剤は香りで選ぶ", $choices2) ? 'checked' : '' ?>> シャンプーや洗剤は香りで選ぶ</div>
                <div><input type="checkbox" name="choices2[]" value="運動をあまりしない" <?= in_array("運動をあまりしない", $choices2) ? 'checked' : '' ?>> 運動をあまりしない</div>
                <div><input type="checkbox" name="choices2[]" value="顎の下に吹き出物が出やすい" <?= in_array("顎の下に吹き出物が出やすい", $choices2) ? 'checked' : '' ?>> 顎の下に吹き出物が出やすい</div>
                <div><input type="checkbox" name="choices2[]" value="鎖骨が出ていない" <?= in_array("鎖骨が出ていない", $choices2) ? 'checked' : '' ?>> 鎖骨が出ていない</div>
            </div>
        </div>

        <!-- hidden：個人情報 -->
        <input type="hidden" name="name" value="<?= $name ?>">
        <input type="hidden" name="email" value="<?= $email ?>">
        <input type="hidden" name="birthdate" value="<?= $birthdate ?>">
        <input type="hidden" name="note" value="<?= $note ?>">

        <!-- hidden：過去の選択 -->
        <?php
            hidden_array('choices1', $choices1);
            hidden_array('choices2', $choices2);
            hidden_array('choices3', $choices3);
            hidden_array('choices4', $choices4);
            hidden_array('choices5', $choices5);
        ?>

        <div class="button-area">
            <button type="button" class="btn-back" onclick="location.href='page1.php'">戻る</button>
            <button type="submit" class="btn-next">次へ</button>
        </div>
    </form>
</body>
</html>