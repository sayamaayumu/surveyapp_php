<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// ここから元の処理
$id = $_GET['id'];

// --- DB接続 ---
$host = 'localhost';
$db   = 'surveyapp';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// --- normalize関数（先に定義すること）---
function normalizeCheckboxValue($value) {
    // 半角・全角スペース、改行・タブをすべて削除
    return preg_replace('/[\s\x{3000}]+/u', '', trim($value));
}

// --- チェックボックス描画関数 ---
function renderCheckboxes($label, $allOptions, $selectedCsv) {
    $selected = array_map('normalizeCheckboxValue', explode(',', $selectedCsv));

    echo "<h3>$label</h3><div class='checkbox-group'>";
    foreach ($allOptions as $option) {
        $normalizedOption = normalizeCheckboxValue($option);
        $checked = in_array($normalizedOption, $selected) ? 'checked' : '';
        echo "<label><input type='checkbox' disabled $checked> $option</label>";
    }
    echo "</div>";
}

// --- 回答データ取得 ---
$id = $_GET['id'] ?? null;
if (!$id) {
    echo "IDが指定されていません";
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM survey_responses WHERE id = ?");
$stmt->execute([$id]);
$response = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$response) {
    echo "データが見つかりません";
    exit;
}

// --- 各ページの選択肢 ---
$options1 = ["肉類をよく食べる","コーヒーを1日5杯以上飲む","いつも時間に追われている","いつリラックスすることができない","自分がやらないと回らないと思う","コツコツ積み重ねることが好きだ","パソコンやスマホを長時間使用する","背中に吹き出物が出やすい","日常で呼吸が浅い","寝つきが悪い"];
$options2 = ["和菓子より洋菓子が好き","冷たいものが好き","薬をよく飲む方だ","人の顔色が気になる","落ち込みやすい","人のために何かをすることが好きだ","シャンプーや洗剤は香りで選ぶ","運動をあまりしない","顎の下に吹き出物が出やすい", "鎖骨が出ていない"];
$options3 = ["食品添加物を気にしていない","菓子パンやケーキ類が好きだ","焼き魚・生魚より焼肉・鶏肉をよく食べる","頑固な方だと思う","少し体調を崩すとすごく落ち込む","思いついたらすぐ行動する方だ","脱力ができない","同じ姿勢で過ごすことが多い","あまり風邪を引かない","前屈をして手が床につかない"];
$options4 = ["甘いものまたはお酒を好む","1日に飲む水の量がコップ1杯程度だ","生野菜や果物を食べない日がある","油っこいものをよく食べる","人の意見と衝突することが多い","よく人をまとめる立場になることが多い","自分の代わりは誰もいないと思う","色んな役割をこなすことが得意","睡眠時間が短い","目がよく乾燥したり充血する"];
$options5 = ["常にアイスクリームのストックがある","食物繊維をあまり食べない","ファーストフードによく行く","自分の意見を言うのが苦手だ","ストレスに感じることが多い","常にどこかに具合の悪さを感じている","シャワーで済ませることが多い","座って作業することが多い","肌が荒れやすい","よく下半身がむくむ"];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>回答詳細</title>
    <style>
        body { font-family: sans-serif; padding: 1em; }
        h2 { color: #d63384; text-align: center; }
        .section { background: #ffe6f0; padding: 1em; margin-bottom: 1.5em; border-radius: 8px; }
        .checkbox-group label {
            display: block;
            margin-bottom: 0.4em;
        }
        h3 { margin-top: 0.5em; color: #555; }
        .info {
            margin-bottom: 1em;
        }
        .info label {
            font-weight: bold;
            display: inline-block;
            width: 6em;
        }
    </style>
</head>
<body>
    <h2>アンケート回答の詳細</h2>

    <div class="section info">
        <p><label>氏名:</label> <?= htmlspecialchars($response['name']) ?></p>
        <p><label>メール:</label> <?= htmlspecialchars($response['email']) ?></p>
        <p><label>生年月日:</label> <?= htmlspecialchars($response['birthdate']) ?></p>
        <p><label>備考:</label> <?= nl2br(htmlspecialchars($response['note'])) ?></p>
        <p><label>送信日時:</label> <?= htmlspecialchars($response['submitted_at']) ?></p>
    </div>

    <div class="section">
        <?php renderCheckboxes("自律神経系 未病タイプ", $options1, $response['choices1']); ?>
        <?php renderCheckboxes("ホルモン系 未病タイプ", $options2, $response['choices2']); ?>
        <?php renderCheckboxes("骨・筋肉・関節系 未病タイプ", $options3, $response['choices3']); ?>
        <?php renderCheckboxes("血管系 未病タイプ", $options4, $response['choices4']); ?>
        <?php renderCheckboxes("腸系 未病タイプ", $options5, $response['choices5']); ?>
    </div>
    <div style="text-align: center; margin-top: 30px;">
    <a href="admin.php">
        <button style="padding: 10px 20px; background-color: #ccc; border: none; border-radius: 5px; font-size: 16px;">
            一覧へ戻る
        </button>
    </a>
</div>
</body>
</html>