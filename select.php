<?php
session_start();
require_once 'funcs.php';
loginCheck();

// データベース接続
$pdo = db_conn();
$sql = "SELECT * FROM conditions WHERE user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
$status = $stmt->execute();

$view = '';
if ($status == false) {
    sql_error($stmt);
} else {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<p>';
        $view .= '乾燥: ' . ($row['kanso'] ? '有' : '無') . '<br>';
        $view .= 'テカり: ' . ($row['tekari'] ? '有' : '無') . '<br>';
        $view .= 'ニキビ: ' . ($row['nikibi'] ? '有' : '無') . '<br>';
        $view .= 'シミ: ' . ($row['shimi'] ? '有' : '無') . '<br>';
        $view .= 'シワ: ' . ($row['shiwa'] ? '有' : '無') . '<br>';
        $view .= 'たるみ: ' . ($row['tarumi'] ? '有' : '無') . '<br>';
        $view .= '毛穴: ' . ($row['keana'] ? '有' : '無') . '<br>';
        $view .= 'クマ: ' . ($row['kuma'] ? '有' : '無') . '<br>';
        $view .= 'コメント: ' . htmlspecialchars($row['content']) . '<br>';
        $view .= '日付: ' . htmlspecialchars($row['indate']) . '<br>'; // 日付を表示
        if ($row['image_path']) {
            $view .= '<img src="' . htmlspecialchars($row['image_path']) . '" width="100"><br>';
        }
        $view .= '</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ表示</title>
    <link rel="stylesheet" href="css/common.css" />
</head>

<body>
    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="index.php">戻る</a></div>
                <div class="navbar-header"><a class="navbar-brand" href="logout.php">ログアウト</a></div>
                <div class="navbar-header user-name"><p><?= $_SESSION['user_name'] ?></p></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <div class="container">
        <?= $view ?>
    </div>
    <!-- Main[End] -->

</body>

</html>
