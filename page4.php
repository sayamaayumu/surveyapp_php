<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>血管系 未病タイプ</title>
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
    <h2>血管系 未病タイプ</h2>

    <?php
    function esc($v) {
        return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8');
    }
    function hidden_array($name, $values) {
        foreach ((array)$values as $v) {
            echo "<input type='hidden' name='{$name}[]' value='" . esc($v) . "'>\n";
        }
    }

    // 個人情報と過去の選択肢
    $name = esc($_POST['name'] ?? '');
    $email = esc($_POST['email'] ?? '');
    $birthdate = esc($_POST['birthdate'] ?? '');
    $note = esc($_POST['note'] ?? '');

    $choices1 = $_POST['choices1'] ?? [];
    $choices2 = $_POST['choices2'] ?? [];
    $choices3 = $_POST['choices3'] ?? [];
    ?>

    <form action="page5.php" method="post">
        <div class="question-box">
            <div class="checkbox-group">
                <label><input type="checkbox" name="choices4[]" value="甘いものまたはお酒を好む"> 甘いものまたはお酒を好む</label>
                <label><input type="checkbox" name="choices4[]" value="1日に飲む水の量がコップ1杯程度だ"> 1日に飲む水の量がコップ1杯程度だ</label>
                <label><input type="checkbox" name="choices4[]" value="生野菜や果物を食べない日がある"> 生野菜や果物を食べない日がある</label>
                <label><input type="checkbox" name="choices4[]" value="油っこいものをよく食べる"> 油っこいものをよく食べる</label>
                <label><input type="checkbox" name="choices4[]" value="人の意見と衝突することが多い"> 人の意見と衝突することが多い</label>
                <label><input type="checkbox" name="choices4[]" value="よく人をまとめる立場になることが多い"> よく人をまとめる立場になることが多い</label>
                <label><input type="checkbox" name="choices4[]" value="自分の代わりは誰もいないと思う"> 自分の代わりは誰もいないと思う</label>
                <label><input type="checkbox" name="choices4[]" value="色んな役割をこなすことが得意"> 色んな役割をこなすことが得意</label>
                <label><input type="checkbox" name="choices4[]" value="睡眠時間が短い"> 睡眠時間が短い</label>
                <label><input type="checkbox" name="choices4[]" value="目がよく乾燥したり充血する"> 目がよく乾燥したり充血する</label>
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
        ?>

        <div class="button-area">
            <button type="button" class="btn-back" onclick="location.href='page3.php'">戻る</button>
            <button type="submit" class="btn-next">次へ</button>
        </div>
    </form>
</body>
</html>