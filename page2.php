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
    <h2>ホルモン系 未病タイプ</h2>

    <form action="page3.php" method="post">
        <!-- hiddenで前ページの情報をすべて引き継ぐ -->
        <input type="hidden" name="name" value="<?= htmlspecialchars($_POST['name']) ?>">
        <input type="hidden" name="email" value="<?= htmlspecialchars($_POST['email']) ?>">
        <input type="hidden" name="birthdate" value="<?= htmlspecialchars($_POST['birthdate']) ?>">
        <input type="hidden" name="note" value="<?= htmlspecialchars($_POST['note']) ?>">
        <input type="hidden" name="choices1" value="<?= isset($_POST['choices1']) ? implode(',', $_POST['choices1']) : '' ?>">

        <div class="question-box">
            <div class="checkbox-group">
                <label><input type="checkbox" name="choices2[]" value="和菓子より洋菓子が好き"> 和菓子より洋菓子が好き</label>
                <label><input type="checkbox" name="choices2[]" value="冷たいものが好き"> 冷たいものが好き</label>
                <label><input type="checkbox" name="choices2[]" value="薬をよく飲む方だ"> 薬をよく飲む方だ</label>
                <label><input type="checkbox" name="choices2[]" value="人の顔色が気になる"> 人の顔色が気になる</label>
                <label><input type="checkbox" name="choices2[]" value="落ち込みやすい"> 落ち込みやすい</label>
                <label><input type="checkbox" name="choices2[]" value="人のために何かをすることが好きだ"> 人のために何かをすることが好きだ</label>
                <label><input type="checkbox" name="choices2[]" value="シャンプーや洗剤は香りで選ぶ"> シャンプーや洗剤は香りで選ぶ</label>
                <label><input type="checkbox" name="choices2[]" value="運動をあまりしない"> 運動をあまりしない</label>
                <label><input type="checkbox" name="choices2[]" value="顎の下に吹き出物が出やすい"> 顎の下に吹き出物が出やすい</label>
                <label><input type="checkbox" name="choices2[]" value="鎖骨が出ていない"> 鎖骨が出ていない</label>
            </div>
        </div>

        <div class="button-area">
            <button type="button" class="btn-back" onclick="location.href='page1.php'">戻る</button>
            <button type="submit" class="btn-next">次へ</button>
        </div>
    </form>
</body>
</html>