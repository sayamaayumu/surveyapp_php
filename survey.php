<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>アンケート（基本情報）</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: sans-serif; margin: 1em; }
        h2 { text-align: center; color: #d63384; }
        .form-box { background: #ffe6f0; padding: 1em; border-radius: 8px; max-width: 500px; margin: auto; }
        .form-group { margin-bottom: 1em; }
        label { display: block; margin-bottom: 0.4em; font-weight: bold; }
        input, textarea {
            width: 100%; padding: 0.5em; border: 1px solid #ccc; border-radius: 4px;
            box-sizing: border-box;
        }
        .button-area {
            display: flex; justify-content: flex-end; margin-top: 2em;
        }
        button {
            background-color: pink;
            border: none;
            padding: 0.6em 1.5em;
            font-size: 1em;
            border-radius: 4px;
        }

    input, select, textarea {
    font-size: 16px;
}
   
    </style>
</head>
<body>
    <h2>アンケート - 基本情報の入力</h2>

    <?php
    function esc($v) {
        return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8');
    }

    $name = esc($_POST['name'] ?? '');
    $email = esc($_POST['email'] ?? '');
    $birthdate = esc($_POST['birthdate'] ?? '');
    $note = esc($_POST['note'] ?? '');

    $isBackFromConfirm = isset($_POST['back_from_confirm']);
    ?>

    <form action="<?= $isBackFromConfirm ? 'confirm.php' : 'page1.php' ?>" method="post">
        <div class="form-box">
            <div class="form-group">
                <label for="name">お名前(カタカナ)</label>
         <input
  type="text"
  name="name"
  id="name"
  value="<?= isset($name) ? htmlspecialchars($name, ENT_QUOTES) : '' ?>"
  pattern="^[ァ-ヴー\s]+$"
  title="全角カタカナで入力してください"
  required
>
            </div>
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" name="email" id="email" value="<?= $email ?>" required>
            </div>
            <div class="form-group">
                <label for="birthdate">生年月日</label>
                <input type="date" name="birthdate" id="birthdate" value="<?= $birthdate ?>" required>
            </div>
            <div class="form-group">
                <label for="note">ご相談欄</label>
                <textarea name="note" id="note" rows="4"><?= $note ?></textarea>
            </div>

            <!-- hiddenでchoices1〜5を再送（confirmから戻ったときのみ） -->
            <?php if ($isBackFromConfirm): ?>
                <?php
                for ($i = 1; $i <= 5; $i++) {
                    $key = "choices{$i}";
                    if (isset($_POST[$key]) && is_array($_POST[$key])) {
                        foreach ($_POST[$key] as $val) {
                            $safe = esc($val);
                            echo "<input type='hidden' name='{$key}[]' value='{$safe}'>\n";
                        }
                    }
                }
                ?>
                <input type="hidden" name="back_from_confirm" value="1">
            <?php endif; ?>

            <div class="button-area">
                <button type="submit"><?= $isBackFromConfirm ? '確認画面へ' : '次へ' ?></button>
            </div>
        </div>
    </form>
</body>
</html>

<script>
let isComposing = false;

document.getElementById("name").addEventListener("compositionstart", () => {
  isComposing = true;
});

document.getElementById("name").addEventListener("compositionend", (e) => {
  isComposing = false;
  toKatakana(e.target);
});

document.getElementById("name").addEventListener("input", (e) => {
  if (!isComposing) {
    toKatakana(e.target);
  }
});

function toKatakana(el) {
  el.value = el.value.replace(/[\u3041-\u3096]/g, function(ch) {
    return String.fromCharCode(ch.charCodeAt(0) + 0x60);
  });
}
</script>