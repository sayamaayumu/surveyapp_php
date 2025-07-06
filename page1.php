<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>自律神経系 未病タイプ</title>
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
    <h2>自律神経系 未病タイプ</h2>

    <?php
    function esc($val) {
        return htmlspecialchars($val ?? '', ENT_QUOTES, 'UTF-8');
    }
    function hidden_array($name, $values) {
        foreach ($values as $val) {
            $safe = esc($val);
            echo "<input type='hidden' name='{$name}[]' value='{$safe}'>\n";
        }
    }

    // 個人情報受け取り
    $name = esc($_POST['name'] ?? '');
    $email = esc($_POST['email'] ?? '');
    $birthdate = esc($_POST['birthdate'] ?? '');
    $note = esc($_POST['note'] ?? '');

    // 過去の選択肢受け取り
    $choices2 = $_POST['choices2'] ?? [];
    $choices3 = $_POST['choices3'] ?? [];
    $choices4 = $_POST['choices4'] ?? [];
    $choices5 = $_POST['choices5'] ?? [];
    ?>

    <form action="page2.php" method="post">
   <div class="question-box">
    <div class="checkbox-group">
        <label><input type="checkbox" name="choices1[]" value="肉類をよく食べる" <?= in_array('肉類をよく食べる', $_POST['choices1'] ?? []) ? 'checked' : '' ?>> 肉類をよく食べる</label>
        <label><input type="checkbox" name="choices1[]" value="コーヒーを1日5杯以上飲む" <?= in_array('コーヒーを1日5杯以上飲む', $_POST['choices1'] ?? []) ? 'checked' : '' ?>> コーヒーを1日5杯以上飲む</label>
        <label><input type="checkbox" name="choices1[]" value="いつも時間に追われている" <?= in_array('いつも時間に追われている', $_POST['choices1'] ?? []) ? 'checked' : '' ?>> いつも時間に追われている</label>
        <label><input type="checkbox" name="choices1[]" value="リラックスすることができない" <?= in_array('リラックスすることができない', $_POST['choices1'] ?? []) ? 'checked' : '' ?>> リラックスすることができない</label>
        <label><input type="checkbox" name="choices1[]" value="自分がやらないと回らないと思う" <?= in_array('自分がやらないと回らないと思う', $_POST['choices1'] ?? []) ? 'checked' : '' ?>> 自分がやらないと回らないと思う</label>
        <label><input type="checkbox" name="choices1[]" value="コツコツ積み重ねることが好きだ" <?= in_array('コツコツ積み重ねることが好きだ', $_POST['choices1'] ?? []) ? 'checked' : '' ?>> コツコツ積み重ねることが好きだ</label>
        <label><input type="checkbox" name="choices1[]" value="パソコンやスマホを長時間使用する" <?= in_array('パソコンやスマホを長時間使用する', $_POST['choices1'] ?? []) ? 'checked' : '' ?>> パソコンやスマホを長時間使用する</label>
        <label><input type="checkbox" name="choices1[]" value="背中に吹き出物が出やすい" <?= in_array('背中に吹き出物が出やすい', $_POST['choices1'] ?? []) ? 'checked' : '' ?>> 背中に吹き出物が出やすい</label>
        <label><input type="checkbox" name="choices1[]" value="日常で呼吸が浅い" <?= in_array('日常で呼吸が浅い', $_POST['choices1'] ?? []) ? 'checked' : '' ?>> 日常で呼吸が浅い</label>
        <label><input type="checkbox" name="choices1[]" value="寝つきが悪い" <?= in_array('寝つきが悪い', $_POST['choices1'] ?? []) ? 'checked' : '' ?>> 寝つきが悪い</label>
    </div>
</div>
        <!-- hiddenで個人情報とchoices2〜5を引き継ぎ -->
        <input type="hidden" name="name" value="<?= $name ?>">
        <input type="hidden" name="email" value="<?= $email ?>">
        <input type="hidden" name="birthdate" value="<?= $birthdate ?>">
        <input type="hidden" name="note" value="<?= $note ?>">

        <?php
            hidden_array('choices2', $choices2);
            hidden_array('choices3', $choices3);
            hidden_array('choices4', $choices4);
            hidden_array('choices5', $choices5);
        ?>

        <div class="button-area">
            <button type="button" class="btn-back" onclick="location.href='survey.php'">戻る</button>
            <button type="submit" class="btn-next">次へ</button>
        </div>
    </form>
</body>
</html>