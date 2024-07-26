<?php
function db_conn() {
    try {
        $db_name = "skin_conditions";    // データベース名
        $db_id   = "root";      // アカウント名
        $db_pw   = "";      // パスワード
        $db_host = "localhost"; // DBホスト

        return new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
    } catch (PDOException $e) {
        exit('DB Connection Error:'.$e->getMessage());
    }
}
