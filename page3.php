<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>骨・筋肉・関節系 未病タイプ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: sans-serif; margin: 1em; }
        h2 { text-align: center; color: #d63384; }
        .question-box { background: #ffe6f0; padding: 1em; border-radius: 8px; }
        .checkbox-group { margin-top: 1em; }
        .checkbox-group label { display: block; margin-bottom: 0.5em; }
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
    <h2>骨・筋肉・関節系 未病タイプ</h2>

    <?php
    function esc($v) {
        return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8');
    }
    function hidden_array($name, $values) {
        foreach ((array)$values as $v) {
            echo "<input type='hidden' name='{$name}[]' value='" . esc($v) . "'>\n";
        }
    }

    // 個人情報
    $name = esc($_POST['name'] ?? '');
    $email = esc($_POST['email'] ?? '');
    $birthdate = esc($_POST['birthdate'] ?? '');
    $note = esc($_POST['note'] ?? '');

    // 過去の選択肢
    $choices1 = $_POST['choices1'] ?? [];
    $choices2 = $_POST['choices2'] ?? [];
    ?>

    <form action="page4.php" method="post">
        <div class="question-box">
            <div class="checkbox-group">
                <label><input type="checkbox" name="choices3[]" value="食品添加物を気にしていない"> 食品添加物を気にしていない</label>
                <label><input type="checkbox" name="choices3[]" value="菓子パンやケーキ類が好きだ"> 菓子パンやケーキ類が好きだ</label>
                <label><input type="checkbox" name="choices3[]" value="焼き魚・生魚より焼肉・鶏肉をよく食べる"> 焼き魚・生魚より焼肉・鶏肉をよく食べる</label>
                <label><input type="checkbox" name="choices3[]" value="頑固な方だと思う"> 頑固な方だと思う</label>
                <label><input type="checkbox" name="choices3[]" value="少し体調を崩すとすごく落ち込む"> 少し体調を崩すとすごく落ち込む</label>
                <label><input type="checkbox" name="choices3[]" value="思いついたらすぐ行動する方だ"> 思いついたらすぐ行動する方だ</label>
                <label><input type="checkbox" name="choices3[]" value="脱力ができない"> 脱力ができない</label>
                <label><input type="checkbox" name="choices3[]" value="同じ姿勢で過ごすことが多い"> 同じ姿勢で過ごすことが多い</label>
                <label><input type="checkbox" name="choices3[]" value="あまり風邪を引かない"> あまり風邪を引かない</label>
                <label><input type="checkbox" name="choices3[]" value="前屈をして手が床につかない"> 前屈をして手が床につかない</label>
            </div>
        </div>

        <!-- hidden：個人情報 -->
        <input type="hidden" name="name" value="<?= $name ?>">
        <input type="hidden" name="email" value="<?= $email ?>">
        <input type="hidden" name="birthdate" value="<?= $birthdate ?>">
        <input type="hidden" name="note" value="<?= $note ?>">

        <!-- hidden：過去の選択肢 -->
        <?php
            hidden_array('choices1', $choices1);
            hidden_array('choices2', $choices2);
        ?>

        <div class="button-area">
            <button type="button" class="btn-back" onclick="location.href='page2.php'">戻る</button>
            <button type="submit" class="btn-next">次へ</button>
        </div>
    </form>
</body>
</html>