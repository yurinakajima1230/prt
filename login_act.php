<?php
session_start();
require_once 'funcs.php';
$pdo = db_conn();

$lid = $_POST['lid'];
$lpw = $_POST['lpw'];

$sql = "SELECT * FROM users WHERE login_id = :lid AND life_flg = 0";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    sql_error($stmt);
}

$val = $stmt->fetch();

if ($val && password_verify($lpw, $val['login_pw'])) {
    $_SESSION['chk_ssid'] = session_id();
    $_SESSION['user_id'] = $val['id'];
    $_SESSION['user_name'] = $val['user_name'];
    redirect('index.php');
} else {
    redirect('login.php');
}

if ($val) {
    if (password_verify($lpw, $val['login_pw'])) {
        echo 'ログイン成功';
        $_SESSION['chk_ssid'] = session_id();
        $_SESSION['user_id'] = $val['id'];
        $_SESSION['user_name'] = $val['user_name'];
        redirect('index.php');
    } else {
        echo 'パスワードが一致しません';
        redirect('login.php');
    }
} else {
    echo 'ユーザーが見つかりません';
    redirect('login.php');
}

?>
