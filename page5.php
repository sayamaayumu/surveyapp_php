<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>腸系 未病タイプ</title>
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
    <h2>腸系 未病タイプ</h2>

    <?php
    function esc($v) {
        return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8');
    }
    function hidden_array($name, $values) {
        foreach ((array)$values as $v) {
            echo "<input type='hidden' name='{$name}[]' value='" . esc($v) . "'>\n";
        }
    }

    // 個人情報と過去のチェック内容を受け取る
    $name = esc($_POST['name'] ?? '');
    $email = esc($_POST['email'] ?? '');
    $birthdate = esc($_POST['birthdate'] ?? '');
    $note = esc($_POST['note'] ?? '');

    $choices1 = $_POST['choices1'] ?? [];
    $choices2 = $_POST['choices2'] ?? [];
    $choices3 = $_POST['choices3'] ?? [];
    $choices4 = $_POST['choices4'] ?? [];
    ?>

    <form action="confirm.php" method="post">
     <div class="question-box">
    <div class="checkbox-group">
        <label><input type="checkbox" name="choices5[]" value="常にアイスクリームのストックがある"
            <?= in_array('常にアイスクリームのストックがある', $_POST['choices5'] ?? []) ? 'checked' : '' ?>> 常にアイスクリームのストックがある</label>

        <label><input type="checkbox" name="choices5[]" value="食物繊維をあまり食べない"
            <?= in_array('食物繊維をあまり食べない', $_POST['choices5'] ?? []) ? 'checked' : '' ?>> 食物繊維をあまり食べない</label>

        <label><input type="checkbox" name="choices5[]" value="ファーストフードによく行く"
            <?= in_array('ファーストフードによく行く', $_POST['choices5'] ?? []) ? 'checked' : '' ?>> ファーストフードによく行く</label>

        <label><input type="checkbox" name="choices5[]" value="自分の意見を言うのが苦手だ"
            <?= in_array('自分の意見を言うのが苦手だ', $_POST['choices5'] ?? []) ? 'checked' : '' ?>> 自分の意見を言うのが苦手だ</label>

        <label><input type="checkbox" name="choices5[]" value="ストレスに感じることが多い"
            <?= in_array('ストレスに感じることが多い', $_POST['choices5'] ?? []) ? 'checked' : '' ?>> ストレスに感じることが多い</label>

        <label><input type="checkbox" name="choices5[]" value="常にどこかに具合の悪さを感じている"
            <?= in_array('常にどこかに具合の悪さを感じている', $_POST['choices5'] ?? []) ? 'checked' : '' ?>> 常にどこかに具合の悪さを感じている</label>

        <label><input type="checkbox" name="choices5[]" value="シャワーで済ませることが多い"
            <?= in_array('シャワーで済ませることが多い', $_POST['choices5'] ?? []) ? 'checked' : '' ?>> シャワーで済ませることが多い</label>

        <label><input type="checkbox" name="choices5[]" value="座って作業することが多い"
            <?= in_array('座って作業することが多い', $_POST['choices5'] ?? []) ? 'checked' : '' ?>> 座って作業することが多い</label>

        <label><input type="checkbox" name="choices5[]" value="肌が荒れやすい"
            <?= in_array('肌が荒れやすい', $_POST['choices5'] ?? []) ? 'checked' : '' ?>> 肌が荒れやすい</label>

        <label><input type="checkbox" name="choices5[]" value="よく下半身がむくむ"
            <?= in_array('よく下半身がむくむ', $_POST['choices5'] ?? []) ? 'checked' : '' ?>> よく下半身がむくむ</label>
    </div>
</div>
        <!-- hidden：個人情報 -->
        <input type="hidden" name="name" value="<?= $name ?>">
        <input type="hidden" name="email" value="<?= $email ?>">
        <input type="hidden" name="birthdate" value="<?= $birthdate ?>">
        <input type="hidden" name="note" value="<?= $note ?>">

        <!-- hidden：過去のチェック内容 -->
        <?php
            hidden_array('choices1', $choices1);
            hidden_array('choices2', $choices2);
            hidden_array('choices3', $choices3);
            hidden_array('choices4', $choices4);
        ?>

        <div class="button-area">
            <button type="button" class="btn-back" onclick="location.href='page4.php'">戻る</button>
            <button type="submit" class="btn-next">確認画面へ</button>
        </div>
    </form>
</body>
</html>