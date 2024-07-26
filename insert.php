<?php
session_start();
require_once 'funcs.php';
loginCheck();

// ファイルアップロード処理
$upload_dir = 'uploads/';
$upload_file = $upload_dir . basename($_FILES['image']['name']);
$image_path = '';

if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_file)) {
    $image_path = $upload_file;
} else {
    echo "ファイルアップロードに失敗しました。";
    exit;
}

// データベース接続
$pdo = db_conn();

// データ挿入
$sql = "INSERT INTO conditions (user_id, kanso, tekari, nikibi, shimi, shiwa, tarumi, keana, kuma, content, image_path, indate) 
        VALUES (:user_id, :kanso, :tekari, :nikibi, :shimi, :shiwa, :tarumi, :keana, :kuma, :content, :image_path, sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
$stmt->bindValue(':kanso', isset($_POST['kanso']) ? 1 : 0, PDO::PARAM_INT);
$stmt->bindValue(':tekari', isset($_POST['tekari']) ? 1 : 0, PDO::PARAM_INT);
$stmt->bindValue(':nikibi', isset($_POST['nikibi']) ? 1 : 0, PDO::PARAM_INT);
$stmt->bindValue(':shimi', isset($_POST['shimi']) ? 1 : 0, PDO::PARAM_INT);
$stmt->bindValue(':shiwa', isset($_POST['shiwa']) ? 1 : 0, PDO::PARAM_INT);
$stmt->bindValue(':tarumi', isset($_POST['tarumi']) ? 1 : 0, PDO::PARAM_INT);
$stmt->bindValue(':keana', isset($_POST['keana']) ? 1 : 0, PDO::PARAM_INT);
$stmt->bindValue(':kuma', isset($_POST['kuma']) ? 1 : 0, PDO::PARAM_INT);
$stmt->bindValue(':content', $_POST['content'], PDO::PARAM_STR);
$stmt->bindValue(':image_path', $image_path, PDO::PARAM_STR);

$status = $stmt->execute();

if ($status == false) {
    sql_error($stmt);
} else {
    redirect('select.php');
}
?>
